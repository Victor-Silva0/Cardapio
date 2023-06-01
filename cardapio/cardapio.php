<?php
require("header.php");

require_once('connection.php');

// Buscar os tipos de opções de cardápio
$tipos_query = "SELECT * FROM tipo_opcoes_cardapio";
$tipos_result = $conn->query($tipos_query);

if (isset($_POST['filtro'])) {
  $filtro = $_POST['filtro'];
  if ($filtro != "0") {
    $mysql_query = "SELECT * FROM opcoes_cardapio WHERE idTipoOpcoesCardapio = $filtro ORDER BY idOpcaoCardapio";
  } else {
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
  <p>Listagem dos itens cadastrados.</p>
  <hr>
  <form method="post" class="mb-3">
    <div class="form-group">
      <label for="filtro">Filtrar por tipo:</label>
      <select name="filtro" id="filtro" class="form-select w-25 d-inline-block">
        <option value="0">Todos</option>
        <?php while ($tipo = mysqli_fetch_array($tipos_result)) { ?>
          <option value="<?php echo $tipo['idTipoOpcoesCardapio']; ?>"><?php echo $tipo['descricao']; ?></option>
        <?php } ?>
      </select>
      <input type="submit" class="btn btn-secondary ms-2 d-inline-block" value="Filtrar">
      <a href="insert-cardapio.php" class="btn btn-warning d-inline-block float-end">Novo</a>
      <a href="tipo_opcao.php" class="btn btn-info  d-inline-block float-end" style="margin-right: 5px;">Gerenciar Categorias</a>
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
      <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
          <th scope="row" style="text-align:center"><?php echo $data['idOpcaoCardapio']; ?></th>
          <td><?php echo $data['nomeOpcaoCardapio']; ?></td>
          <td><?php echo $data['descricao']; ?></td>
          <td><?php echo "R$ " . number_format($data['preco'], 2, ',', '.'); ?></td>
          <td style="text-align:center">
            <a href="edit-cardapio.php?id=<?php echo $data['idOpcaoCardapio']; ?>" class="btn btn-primary btn-sm">Editar</a>
            <a href="delete-cardapio.php?id=<?php echo $data['idOpcaoCardapio']; ?>" class="btn btn-danger btn-sm">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php require("footer.php"); ?>
