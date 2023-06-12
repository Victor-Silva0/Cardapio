<?php
require("header.php");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<head>
  <title>Dashboard</title>
</head>
<div class="container">
  <h2 class="espaco">Dashboard</h2>
  <p>Olá, <b><?php echo htmlspecialchars($_SESSION["nomeUsuario"]); ?></b>. Seja bem-vindo!</h1>
  <hr>  
  <p>&nbsp;</p>
  <strong>Conta de gerenciamento</strong><br><br>
  <p class="alert alert-info">
    Enquanto logado na conta, o administrador pode realizar o gerenciamento das comandas,<br>
    dos itens das comandas, gerenciar opções do cardápio, tipos de opções<br>
    e também tem controle sobre os comentários dos clientes!
  </p>
  <p>
    <a href="reset-senha.php" class="btn btn-warning">Resete a sua senha</a>
    <a href="logout.php" class="btn btn-danger ml-3">Faça logout em sua conta</a>
  </p>
</div>

<?php require("footer.php"); ?>
