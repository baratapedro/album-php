<?php
session_start();
require_once "connection.php";


if(isset($_POST['send-button'])) {
    $email =  $_POST['email'];
    $password =  md5($_POST['password']);
    $userID = "SELECT id FROM usuarios WHERE email = '$email'";
    $emailSql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$password'";

    $result = mysqli_query($con, $emailSql);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Logado com sucesso!";
        $_SESSION['email'] = $email;   
        header('Location: ./index.php');
    } else {
        $_SESSION['message'] = "E-mail e/ou senha inválidos!";
        header('Location: ./login.php');
    }   

    

}