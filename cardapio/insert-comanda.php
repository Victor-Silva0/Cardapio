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
    $nome = $_POST['nome'];
    $id_situacao = $_POST['id_situacao'];
    $id_origem = $_POST['id_origem'];

    $mysql_query = "INSERT INTO `comanda`(`idComanda`, `nomeClienteComanda`, `idOrigem`, `idSituacao`) 
    VALUES (
    '{$id_comanda}', 
    '{$nome}',
    '{$id_origem}',
    '{$id_situacao}'
    )";

    $insertItensComanda = $conn->query($mysql_query);

    header("Location: comanda.php");
    mysqli_close($conn);    	
}
else
{
    $mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY idOpcaoCardapio";
    $selectOpCardapio = $conn->query($mysql_query);
    
    $mysql_query1 = "SELECT * FROM origem_comanda";
    $selectOrigem = $conn->query($mysql_query1);
    
    $mysql_query2 = "SELECT * FROM situacao_comanda";
    $selectSituacao = $conn->query($mysql_query2);

}

?>

<head>
    <title>Nova comanda</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Cadastrar nova comanda</h2>
    <hr>
    <br>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_comanda" value="<?php echo"$id_comanda_get" ?>">
            
            <div class="row">
                <div class="col-4">
                    <input type="text" name="nome" class="form-control" placeholder="Nome do cliente" required>
                </div>
                <div class="col-3">  
                    <select class="form-select" name="id_origem" required>
                        <option selected>Selecione a origem da comanda</option>
                        <?php while ($row_origem = mysqli_fetch_array($selectOrigem, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row_origem['idOrigem'];?>"><?= $row_origem['descricaoOrigem'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-3">  
                    <select class="form-select" name="id_situacao" required>
                        <option selected>Selecione a situação da comanda</option>
                        <?php while ($row_situacao = mysqli_fetch_array($selectSituacao, MYSQLI_ASSOC)) { ?>
                        <option value="<?= $row_situacao['idSituacao'];?>"><?= $row_situacao['descricao'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-2">
                <input type="submit" name="cadastrar" value="Inserir" class="btn btn-primary">
                </div>
            </div>
            <br>

        </form>
        <br>
        <br>
        


    </div>
</div>

<br>
<?php require("footer.php"); ?>
