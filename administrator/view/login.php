
<header class="mb-5">
	<div class="p-5 text-center" style="margin-top: 58px;">
		<h1 class="p-3 mx-auto bg-primary rounded" style="width: 50%;">Iniciar Sesión</h1>
	</div>
</header>
<div class="grid text-center">
	<div class="row">
		<div class="col"></div>
		<div class="col"></div>
		<div class="col bg-light p-5">
			<form action="index.php?action=logearUsuario" method="post">
				<div class="mb-3">
					<label for="email" class="form-label">Correo electrónico</label>
					<input type="email" class="form-control" id="email" name="email" required/>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Contraseña</label>
					<input type="password" class="form-control" id="password" name="password" required/>
				</div>
				<button type="submit" class="btn btn-primary ">Entrar</button>
			</form>
			<br />
			<a href="index.php?action=crear_usuario"><button class="btn btn-secondary ">Crear Cuenta</button></a>
		</div>
		<div class="col"></div>
		<div class="col"></div>
	</div>
</div>