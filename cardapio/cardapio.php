<?php
require("header.php");

require_once('connection.php');


if (isset($_POST['filtro'])) {
  $filtro = $_POST['filtro'];
  if ($filtro != "0") {
  $mysql_query = "SELECT * FROM opcoes_cardapio WHERE idTipoOpcoesCardapio = $filtro ORDER BY idOpcaoCardapio";
  }
  else {
    $mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY idOpcaoCardapio";
  }

} else {
  $mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY idOpcaoCardapio";
}

$result = $conn->query($mysql_query);
mysqli_close($conn);
?> 

<head>
  <title>Cardápio</title>
</head>
<div class="container">
  <br>
  <h2>Cardápio</h2>
  <p>Listagem do itens cadastrados.</p>
  <hr>
  <form method="post" class="mb-3">
    <div class="form-group">
      <label for="filtro">Filtrar por tipo:</label>
      <select name="filtro" id="filtro" class="form-control w-25 d-inline-block">
        <option value="0">Todos</option>
        <option value="1">Refrigerante</option>
        <option value="2">Cerveja</option>
        <option value="3">Chop</option>
        <option value="4">Suco</option>
        <option value="5">Sobremesa</option>
        <option value="6">Lanche</option>
      </select>
      <input type="submit" class="btn btn-secondary ms-5 d-inline-block" style="width: 100px;" value="Filtrar">
      <a href="insert-item.php" class="btn btn-warning" style="margin-left: 600px;">Novo</a>
    </div>
  </form>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col" style="width: 20%">Nome</th>
        <th scope="col" style="width: 30%;">Descrição</th>
        <th scope="col" style="width: 15%;">Preço (R$)</th>
        <th scope="col" style="width: 15%;">Opções</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['idOpcaoCardapio']; ?></th>
        <td><?php echo $data['nomeOpcaoCardapio']; ?></td> 
        <td><?php echo $data['descricao']; ?></td> 
        <td style="text-align:center">R$ <?php echo number_format($data['preco'],2,",",".");  ?></td> 
        <td>
         
          <a href="update-item.php?idOpcaoCardapio=<?php echo $data['idOpcaoCardapio']; ?> "type="button" class="btn btn-primary">Editar</a>
          <a href="delete-cardapio.php?idOpcaoCardapio=<?php echo $data['idOpcaoCardapio']; ?>" button type="button" class="btn btn-danger">Excluir</a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php require("footer.php"); ?>
