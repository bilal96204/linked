<div class="container-fluid bg-primary mx-auto grid p-4" style="width: 100%;">
	<div class="row">
		<div class="col grid">
			<h2 class="fw-bold">Tus Datos:</h2>
			<div class="row"><p class="col fs-3 text-decoration-underline">Nombre completo:</p><p class="col fs-4"><?= $dataToView->getNombre() ?> <?= $dataToView->getApellido1() ?> <?= $dataToView->getApellido2() ?></p></div> <!-- Nombre y apellidos -->
			<div class="row"><p class="col fs-3 text-decoration-underline">Correo electrónico:</p><p class="col fs-4"><?= $dataToView->getEmail() ?></p></div> <!-- Email -->
			<div class="row"><p class="col fs-3 text-decoration-underline">DNI:</p><p class="col fs-4"><?= $dataToView->getDNI() ?></p></div> <!-- DNI -->
			<div class="row"><p class="col fs-3 text-decoration-underline">Teléfono:</p><p class="col fs-4"><?= $dataToView->getTelefono() ?></p></div> <!-- Telefono -->
			<div class="row"><p class="col fs-3 text-decoration-underline">Dirección:</p><p class="col fs-4"><?= $dataToView->getDireccion() ?></p></div> <!-- Direccion -->
		</div>
		<div class="col"></div>
		<div class="col">
			<div class="grid row text-end pt-3">
				<div class="row mb-2"><a href="index.php?action=editarGestor"><button type="button" class="btn btn-light">Editar perfil</button></a></div>
				<div class="row"><a href="index.php?action=cerrarSesion"><button type="button" class="btn btn-light">Cerrar Sesión</button></a></div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid bg-light mx-auto grid p-4" style="width: 100%;">
	<div class="row" style="width: 100%;">
		<div class="col" style="position: relative;">
			<a href="index.php?action=crearNegocio" style="color: black;"><i class="bi bi-plus fs-2"></i></a>
		</div>
	</div>
	<div class="row d-flex flex-row justify-content-around align-items-center flex-wrap p-5">
		<div class="column p-4" style="width: 45%;">
			<h1 class="text-center">Tus negocios:</h1>
			<div class="row d-flex flex-row justify-content-around align-items-center flex-wrap p-5">
				<?php
					foreach($dataToView->negociosUnido as $negocio){
						?>
						<a href="index.php?action=verNegocio&id=<?= $negocio->getId() ?>" style="width: 300px; height: 300px;">
							<div class="border border-primary rounded-3 position-relative" style="width: 100%; height: 100%;">
								<img class="rounded-3" src="<?= $negocio->getImagen() ?>" style="width: 100%; height: 100%;">
								<p class="position-absolute top-50 start-0 text-center bg-success p-2" style="width: 100%; --bs-bg-opacity: .5;"><?= $negocio->getNombre() ?></p>
							</div>
						</a>
						<?php
					}
				?>
			</div>
		</div>
		<div class="column p-4" style="width: 45%;">
			<h1 class="text-center">Invitaciones:</h1>
			<div class="row d-flex flex-row justify-content-around align-items-center flex-wrap p-5">
				<?php
					if(count($dataToView->negociosInvitado) > 0){
						foreach($dataToView->negociosInvitado as $negocio){
							?>
							<a href="" style="width: 300px; height: 300px;">
								<div class="border border-primary rounded-3 position-relative" style="width: 100%; height: 100%;">
									<img class="rounded-3" src="<?= $negocio->getImagen() ?>" style="width: 100%; height: 100%;">
									<p class="position-absolute top-50 start-0 text-center bg-success p-2" style="width: 100%; --bs-bg-opacity: .5;"><?= $negocio->getNombre() ?></p>
								</div>
							</a>
							<?php
						}
					} else {
						echo "<p>No tienes invitaciones pendientes.</p>";
					}
				?>
			</div>
		</div>
	</div>
</div>