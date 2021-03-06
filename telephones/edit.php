<?php require "../_helpers/index.php";
echo siteHeader("Editar Telefone");
require("../_config/connection.php");

require("../dao/Telefones.php");
require("../dao/Pessoas.php");
$telephoneDao = new Telefones();
$pessoasDao = new Pessoas();

$telephone = false;
$error = false;

if (!$_GET || !isset($_GET["id"])) {
    header('Location: index.php?message=Id do telefone não informado!');
    die();
}

$telephoneId = $_GET["id"];

try {
    $telephone = $telephoneDao->getById($telephoneId);
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (!$telephone || $error) {
    header('Location: index.php?message=Erro ao recuperar dados do telefone!');
    die();
}

$upadeError = false;
$updateResult = false;
if ($_POST) {
    try {
        $t_id_pessoa  = $_POST["t_id_pessoa"];
        $t_numero = $_POST["t_numero"];
        $t_ddd = $_POST["t_ddd"];
        $t_tipo = $_POST["t_tipo"];

        $params = [$t_id_pessoa, $t_numero, $t_ddd, $t_tipo];
        $updateResult = $telephoneDao->update($telephone["t_id"], $params);
        
        if ($updateResult) {
            header('Location: index.php?message=Telefone alterado com sucesso!');
            die();
        }
    } catch (Exception $e) {
        $upadeError = $e->getMessage();
    }
}
try {
    $personsResult = $pessoasDao->getAll();
} catch (Exception $e) {
    header('Location: index.php?message=Erro ao recuperar pessoas!');
    die();
}

?>


<section class="container mt-5 mb-5">

    <?php if ($_POST && (!$updateResult || $upadeError)) : ?>
        <p>
            Erro ao alterar o telefone.
            <?= $error ? $error : "Erro desconhecido." ?>
        </p>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col">
            <h1>Editar Telefone</h1>
        </div>
    </div>

    <form action="" method="post">
        <div class="row">

            <div class="mb-3">
                <label for="t_id_pessoa" class="form-label">De quem é este telefone?</label>
                <select class="form-select" id="t_id_pessoa" name="t_id_pessoa" required>
                    <option value="">-- Selecione um --</option>

                    <?php foreach ($personsResult as $persons) : ?>
                        <option value="<?= $persons->p_id ?>" <?= $persons->p_id == $telephone["t_id_pessoa"] ? "selected" : "" ?>>
                            <?= $persons->p_nome ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3">
                <label for="t_ddd" class="form-label">DDD</label>
                <input type="text" class="form-control" id="t_ddd" name="t_ddd" value="<?= $telephone["t_ddd"] ?>" />
            </div>
            <div class="col-9">
                <label for="t_numero" class="form-label">Número</label>
                <input type="text" class="form-control" id="t_numero" name="t_numero" value="<?= $telephone["t_numero"] ?>" />
            </div>
        </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="t_tipo" class="form-label">Tipo</label>
                <select name="t_tipo" id="t_tipo" class="form-select">
                    <option value="">-- Selecione um --</option>
                    <option value="1" <?= $telephone["t_tipo"] == 1 ? "selected" : "" ?>>Fixo</option>
                    <option value="2" <?= $telephone["t_tipo"] == 2 ? "selected" : "" ?>>Celular</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="index.php" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Atualizar</button>
            </div>
        </div>

    </form>
</section>

<?php require "../_partials/footer.php"; ?>