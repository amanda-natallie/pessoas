<?php  
	require("../_config/connection.php");

    $error = false;

    if(!$_GET || !$_GET["id"]){
        header('Location: index.php?message=Id do telefone não informado!');
        die();
    }

    $telephoneId = $_GET["id"];

    try {
        $query = "DELETE FROM tbl_telefones WHERE t_id=$telephoneId";
		$result = $conn->query($query);
        $conn->close();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $message = ($result && !$error) ? "Telefone excluido com sucesso." : "Erro ao excluir o telefone.";
    header("Location: index.php?message=$message");
    die();

