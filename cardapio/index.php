<?php require("header.php"); ?>

<head>
  <title>Home</title>
</head>

    <article>
        <section class="s1">
            <h1 class="espaco">Tipos de Pratos</h1>
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
                        <a href="cardapioList.php"><img src="image/1.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>

                        <a href="cardapioList.php">Ver mais...</a>
                    </div>
                    <div class="col-md-6">
                        <a href="cardapioList.php"><img src="image/2.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>
                        <a href="cardapioList.php">Ver mais...</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <a href="cardapioList.php"><img src="image/3.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>
                        <a href="cardapioList.php">Ver mais...</a>
                    </div>
                    <div class="col-md-6">
                        <a href="cardapioList.php"><img src="image/4.jpg"
                                class="img-fluid smaller-image mx-auto d-block"></a>
                        <a href="cardapioList.php">Ver mais...</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="s3">
            <h1>Veja o que os nossos clientes dizem sobre o nosso restaurante</h1>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card text-white mb-3" style="background-color:#8F5753;">
                        <div class="card-body">
                            <h5 class="card-title">Morgan Yu</h5>
                            <p class="card-text">Os lanches são deliciosos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-white mb-3" style="background-color:#8F5753;">
                        <div class="card-body">
                            <h5 class="card-title">Altina Orion</h5>
                            <p class="card-text">Tudo estava ótimo mas o meu prato favorito foi o pudim divino que eu comi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-white mb-3" style="background-color:#8F5753;">
                        <div class="card-body">
                            <h5 class="card-title">Josival Silva</h5>
                            <p class="card-text">A comida não foi muito boa teria sido melhor eu ter ido na pizzaria.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-white mb-3" style="background-color:#8F5753;">
                        <div class="card-body">
                            <h5 class="card-title">Luna Hakurei Kochiya</h5>
                            <p class="card-text">O atendimento e a comida estavam ótimos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
   
<?php require("footer.php"); ?>
