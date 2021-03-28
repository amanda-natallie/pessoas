<?php require "../_helpers/index.php";
echo siteHeader("Ver Telefone");
require("../_config/connection.php");

$telephone = false;
$error = false;

if (!$_GET || !$_GET["id"]) {
    header('Location: index.php?message=Id da categoria não informado!');
    die();
}

$telephoneId = $_GET["id"];

try {
    $query = "SELECT * FROM tbl_telefones INNER JOIN tbl_pessoas 
	ON tbl_telefones.t_id_pessoa = tbl_pessoas.p_id WHERE tbl_telefones.t_id = $telephoneId";
    $result = $conn->query($query);
    $telephone = $result->fetch_assoc();
    $result->close();
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (!$telephone || $error) {
    header('Location: index.php?message=Erro ao recuperar dados da categoria!');
    die();
}

$conn->close();

?>


    <section class="container mt-5 mb-5">
        <div class="row mb-3">
            <div class="col">
                <h1>Visualizar telefone</h1>
            </div>
        </div>

        <div class="mb-3">
            <h3>Dono do Telefone</h3>
            <p><?= $telephone["p_nome"] ?></p>
        </div>
        
        <div class="mb-3">
            <h3>Telefone</h3>
            <p><?= "(".$telephone["t_ddd"].") " . $telephone["t_numero"] ?></p>
        </div>
        
        <div class="mb-3">
            <h3>Tipo</h3>
            <p><?= $telephone["t_tipo"] == 1 ? "Fixo" : "Celular" ?></p>
        </div>
        <a href="index.php" class="btn btn-primary">Voltar</a>
    </section>
<?php require "../_partials/footer.php"; ?>