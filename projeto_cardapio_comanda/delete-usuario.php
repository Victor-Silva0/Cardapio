<?php

if (isset($_GET['idUsuario']))
{
    $id = $_GET['idUsuario'];

    require_once("connection.php");
        $mysql_query = "DELETE FROM usuarios WHERE idUsuario = {$id}";
        $conn->query($mysql_query);
        $msg = "delete-usuario success";
        $msgerror = "";
        mysqli_close($conn);
}

header("Location: usuario.php?msg={$msg}&msgerror={$msgerror}");
?>