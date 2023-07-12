<?php

if (isset($_GET['idItemComanda']))
{
    $id = $_GET['idItemComanda'];
    $id_comanda_get = $_GET['idComanda'];
    
    require_once("connection.php");
        $mysql_query = "DELETE FROM itens_comanda WHERE idItemComanda = {$id}";
        $conn->query($mysql_query);
        $msg = "delete-item_comanda success";
        $msgerror = "";
        mysqli_close($conn);
}

header("Location: insert-item_comanda.php?msg={$msg}&msgerror={$msgerror}&idComanda={$id_comanda_get}");
?>
