<?php
require("header.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

require_once('connection.php');

$mysql_query = "SELECT * FROM usuarios 
ORDER BY nomeUsuario";

$result = $conn->query($mysql_query);
mysqli_close($conn);
?>

<head>
  <title>Gerenciar Usuários</title>
</head>
<div class="container">
  <br>
  <h2 class="espaco">Gerenciar Usuários</h2>
  <hr>
      <a href="dashboard.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
      <a href="registro-usuarios.php" class="btn btn-warning d-inline-block float-end">Registrar novo usuário</a>
  
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col" style="width: 20%">Nome</th>
        <th scope="col" style="width: 10%">Data de cadastro</th>

        <th scope="col" style="width: 15%;">Opções</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
          <th scope="row" style="text-align:center"><?php echo $data['idUsuario']; ?></th>
          <td><?php echo $data['nomeUsuario']; ?></td>
          <td><?php echo $data['dt_criacaoUsuario']; ?></td>
          <td style="text-align:center">
          <a href="delete-usuario.php?idUsuario=<?php echo $data['idUsuario']; ?>" button type="button" class="btn btn-danger">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
</div>

<?php require("footer.php"); ?>
