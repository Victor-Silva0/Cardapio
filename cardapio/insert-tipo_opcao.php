<?php
require("header.php");

require_once("connection.php");

if (isset($_POST['cadastrar'])) {
	$descricao = $_POST['descricao'];
	// Mysql query to insert record into table
	$mysql_query = "INSERT INTO tipo_opcoes_cardapio (descricao) VALUES ('{$descricao}')";
	$result = $conn->query($mysql_query);
    mysqli_close($conn);
    header("Location: tipo_opcao.php");
}
?>
<head>
    <title>Novo tipo</title>
</head>

<div class="container">
    <br>
    <h2 class="espaco">Cadastrar novo tipo de opção no cardápio</h2>
    <hr>
    <div class="wrapper">
        <form method="post">
            <input type="text" name="descricao" class="form-control" style="width: 500px;" placeholder="Nome do novo tipo de opção" required>
            <br>
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary w100">
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>
