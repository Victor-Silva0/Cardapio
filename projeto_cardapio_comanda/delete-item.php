<?php
session_start();

if (isset($_GET['idOpcaoCardapio']))
{
    $id = $_GET['idOpcaoCardapio'];
    
    require_once("connection.php");
    $quantidade_query = "SELECT COUNT(*) AS qtde FROM itens_comanda WHERE idOpcaoCardapio = {$id}";
    $quantidade_result = $conn->query($quantidade_query);
    $quantidade_row = $quantidade_result->fetch_assoc();
    $quantidade = $quantidade_row['qtde'];
    $file_query = "SELECT * FROM opcoes_cardapio WHERE idOpcaoCardapio = {$id}";
    $file_result = $conn->query($file_query);
    $row = mysqli_fetch_array($file_result);
    
    if ($quantidade > 0)
    {
        $msg = "delete-item error";
		$msgerror = $conn->error;
        mysqli_close($conn);
    }
    else
    {
        $mysql_query = "DELETE FROM opcoes_cardapio WHERE idOpcaoCardapio = {$id}";
        $conn->query($mysql_query);
        $file_path = "image/" . $row['imagem'];
        unlink($file_path);
        $msg = "delete-item success";
        $msgerror = "";
        mysqli_close($conn);
    }
}

header("Location: cardapio.php?msg={$msg}&msgerror={$msgerror}");
?>
