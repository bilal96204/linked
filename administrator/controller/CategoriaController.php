<?php



class CategoriaController
{


    public $view;
    public $title;
    private $linkedbar;



    public function crear_categoria()
    {
        $this->title = "Crear Categoria";
        $this->view = 'form_categoria';
    }

    public function guardar_categoria()
    {
        $this->title = "Guardar Categoria";
        $this->view = 'categoria_insertada';

        $nombre = $_POST['nombre'];
        $img = $_POST['img'];
        $estado = $_POST['estado'];
        $orden = $_POST['orden'];
        $idNegocio = $_POST['idNegocio'];

        //pasar por argumento el post del formulario
        $categoria = new Categoria(null, $nombre, $img, $estado, $orden, $idNegocio);

        return $categoria->guardar_categoria($nombre, $img, $estado, $orden, $idNegocio);
    }

    public function editar_categoria()
    {
    }

    public function borrar_categoria()
    {
    }
}
