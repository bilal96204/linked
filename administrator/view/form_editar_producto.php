<div class="m-5 container-lg m-auto mb-5">
    <?php
    if ($dataToView != null) {
    ?>
        <header class="mb-5 container">
            <div class="p-5 text-center bg-light mt-4">
                <h1 class="mb-3">Editar Producto</h1>
            </div>
        </header>
        <form action="index.php?controller=ProductoController&action=actualizar_producto" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $dataToView->getId(); ?>">
                <div class="form-floating p-1 col-6 mb-1">
                    <input type="text" class="form-control" id="floatingInput" name="nombre" placeholder="nombre" value="<?php echo $dataToView->getNombre(); ?>" required>
                    <label for="floatingInput">Nombre</label>
                </div>
                <div class="form-floating p-1 col-6 mb-1">
                    <input type="text" class="form-control" pattern="[0-9]+[.]{0,1}[0-9]{0,2}" title="Introduce un precio válido" placeholder="precio" id="precio" name="precio" value="<?php echo $dataToView->getPrecio(); ?>" required>
                    <label for="precio">Precio</label>
                </div>
                <div class="form-floating p-1 col-5 mb-1">
                    <input type="file" class="form-control" id="img" placeholder="imagen" name="img">
                </div>
                <div class="col-5 w-50">
                    <img src="<?php echo $dataToView->getImg(); ?>" height="100px" width="300px" alt="No tiene imagen...">
                </div>
                <div class="form-floating p-1 col mb-1">
                    <input type="number" class="form-control" id="estado" min='0' max='1' name="estado" placeholder="imagen" value="<?php echo $dataToView->getEstado(); ?>" required>
                    <label for="estado">Estado</label>
                </div>
                <input type="submit" class="btn btn-primary col-2 m-1" value="Actualizar" name="actualizar">
                <a href="index.php?controller=carta&action=gestionar_menu" class="btn btn-outline-primary col-2 m-1">Volver</a>
            </div>
        </form>
    <?php
    } else {
        echo "<div class='alert alert-danger mt-5' role='alert'>No tienes acceso para editar este producto</div>";
    }
    ?>
</div>