<?php
require("header.php");

require_once('connection.php');

// Buscar os tipos de opções de cardápio
$tipos_query = "SELECT * FROM tipo_opcoes_cardapio";
$tipos_result = $conn->query($tipos_query);

if (isset($_POST['filtro'])) {
  $filtro = $_POST['filtro'];
  if ($filtro != "0") {
    $mysql_query = "SELECT o.*, t.descricao as tipoDescricao, 
    concat(t.descricao, ' - ',o.nomeOpcaoCardapio,' - ',o.descricao) as TipoNomeDesc 
    FROM opcoes_cardapio o, tipo_opcoes_cardapio t 
    WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio
    and o.idTipoOpcoesCardapio = $filtro 
    ORDER BY TipoNomeDesc";
  } else {
    $mysql_query = "SELECT o.*, t.descricao as tipoDescricao, 
    concat(t.descricao, ' - ',o.nomeOpcaoCardapio,' - ',o.descricao) as TipoNomeDesc 
    FROM opcoes_cardapio o, tipo_opcoes_cardapio t 
    WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio 
    ORDER BY TipoNomeDesc";
  }
} else {
  $mysql_query = "SELECT o.*, t.descricao as tipoDescricao, 
  concat(t.descricao, ' - ',o.nomeOpcaoCardapio,' - ',o.descricao) as TipoNomeDesc
  FROM opcoes_cardapio o, tipo_opcoes_cardapio t 
  WHERE o.idTipoOpcoesCardapio = t.idTipoOpcoesCardapio 
  ORDER BY TipoNomeDesc";
}

$result = $conn->query($mysql_query);
mysqli_close($conn);
?>

<head>
  <title>Cardápio</title>
</head>
<div class="container">
  <br>
  <h2 class="espaco">Cardápio</h2>
  <hr>
  <form method="post" class="mb-3">
    <div class="form-group">
    <label>Filtrar por tipo:</label>
    <div class="row">

      <div class="col-5">
      <select name="filtro" id="filtro" class="form-select ">
        <option value="0">Todos</option>
        <?php while ($tipo = mysqli_fetch_array($tipos_result)) { ?>
          <option value="<?php echo $tipo['idTipoOpcoesCardapio']; ?>"><?php echo $tipo['descricao']; ?></option>
        <?php } ?>
      </select>
      </div>
      <div class="col-2">
      <input type="submit" class="btn btn-primary ms-2 d-inline-block" value="Filtrar">
      </div>
    </div>
    </div>
  </form>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 20%">Nome</th>
        <th scope="col" style="width: 30%;">Descrição</th>
        <th scope="col" style="width: 15%;">Preço</th>

      </tr>
    </thead>
    <tbody>
      <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
          <td><?php echo $data['nomeOpcaoCardapio']; ?></td>
          <td><?php echo $data['descricao']; ?></td>
          <td><?php echo "R$ " . number_format($data['preco'], 2, ',', '.'); ?></td>

        </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
</div>

<?php require("footer.php"); ?>
