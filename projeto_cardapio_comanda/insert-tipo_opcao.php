<?php
require("header.php");

require_once("connection.php");

$inputErro = "";

if (isset($_POST['cadastrar'])) {
	$descricao = $_POST['descricao'];
    $imgPath = "image/";

    if ($_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE && empty($_POST['imagemURL']))
    {
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTmp = $_FILES['imagem']['tmp_name'];

        $imgNomeArray = explode('.', $imagemNome);
        $imgTipo = strtolower(end($imgNomeArray));

        $novaImagem = uniqid();
        $novaImagem .= "." . $imgTipo;

        move_uploaded_file($imagemTmp, $imgPath . $novaImagem);

        $mysql_query = "INSERT INTO `tipo_opcoes_cardapio` (`descricao`, `imagem`) 
            VALUES ('{$descricao}', '{$novaImagem}');";

        $result = $conn->query($mysql_query);
        if ($result === TRUE)
        {
            $msg = "insert success";
            $msgerror = "";
        }
        else
        {
            $msg = "insert error";
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

        $mysql_query = "INSERT INTO `tipo_opcoes_cardapio` (`descricao`, `imagem`) VALUES
                            ('{$descricao}', '{$novaImagem}');";

        $result = $conn->query($mysql_query);
        if ($result === TRUE)
        {
            $msg = "insert success";
            $msgerror = "";
        }
        else
        {
            $msg = "insert error";
            $msgerror = $conn->error;
        }
        mysqli_close($conn);
        header("Location: tipo_opcao.php?msg={$msg}&msgerror={$msgerror}");
    }

    else if (!empty($_POST['imagemURL']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE)
        $inputErro = "Escolha apenas uma das formas de carregar imagem!";
    
    else if ($_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE && empty($_POST['imagemURL']))
        $inputErro = "Imagem não selecionada";
}
?>

<head>
    <title>Novo tipo</title>
</head>

<div class="container">
    <br>
    <h2 class="espaco">Cadastrar novo tipo de opção no cardápio</h2>
    <hr>
    <a href="tipo_opcao.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
    <div class="wrapper row">
        <div class="col-sm-5">
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="descricao" class="form-control" style="width: 500px;" placeholder="Nome do novo tipo de opção" value="<?php echo isset($_POST['descricao']) ? $_POST['descricao'] : ''; ?>" required>
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
                </div>
                <br>
                <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            </form>
        </div>
        <div class="col-sm-7">
            <img id="imagemPreview" src="" alt="Preview">
        </div>
    </div>
</div>
<br>
<?php require("footer.php"); ?>