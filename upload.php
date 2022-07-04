<?php
session_start();
require_once "connection.php";

if (isset($_POST['send_button'])) {
    $description = $_POST['description'];
    $email = $_SESSION['email'];
    
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'];

    $extension = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

    if (in_array($extension, $allowed_extensions)) {
        $folder = "images/";
        $temporary = $_FILES['arquivo']['tmp_name'];
        $new_file_name = uniqid() . ".$extension";

        if (move_uploaded_file($temporary, $folder . $new_file_name)) {
            $_SESSION['message'] = "Upload realizado!";

            $userID = "SELECT id FROM usuarios WHERE email = '$email'";
            $resultID = mysqli_query($con, $userID);

            if (mysqli_num_rows($resultID) > 0) {
                while($row = mysqli_fetch_assoc($resultID)) {
                    $id = $row["id"];
                    $sql = "INSERT INTO images (id, descricao, image_path) VALUES ('$id', '$description', 'images/$new_file_name')";

                    if (mysqli_query($con, $sql)) {
                        $_SESSION['message'] = "Upload feito com sucesso!";
                        $_SESSION['path'] = $folder . $new_file_name;
                        $_SESSION['description'] = $description;
                        header('Location: ./index.php');
                        exit;
                    } else {
                        $_SESSION['message'] = "Falha no upload";
                        header('Location: ./index.php');
                        exit;
                    }
                }               
            }        
        } else {
            $_SESSION['message'] = "Falha no upload";
            header('Location: ./index.php');
        }
    } else {
        $_SESSION['message'] = "Tipo do arquivo não permitido";
        header('Location: ./index.php');
    }
}
