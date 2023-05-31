<?php

session_start();

if (isset($_GET['idOpcaoCardapio']))
{
    $id = $_GET['idOpcaoCardapio'];
    
    require_once("connection.php");

    $mysql_query = "DELETE FROM opcoes_cardapio WHERE idOpcaoCardapio=$id";

    $conn->query($mysql_query);
    
    mysqli_close($conn);
}

header("Location: cardapio.php")
?>