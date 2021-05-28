<?php
require("../_config/connection.php");
require("../dao/Pessoas.php");
$pessoasDAO = new Pessoas();
$error = false;

if (!$_GET || !$_GET["id"]) {
    header('Location: index.php?message=Id do pessoa não informada!');
    die();
}

$pessoaId = $_GET["id"];

try {
    $result = $pessoasDAO->delete($pessoaId);
} catch (Exception $e) {
    $error = $e->getMessage();
}

$message = ($result && !$error) ? "pessoa excluida com sucesso." : "Erro ao excluir o pessoa.";
header("Location: index.php?message=$message");
die();
