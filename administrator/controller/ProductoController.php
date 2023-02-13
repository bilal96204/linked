<?php






class ProductoController
{

    public $view;
    private $linkedbar;
    public $title;

    public function crear_producto()
    {
        $this->title = 'Crear producto';
        $this->view = 'form_producto';
        $this->linkedbar = new Linkedbar();
        //$idNegocio = $_SESSION['idNegocio']; 
        $idNegocio = 1;
        $negocio = $this->linkedbar->verNegocioPorId($idNegocio);
        $categorias = $negocio->getCategorias($idNegocio);
        return [$this->linkedbar->getAlergenos(), $categorias];
    }

    public function guardar_producto()
    {
        $this->title = 'Producto insertado';
        $this->view = 'producto_insertado';


        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $estado = $_POST['estado'];
        $idNegocio = 1; //$_SESSION['idNegocio'];

        /* si no existe la carpeta con id negocio/productos/idProducto.jpg crearla */
        if (!file_exists('imagenes/Negocio-' . $idNegocio . '/productos/')) {
            mkdir('imagenes/Negocio-' . $idNegocio . '/productos/', 0777, true);
        }

        $tipo_imagen = $_FILES['img']['type']; // tipo imagen
        // Separamos el tipo MIME en un array
        $tipo_imagen = explode("/", $tipo_imagen);

        // La extensión se encuentra en la última posición del array
        $extension = "." . $tipo_imagen[1];
        $nombre_imagen = $extension; // nombre imagen
        $carpeta_destino = 'imagenes/Negocio-' . $idNegocio .  '/productos/'; // ruta en la que se van a guardar las imágenes







        $producto = new Producto(NULL, strtolower($nombre), $precio, $nombre_imagen, $estado);
        $lastId = $producto->guardar_producto(); // Guardar el producto en la base de datos


        move_uploaded_file($_FILES['img']['tmp_name'], $carpeta_destino . $lastId . $extension);


        if (!empty($_POST['categoria']) && $_POST['categoria'] != 0) {
            $idCategoria = $_POST['categoria'];
            $producto->guardar_producto_categoria($lastId, $idCategoria);
        }

        if (!empty($_POST['alergeno']) && $_POST['alergeno'] != 0) {

            $alergenos = $_POST['alergeno'];
            if (is_array($alergenos)) {
                foreach ($alergenos as $alergeno) {
                    $producto->guardar_producto_alergeno($lastId, $alergeno);
                }
            } else {
                $producto->guardar_producto_alergeno($lastId, $alergenos);
            }
        }

        // Si no hay errores, guardar el producto con las etiquetas en la base de datos
        if (!empty($_POST['etiquetaSeleccionada']) && $_POST['etiquetaSeleccionada'] != 0) {

            $etiquetaSeleccionada = $_POST['etiquetaSeleccionada'];

            if (is_array($etiquetaSeleccionada)) {
                foreach ($etiquetaSeleccionada as $etiqueta) {
                    $producto->guardar_producto_etiqueta($lastId, $etiqueta);
                }
            } else {
                $producto->guardar_producto_etiqueta($lastId, $etiquetaSeleccionada);
            }
        }
    }

    // Devuelve los productos de un negocio
    public function editar_producto()
    {
        $this->title = "Editar producto";
        $this->view = "form_editar_producto";

        $idNegocio = 1; // Id del negocio $_SESSION['idNegocio']
        $idProducto = $_GET['idProducto'];
        $this->linkedbar = new Linkedbar();
        $negocio = $this->linkedbar->comprobar_permiso_producto($idNegocio, $idProducto);
        if ($negocio == $idNegocio) {
            $producto = $this->linkedbar->getProductoById($idProducto);
            return $producto;
        } else {
            return null;
        }
    }

    // Actualiza los datos de un producto
    public function actualizar_producto()
    {
        $this->title = "Actualizar producto";
        $this->view = "producto_editado";

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $estado = $_POST['estado'];

        $idNegocio = 1; // Id del negocio $_SESSION['idNegocio']

        $tipo_imagen = $_FILES['img']['type']; // tipo imagen
        $tipo_imagen = explode("/", $tipo_imagen);
        $extension = "." . $tipo_imagen[1]; // sacamos extensión
        $nombre_imagen = $id . $extension; // nombre imagen
        $carpeta_destino = 'imagenes/Negocio-' . $idNegocio .  '/productos/';

        move_uploaded_file($_FILES['img']['tmp_name'], $carpeta_destino . $nombre_imagen);


        $producto = new Producto($id, $nombre, $precio, $nombre_imagen, $estado);
        $producto->editar_producto($id, strtolower($nombre), $precio, $nombre_imagen, $estado);
    }


    public function eliminar_producto_categoria()
    {
        $this->view = 'gestionar_menu';
        $idProducto = $_GET['idProducto'];
        $idCategoria = $_GET['idCategoria'];
        $producto = new Producto($idProducto, NULL, NULL, NULL, NULL);
        $producto->eliminar_producto_categoria($idProducto, $idCategoria);
    }


    // eliminar producto definitivamente
    public function eliminar_producto()
    {
        $this->view = 'gestionar_menu';
        $idProducto = $_GET['idProducto'];
        $producto = new Producto($idProducto, NULL, NULL, NULL, NULL);
        $producto->eliminar_producto($idProducto);


        //borrar imagen asignada a un producto
        $idNegocio = 1; // Id del negocio $_SESSION['idNegocio']
        $rutaImagen = "imagenes/Negocio-" . $idNegocio . "/productos/" . $idProducto;
        $extensiones = array(".png", ".jpg", ".jpeg", ".gif");
        foreach ($extensiones as $extension) {
            if (file_exists($rutaImagen . $extension)) {
                unlink($rutaImagen . $extension);
                break;
            }
        }
    }

    public function guardar_producto_etiquetas()
    {
        $idProducto = $_GET['idProducto'];
        $producto = new Producto($idProducto, NULL, NULL, NULL, NULL);

        if (!empty($_POST['alergeno']) && $_POST['alergeno'] != 0) {

            $alergenos = $_POST['alergeno'];
            if (is_array($alergenos)) {
                foreach ($alergenos as $alergeno) {
                    $producto->guardar_producto_alergeno($idProducto, $alergeno);
                }
            } else {
                $producto->guardar_producto_alergeno($idProducto, $alergenos);
            }
        }

        // Si no hay errores, guardar el producto con las etiquetas en la base de datos
        if (!empty($_POST['etiquetaSeleccionada']) && $_POST['etiquetaSeleccionada'] != 0) {

            $etiquetaSeleccionada = $_POST['etiquetaSeleccionada'];

            if (is_array($etiquetaSeleccionada)) {
                foreach ($etiquetaSeleccionada as $etiqueta) {
                    $producto->guardar_producto_etiqueta($idProducto, $etiqueta);
                }
            } else {
                $producto->guardar_producto_etiqueta($idProducto, $etiquetaSeleccionada);
            }
        }
    }
}
