<?php
ini_set('display_errors', 1);


$link = new LinkedBar();

$idNegocio = 1;

$negocio = $link->verNegocioPorId($idNegocio);


$categorias = $negocio->getCategorias($negocio->getId());


?>

<header class="mb-5">
	<h1 class="mb-5 p-5 text-center bg-light">Gestionar Menu</h1>
	<div style="margin-top: 58px;">
</header>
<div class="spinner-border position-absolute top-10 start-50 text-danger" style="width : 2.5rem; height:2.5rem; display:none;" role="status">
</div>
<main class="d-flex">
	<section class="w-25" style="margin-top: 58px;">
		<article style="border-right: 6px solid black; height: 500px;" class="text-center p-2 d-flex flex-column">
			<?php echo $negocio->getImg(); ?>
			<h2>
				<?php
				echo $negocio->getNombre();
				?>
			</h2>
			<p> <?php
				echo $negocio->getCifNif();
				?>
			</p>
			<a class='mb-3 btn btn-primary' href="">
				Ordenar categoría
			</a>
			<a class='mb-3 btn btn-primary' href="index.php?controller=CategoriaController&action=crear_categoria">
				Nueva categoría
			</a>
			<a class='mb-3 btn btn-primary' href="index.php?controller=ProductoController&action=crear_producto">
				Nuevo Producto
			</a>
		</article>
	</section>
	<section style="margin-top: 58px; margin-left: 20px; width: 100%;">

		<article>
			<div id="accordion">
				<div class="card">
					<?php
					$i = 1;
					foreach ($categorias as $datos) {
						echo '<div class="card-header" id="headingOne' . $i . '">';
						echo '<h5 class="mb-0">';
						echo '<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne' . $i . '" aria-expanded="true" aria-controls="collapseOne' . $i . '">' . $datos->getNombre() . '</button>';
						echo '<a class="mx-2 btn btn-primary" style="height: 40px;" href="">Editar nombre <i class="fa-solid fa-pen-to-square"></i></a>
							<a class="mx-2 btn btn-primary" style="height: 40px;" href="">Publicar <i class="fa-sharp fa-solid fa-square-check"></i></a>
							<a class="mx-2 btn btn-danger" style="height: 40px;" href=""><i class="fa-solid fa-trash"></i></a>';

						echo '</h5>';
						echo '</div>';
						echo '<div id="collapseOne' . $i . '" class="collapse" aria-labelledby="headingOne' . $i . '" data-parent="#accordion">';
						echo '<div class="card-body">';
						echo '<ul class="list-group">';

						if ($datos->getProductos($datos->getId()) == null) {
							echo "<p class='p-3' style='font-size: 1.2em;'>No hay productos en esta categoria</p>";
						} else {
							foreach ($datos->getProductos($datos->getId()) as $productos) {
								echo '<li class="list-group-item
								"id="producto-' . $productos->getId() .
									'-' . $datos->getId() .
									'">';
								echo $productos->getNombre();
								echo "<a class='mx-2 btn btn-primary' style='height: 40px;' href='index.php?controller=ProductoController&action=editar_producto&idProducto=" . $productos->getId() . "'>Editar Producto <i class='fa-solid fa-pen-to-square'></i></a>";
								echo "<a class='mx-2 btn btn-primary' style='height: 40px;' href='#'>Publicar <i class='fa-sharp fa-solid fa-square-check'></i></a>";
								echo "<btn class='mx-2 btn btn-danger' style='height: 40px;'
									onclick='confirmELiminar(
									" . $productos->getId() . ",
									" . $datos->getId() . "
								)'>Eliminar Producto <i class='fa-solid fa-trash'></i></btn>";
								echo "<a class='mx-2 btn btn-success' style='height: 40px;' href=''>Copiar <i class='fa-regular fa-copy'></i></a>";
								echo '</li>';
								echo "<li class='list-group-item' 
								id='etiquetas-" . $productos->getId() . "'
								>";
								foreach ($productos->getEtiquetas($productos->getId()) as $etiquetas) {
									if ($etiquetas->getAlergeno() == 0) {
										echo "<div class='badge badge-primary border border-primary m-1'>";
										echo "<div class='d-flex' id='etiqueta-" . $etiquetas->getIdEtiqueta() . "'>";
										echo "<span style='color: black;' class='m-1'>" . $etiquetas->getNombre() . "</span>";
										echo "<i id='eliminarEtiqueta'
										onclick='eliminarEtiqueta(
											" . $etiquetas->getIdEtiqueta() . ",
											" . $productos->getId() . "
										)'
										class='fa-solid fa-circle-xmark text-danger' style='cursor:pointer;'></i></div>";
										echo "</div>";
									}
								}
								echo "<button type='button' onclick='
								crearEtiqueta(" . $productos->getId() . " )'
								)' class='btn btn-primary rounded-5' data-toggle='modal' data-target='#myModal'>Nueva Etiqueta<i class='fa-solid fa-plus'>
								</i></button>";
								echo "<button type='button' onclick='
								añadirEtiquetas(" . $productos->getId() . " )'
								)' class='btn btn-warning rounded-5 m-1' data-toggle='modal' data-target='#myModal2'>Añadir Etiquetas<i class='fa-solid fa-plus'></i></button>";
								echo "</li>";
							}
						}
						echo '</ul>';
						echo '</div>';
						echo '</div>';
						$i++;
					}

					?>
				</div>
			</div>
		</article>
	</section>
</main>
<!-- Modal formulario crear etiqueta -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="myModalLabel">Crear Etiqueta</h1>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php
				require 'form_etiqueta.php';
				?>
			</div>
		</div>
	</div>
</div>

<!-- Modal formulario añadir etiquetas -->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="myModalLabel">Añadir etiquetas</h1>
				<button type="button" class="btn-close btnClose2" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-grid">
				<form id="formEtiqueta2" method="post">
					<h4 class="d-block col">Selecciona una etiqueta</h4>
					<div class="form-group col mt-1">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="bi bi-search"></i></span>
							</div>
							<input type="text" class="form-control" name="inputEtiqueta" id="inputEtiqueta" placeholder="Buscar...">
						</div>
					</div>
					<div class="d-flex col">
						<div class="mb-3 input-group contenedorEtiquetas w-75 mt-2 ">
							<!--  Hacer que se muestren las etiquetas -->

						</div>
						<div class="inputsEtiquetas p-1 d-flex flex-wrap w-25 mt-2 ">
							<!--  mostrar las etiquetas elegidas con js -->
						</div>
					</div>
					<button id="añadirEtiqueta" class="d-none btn btn-primary m-5 mt-0 mb-0 botonEtiqueta">
						<i class="bi bi-plus-circle"></i>
						Añadir etiqueta
					</button>
					<h4 class="d-block col">Selecciona un alérgeno</h4>
					<div class="row ">
						<?php
						foreach ($dataToView as $alergeno) {
							echo "<label class='mr-2 col-4'>
							<input type='checkbox' class='m-1' name='alergeno[]' value='" . $alergeno->getIdEtiqueta() . "'>" . $alergeno->getNombre() . "
						</label>";
						}
						?>
					</div>
					<div class="modal-footer mt-2">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>