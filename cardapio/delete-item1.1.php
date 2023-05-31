<?php
use Exception;

session_start();

if (isset($_GET['idOpcaoCardapio']))
{
    $id = $_GET['idOpcaoCardapio'];
    
    require_once("connection.php");
    $quantidade = "SELECT count(*) as qtde FROM itens_comanda group by idOpcaoCardapio HAVING idOpcaoCardapio = {$id}";
    if ( $quantidade > 0)
    {
        $msg = "delete error";
        $msgerror = "Teste";
    }
    else
    {
    $mysql_query = "DELETE FROM opcoes_cardapio WHERE idOpcaoCardapio={$id}";
    echo $mysql_query;
    $conn->query($mysql_query);
    /*try {
    } catch (Exception $e) {
        echo "message: ".$e->getCode();
        exit;
    }*/
    mysqli_close($conn);
    }
}

header("Location: cardapio.php");
?>