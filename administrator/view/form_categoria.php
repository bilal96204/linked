
		<header class="mb-5">
		    <div class="p-5 text-center bg-light" style="margin-top: 58px;">
		        <h1 class="mb-3">Formulario Categoria</h1>
		    </div>
		    <div class="mt-5 d-flex justify-content-center">
		        <form action="index.php?controller=CategoriaController&action=guardar_categoria" method="post">
		            <div style="width: 500px;">
		                <label class="mt-2 mb-2" for="nombre">Nombre</label>
		                <input class="form-control" type="text" name="nombre" id="nombre" />
		            </div>
		            <div style="width: 500px;">
		                <label class="mt-2 mb-2" for="img">Imagen</label>
		                <input class="form-control" type="file" name="img" id="img">
		            </div>
		            <div style="width: 500px;">
		                <label class="mt-2 mb-2" for="estado">Estado</label>
		                <input class="form-control" type="text" name="estado" id="estado" />
		            </div>
		            <div style="width: 500px;">
		                <label class="mt-2 mb-2" for="orden">Orden</label>
		                <input class="form-control" type="text" name="orden" id="orden" />
		            </div>
		            <div style="width: 500px;">
		                <label class="mt-2 mb-2" for="idNegocio">idNegocio</label>
		                <input class="form-control" type="number" name="idNegocio" id="idNegocio" />
		            </div>
		            <div>
		                <input class="mt-2 mb-2 btn btn-primary" type="submit" value="Enviar" name="enviar">
		                <a class="mt-2 mb-2 btn btn-outline-primary"
		                    href="index.php?controller=carta&action=gestionar_menu">Volver atrás</a>
		            </div>
		        </form>
		    </div>


		</header>