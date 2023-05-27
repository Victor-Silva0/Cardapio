<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
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
    <header>
        <h1>Tech's Restaurante</h1>
        <button class="toggle-menu">&#9776;</button>
        <nav class="menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="cardapio.html">Cardápio</a></li>
                <li><a href="pedido.html">Pedido</a></li>
                <li><a href="login.html">Administração</a></li>
            </ul>
        </nav>
    </header>
    <main>