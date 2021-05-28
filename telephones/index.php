<?php require "../_helpers/index.php";
echo siteHeader("Gerenciar Telefones");
require("../_config/connection.php");
$message = false;
if ($_GET && $_GET["message"]) {
	$message = $_GET["message"];
}
require("../dao/Telefones.php");
$telefones = new Telefones();
?>
<section class="container mt-5 mb-5">

	<?php if ($message) : ?>
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<?= $message ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>

	<div class="row mb-3">
		<div class="col">
			<h1>Telefones</h1>
		</div>
		<div class="col d-flex justify-content-end align-items-center">
			<a class="btn btn-primary" href="add.php">Adicionar</a>
		</div>
	</div>

	<table class="table table-striped table-bordered text-center">
		<thead class="table-dark">
			<tr>
				<th>ID</th>
				<th>Pessoa</th>
				<th>DDD</th>
				<th>Número</th>
				<th>Tipo</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($telefones->getAll(true) AS $telephone) : ?>
				<tr>
					<td>
						<?= "#".$telephone->t_id?>
					</td>

					<td>
						<?= $telephone->p_nome ?>
					</td>
					
					<td>
						<?= $telephone->t_ddd ?>
					</td>
					
					<td>
						<?= $telephone->t_numero ?>
					</td>
					<td>
						<?= $telephone->t_tipo == 1 ? "Fixo" : "Celular" ?>
					</td>
					<td>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-outline-primary" onclick="confirmDelete(<?= $telephone->t_id ?>)">
								Excluir
							</button>
							<a href="edit.php?id=<?= $telephone->t_id ?>" class="btn btn-outline-primary">
								Editar
							</a>
							<a href="view.php?id=<?= $telephone->t_id ?>" class="btn btn-outline-primary">
								Ver
							</a>
						</div>
					</td>
				</tr>

			<?php endforeach; ?>
		</tbody>
		<tfooter class="table-dark">
			<tr>
				<th>ID</th>
				<th>Pessoa</th>
				<th>DDD</th>
				<th>Número</th>
				<th>Tipo</th>
				<th>Ações</th>
			</tr>
		</tfooter>
	</table>
</section>

<script>
	const confirmDelete = (telephoneId) => {
		const response = confirm("Deseja realmente excluir esta categoria?")
		if (response) {
			window.location.href = "delete.php?id=" + telephoneId
		}
	}
</script>

<?php require("../_partials/footer.php"); ?>