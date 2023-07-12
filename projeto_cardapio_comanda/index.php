<?php 
require("header.php");
require("connection.php");

$mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTIpoOpcoesCardapio";
$result = $conn->query($mysql_query);
$contador = 1;


if (isset($_POST['filtro'])) {
  $filtro = $_POST['filtro'];
  if ($filtro != "0") {
    $mysql_query = "SELECT o.nomeOpcaoCardapio o_nome, o.descricao o_desc, o.imagem o_img, o.preco o_preco, t.* FROM opcoes_cardapio o, tipo_opcoes_cardapio t 
    WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio
    and o.idTipoOpcoesCardapio = $filtro 
    ORDER BY o.idOpcaoCardapio";

  } else {
    $mysql_query = "SELECT o.nomeOpcaoCardapio o_nome, o.descricao o_desc, o.imagem o_img, o.preco o_preco, t.* FROM opcoes_cardapio o, tipo_opcoes_cardapio t 
    WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio ORDER BY o.idOpcaoCardapio";
  }
} else {
  $mysql_query = "SELECT o.nomeOpcaoCardapio o_nome, o.descricao o_desc, o.imagem o_img, o.preco o_preco, t.* FROM opcoes_cardapio o, tipo_opcoes_cardapio t 
  WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio ORDER BY o.idOpcaoCardapio";
}

$result_cardapio = $conn->query($mysql_query);
mysqli_close($conn);

?>

<head>
  <title>Home</title>
</head>

    <article>
        <section class="s1">
            <h1 class="espaco">Tipos de Refeições</h1>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <?php while ($rowindicador = mysqli_fetch_array($result)) { ?>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $contador; ?>"></li>
                    <?php $contador = $contador + 1; } ?>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-50 img-fluid" src="image/carousel_active.jpg" alt="Seleção">
                    </div>
                    <?php
                        mysqli_data_seek($result, 0);
                        while($rowtipo = mysqli_fetch_array($result)) {
                    ?>
                        <div class="carousel-item">
                            <img class="d-block w-50 img-fluid" src="image/<?=$rowtipo['imagem'];?>" alt="<?=$rowtipo['descricao'];?>">
                            <div class="carousel-caption d-none d-md-block">
                            <h3 class="carousel-title"><?=$rowtipo['descricao'];?></h3>
                            </div>
                        </div>
                    <?php } ?>
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
            <form method="post" class="mb-3">
              <div class="form-group">
                <label for="filtro" class="h4">Filtrar por tipo:</label>
                <select name="filtro" id="filtro" class="form-select w-25 d-inline-block">
                  <option value="0">Todos</option>
                  <?php
                    mysqli_data_seek($result, 0);
                    while ($tipo = mysqli_fetch_array($result)) { ?>
                    <option value="<?= $tipo['idTipoOpcoesCardapio']; ?>" <?php echo isset($_POST['filtro']) && $_POST['filtro'] == $tipo['idTipoOpcoesCardapio'] ? 'selected' : '' ?>><?= $tipo['descricao']; ?></option>
                  <?php } ?>
                </select>
                <input type="submit" class="btn btn-secondary ms-2 d-inline-block" value="Filtrar">
              </div>
            </form>
            <br>
            <div class="container">
                <ol style="list-style-type: none; padding-left: 0;">
                <?php 
                mysqli_data_seek($result_cardapio, 0);
                while ($row_opcao = mysqli_fetch_array($result_cardapio)) { ?>
                    <li>
                        <div class="row">
                            <div class="col">
                                <img src="image/<?= $row_opcao['o_img'];?>" alt="opção" class="img-fluid img-thumbnail">
                            </div>
                            <div class="col-5">
                                <p class="mb-4 h2"><strong><?= $row_opcao['o_nome'];?></strong></p>
                                <p class="h3"><?= $row_opcao['o_desc'];?></p>
                            </div>
                            <div class="col-3">
                                <p class="h3">R$ <?= number_format($row_opcao['o_preco'], 2, ',', '.');?></p>
                            </div>
                        </div>
                    </li>
                    <hr class="border border-3">   
                <?php } ?>
                </ol>
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
