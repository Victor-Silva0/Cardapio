<?php

require("header.php");


session_start();

if (isset($_GET['idOpcaoCardapio']))
{
    $id = $_GET['idOpcaoCardapio'];
    
    require_once("connection.php");

    $mysql_query = "DELETE FROM opcoes_cardapio WHERE idOpcaoCardapio=$id";
    
    mysqli_close($conn);
}


header("Location: cardapio.php")
?>

<?php require("footer.php"); ?>