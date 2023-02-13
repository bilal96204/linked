<?php






class EtiquetaController
{

    public $view;
    private $linkedbar;
    public array $errors;
    public $title;

    public function crear_etiqueta()
    {
        $this->title = 'Crear etiqueta';
        $this->view = 'form_etiqueta';
    }


    public function guardar_etiqueta()
    {
        $this->view = 'etiqueta_insertada';
        $this->title = 'Etiqueta insertada';
        $nombre = $_POST['nombre'];
        $alergeno = $_POST['alergeno'];
        $img = $_POST['img'];


        if (is_numeric($nombre)) $this->errors['nombre'] = "El nombre no puede ser un número";
        if (!is_numeric($alergeno)) $this->errors['alergeno'] = "El alergeno debe ser un número";

        if (!preg_match("/^[a-zA-Z0-9 ]{3,}/", $nombre)) $this->errors['nombre'] = "Introduce un nombre válido, sin caracteres especiales, mínimo 3 caracteres";

        // Si hay errores, mostrar el formulario de nuevo
        if (!empty($this->errors)) {
            $this->view = 'form_etiqueta';
            return $this->errors;
        }

        //pasar por argumento el post del formulario
        $etiqueta = new etiqueta(NULL, strtolower($nombre), $alergeno, $img);



        $etiqueta = new Etiqueta(
            NULL,
            $nombre,
            $alergeno,
            $img,

        ); //pasar por argumento el post del formulario

        // guardar etiqueta en un producto
        $idEtiqueta = $etiqueta->guardar_etiqueta();
        if (!$idEtiqueta) {
            echo "existe";
            return false;
        }
        $idProducto = isset($_GET['idProducto']) ? $_GET['idProducto'] : NULL;
        $etiqueta->guardar_etiqueta_producto($idEtiqueta, $idProducto);
    }

    // eliminar etiqueta de un producto
    public function eliminar_etiqueta()
    {
        $idEtiqueta = isset($_GET['idEtiqueta']) ? $_GET['idEtiqueta'] : NULL;
        $idProducto = isset($_GET['idProducto']) ? $_GET['idProducto'] : NULL;
        $etiqueta = new Etiqueta($idEtiqueta, NULL, NULL, NULL);
        $etiqueta->eliminar_etiqueta($idEtiqueta, $idProducto);
    }
}
