<?php

if (isset($_GET['idComanda']))
{
    $id = $_GET['idComanda'];

    require_once("connection.php");
    $quantidade_query = "SELECT COUNT(*) AS qtde FROM itens_comanda WHERE idComanda = {$id}";
    $quantidade_result = $conn->query($quantidade_query);
    $quantidade_row = $quantidade_result->fetch_assoc();
    $quantidade = $quantidade_row['qtde'];

    if ($quantidade > 0)
    {
        $msg = "delete-comanda error";
		$msgerror = $conn->error;
        mysqli_close($conn);
    }
    else
    {
        $mysql_query = "DELETE FROM comanda WHERE idComanda = {$id}";
        $conn->query($mysql_query);
        $msg = "delete-comanda success";
        $msgerror = "";
        mysqli_close($conn);
    }
}

header("Location: comanda.php?msg={$msg}&msgerror={$msgerror}");
?>