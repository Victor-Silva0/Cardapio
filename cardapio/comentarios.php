<?php
require("header.php");

require_once('connection.php');

// Query to fetch reviews
$reviews_query = "SELECT * FROM comentarios";
$reviews_result = $conn->query($reviews_query);

mysqli_close($conn);
?>

<head>
  <title>Comentários</title>
</head>
<div class="container">
  <br>
  <h2 class="espaco">Comentários</h2>
  <hr>
  <form method="post" class="mb-3">
  <div class="form-group">
    <a href="insert-comentario.php" class="btn btn-warning d-inline-block float-end" style="margin-bottom: 10px;">Incluir novo comentario</a>
  </form>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 20%">Nome</th>
        <th scope="col" style="width: 30%;">Comentário</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($review = mysqli_fetch_array($reviews_result)) { ?>
        <tr>
          <td><?php echo $review['nome']; ?></td>
          <td><?php echo $review['comentario']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
</div>

<?php require("footer.php"); ?>