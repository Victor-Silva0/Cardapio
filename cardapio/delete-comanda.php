<?php

if (isset($_GET['idComanda']))
{
    $id = $_GET['idComanda'];

    require_once("connection.php");
    $mysql_query = "DELETE FROM itens_comanda WHERE idComanda={$id}";
    $mysql_query1 = "DELETE FROM comanda WHERE idComanda={$id}";

    if ($conn->query($mysql_query) === TRUE)
    {
        $conn->query($mysql_query1);
        $msg = "delete-comanda success";
        $msgerror = "";
    }
    else
    {
        $msg = "delete-comanda error";
		$msgerror = $conn->error;
    }
}

header("Location: comanda.php?msg={$msg}&msgerror={$msgerror}");
?>