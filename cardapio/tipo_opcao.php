<?php
require("header.php");

require_once('connection.php');

$mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";

$result = $conn->query($mysql_query);
mysqli_close($conn);
?> 

<head>
  <title>Tipo de Opções Cardápio</title>
</head>
<div class="container">
  <br>
  <h2>Tipo de Opções do cardápio</h2>
  <p>Listagem das opções itens do cardápio.</p>
  <hr>
  <a href="novo_tipo_cardapio.php" class="btn btn-warning d-inline-block" style="margin-left: 1050px; margin-bottom: 10px">Novo</a>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-danger" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col" style="width: 20%">Descrição</th>
        <th scope="col" style="width: 20%;">Opções</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['idTipoOpcoesCardapio']; ?></th>
        <td scope="row" style="text-align:center"><?php echo $data['descricao']; ?></td> 
        <td scope="row" style="text-align:center">
          <a href="update-item.php?idTipoOpcoesCardapio=<?php echo $data['idTipoOpcoesCardapio']; ?> "type="button" class="btn btn-primary">Editar</a>
          <a href="delete-item.php?idTipoOpcoesCardapio=<?php echo $data['idTipoOpcoesCardapio']; ?>" button type="button" class="btn btn-danger">Excluir</a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>
<?php require("footer.php"); ?>
