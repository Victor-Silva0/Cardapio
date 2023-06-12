<?php
require("header.php");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div class="container">
  <br>
  <h2 class="espaco">Dashboard</h2>
  <p>Olá, <b><?php echo htmlspecialchars($_SESSION["nomeUsuario"]); ?></b>. Seja bem-vindo!</h1>
  <hr>
  <strong>Conta de gerenciamento</strong><br><br>
  <p class="alert alert-info">
    Enquanto logado na conta, o administrador pode realizar o gerenciamento das comandas, 
    dos itens das comandas, gerenciar opções do cardápio, tipos de opções e também tem controle sobre os comentários dos clientes!
  </p>
  <br>
  <div class="row">

    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_cardapio.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Cardápio</h5>
            <p class="card-text">Some quick example text ...</p>
            <a href="cardapio.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>  
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_comanda.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Comandas</h5>
            <p class="card-text">Some quick example ...</p>
            <a href="comanda.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_usuarios.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Usuários</h5>
            <p class="card-text">Some quick ...</p>
            <a href="usuario.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_comentarios.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Comentários</h5>
            <p class="card-text">Some ...</p>
            <a href="comentarios2.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>


  </div>

  <br>
<!--
  <p>
    <a href="reset-senha.php" class="btn btn-warning">Resete a sua senha</a>
    <a href="logout.php" class="btn btn-danger ml-3">Faça logout em sua conta</a>
  </p>
-->


</div>





<br>

<?php require("footer.php"); ?>
