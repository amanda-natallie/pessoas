<?php require "../_helpers/index.php";
echo siteHeader("Adicionar Pessoa");
require("../_config/connection.php");
$result = false;
$error = false;


if ($_POST) {
    try {
        $p_nome = $_POST["p_nome"];
        $p_endereco = $_POST["p_endereco"];

        $query = "INSERT INTO tbl_pessoas (
            p_nome, 
            p_endereco 
        ) VALUES (
            '$p_nome',
            '$p_endereco'
        )";
        echo $query;
        $result = $conn->query($query);
        $conn->close();

        if ($result) {
            header('Location: index.php?message=Pessoa inserida com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}


?>

<body>



    <section class="container mt-5 mb-5">

        <?php if ($_POST && (!$result || $error)) : ?>
            <p>
                Erro ao salvar a nova pessoa.
                <?= $error ? $error : "Erro desconhecido." ?>
            </p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col">
                <h1>Adicionar pessoa</h1>
            </div>
        </div>

        <form action="" method="post">
            <div class="mb-3">
                <label for="p_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="p_nome" name="p_nome" placeholder="Nome da pessoa">
            </div>

            <div class="mb-3">
                <label for="p_endereco" class="form-label">Endereço</label>
                <textarea style="resize:none" type="text" class="form-control" id="p_endereco" name="p_endereco" placeholder="Endereço da pessoa"></textarea>
            </div>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </section>

    <?php require "../_partials/footer.php"; ?>