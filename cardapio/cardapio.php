<?php
require("header.php");

require_once('connection.php');

$mysql_query = "SELECT * FROM opcoes_cardapio ORDER BY 	idOpcaoCardapio";
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
  <div class="float-right p-1">
    <a href="insert-item.php" type="button" class="btn btn-primary">Novo</a>
  </div>
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
          <a href="delete-item.php?idOpcaoCardapio=<?php echo $data['idOpcaoCardapio']; ?>" button type="button" class="btn btn-danger">Excluir</a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php require("footer.php"); ?>