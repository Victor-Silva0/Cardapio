<?php
require("header.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

require_once('connection.php');

// Query to fetch reviews
$reviews_query = "SELECT * FROM comentarios";
$reviews_result = $conn->query($reviews_query);

mysqli_close($conn);
?>

<head>
  <title>Gerenciar Comentários</title>
</head>
<div class="container">
  <br>
  <h2 class="espaco">Gerenciar Comentários</h2>
  <hr>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 20%">Nome</th>
        <th scope="col" style="width: 30%;">Comentário</th>
        <th scope="col" style="width: 15%;">Opções</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($review = mysqli_fetch_array($reviews_result)) { ?>
        <tr>
          <td><?php echo $review['nome']; ?></td>
          <td><?php echo $review['comentario']; ?></td>
          <td style="text-align:center">
          <a href="delete-comentario.php?idComentario=<?php echo $review['idComentario']; ?>" button type="button" class="btn btn-danger">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
</div>

<?php require("footer.php"); ?>