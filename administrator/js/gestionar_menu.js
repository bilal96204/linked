async function confirmELiminar(idProducto, idCategoria) {
    const fetchProductosURL = `ajax/fetch_numeros_productos_categoria.php?idProducto=${idProducto}`;
    const eliminarProductoURL = `index.php?controller=ProductoController&action=eliminar_producto&idProducto=${idProducto}`;
    const eliminarProductoCategoriaURL = `index.php?controller=ProductoController&action=eliminar_producto_categoria&idProducto=${idProducto}&idCategoria=${idCategoria}`;

    // devolvemos el número de categorías que tiene el producto
    const response = await fetch(fetchProductosURL);

    const numeroProductos = await response.json();
    const producto = document.querySelector(
        `#producto-${idProducto}-${idCategoria}`
    );
    const spinner = document.querySelector('.spinner-border');
    const etiquetas = document.querySelector(
        '#etiquetas-' + idProducto
    );

    if (numeroProductos == 1) {
        swal.fire({
            title: '¿Estás seguro de que quieres eliminar este producto definitivamente?',
            showCancelButton: true,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                spinner.style.display = 'block';
                fetch(eliminarProductoURL).then(() => {
                    etiquetas.remove();
                    producto.remove();
                    spinner.style.display = 'none';
                });
            }
        });
    } else {
        swal.fire({
            title: '¿Estás seguro de que quieres eliminar este producto de esta categoría?',
            showCancelButton: true,
            confirmButtonText: `Eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                spinner.style.display = 'block';
                fetch(eliminarProductoCategoriaURL).then(() => {
                    etiquetas.remove();
                    producto.remove();
                    spinner.style.display = 'none';
                });
            }
        });
    }
}

function eliminarEtiqueta($idEtiqueta, $idProducto) {
    let etiqueta = document.querySelector(`#etiqueta-${$idEtiqueta}`);
    let url = `index.php?action=eliminar_etiqueta&controller=EtiquetaController&idEtiqueta=${$idEtiqueta}&idProducto=${$idProducto}`;
    fetch(url).then(() => {
        etiqueta.remove();
        swal.fire({
            title: 'Etiqueta eliminada correctamente',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        });
    });
}

function crearEtiqueta(idProducto) {
    let form = document.getElementById('formEtiqueta');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(form);
        fetch(
            'index.php?controller=EtiquetaController&action=guardar_etiqueta&idProducto=' +
                idProducto,
            {
                method: 'POST',
                body: formData,
            }
        )
            .then((res) => res.text())
            .then((data) => {
                if (data.includes('existe')) {
                    swal.fire({
                        title: 'Alguna etiqueta ya existe',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } else {
                    document.querySelector('.btn-close').click();
                    swal.fire({
                        title: 'Etiqueta creada correctamente',
                        icon: 'success',
                        showConfirmButton: false,
                    });

                    location.reload();
                }
            });
    });
}

function añadirEtiquetas(idProducto) {
    let form = document.getElementById('formEtiqueta2');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(form);
        fetch(
            'index.php?controller=ProductoController&action=guardar_producto_etiquetas&idProducto=' +
                idProducto,
            {
                method: 'POST',
                body: formData,
            }
        )
            .then((res) => res.text())
            .then((data) => {
                if (data.includes('Duplicate')) {
                    swal.fire({
                        title: 'La etiqueta ya existe',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } else {
                    document.querySelector('.btnClose2').click();
                    swal.fire({
                        title: 'Etiqueta añadida correctamente',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    location.reload();
                }
            });
    });
}
