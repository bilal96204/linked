		<header class="mb-5">
			<div class="p-5 text-center bg-light" style="margin-top: 58px;">
				<h1 class="mb-3">Usuario editado</h1>

			</div>
		</header>

		<main>
			<?php
			if ($dataToView == false) {
				$mensaje = "Ha habido un error";
			} else {
				$mensaje = "Datos actualizados correctamente";
			}
			echo ("<h4>" . $mensaje . "</h4>");
			?>
			<div><a href="index.php?action=verGestor">Volver a inicio</div>

		</main>