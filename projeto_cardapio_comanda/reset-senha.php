<?php
require("header.php");

// Include config file
require_once("connection.php");

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Define variables and initialize with empty values
$nova_senha = $conf_senha = "";
$nova_senha_err = $conf_senha_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["nova_senha"]))){
        $nova_senha_err = "Por favor, digite a nova senha.";     
    } elseif(strlen(trim($_POST["nova_senha"])) < 6){
        $nova_senha_err = "A senha deve possuir ao menos 6 caracteres.";
    } else{
        $nova_senha = trim($_POST["nova_senha"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["conf_senha"]))){
        $conf_senha_err = "Por favor, confirme a nova senha.";
    } else{
        $conf_senha = trim($_POST["conf_senha"]);
        if(empty($nova_senha_err) && ($nova_senha != $conf_senha)){
            $conf_senha_err = "As senhas digitadas não conferem.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($nova_senha_err) && empty($conf_senha_err)){
        // Prepare an update statement
        $sql = "UPDATE usuarios SET senhaUsuario = ? WHERE idUsuario = ?";
        
        if($sentenca = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($sentenca, "si", $param_senha, $param_id);
            
            // Set parameters
            $param_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
            $param_id = $_SESSION["idUsuario"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($sentenca)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($sentenca);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<div class="container-sm">
    <br>
    <h2 class="espaco">Alterar senha</h2>
    <p>Por favor, preencha os campos do formulário abaixo para alterar a sua senha.</p>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" name="nova_senha" style="width: 250px;" class="form-control <?php echo (!empty($nova_senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nova_senha; ?>">
                <span class="invalid-feedback"><?php echo $nova_senha_err; ?></span>
            </div>
            <div class="form-group">
                <label for="conf_senha">Confirmação da Nova Senha:</label>
                <input type="password" name="conf_senha" style="width: 250px;" class="form-control <?php echo (!empty($conf_senha_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $conf_senha_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar">
                <button class="btn btn-danger" href="dashboard.php">Cancelar</button>
            </div>
            <br>
        </form>
    </div>    
</div>

<?php require("footer.php"); ?>
