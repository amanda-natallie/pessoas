<?php

$host = "localhost";
$user = "root";
$pwd = "";
$db = "pessoas";

$conn = new mysqli($host, $user, $pwd, $db);

$error = mysqli_connect_errno();
if($error){
    echo "Erro ao tentat se conectar com o banco de dados $error";
    exit();
}
