<?php
session_start();

if (isset($_GET['idTipoOpcoesCardapio']))
{
    $id = $_GET['idTipoOpcoesCardapio'];
    
    require_once("connection.php");
    $quantidade_query = "SELECT COUNT(*) AS qtde FROM opcoes_cardapio WHERE idTipoOpcoesCardapio = {$id}";
    $quantidade_result = $conn->query($quantidade_query);
    $quantidade_row = $quantidade_result->fetch_assoc();
    $quantidade = $quantidade_row['qtde'];
    $file_query = "SELECT * FROM tipo_opcoes_cardapio WHERE idTipoOpcoesCardapio = {$id}";
    $file_result = $conn->query($file_query);
    $row = mysqli_fetch_array($file_result);
    
    if ($quantidade > 0)
    {
        $msg = "delete-tipo_opcao error";
		$msgerror = $conn->error;
        mysqli_close($conn);
    }
    else
    {
        $mysql_query = "DELETE FROM tipo_opcoes_cardapio WHERE idTipoOpcoesCardapio = {$id}";
        $conn->query($mysql_query);
        $file_path = "image/" . $row['imagem'];
        unlink($file_path);
        $msg = "delete-tipo_opcao success";
        $msgerror = "";
        mysqli_close($conn);
    }
}

header("Location: tipo_opcao.php?msg={$msg}&msgerror={$msgerror}");
?>
