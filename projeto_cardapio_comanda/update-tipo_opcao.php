<?php
require("header.php");

require_once("connection.php");

$inputErro = "";
$imgPath = "image/";

if (isset($_GET['idTipoOpcoesCardapio']))
{
    $id_tipo = $_GET['idTipoOpcoesCardapio'];
    $mysql_query = "SELECT * FROM tipo_opcoes_cardapio
                        WHERE idTipoOpcoesCardapio={$id_tipo}";
    $result = $conn->query($mysql_query);
    $row_tipo = mysqli_fetch_array($result);
}

if (isset($_POST['atualizar']))
{
    $id_tipo = $_POST['id_tipo'];
    $nome_tipo = $_POST['nome'];
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

        $mysql_query = "UPDATE tipo_opcoes_cardapio 
            SET descricao='{$nome_tipo}', imagem='{$novaImagem}' WHERE idTipoOpcoesCardapio={$id_tipo}";

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
        header("Location: tipo_opcao.php?msg={$msg}&msgerror={$msgerror}");
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

        $mysql_query = "UPDATE tipo_opcoes_cardapio 
            SET descricao='{$nome_tipo}', imagem='{$novaImagem}' WHERE idTipoOpcoesCardapio={$id_tipo}";

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
        header("Location: tipo_opcao.php?msg={$msg}&msgerror={$msgerror}");
    }

    else if (!empty($_POST['imagemURL']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE)
        $inputErro = "Escolha apenas uma das formas de carregar imagem!";

    else if ($_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE && empty($_POST['imagemURL']))
    {
        $mysql_query = "UPDATE tipo_opcoes_cardapio
            SET descricao='{$nome_tipo}', imagem='{$img_atual}' WHERE idTipoOpcoesCardapio={$id_tipo}";

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
        header("Location: tipo_opcao.php?msg={$msg}&msgerror={$msgerror}");
    }
}

?>

<head>
    <title>Alterar tipo</title>
</head>
<div class="container">
    <br>
    <h2 class="espaco">Categorias</h2>
    <p>Atualização do cadastro de categorias.</p>
    <hr>
    <a href="tipo_opcao.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
    <div class="wrapper row">
        <div class="col-sm-6">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_tipo" value="<?= $row_tipo['idTipoOpcoesCardapio'];?>">
                <input type="hidden" name="img_atual" value="<?= $row_tipo['imagem'];?>">
                <label for="nome">Nome da categoria</label>
                <input type="text" name="nome" class="form-control" style="width: 250px;" required value="<?= $row_tipo['descricao']?>">
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
                        <h4>Imagem atual: <?= $row_tipo['imagem'];?></h4>
                        <img src="image/<?= $row_tipo['imagem'];?>" alt="Imagem atual" class="img-fluid">
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