<?php
require("header.php");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div class="container">

<head>
  <title>Dashboard</title>
</head>

  <br>
  <h2 class="espaco">Olá, <font color="#b22222"><b><?php echo htmlspecialchars($_SESSION["nomeUsuario"]); ?></b></font>. Seja bem-vindo ao ambiente administrativo!</h2>


  <hr>


  <div class="row">
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_cardapio.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Cardápio</h5>
            <p class="card-text">Aqui você gerencia o cardápio, incluindo novos opções, consultando as já cadastradas, alterando alguma informação ou até mesmo excluindo alguma opção.</p>
            <a href="cardapio.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>  
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_comanda.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Comandas</h5>
            <p class="card-text">Aqui você gerencia as comandas, incluindo novas comandas, consultando as já cadastradas, alterando algum item cadastrado ou adicionando uma informação nova ao item 
              ou também excluindo algum item cadastrado por engano.</p>
            <a href="comanda.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_usuarios.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Usuários</h5>
            <p class="card-text">Aqui você gerencia os usuários administradores do sistema, somente é possivel consultar os usuários já cadastrados, incluir um novo usuário ou excluir 
              algum usuário que não poderá mais acessar o sistema.</p>
            <a href="usuario.php" class="btn btn-primary">Entrar</a>
          </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="image/foto_comentarios.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Gerenciar Comentários</h5>
            <p class="card-text">Aqui você gerencia os comentários dos clientes, somente é possivel consultar os 
              comentários já cadastrados ou excluir algum que não seja adequado.</p>
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
