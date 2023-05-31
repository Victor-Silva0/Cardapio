<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idComanda']))
{
    $id_comanda_get = $_GET['idComanda'];

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
    $mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY idOpcaoCardapio";
    $selectOpCardapio = $conn->query($mysql_query);

    $mysql_query1 = "SELECT ic.*, oc.*, c.nomeClienteComanda
    FROM itens_comanda ic, opcoes_cardapio oc, comanda c
    WHERE ic.idOpcaoCardapio=oc.idOpcaoCardapio
    AND c.idComanda=ic.idComanda 
    AND ic.idComanda={$id_comanda_get}
    order by idItemComanda";
    $selectDados = $conn->query($mysql_query1);
    


}

?>

<div class="container">
    <br>
    <h2><?php echo "Comanda #"."$id_comanda_get" ?></h2>
    <p>Gerenciamento dos itens da comanda</p>
    <hr>
    <br>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_comanda" value="<?php echo"$id_comanda_get" ?>">
            <div class="row">
                <div class="col-4">  
                    <label for="op_cardapio">Opção Cardápio</label>
                    <select class="form-select" name="op_cardapio" required>
                        <option selected>Selecione...</option>
                        <?php while ($row_opcardapio = mysqli_fetch_array($selectOpCardapio, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row_opcardapio['idOpcaoCardapio'];?>"><?= $row_opcardapio['nomeOpcaoCardapio'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-1">
                    <label for="qtde">Quantidade</label>
                    <input type="text" name="qtde" class="form-control" required>
                </div>
                <div class="col-7">
                    <label for="obs">Observação</label>
                    <input type="text" name="obs" class="form-control" >
                </div>
            </div>
            <br>
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <a href="comanda.php"type="button" class="btn btn-warning d-inline-block">Ir para Comandas</a>
            
        </form>
        <br>
        <br>
        <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="table-danger" style="text-align:center">
            
            <th scope="col" style="width: 3%">Comanda</th>
            <th scope="col" style="width: 3%">Cliente</th>
            <th scope="col" style="width: 12%;">Item</th>
            <th scope="col" style="width: 12%;">Preço</th>
            <th scope="col" style="width: 3%;">Quantidade</th>
            <th scope="col" style="width: 20%;">Observação</th>
            <th scope="col" style="width: 20%;">Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php while($data = mysqli_fetch_array($selectDados)) { ?> 
        <tr> 

            <td style="text-align:center"><?php echo $data['idComanda']; ?></td>
            <td style="text-align:center"><?php echo $data['nomeClienteComanda']; ?></td> 
            <td style="text-align:center"><?php echo $data['nomeOpcaoCardapio']; ?></td>
            <td style="text-align:center"><?php echo $data['preco']; ?></td>  
            <td style="text-align:center"><?php echo $data['quantidade'];  ?></td> 
            <td style="text-align:center"><?php echo $data['obs'];  ?></td>
            <td style="text-align:center">
            <a href="update-item_comanda.php?idItemComanda=<?php echo $data['idItemComanda']; ?> "type="button" class="btn btn-primary">Editar</a>
            <a href="delete-item_comanda.php?idItemComanda=<?php echo $data['idItemComanda']; ?> "type="button" class="btn btn-danger">Deletar</a>
            <span class="glyphicon glyphicon-trash"></span>    
            </td> 
        </tr> 
        <?php } ?>       
        </tbody>
    </table>



    </div>
</div>

<br>
<?php require("footer.php"); ?>
