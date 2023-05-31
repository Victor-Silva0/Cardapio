<?php
require("header.php");

require_once('connection.php');


if (isset($_POST['filtro'])) {
  $filtro = $_POST['filtro'];
  if ($filtro != "0") {
  $mysql_query = "SELECT c.*, sitComanda.descricao situacao, origem.descricaoOrigem origem FROM comanda c, situacao_comanda sitComanda, origem_comanda origem WHERE c.idSituacao = {$filtro} and sitComanda.idSituacao = {$filtro} and c.idOrigem = origem.idOrigem ORDER BY dataComanda desc";
  }
  else {
    $mysql_query = "SELECT c.*, sitComanda.descricao situacao, origem.descricaoOrigem origem FROM comanda c, situacao_comanda sitComanda, origem_comanda origem WHERE c.idSituacao = sitComanda.idSituacao and c.idOrigem = origem.idOrigem ORDER BY dataComanda desc";
  }

} else {
    $mysql_query = "SELECT c.*, sitComanda.descricao situacao, origem.descricaoOrigem origem FROM comanda c, situacao_comanda sitComanda, origem_comanda origem WHERE c.idSituacao = sitComanda.idSituacao and c.idOrigem = origem.idOrigem ORDER BY dataComanda desc";
}

$result = $conn->query($mysql_query);
mysqli_close($conn);
?> 

<head>
  <title>Comandas</title>
</head>
<div class="container">
  <br>
  <h2>Comanda</h2>
  <p>Listagem das comandas</p>
  <hr>
  <form method="post" class="mb-3">
    <div class="form-group">
      <label for="filtro">Filtrar por tipo:</label>
      <select name="filtro" id="filtro" class="form-control w-25 d-inline-block">
        <option value="0">Todos</option>
        <option value="1">Aberta</option>
        <option value="2">Fechada</option>
      </select>
      <input type="submit" class="btn btn-secondary ms-5 d-inline-block" style="width: 100px;" value="Filtrar">
      <a href="insert-comanda.php" class="btn btn-warning d-inline-block" style="margin-left: 500px;">Novo</a>
    </div>
  </form>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col" style="width: 15%">Cliente</th>
        <th scope="col" style="width: 5%;">Situação</th>
        <th scope="col" style="width: 20%;">Data Pedido</th>
        <th scope="col" style="width: 15%;">Origem</th>
        <th scope="col" style="width: 15%;">Itens da Comanda</th>
        <th scope="col" style="width: 30%;">Opções Comanda</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['idComanda']; ?></th>
        <td style="text-align:center"><?php echo $data['nomeClienteComanda']; ?></td> 
        <td style="text-align:center"><?php echo $data['situacao']; ?></td> 
        <td style="text-align:center"><?php echo $data['dataComanda'];  ?></td> 
        <td style="text-align:center"><?php echo $data['origem'];  ?></td> 
        <td style="text-align:center">
            <a href="update-comanda.php?idComanda=<?php echo $data['idComanda']; ?> "type="button" class="btn btn-success d-inline-block">Visualizar</a>
        </td>
        <td style="text-align:center">
          <a href="update-comanda.php?idComanda=<?php echo $data['idComanda']; ?> "type="button" class="btn btn-primary">Editar</a>
          <a href="delete-comanda.php?idComanda=<?php echo $data['idComanda']; ?>" button type="button" class="btn btn-danger">Excluir</a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php require("footer.php"); ?>
