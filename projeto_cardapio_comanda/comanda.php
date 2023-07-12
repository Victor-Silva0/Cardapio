<?php
require("header.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

require_once('connection.php');


if (isset($_POST['filtro'])) {
  $filtro = $_POST['filtro'];
  if ($filtro != "0") {
  $mysql_query = "SELECT c.*, sitComanda.idSituacao idS, sitComanda.descricao situacao, origem.descricaoOrigem origem 
  FROM comanda c, situacao_comanda sitComanda, origem_comanda origem 
  WHERE c.idSituacao = {$filtro} 
  and sitComanda.idSituacao = {$filtro} 
  and c.idOrigem = origem.idOrigem 
  ORDER BY idComanda";
  }
  else {
    $mysql_query = "SELECT c.*, sitComanda.idSituacao idS, sitComanda.descricao situacao, origem.descricaoOrigem origem 
    FROM comanda c, situacao_comanda sitComanda, origem_comanda origem 
    WHERE c.idSituacao = sitComanda.idSituacao and c.idOrigem = origem.idOrigem 
    ORDER BY idComanda";
  }

} else {
    $mysql_query = "SELECT c.*, sitComanda.idSituacao idS, sitComanda.descricao situacao, origem.descricaoOrigem origem 
    FROM comanda c, situacao_comanda sitComanda, origem_comanda origem 
    WHERE c.idSituacao = sitComanda.idSituacao and c.idOrigem = origem.idOrigem 
    ORDER BY idComanda";
    }

$result = $conn->query($mysql_query);

$sit_query = "SELECT * FROM situacao_comanda";
$sit_result = $conn->query($sit_query);

mysqli_close($conn);
?> 

<head>
  <title>Gerenciar Comandas</title>
</head>
<div class="container">
  <br>
  <h2 class="espaco">Gerenciar Comandas</h2>
  <hr>
  <a href="dashboard.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
  <form method="post" class="mb-3">
    <div class="form-group">
      <label for="filtro">Filtrar por situação:</label>
      <select name="filtro" id="filtro" class="form-select w-25 d-inline-block">
        <option value="0">Todas</option>
        <?php while ($row = mysqli_fetch_array($sit_result)) { ?>
        <option value="<?= $row['idSituacao'];?>" <?php echo isset($_POST['filtro']) && $_POST['filtro'] == $row['idSituacao'] ? 'selected' : '' ?>><?= $row['descricao'];?></option>
        <?php } ?>
      </select>
      <input type="submit" class="btn btn-secondary ms-0 d-inline-block" style="width: 100px;" value="Filtrar">
      <a href="insert-comanda.php" class="btn btn-warning d-inline-block float-end">Incluir nova Comanda</a>
    </div>
  </form>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col" style="width: 15%">Cliente</th>
        <th scope="col" style="width: 5%;">Situação</th>
        <th scope="col" style="width: 20%;">Data Pedido</th>
        <th scope="col" style="width: 12%;">Origem</th>
        <th scope="col" style="width: 12%;">Itens da Comanda</th>
        <th scope="col" style="width: 17%;">Opções Comanda</th>
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
            <a href="insert-item_comanda.php?idComanda=<?php echo $data['idComanda']; ?> "type="button" class="btn btn-success d-inline-block">Abrir</a>
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
