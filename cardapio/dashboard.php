<?php
require("header.php");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div class="container">
  <h2>Dashboard</h2>
  <p>Olá, <b><?php echo htmlspecialchars($_SESSION["nomeUsuario"]); ?></b>. Benvindo ao nosso site.</h1>
  <hr>  
  <p>&nbsp;</p>
  <p>As alterações foram inseridas aqui!!!</p>
  <p>
    <a href="reset-senha.php" class="btn btn-warning">Resete a sua senha</a>
    <a href="logout.php" class="btn btn-danger ml-3">Faça logout em sua conta</a>
  </p>
</div>

<?php require("footer.php"); ?>