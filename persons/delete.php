<?php  
	require("../_config/connection.php");

    $error = false;

    if(!$_GET || !$_GET["id"]){
        header('Location: index.php?message=Id do pessoa não informada!');
        die();
    }

    $pessoaId = $_GET["id"];

    try {
        $query = "DELETE FROM tbl_pessoas WHERE p_id=$pessoaId";
		$result = $conn->query($query);
        $conn->close();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    $message = ($result && !$error) ? "pessoa excluida com sucesso." : "Erro ao excluir o pessoa.";
    header("Location: index.php?message=$message");
    die();

