<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idTipoOpcoesCardapio']))
{
    $id_tipo = $_GET['idTipoOpcoesCardapio'];
    $mysql_query = "SELECT * FROM tipo_opcoes_cardapio
                        WHERE idTipoOpcoesCardapio={$id_tipo}";
    $result = $conn->query($mysql_query);
    $row_tipo = mysqli_fetch_array($result);
}

if (isset($_POST['atualizar']))
{
    $id_tipo = $_POST['id_tipo'];
    $nome_tipo = $_POST['nome'];

    $mysql_query = "UPDATE tipo_opcoes_cardapio SET descricao='{$nome_tipo}' 
                            WHERE idTipoOpcoesCardapio='{$id_tipo}'";

    $result = $conn->query($mysql_query);

    mysqli_close($conn);

    header("Location: tipo_opcao.php");
}
else
{
    $mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
}

?>

<head>
    <title>Alterar tipo</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Categorias</h2>
    <p>Atualização do cadastro de categorias.</p>
    <hr>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_tipo" value="<?= $row_tipo['idTipoOpcoesCardapio']?>">
            <label for="nome">Nome da categoria</label>
            <input type="text" name="nome" class="form-control" style="width: 250px;" required value="<?= $row_tipo['descricao']?>">
            <br>
            <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary w100">
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>