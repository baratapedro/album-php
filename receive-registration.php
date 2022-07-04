<?php
session_start();
require_once "connection.php";


if (isset($_POST['send-button'])) {
    $email =  mysqli_real_escape_string($con, $_POST['email']);
    $password = md5(mysqli_real_escape_string($con, $_POST['password']));

    $emailSql = "SELECT * FROM usuarios WHERE email = '$email'";
    $userID = "SELECT id FROM usuarios WHERE email = '$email'";
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


    $result = mysqli_query($con, $emailSql);


    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "E-mail ja cadastrado!";
        header('Location: ./registration.php');
        exit;
    }

    $sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$password')";

    if (mysqli_query($con, $sql)) {
        $_SESSION['message'] = "Cadastrado com sucesso!";
        $_SESSION['email'] = $email;
        header('Location: ./index.php');
        exit;
    } else {
        $_SESSION['message'] = "Erro no cadastro!";
        header('Location: ./registration.php');
        exit;
    }

    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail inválido.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
    }
}
