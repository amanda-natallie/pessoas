<?php require "../_helpers/index.php";
echo siteHeader("Ver Pessoa");
require("../_config/connection.php");

$product = false;
$error = false;

if (!$_GET || !isset($_GET["id"])) {
    header('Location: index.php?message=Id do produto não informado!');
    die();
}

$person_id = $_GET["id"];

try {
    $query = "SELECT * FROM tbl_pessoas WHERE p_id = $person_id";

    $result = $conn->query($query);
    $product = $result->fetch_assoc();
    $result->close();
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (!$product || $error) {
    header('Location: index.php?message=Erro ao recuperar dados do produto!');
    die();
}

$conn->close();

?>

    <section class="container mt-5 mb-5">
        <div class="row mb-3">
            <div class="col">
                <h1>Visualizar Pessoa</h1>
            </div>
        </div>

        <div class="mb-3">
            <h3>Nome</h3>
            <p><?= $product["p_nome"] ?></p>
        </div>

        <div class="mb-3">
            <h3>Endereço</h3>
            <p><?= $product["p_endereco"] ?></p>
        </div>
        
        <a href="index.php" class="btn btn-primary">Voltar</a>
       
    </section>
<?php require "../_partials/footer.php"; ?>