<?php require "../_helpers/index.php";
echo siteHeader("Adicionar Telefone");
require("../_config/connection.php");
require("../dao/Telefones.php");
require("../dao/Pessoas.php");

$telefonesDAO = new Telefones();
$pessoasDAO = new Pessoas();

$result = false;
$error = false;
if ($_POST) {
    try {
        $t_id_pessoa  = $_POST["t_id_pessoa"];
        $t_numero = $_POST["t_numero"];
        $t_ddd = $_POST["t_ddd"];
        $t_tipo = $_POST["t_tipo"];

        $params = [$t_id_pessoa, $t_numero, $t_ddd, $t_tipo];
        $result = $telefonesDAO->insert($params);
         if ($result) {
            header('Location: index.php?message=Telefone inserido com sucesso!');
            die();
        } 
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
try {
    $personsResult = $pessoasDAO->getAll();
} catch (Exception $e) {
    header('Location: index.php?message=Erro ao recuperar pessoas!');
    die();
}
?>

<section class="container mt-5 mb-5">

    <?php if ($_POST && (!$result || $error)) : ?>
        <p>
            Erro ao salvar o novo telefone.
            <?= $error ? $error : "Erro desconhecido." ?>
        </p>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col">
            <h1>Adicionar telefone</h1>
        </div>
    </div>

    <form action="" method="post">
        <div class="row">

            <div class="mb-3">
                <label for="t_id_pessoa" class="form-label">De quem é este telefone?</label>
                <select class="form-select" id="t_id_pessoa" name="t_id_pessoa" required>
                    <option value="">-- Selecione um --</option>

                    <?php foreach ($personsResult as $persons) : ?>
                        <option value="<?= $persons->p_id ?>">
                            <?= $persons->p_nome ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3">
                <label for="t_ddd" class="form-label">DDD</label>
                <input type="text" class="form-control" id="t_ddd" name="t_ddd" />
            </div>
            <div class="col-9">
                <label for="t_numero" class="form-label">Número</label>
                <input type="text" class="form-control" id="t_numero" name="t_numero" />
            </div>
        </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="t_tipo" class="form-label">Tipo</label>
                <select name="t_tipo" id="t_tipo" class="form-select">
                    <option value="">-- Selecione um --</option>
                    <option value="1">Fixo</option>
                    <option value="2">Celular</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="index.php" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>

    </form>
</section>

<?php require "../_partials/footer.php"; ?>