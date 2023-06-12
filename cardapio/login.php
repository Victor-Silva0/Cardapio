<?php
require("header.php");

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}

// Include config file
require_once("connection.php");
 
// Define variables and initialize with empty values
$nomeUsuario = $senhaUsuario = "";
$nomeUsuario_err = $senhaUsuario_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["nomeUsuario"]))){
        $nomeUsuario_err = "Por favor, digite o usuário.";
    } else{
        $nomeUsuario = trim($_POST["nomeUsuario"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["senhaUsuario"]))){
        $senhaUsuario_err = "Por favor, digite a senha.";
    } else{
        $senhaUsuario = trim($_POST["senhaUsuario"]);
    }
    
    // Validate credentials
    if(empty($nomeUsuario_err) && empty($senhaUsuario_err)){
        // Prepare a select statement
        $sql = "SELECT idUsuario, nomeUsuario, senhaUsuario FROM usuarios WHERE nomeUsuario = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $nomeUsuario;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $idUsuario, $nomeUsuario, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($senhaUsuario, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["idUsuario"] = $idUsuario;
                            $_SESSION["nomeUsuario"] = $nomeUsuario;                            
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Usuário ou senha incorretos.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Usuário ou senha incorretos.";
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="all">
        <div class="container-sm">
            <br>
            <h2>Login</h2>
            <p>Por favor, entre com os seus dados de login.</p>
            <div class="wrapper">
                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label class="control-label">Usuário:</label>
                        <input type="text" name="nomeUsuario" class="form-control <?php echo (!empty($nomeUsuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nomeUsuario; ?>">
                        <span><?php echo $nomeUsuario_err; ?></span>
                    </div>    
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="senhaUsuario" class="form-control <?php echo (!empty($senhaUsuario_err)) ? 'is-invalid' : ''; ?>">
                        <span><?php echo $senhaUsuario_err; ?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <br>
                    <p>Não possui uma conta? <a href="registro-usuarios.php" style="color: #74cee9;">Registre-se agora</a>.</p>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
require("footer.php");
?>
