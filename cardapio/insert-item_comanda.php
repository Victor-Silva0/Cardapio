<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idComanda']))
{
    $id_comanda_get = $_GET['idComanda'];
}

if (isset($_POST['encerrar']))
{
    $update = "UPDATE comanda SET idSituacao = 2 WHERE idComanda = '{$id_comanda_get}';";
    $executa_update = $conn->query($update);
    header("Location: insert-item_comanda.php?idComanda={$id_comanda_get}");
    mysqli_close($conn);
}


if (isset($_POST['cadastrar']))
{
    $id_comanda = $_POST['id_comanda'];
    $id_op_cardapio = $_POST['op_cardapio'];
    $qtde = $_POST['qtde'];
    $obs = $_POST['obs'];

    $mysql_query = "INSERT INTO `itens_comanda`(`idItemComanda`,`idComanda`, `idOpcaoCardapio`, `quantidade`, `obs`) 
    VALUES (
    'null',
    '{$id_comanda}', 
    '{$id_op_cardapio}', 
    '{$qtde}', 
    '{$obs}'
    )";

    $insertItensComanda = $conn->query($mysql_query);

    header("Location: insert-item_comanda.php?idComanda={$id_comanda}");

    mysqli_close($conn);    	
}

else
{
    $mysql_query = "SELECT 
    o.*,
    concat(o.nomeOpcaoCardapio,' (',o.descricao,')') as NomeDesc, 
    concat(t.descricao, ' - ',o.nomeOpcaoCardapio,' - ',o.descricao) as TipoNomeDesc
    FROM opcoes_cardapio o, tipo_opcoes_cardapio t
    WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio 
    ORDER BY TipoNomeDesc";
    $selectOpCardapio = $conn->query($mysql_query);

    $mysql_query1 = "SELECT ic.*, oc.*, c.nomeClienteComanda
    FROM itens_comanda ic, opcoes_cardapio oc, comanda c
    WHERE ic.idOpcaoCardapio=oc.idOpcaoCardapio
    AND c.idComanda=ic.idComanda 
    AND ic.idComanda={$id_comanda_get}
    order by idItemComanda";
    $selectDados = $conn->query($mysql_query1);

    $query = "SELECT sum(oc.preco*ic.quantidade) preco 
    FROM opcoes_cardapio oc, itens_comanda ic 
    where ic.idOpcaoCardapio = oc.idOpcaoCardapio 
    and ic.idComanda = {$id_comanda_get}";
    $result = mysqli_query($conn,$query);
    $fetch = mysqli_fetch_row($result);
    $valor = $fetch[0];

    $query_nome = "SELECT nomeClienteComanda FROM comanda
    where idComanda = {$id_comanda_get}";
    $result_nome = mysqli_query($conn,$query_nome);
    $fetch1 = mysqli_fetch_row($result_nome);
    $nome = $fetch1[0];

    $query_origem = "SELECT o.descricaoOrigem, s.descricao
    FROM comanda c, origem_comanda o, situacao_comanda s
    where c.idOrigem = o.idOrigem
    and c.idSituacao = s.idSituacao
    and c.idComanda = {$id_comanda_get}";
    $result_origem = mysqli_query($conn,$query_origem);
    $fetch2 = mysqli_fetch_row($result_origem);
    $dorigem = $fetch2[0];

    $query_situacao = "SELECT s.descricao
    FROM comanda c, situacao_comanda s
    where c.idSituacao = s.idSituacao
    and c.idComanda = {$id_comanda_get}";
    $result_situacao = mysqli_query($conn,$query_situacao);
    $fetch3 = mysqli_fetch_row($result_situacao);
    $dsituacao = $fetch3[0];

}

?>

<head>
    <title>Alterar <?php echo "Comanda #"."$id_comanda_get" ?></title>
</head>

<div class="container">
    <br>

    <h1 class="espaco"><?php echo "Comanda #"."$id_comanda_get" ?></h1>
    
    <hr>
    <form method="post">
    <div class="row">
        <div class="col-2">
            <a href="comanda.php"type="button" class="btn btn-warning d-inline-block">Voltar</a>
        </div>
        <div class="col-2">
            <p><?php echo "Cliente: <b>".$nome."</b>"?></p>
        </div>
        <div class="col-2">
            <p><?php echo "Valor total: <b>R$ ".number_format($valor,2,",",".")."</b>"?></p>
        </div>
        <div class="col-2">
            <p><?php echo "Origem: <b>".$dorigem."</b>"?></p>
        </div>
        <div class="col-3">
            <p><?php echo "Situação: <b>".$dsituacao."</b>"?></p>
        </div>
        <div class="col-1">
            <input type="submit" name="encerrar" value="Encerrar Comanda" class="btn btn-danger float-end">
        </div>

    </div>
    </form>
    <hr>
    <br>    
    <h4>Incluir mais itens na comanda</h4>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_comanda" value="<?php echo"$id_comanda_get" ?>">
            <div class="row">
                <div class="col-3">  
                    <select class="form-select" name="op_cardapio" required>
                    <option selected>Selecione a opção do cardápio...</option>
                        <?php while ($row_opcardapio = mysqli_fetch_array($selectOpCardapio, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row_opcardapio['idOpcaoCardapio'];?>"><?= $row_opcardapio['NomeDesc'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-2">
                    <input type="number" min="1" name="qtde" class="form-control" placeholder="Quantidade" required >
                </div>
                <div class="col-6">
                    <input type="text" name="obs" class="form-control" placeholder="Observações">
                </div>
                <div class="col-1">
                    <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary float-end">
                </div>
            </div>
            <br>
        </form>
        <br>
        <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="table-danger" style="text-align:center">
            <th scope="col" style="width: 20%;">Item</th>
            <th scope="col" style="width: 10%;">Valor Unitário</th>
            <th scope="col" style="width: 10%;">Quantidade</th>
            <th scope="col" style="width: 10%;">Valor Total</th>
            <th scope="col" style="width: 30%;">Observação</th>
            <th scope="col" style="width: 20%;">Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php while($data = mysqli_fetch_array($selectDados)) { ?> 
        <tr>
            <td style="text-align:center"><?php echo $data['nomeOpcaoCardapio']; ?></td>
            <td style="text-align:center"><?php echo "R$ " . number_format($data['preco'], 2, ',', '.'); ?></td>  
            <td style="text-align:center"><?php echo $data['quantidade'];  ?></td>
            <td style="text-align:center"><?php echo "R$ " . number_format((($data['preco'])*$data['quantidade']), 2, ',', '.'); ?></td>
            <td style="text-align:center"><?php echo $data['obs'];  ?></td>
            <td style="text-align:center">
            <a href="update-item_comanda.php?idItemComanda=<?php echo $data['idItemComanda']; ?> "type="button" class="btn btn-primary">Editar</a>
            <a href="delete-item_comanda.php?idItemComanda=<?php echo $data['idItemComanda']; ?>&idComanda=<?php echo $id_comanda_get; ?> "type="button" class="btn btn-danger">Excluir</a>    
            </td> 
        </tr> 
        <?php } ?>       
        </tbody>
    </table>



    </div>
</div>

<br>
<?php require("footer.php"); ?>
