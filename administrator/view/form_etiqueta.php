<!-- <header class="mb-5">
    <div class="p-5 text-center bg-light mt-4">
        <h1 class="mb-3">Formulario Etiqueta</h1>
    </div>
</header> -->
<div>
    <form id="formEtiqueta" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>

            <?php if (isset($dataToView['nombre']))
                echo "<div class='text-danger'>" . $dataToView['nombre'] . "</div>";
            ?>
        </div>
        <div class="mb-3">
            <label for="alergeno" class="form-label">alergeno</label>
            <input type="text" class="form-control" id="alergeno" name="alergeno" placeholder="Alergeno" required>
            <?php if (isset($dataToView['alergeno']))
                echo "<div class='text-danger'>" . $dataToView['alergeno'] . "</div>";
            ?>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">img</label>
            <input type="text" class="form-control" id="img" name="img" placeholder="URL Imagen Alergeno" required>
            <?php if (isset($dataToView['img']))
                echo "<div class='text-danger'>" . $dataToView['img'] . "</div>";
            ?>
        </div>
        <input type="submit" value="Añadir" name="enviar" class="btn btn-primary">
    </form>
</div>