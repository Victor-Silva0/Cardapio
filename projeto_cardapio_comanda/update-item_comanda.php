<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idItemComanda']))
{
    $id_item = $_GET['idItemComanda'];
    $mysql_query = "SELECT i.*, o.idOpcaoCardapio id_cardapio, o.nomeOpcaoCardapio FROM itens_comanda i, opcoes_cardapio o
                        WHERE idItemComanda={$id_item} AND i.idOpcaoCardapio=o.idOpcaoCardapio";
    $result = $conn->query($mysql_query);
    $row_placeholder = mysqli_fetch_array($result);
}

if (isset($_POST['atualizar']))
{
    $id_comanda = $_POST['id_comanda'];
    $id_item = $_POST['id_item'];
    $id_opcao = $_POST['opcao_cardapio'];
    $quantidade = $_POST['quantidade'];
    $observacao = $_POST['observacao'];

    $mysql_query = "UPDATE itens_comanda SET idOpcaoCardapio='{$id_opcao}', quantidade='{$quantidade}', obs='{$observacao}'
                        WHERE idItemComanda={$id_item}";

    $result = $conn->query($mysql_query);
    if ($result === TRUE)
    {
        $msg = "update success";
        $msgerror = "";
    }
    else
    {
        $msg = "update error";
        $msgerror = $conn->error;
    }

    mysqli_close($conn);

    header("Location: insert-item_comanda.php?idComanda={$id_comanda}&msg={$msg}&msgerror={$msgerror}");
}
else
{
    $mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY idOpcaoCardapio";
    $result = $conn->query($mysql_query);
}

?>

<head>
    <title>Itens da comanda</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Itens da comanda</h2>
    <p>Atualização do cadastro dos itens da comanda.</p>
    <hr>
    <a href="insert-item_comanda.php?idComanda=<?= $row_placeholder['idComanda']; ?>" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_comanda" value="<?= $row_placeholder['idComanda']?>">
            <input type="hidden" name="id_item" value="<?= $row_placeholder['idItemComanda']?>">
            <br>
            <label for="opcao_cardapio">Opção do cardápio</label>
            <select name="opcao_cardapio" class="form-select" style="width: 200px;" required>
                <option value="<?= $row_placeholder['idOpcaoCardapio'] ?>" selected><?= $row_placeholder['nomeOpcaoCardapio']; ?></option>
                <?php while ($row_opcao = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($row_opcao['idOpcaoCardapio'] != $row_placeholder['idOpcaoCardapio']) {?>
                        <option value="<?= $row_opcao['idOpcaoCardapio'];?>"><?= $row_opcao['nomeOpcaoCardapio'];?></option>
                <?php  } } ?>
            </select>
            <br>
            <label for="quantidade">Quantidade</label>
            <input type="number" min="1" name="quantidade" class="form-control" style="width: 200px;" required value="<?= $row_placeholder['quantidade']?>">
            <br>
            <label for="observacao">Observação</label>
            <input type="text" name="observacao" class="form-control" style="width: 500px;" value="<?= $row_placeholder['obs']?>">
            <br>
            <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary w100">
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>
