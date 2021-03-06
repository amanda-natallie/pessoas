<?php require "../_helpers/index.php";
echo siteHeader("Editar Pessoa");
require("../_config/connection.php");
require("../dao/Pessoas.php");
$pessoasDAO = new Pessoas();

$pessoa = false;
$error = false;

if (!$_GET || !isset($_GET["id"])) {
    header('Location: index.php?message=Id da pessoa não informado!');
    die();
}

$pessoaId = $_GET["id"];

$pessoa = $pessoasDAO->getById($pessoaId);

if (!$pessoa || $error) {
    header('Location: index.php?message=Erro ao recuperar dados da pessoa!');
    die();
}

$updateError = false;
$rs = false;
if ($_POST) {
    try {
        $p_nome = $_POST["p_nome"];
        $p_endereco = $_POST["p_endereco"];


        $params = [$p_nome, $p_endereco];
        $rs = $pessoasDAO->update($pessoaId, $params);
        
        if ($rs) {
            header('Location: index.php?message=Pessoa atualizada com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $updateError = $e->getMessage();
    }
}

?>

<body>



    <section class="container mt-5 mb-5">

        <?php if ($_POST && (!$rs || $upadeError)) : ?>
            <p>
                Erro ao alterar o pessoa.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Editar pessoa</h1>
            </div>
        </div>

        <form action="" method="post">

            <div class="mb-3">
                <label for="p_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="p_nome" name="p_nome" placeholder="Nome da pessoa" value="<?= $pessoa["p_nome"] ?>">
            </div>

            <div class="mb-3">
                <label for="p_endereco" class="form-label">Endereço</label>
                <textarea style="resize:none" type="text" class="form-control" id="p_endereco" name="p_endereco" placeholder="Endereço da pessoa"><?= $pessoa["p_endereco"] ?></textarea>
            </div>

            <a href="index.php" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>

        </form>
    </section>

    <?php require "../_partials/footer.php"; ?>