<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idComanda']))
{
    $id_comanda = $_GET['idComanda'];
    $mysql_query = "SELECT c.*, o.descricaoOrigem, s.descricao FROM comanda c, origem_comanda o, situacao_comanda s
                        WHERE c.idComanda={$id_comanda} AND o.idOrigem=c.idOrigem AND s.idSituacao=c.idSituacao";
    $result = $conn->query($mysql_query);
    $row_placeholder = mysqli_fetch_array($result);
}

if (isset($_POST['atualizar']))
{
    $id_comanda = $_POST['id_comanda'];
    $nome_cliente = $_POST['nome'];
    $id_origem = $_POST['id_origem'];
    $id_situacao = $_POST['id_situacao'];

    $mysql_query = "UPDATE comanda c SET nomeClienteComanda='{$nome_cliente}', idOrigem='{$id_origem}', idSituacao='{$id_situacao}'
                        WHERE c.idComanda={$id_comanda}";

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

    header("Location: comanda.php?msg={$msg}&msgerror={$msgerror}");
}
else
{
    $mysql_query = "SELECT * FROM origem_comanda ORDER BY idOrigem";
    $select_origem = $conn->query($mysql_query);
    $mysql_query = "SELECT * FROM situacao_comanda ORDER BY idSituacao";
    $select_situacao = $conn->query($mysql_query);
}

?>

<head>
    <title>Atualizar Comanda</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Comanda</h2>
    <p>Atualização do cadastro da comanda.</p>
    <hr>
    <a href="comanda.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_comanda" value="<?= $row_placeholder['idComanda']?>">
            <label for="nome">Nome do cliente</label>
            <input type="text" name="nome" class="form-control" style="width: 250px;" required value="<?= $row_placeholder['nomeClienteComanda']?>">
            <br>
            <label for="id_origem">Origem</label>
            <select name="id_origem" class="form-select" style="width: 200px;" required>
                <option value="<?= $row_placeholder['idOrigem'] ?>" selected><?= $row_placeholder['descricaoOrigem']; ?></option>
                <?php while ($row_origem = mysqli_fetch_array($select_origem, MYSQLI_ASSOC)) {
                    if ($row_origem['idOrigem'] != $row_placeholder['idOrigem']) {?>
                        <option value="<?= $row_origem['idOrigem'];?>"><?= $row_origem['descricaoOrigem'];?></option>
                <?php  } } ?>
            </select>
            <br>
            <label for="id_situacao">Situação</label>
            <select name="id_situacao" class="form-select" style="width: 200px;" required>
                <option value="<?= $row_placeholder['idSituacao'] ?>" selected><?= $row_placeholder['descricao']; ?></option>
                <?php while ($row_situacao = mysqli_fetch_array($select_situacao, MYSQLI_ASSOC)) {
                    if ($row_situacao['idSituacao'] != $row_placeholder['idSituacao']) {?>
                        <option value="<?= $row_situacao['idSituacao'];?>"><?= $row_situacao['descricao'];?></option>
                <?php  } } ?>
            </select>
            <br>
            <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary w100">
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>