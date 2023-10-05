<?php
require("header.php");

require_once("connection.php");

// Definição das variáveis e inicialização
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, digite o nome do usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Usuário pode conter apenas letras, números e underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT idUsuario FROM USUARIOS WHERE nomeUsuario = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Esse usuário já está sendo usado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, digite a senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve possuir ao menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, digite a confirmação da senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas digitadas não conferem.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO USUARIOS (nomeUsuario, senhaUsuario) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            // Creates a password hash
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $msg = "insert success";
                $msgerror = "";
                header("location: usuario.php?msg={$msg}&msgerror={$msgerror}");
            } else{
                echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}

?>

<head>
    <title>Novo usuário</title>
</head>

<div class="container-sm">
    <br>
    <h2 class="espaco">Registro de novo usuário</h2>
    <p>Por favor, preencha os campos do formulário abaixo para criar a sua conta.</p>
    <hr>
    <br>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
            <div class="col-4">
            <div class="form-group">
                <input type="text" name="username" placeholder="Usuário" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div> 
            </div>
            <div class="col-3">  
            <div class="form-group">
                <input type="password" name="password" placeholder="Senha" aria-labelledby="passwordHelpBlock" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <div id="passwordHelpBlock" class="form-text">
                A senha deve possuir ao menos 6 caracteres.
                </div>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            </div>
            <div class="col-3">
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirme a senha" aria-labelledby="passwordHelpBlock" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <div id="passwordHelpBlock" class="form-text">
                Digite novamente a mesma senha.
                </div>
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            </div>
            <div class="col-2">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
                <input type="reset" class="btn btn-secondary ml-2" value="Limpar">
            </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        </form>
    </div>    
</div>



<br>
<?php require("footer.php"); ?>