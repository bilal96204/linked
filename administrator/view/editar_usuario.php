<?php
//session_start();
//var_dump($dataToView);
//echo $_SESSION['gestor'];
?>

<header class="mb-5">
	<div class="p-5 text-center bg-light" style="margin-top: 58px;">
		<h1 class="mb-3">Editar Usuario</h1>

	</div>
</header>
<main>
	<form action="index.php?action=guardar_edicion" method="post">
		<h4>Datos personales</h4>
		<div>
			<div class="form-floating mb-3">
				<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $dataToView->getNombre(); ?>">
				<label for="nombre" class="floatingInput">Nombre:</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" name="apellido1" id="apellido1" class="form-control" value="<?php echo $dataToView->getApellido1(); ?>">
				<label for="apellido1" class="floatingInput">Primer apellido:</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" name="apellido2" id="apellido2" class="form-control" value="<?php echo $dataToView->getApellido2(); ?>">
				<label for="apellido2" class="floatingInput">Segundo apellido:</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" name="dni" id="dni" class="form-control" value="<?php echo $dataToView->getDNI(); ?>">
				<label for="dni" class="floatingInput">DNI:</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $dataToView->getDireccion(); ?>">
				<label for="direccion" class="floatingInput">Dirección:</label>
			</div>
		</div>
		<hr>
		<h4>Datos de contacto</h4>

		<div>
			<div class="form-floating mb-3">
				<input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $dataToView->getTelefono(); ?>">
				<label for="telefono" class="floatingInput">Teléfono:</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" name="email" id="email" class="form-control" value="<?php echo $dataToView->getEmail(); ?>">
				<label for="email" class="floatingInput">Mail:</label>
			</div>
		</div>
		<hr>

        <div>
			<div class="form-floating mb-3">
				<input type="password" name="newPassword" id="newPassword" class="form-control">
				<label for="password" class="floatingInput">Nueva contraseña:</label>
			</div>
		</div>
		<hr>

        <div>
			<div class="form-floating mb-3">
				<input type="password" name="oldPassword" id="oldPassword" class="form-control" >
				<label for="password" class="floatingInput">Tu contraseña:</label>
			</div>
		</div>
		<hr>
		<input type="submit" value="Actualizar datos" id="guardar" class="form-control">
	</form>

	<div><a href="index.php?action=verGestor">Volver al inicio</div>
</main>