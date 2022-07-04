<?php
session_start();
require_once "connection.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css"/>
</head>
<body>
<div class="container">
    <div class="login">
        <h1>Login</h1>
        <div id="alert"></div>
          <?php
            if(isset($_SESSION['message'])) {
              echo "
              <script>
              let errorMessage = '{$_SESSION['message']}';
              let message = document.getElementById('alert');
              message.innerHTML = errorMessage;
              setInterval(() => {message.innerHTML = ''}, 3000);
              </script>";
            }
            unset($_SESSION['message']);

?>
        <form class="form" action="receive-login.php" method="POST">
            <label>
                Email:
                <input type="email" name="email" />
            </label>
            <label>
                Senha:
                <input type="password" name="password" min="4" max="12"/>
            </label>
            <span>Não tem uma conta? <a href="registration.php">Cadastrar</a></span>
            <div class="buttons">
            <button><a href="index.php">Voltar</a></button>
            <button type="submit" name="send-button">Login</button>
            </div>      
        </form>
    </div>
    </div>
</body>
</html>