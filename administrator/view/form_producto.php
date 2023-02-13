<header class="mb-5 container">
	<div class="p-5 text-center bg-light mt-4">
		<h1 class="mb-3">Formulario Producto</h1>
	</div>
</header>
<div class="m-5 container-lg m-auto">
	<form action="index.php?controller=ProductoController&action=guardar_producto" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="mb-3 form-floating p-1 col-6">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
				<label for="nombre" class="form-label">Nombre</label>
			</div>
			<div class="mb-3 form-floating p-1 col-6">
				<input type="text" pattern="[0-9]+[.]{0,1}[0-9]{0,2}" title="Introduce un precio válido" class="form-control" id="precio" name="precio" placeholder="Precio" required>
				<label for="precio" class="form-label">Precio</label>
			</div>
			<div class="mb-3 col-6">
				<input type="file" class="form-control" id="img" name="img" required>
			</div>
			<div class="mb-3 col-6">
				<h5 class="mr-5 tex-center">Estado</h5>
				<input type="radio" name="estado" id="estado" value="1">
				<label for="estado">Publicado</label>
				<input type="radio" name="estado" id="estado1" value="0" checked>
				<label for="estado1">No publicado</label>
			</div>
			<div class="mb-3 form-floating p-1 col-6">
				<select name="categoria" class="form-select" id="categoria">
					<?php
					foreach ($dataToView[1] as $categoria) {
						if (strpos($categoria->getNombre(), 'Principal') !== false) {
							echo "<option id='categoria' value='" . $categoria->getId() . "' selected>" . $categoria->getNombre() . "</option>";
						} else {
							echo "<option id='categoria' value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
						}
					}
					?>
				</select>
				<label for="categoria" class="form-label">Categoría</label>
			</div>
			<div class="col-6">
				<h5 class="mr-5 tex-center">Selecciona un alérgeno</h5>
				<?php
				foreach ($dataToView[0] as $alergeno) {
					echo "<label class='mr-2'>
							<input type='checkbox' class='m-1' name='alergeno[]' value='" . $alergeno->getIdEtiqueta() . "'>" . $alergeno->getNombre() . "
						</label>";
				}
				?>
			</div>
			<div class="d-flex mt-3 justify-content-between">
				<h4 class="d-block w-25">Selecciona una etiqueta</h4>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="bi bi-search"></i></span>
						</div>
						<input type="text" class="form-control" name="inputEtiqueta" id="inputEtiqueta" placeholder="Buscar...">
					</div>
				</div>
				<button id="añadirEtiqueta" class="btn btn-primary m-5 mt-0 mb-0 botonEtiqueta">
					<i class="bi bi-plus-circle"></i>
					Añadir etiqueta
				</button>
			</div>
			<div class="d-flex">
				<div class="mb-3 input-group contenedorEtiquetas w-75 mt-2 ">
					<!--  Hacer que se muestren las etiquetas -->

				</div>
				<div class="inputsEtiquetas p-1 d-flex flex-wrap w-25 mt-2 ">
					<!--  mostrar las etiquetas elegidas con js -->
				</div>
			</div>

			<input type="submit" value="Guardar" name="enviar" id="enviar" class="btn btn-primary mt-3 mb-3 col-2">
			<a class="btn btn-outline-primary mt-3 m-1 mb-3 col-2" href="index.php?controller=carta&action=gestionar_menu">Volver</a>

		</div>
	</form>
</div>