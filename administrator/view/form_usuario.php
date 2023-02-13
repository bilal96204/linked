		<header class="mb-5">
		    <div class="p-5 text-center bg-light" style="margin-top: 58px;">
		        <h1 class="mb-3">Formulario Usuario</h1>

		    </div>
		</header>

		<main>
		    <form action="index.php?action=guardar_usuario" method="post">
		        <h4>Datos personales</h4>
		        <div>
		            <div class="form-floating mb-3">
		                <input type="text" name="nombre" id="nombre" class="form-control">
		                <label for="nombre" class="floatingInput">Nombre:</label>
		            </div>
		            <div class="form-floating mb-3">
		                <input type="text" name="apellido1" id="apellido1" class="form-control">
		                <label for="apellido1" class="floatingInput">Primer apellido:</label>
		            </div>
		            <div class="form-floating mb-3">
		                <input type="text" name="apellido2" id="apellido2" class="form-control">
		                <label for="apellido2" class="floatingInput">Segundo apellido:</label>
		            </div>
		            <div class="form-floating mb-3">
		                <input type="text" name="dni" id="dni" class="form-control">
		                <label for="dni" class="floatingInput">DNI:</label>
		            </div>
		            <div class="form-floating mb-3">
		                <input type="text" name="direccion" id="direccion" class="form-control">
		                <label for="direccion" class="floatingInput">Dirección:</label>
		            </div>
		        </div>
		        <hr>
		        <h4>Datos de contacto</h4>

		        <div>
		            <div class="form-floating mb-3">
		                <input type="text" name="telefono" id="telefono" class="form-control">
		                <label for="telefono" class="floatingInput">Teléfono:</label>
		            </div>
		            <div class="form-floating mb-3">
		                <input type="text" name="email" id="email" class="form-control">
		                <label for="email" class="floatingInput">Mail:</label>
		            </div>
		        </div>
		        <hr>

		        <div>
		            <div class="form-floating mb-3">
		                <input type="text" name="password" id="password" class="form-control">
		                <label for="password" class="floatingInput">Constraseña:</label>
		            </div>
		        </div>
		        <hr>
		        <input type="submit" value="Crear usuario" id="guardar" class="form-control">
		    </form>

		    <div><a href="index.php">Volver al inicio</div>
		</main>