<?php
require("header.php");
require_once("connection.php");

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $comentario = $_POST['comentario'];

    $mysql_query = "INSERT INTO `comentarios` (`nome`, `comentario`)
                    VALUES (
                        '{$nome}',
                        '{$comentario}'
                    )";

    $result = $conn->query($mysql_query);

    if ($result === TRUE)
        {
            $msg = "insert success";
            $msgerror = "";
        }
        else
        {
            $msg = "insert error";
            $msgerror = $conn->error;
        }
    
    mysqli_close($conn);
    header("Location: comentarios.php?msg={$msg}&msgerror={$msgerror}");
    exit();
}
?>

<head>
    <title>Novo Comentário</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Cadastro de Novo Comentário</h2>
    <hr>
    <div class="wrapper">
        <form method="post">
            <div class="row">
                <div class="col-3">
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome" required>
                </div>
                <div class="col-8">
                    <input type="text" name="comentario" class="form-control" placeholder="Digite seu comentário" required>
                </div>
                <div class="col-1">
                    <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary w-100">
                </div>
            </div>
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>