<?php

session_start();

?>

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
            document.querySelector('.dropdown-toggle').addEventListener('click', function () {
                document.querySelector('.dropdown-menu').classList.toggle('show');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.toggle-menu').addEventListener('click', function () {
                document.querySelector('.menu').classList.toggle('show');
            });
        });

        document.addEventListener('click', function(event) {
        var menu = document.querySelector('.menu');
        var toggleButton = document.querySelector('.toggle-menu');
        if (!menu.contains(event.target) && !toggleButton.contains(event.target)) {
            menu.classList.remove('show'); // Recolhe o menu
        }
        });

        document.addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        var dropdownToggle = document.querySelector('.dropdown-toggle');
        if (!dropdownMenu.contains(event.target) && !dropdownToggle.contains(event.target)) {
            dropdownMenu.classList.remove('show'); // Recolhe o menu dropdown
        }
        });
    </script>
</head>
<body>
    <header>
        <h1>Tech's Restaurante</h1>
        <button class="toggle-menu">&#9776;</button>
        <span class="navbar-text d-inline-block float-end">
            <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ ?>
                <a class="btn btn-warning" href="login.php">Login</a>
                <nav class="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="cardapioList.php">Cardápio</a></li>
                        <li><a href="comentarios.php">Reviews</a></li>
                    </ul>
                </nav>
            <?php } else { ?>
                <div row>
                <div class="col-4">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION["nomeUsuario"]); ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="reset-senha.php">Reset senha</a>
                            <a class="dropdown-item" href="logout.php">Sair</a>
                        </div>
                    </div>
                </div>
                </div>              
                <nav class="menu">
                     <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                    </ul>
                </nav> 
            <?php } ?>
        </span>

    </header>
    <main>
    <?php 
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $msgerror = $_GET['msgerror'];
    if ($msg == 'insert success') {
		echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh; margin-bottom: -18vh' role='alert'>Registro inserido com sucesso!</div>";
    } else if ($msg  == 'insert error')  { 
            echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Falha ao inserir o registro! {$msgerror}</div>";
    } else if ($msg  == 'update success')  { 
            echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Registro atualizado com sucesso!</div>";
    } else if ($msg  == 'update error')  { 
            echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Falha ao atualizar o registro! {$msgerror}</div>";
    } else if ($msg  == 'delete success')  { 
            echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Registro excluido com sucesso!</div>";
    } else if ($msg  == 'delete error')  { 
            echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Falha ao excluir o registro! {$msgerror}</div>";
    }
    else if ($msg == 'delete-item error') {
        echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>O item não pode ser excluido do cardápio pois ele existe em uma comanda. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-item success') {
        echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Item excluido com sucesso!</div>";
    }
    else if ($msg == 'delete-comanda error') {
        echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>A comanda não pode ser excluida pois ela tem itens dentro. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-comanda success') {
        echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Comanda excluida com sucesso!</div>";
    }
    else if ($msg  == 'delete-item_comanda success') {
        echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Item excluido com sucesso!</div>";
    }
    else if ($msg == 'delete-tipo_opcao error') {
        echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>A opção não pode ser excluida pois existem produtos cadastrados com essa opção do cardápio. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-tipo_opcao success') {
        echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Opção excluida com sucesso!</div>";
    }
    else if ($msg == 'delete-comentario error') {
        echo "<div class='alert alert-danger' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Ocorreu um erro ao tentar excluir o comentario. {$msgerror}</div>";
    }
    else if ($msg  == 'delete-comentario success') {
        echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Comentario excluido com sucesso!</div>";
    }
    else if ($msg  == 'delete-usuario success') {
        echo "<div class='alert alert-success' style='margin-top: 15vh; margin-bottom: -18vh' role='alert'>Usuário excluido com sucesso!</div>";
    }

}
?>