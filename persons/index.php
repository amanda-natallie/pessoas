<?php require "../_helpers/index.php";
echo siteHeader("Gerenciar Pessoas");
require("../_config/connection.php");
require("../dao/Pessoas.php");
require("../dao/Telefones.php");

$message = false;
$telephone_id = null;
$pessoas = new Pessoas();
$telefones = new Telefones();

if ($_GET) {
	if (isset($_GET["message"])) {
		$message = $_GET["message"];
	}
	if (isset($_GET["telephone_id"])) {
		$telephone_id = $_GET["telephone_id"];
	}
}
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
			<h1>Pessoas</h1>
		</div>
		<div class="col d-flex justify-content-end align-items-center">
			<a class="btn btn-primary" href="add.php">Adicionar</a>
		</div>
	</div>

	<form action="" method="get">
		<div class="input-group mb-3">
			<select class="form-select" id="telephone_id" name="telephone_id">
				<option value>--filtre por telefone --</option>

				<?php foreach ($telefones->getAll() AS $telephone) : ?>
					<option value="<?= $telephone->t_id ?>" <?= $telephone->t_id == $telephone_id ? 'selected' : ''; ?>>
						<?= "(".$telephone->t_ddd.") " . $telephone->t_numero ?>
					</option>
				<?php endforeach; ?>

			</select>
			<button class="btn btn-outline-secondary" type="submit">
				Pesquisar
			</button>
			<?php if (isset($_GET["telephone_id"])) {
				echo '<a class="btn btn-outline-secondary" href="index.php">
							Mostrar tudo
					  </a>';
			} ?>
			
		</div>
	</form>

	<table class="table table-striped table-bordered text-center">
		<thead class="table-dark">
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Endereço</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pessoas->getAll($telephone_id) AS $product) : ?>
				<tr>
					<td>
						<?= "#".$product->p_id ?>
					</td>
					<td>
						<?= $product->p_nome ?>
					</td>
					<td>
						<?= $product->p_endereco ?>
					</td>
					
					<td>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-outline-primary" onclick="confirmDelete(<?= $product->p_id ?>)">
								Excluir
							</button>
							<a href="edit.php?id=<?= $product->p_id ?>" class="btn btn-outline-primary">
								Editar
							</a>
							<a href="view.php?id=<?= $product->p_id ?>" class="btn btn-outline-primary">
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
				<th>Nome</th>
				<th>Endereço</th>
				<th>Ações</th>
			</tr>
		</tfooter>
	</table>
</section>


<script>
	const confirmDelete = (productId) => {
		const response = confirm("Deseja realmente excluir esta pessoa?")
		if (response) {
			window.location.href = "delete.php?id=" + productId
		}
	}
</script>

<?php require("../_partials/footer.php"); ?>