<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="cardapio.php">Cardápio</a></li>
                <li><a href="pedido.php">Pedido</a></li>
                <li><a href="login.php">Administração</a></li>
            </ul>
        </nav>
    </header>
    <article>
        <section class="s1">
            <h1>Tipos de Pratos</h1>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-50" src="image/1.jpg" alt="Porções">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="carousel-title">Porções</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-50" src="image/2.jpg" alt="Lanches">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="carousel-title">Lanches</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-50" src="image/3.jpg" alt="Bebidas">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="carousel-title">Drinks</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-50" src="image/4.jpg" alt="Sobremesas">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="carousel-title">Sobremesas</h3>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </a>
            </div>
        </section>
        <section class="s2">
            <h1>Veja mais!</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="cardapio.php"><img src="image/1.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>

                        <a href="cardapio.php">Ver mais...</a>
                    </div>
                    <div class="col-md-6">
                        <a href="cardapio.php"><img src="image/2.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>
                        <a href="cardapio.php">Ver mais...</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <a href="cardapio.php"><img src="image/3.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>
                        <a href="cardapio.php">Ver mais...</a>
                    </div>
                    <div class="col-md-6">
                        <a href="cardapio.php"><img src="image/4.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>
                        <a href="cardapio.php">Ver mais...</a>
                    </div>
                </div>
            </div>
        </section>
    </article>
    <footer>
        <div class="footer-content">
          <div class="footer-item">
            <h4>Endereço</h4>
            <p>R. Teresina, 75 - Vila Paulo Roberto, Pres. Prudente - SP, 19046-230</p>
          </div>
          <div class="footer-item">
            <h4>Contato</h4>
            <p>Email: restaurante@gmail.com - Telefone: (18) 99999-9999</p>

          </div>
        </div>
      </footer>
</body>
</html>