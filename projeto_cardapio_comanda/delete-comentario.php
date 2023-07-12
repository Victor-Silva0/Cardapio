<?php

if (isset($_GET['idComentario']))
{
    $id = $_GET['idComentario'];

    require_once("connection.php");
        $mysql_query = "DELETE FROM comentarios WHERE idComentario = {$id}";
        $conn->query($mysql_query);
        $msg = "delete-comentario success";
        $msgerror = "";
        mysqli_close($conn);
}

header("Location: comentarios2.php?msg={$msg}&msgerror={$msgerror}");
?>
