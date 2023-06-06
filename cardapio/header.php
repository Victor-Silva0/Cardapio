<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="image/restaurante.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.toggle-menu').addEventListener('click', function () {
                document.querySelector('.menu').classList.toggle('show');
            });
        });
    </script>
</head>
<body>
    <header style="background-color: #8F342D;">
        <h1>Tech's Restaurante</h1>
        <button class="toggle-menu">&#9776;</button>
        <nav class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cardapioList.php">Cardápio</a></li>
                <li><a href="cardapio.php">Gerenciar Cardápio</a></li>
                <li><a href="comanda.php">Gerenciar Comandas</a></li>
                <li><a href="login.php">Administração</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?php 
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $msgerror = $_GET['msgerror'];
    if ($msg == 'insert success') {
		echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso!</div>";
    } else if ($msg  == 'insert error')  { 
            echo "<div class='alert alert-danger' role='alert'>Falha ao inserir o registro! {$msgerror}</div>";
    } else if ($msg  == 'update success')  { 
            echo "<div class='alert alert-success' role='alert'>Registro atualizado com sucesso!</div>";
    } else if ($msg  == 'update error')  { 
            echo "<div class='alert alert-danger' role='alert'>Falha ao atualizar o registro! {$msgerror}</div>";
    } else if ($msg  == 'delete success')  { 
            echo "<div class='alert alert-success' role='alert'>Registro excluido com sucesso!</div>";
    } else if ($msg  == 'delete error')  { 
            echo "<div class='alert alert-danger' role='alert'>Falha ao excluir o registro! {$msgerror}</div>";
    }
    else if ($msg == 'delete-item error') {
        echo "<div class='alert alert-danger' role='alert'>O item não pode ser excluido do cardápio pois ele existe em uma comanda. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-item success') {
        echo "<div class='alert alert-success' role='alert'>Item excluido com sucesso!</div>";
    }
    else if ($msg == 'delete-comanda error') {
        echo "<div class='alert alert-danger' role='alert'>A comanda não pode ser excluida pois ela tem itens dentro. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-comanda success') {
        echo "<div class='alert alert-success' role='alert'>Comanda excluida com sucesso!</div>";
    }
    else if ($msg  == 'delete-item_comanda success') {
        echo "<div class='alert alert-success' role='alert'>Item excluido com sucesso!</div>";
    }
    else if ($msg == 'delete-tipo_opcao error') {
        echo "<div class='alert alert-danger' role='alert'>A opção não pode ser excluida pois existem produtos cadastrados com essa opção do cardápio. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-tipo_opcao success') {
        echo "<div class='alert alert-success' role='alert'>Opção excluida com sucesso!</div>";
    }
}
?>
