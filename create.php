<?php

$emailSql = "SELECT email FROM usuarios";
$emailResult = mysqli_query($con, $emailSql);
$emailQuery = "SELECT * FROM usuarios WHERE {$_SESSION['email']} = $emailSql";
