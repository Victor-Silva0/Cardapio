<?php
require("header.php");

require_once("connection.php");


if (isset($_GET['idOpcaoCardapio']))
{
    $id_opcao_cardapio = $_GET['idOpcaoCardapio'];
    $mysql_query = "SELECT oc.*, toc.descricao tipo FROM opcoes_cardapio oc, tipo_opcoes_cardapio toc
                        WHERE oc.idOpcaoCardapio={$id_opcao_cardapio} AND toc.idTipoOpcoesCardapio=oc.idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
    $row_opcao = mysqli_fetch_array($result);
}

if (isset($_POST['atualizar']))
{
    $id_opcao = $_POST['id_opcao'];
    $nome_opcao = $_POST['nome'];
    $id_tipo = $_POST['tipo_opcao'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $mysql_query = "UPDATE opcoes_cardapio oc SET nomeOpcaoCardapio='{$nome_opcao}', idTipoOpcoesCardapio='{$id_tipo}', descricao='{$descricao}', preco='{$preco}' WHERE oc.idOpcaoCardapio={$id_opcao}";

    $result = $conn->query($mysql_query);

    mysqli_close($conn);

    header("Location: cardapio.php");
}
else
{
    $mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
}

?>

<head>
    <title>Alterar Item</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Cardápio</h2>
    <p>Atualização do cadastro do cardápio.</p>
    <hr>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_opcao" value="<?= $row_opcao['idOpcaoCardapio']?>">
            <label for="nome">Nome da opção</label>
            <input type="text" name="nome" class="form-control" style="width: 250px;" required value="<?= $row_opcao['nomeOpcaoCardapio']?>">
            <br>
            <label for="tipo_opcao">Tipo da opção</label>
            <select name="tipo_opcao" class="form-select" style="width: 200px;" required>
                <option value="<?= $row_opcao['idTipoOpcoesCardapio'] ?>" selected><?= $row_opcao['tipo']; ?></option>
                <?php while ($row_tipo = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($row_tipo['idTipoOpcoesCardapio'] != $row_opcao['idTipoOpcoesCardapio']) {?>
                        <option value="<?= $row_tipo['idTipoOpcoesCardapio'];?>"><?= $row_tipo['descricao'];?></option>
                <?php  } } ?>
            </select>
            <br>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" class="form-control" style="width: 550px;" required value="<?= $row_opcao['descricao']?>">
            <br>
            <label for="preco">Preço</label>
            <input type="number" min="0.05" step=0.01 name="preco" class="form-control" style="width: 200px;" required value="<?= $row_opcao['preco']?>">
            <br>
            <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary w100">
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>