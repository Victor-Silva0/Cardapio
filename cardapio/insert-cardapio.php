<?php
require("header.php");

require_once("connection.php");

if (isset($_GET['idOpcaoCardapio']))
{
    $id_opcao_cardapio = $_GET['idOpcaoCardapio'];
    $mysql_query = "SELECT oc.*, toc.descricao tipo FROM opcoes_cardapio oc, tipo_opcoes_cardapio toc
                        WHERE oc.idOpcaoCardapio={$id_opcao_cardapio} AND toc.idTipoOpcoesCardapio=oc.idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
    $row_opcao = mysqli_fetch_array($result);
}

if (isset($_POST['cadastrar']))
{
    $id_opcao = $_POST['id_opcao'];
    $nome_opcao = $_POST['nome'];
    $id_tipo = $_POST['tipo_opcao'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    $mysql_query = "INSERT INTO `opcoes_cardapio`(`nomeOpcaoCardapio`, `idTipoOpcoesCardapio`, `descricao`, `preco`)
    VALUES (
    '{$nome_opcao}', 
    '{$id_tipo}', 
    '{$descricao}', 
    '{$preco}'
    )";

    $result = $conn->query($mysql_query);

    mysqli_close($conn);

    header("Location: cardapio.php");
}
else
{
    $mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
}

?>

<head>
    <title>Novo item</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Cadastro de novas opções no cardápio</h2>
    <hr>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id_opcao" value="<?= $row_opcao['idOpcaoCardapio']?>">
            <div class="row">
                <div class="col-2">
                    <input type="text" name="nome" class="form-control" placeholder="Nome da opção" required>
                </div>
                <div class="col-2">
                    <select class="form-select" name="tipo_opcao"  required>
                    <option selected>Tipo</option>
                    <?php while ($row_tipo = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                    <option value="<?= $row_tipo['idTipoOpcoesCardapio'];?>"><?= $row_tipo['descricao'];?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-5">
                    <input type="text" name="descricao" class="form-control" placeholder="Descrição" required>
                </div>
                <div class="col-2">
                    <input type="number" min="0.05" step=0.01 name="preco" class="form-control" placeholder="Preço" required >
                </div>
                <div class="col-1">
                <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary w100">
                </div>
            </div>
        </form>
    </div>
</div>

<br>
<?php require("footer.php"); ?>
