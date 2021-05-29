<?php  
	require("../_config/connection.php");
    require("../dao/Telefones.php");
    $telefonesDAO = new Telefones();
    $error = false;

    if(!$_GET || !$_GET["id"]){
        header('Location: index.php?message=Id do telefone não informado!');
        die();
    }

    $telephoneId = $_GET["id"];

    try {
        $result = $telefonesDAO->delete($telephoneId);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $message = ($result && !$error) ? "Telefone excluido com sucesso." : "Erro ao excluir o telefone.";
    header("Location: index.php?message=$message");
    die();

