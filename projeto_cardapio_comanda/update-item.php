<?php
require("header.php");

require_once("connection.php");

$inputErro = "";
$imgPath = "image/";

if (isset($_GET['idOpcaoCardapio']))
{
    $id_opcao_cardapio = $_GET['idOpcaoCardapio'];
    $mysql_query = "SELECT oc.*, toc.descricao tipo FROM opcoes_cardapio oc, tipo_opcoes_cardapio toc
                        WHERE oc.idOpcaoCardapio={$id_opcao_cardapio} AND toc.idTipoOpcoesCardapio=oc.idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
    $row_opcao = mysqli_fetch_array($result);
}

if (isset($_POST['atualizar']))
{
    $id_opcao = $_POST['id_opcao'];
    $nome_opcao = $_POST['nome'];
    $id_tipo = $_POST['tipo_opcao'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $img_atual = $_POST['img_atual'];

    if ($_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE && empty($_POST['imagemURL']))
    {
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTmp = $_FILES['imagem']['tmp_name'];

        $imgNomeArray = explode('.', $imagemNome);
        $imgTipo = strtolower(end($imgNomeArray));

        $novaImagem = uniqid();
        $novaImagem .= "." . $imgTipo;

        move_uploaded_file($imagemTmp, $imgPath . $novaImagem);
        $file_path = "image/" . $img_atual;
        unlink($file_path);

        $mysql_query = "UPDATE opcoes_cardapio oc SET nomeOpcaoCardapio='{$nome_opcao}', 
        idTipoOpcoesCardapio='{$id_tipo}', descricao='{$descricao}', preco='{$preco}', imagem='{$novaImagem}' 
        WHERE oc.idOpcaoCardapio={$id_opcao}";

        $result = $conn->query($mysql_query);
        if ($result === TRUE)
        {
            $msg = "update success";
            $msgerror = "";
        }
        else
        {
            $msg = "update error";
            $msgerror = $conn->error;
        }
        mysqli_close($conn);
        header("Location: cardapio.php?msg={$msg}&msgerror={$msgerror}");
    }

    else if (!empty($_POST['imagemURL']) && $_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE)
    {
        $imagemURL = $_POST['imagemURL'];
        $imagemData = file_get_contents($imagemURL);
        $imagemInfo = getimagesizefromstring($imagemData);
        $imgTipoArray = explode('/', $imagemInfo['mime']);
        $imgTipo = strtolower(end($imgTipoArray));

        $novaImagem = uniqid();
        $novaImagem .= "." . $imgTipo;

        file_put_contents($imgPath . $novaImagem, $imagemData);
        $file_path = "image/" . $img_atual;
        unlink($file_path);

        $mysql_query = "UPDATE opcoes_cardapio oc SET nomeOpcaoCardapio='{$nome_opcao}', 
        idTipoOpcoesCardapio='{$id_tipo}', descricao='{$descricao}', preco='{$preco}', imagem='{$novaImagem}' 
        WHERE oc.idOpcaoCardapio={$id_opcao}";

        $result = $conn->query($mysql_query);
        if ($result === TRUE)
        {
            $msg = "update success";
            $msgerror = "";
        }
        else
        {
            $msg = "update error";
            $msgerror = $conn->error;
        }
        mysqli_close($conn);
        header("Location: cardapio.php?msg={$msg}&msgerror={$msgerror}");
    }

    else if (!empty($_POST['imagemURL']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE)
        $inputErro = "Escolha apenas uma das formas de carregar imagem!";

    else if ($_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE && empty($_POST['imagemURL']))
    {
        $mysql_query = "UPDATE opcoes_cardapio oc SET nomeOpcaoCardapio='{$nome_opcao}', 
        idTipoOpcoesCardapio='{$id_tipo}', descricao='{$descricao}', preco='{$preco}', imagem='{$img_atual}' 
        WHERE oc.idOpcaoCardapio={$id_opcao}";

        $result = $conn->query($mysql_query);
        if ($result === TRUE)
        {
            $msg = "update success";
            $msgerror = "";
        }
        else
        {
            $msg = "update error";
            $msgerror = $conn->error;
        }
        mysqli_close($conn);
        header("Location: cardapio.php?msg={$msg}&msgerror={$msgerror}");
    }

}
else
{
    $mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";
    $result = $conn->query($mysql_query);
}

?>

<head>
    <title>Alterar Item</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Cardápio</h2>
    <p>Atualização do cadastro do cardápio.</p>
    <hr>
    <a href="cardapio.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
    <div class="wrapper row">
        <div class="col-sm-6">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_opcao" value="<?= $row_opcao['idOpcaoCardapio']?>">
                <input type="hidden" name="img_atual" value="<?= $row_opcao['imagem'];?>">
                <label for="nome">Nome da opção</label>
                <input type="text" name="nome" class="form-control" style="width: 250px;" required value="<?= $row_opcao['nomeOpcaoCardapio']?>">
                <br>
                <label for="tipo_opcao">Tipo da opção</label>
                <select name="tipo_opcao" class="form-select" style="width: 200px;" required>
                    <option value="<?= $row_opcao['idTipoOpcoesCardapio'] ?>" selected><?= $row_opcao['tipo']; ?></option>
                    <?php while ($row_tipo = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        if ($row_tipo['idTipoOpcoesCardapio'] != $row_opcao['idTipoOpcoesCardapio']) {?>
                            <option value="<?= $row_tipo['idTipoOpcoesCardapio'];?>"><?= $row_tipo['descricao'];?></option>
                    <?php  } } ?>
                </select>
                <br>
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" class="form-control" style="width: 550px;" required value="<?= $row_opcao['descricao']?>">
                <br>
                <label for="preco">Preço</label>
                <input type="number" min="0.05" step=0.01 name="preco" class="form-control" style="width: 200px;" required value="<?= $row_opcao['preco']?>">
                <br>
                <div class="form-group">
                    <label for="imagem">Imagem salva no computador (recomendado 640:427):</label>
                    <input type="file" name="imagem" accept="image/*" class="form-control w-50"><br>
                    <strong>OU</strong><br><br>
                    <label for="imagemURL">URL da imagem (recomendado 640:427):</label><br>
                    <input type="url" id="imagemURL" name="imagemURL" placeholder="Insira o URL da imagem" class="form-control w-50 d-inline">
                    <button onclick="loadImage()" class="btn btn-info">Projetar imagem</button>
                    <br>
                    <?php if (!empty($inputErro)) { ?>
                    <br>
                    <span class="alert alert-warning"><?php echo $inputErro; ?></span>
                    <br>
                    <?php } ?>
                    <br>
                    <div class="alert alert-info">
                        <h4>Imagem atual: <?= $row_opcao['imagem'];?></h4>
                        <img src="image/<?= $row_opcao['imagem'];?>" alt="Imagem atual" class="img-fluid">
                    </div>
                </div>
                <br>
                <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary w100">
            </form>
        </div>
        <div class="col-sm-6">
            <br>
            <img id="imagemPreview" src="" alt="Preview">
        </div>
    </div>
</div>

<br>
<?php require("footer.php"); ?>