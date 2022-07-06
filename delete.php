<?php 
session_start();
require_once "connection.php";


$path_name = $_POST['path_name'];

$sql = "DELETE FROM images WHERE image_path = '$path_name'";
$result = mysqli_query($con, $sql);
if (mysqli_query($con, $sql)) {
    header('Location: ./index.php');
    exit;
}
