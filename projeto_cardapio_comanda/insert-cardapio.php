<?php
require("header.php");

require_once("connection.php");

$inputErro = "";

if (isset($_POST['cadastrar'])) {
    $nome_opcao = $_POST['nome'];
    $id_tipo = $_POST['tipo_opcao'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
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

        $mysql_query = "INSERT INTO `opcoes_cardapio` (`nomeOpcaoCardapio`, `idTipoOpcoesCardapio`, `descricao`, `preco`, `imagem`)
        VALUES (
        '{$nome_opcao}',
        '{$id_tipo}', 
        '{$descricao}', 
        '{$preco}',
        '{$novaImagem}'
        );";

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

        $mysql_query = "INSERT INTO `opcoes_cardapio`(`nomeOpcaoCardapio`, `idTipoOpcoesCardapio`, `descricao`, `preco`, `imagem`)
        VALUES (
        '{$nome_opcao}',
        '{$id_tipo}', 
        '{$descricao}', 
        '{$preco}',
        '{$novaImagem}'
        )";

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
        header("Location: cardapio.php?msg={$msg}&msgerror={$msgerror}");
    }

    else if (!empty($_POST['imagemURL']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE) {
        $inputErro = "Escolha apenas uma das formas de carregar imagem!";
        $mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";
        $result = $conn->query($mysql_query);
    }
    
    else if ($_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE && empty($_POST['imagemURL'])){
        $inputErro = "Imagem não selecionada";
        $mysql_query = "SELECT * FROM tipo_opcoes_cardapio ORDER BY idTipoOpcoesCardapio";
        $result = $conn->query($mysql_query);
        }

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
    <a href="cardapio.php" type="button" class="btn btn-info d-inline-block" style="margin-bottom: 10px">Voltar</a>
    <div class="wrapper row">
        <div class="col-sm-5">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="nome" class="form-control w-75" placeholder="Nome da opção" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>" required>
            <br>
            <label for="tipo_opcao">Tipo da opção:</label>
            <select class="form-select w-75" name="tipo_opcao"  required>
            <?php while ($row_tipo = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
            <option value="<?= $row_tipo['idTipoOpcoesCardapio'];?>" <?php echo isset($_POST['tipo_opcao']) && $_POST['tipo_opcao'] == $row_tipo['idTipoOpcoesCardapio'] ? 'selected' : '';?>><?= $row_tipo['descricao'];?></option>
            <?php } ?>
            </select>
            <br>
            <input type="text" name="descricao" class="form-control w-75" placeholder="Descrição" value="<?php echo isset($_POST['descricao']) ? $_POST['descricao'] : ''; ?>" required>
            <br>
            <input type="number" min="0.05" step=0.01 name="preco" class="form-control w-75" placeholder="Preço" value="<?php echo isset($_POST['preco']) ? $_POST['preco'] : ''; ?>" required>
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
