<?php

class Producto
{

	private $id;
	private $nombre;
	private $precio;
	private $img;
	private $estado;


	private array $etiquetas = array();
	//Acceso a datos

	private $conection;
	//Métodos----------------------------
	public function __construct($id, $nombre, $precio, $img, $estado)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->img = $img;
		$this->estado = $estado;
		$this->precio = $precio;
		$this->getConection();

		$this->getEtiquetas($this->id);
	}

	/* getters */
	public function getId()
	{
		return $this->id;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getPrecio()
	{
		return $this->precio;
	}

	public function getImg()
	{
		$this->getConection();
		$sql = "SELECT img FROM producto WHERE idProducto = " . $this->id;
		$resultado = mysqli_query($this->conection, $sql);

		$idNegocio = 1; // $idNegocio = $_SESSION['idNegocio'];

		while ($fila = mysqli_fetch_array($resultado)) {
			$ruta_img = 'imagenes/Negocio-' . $idNegocio . '/productos/' . $fila['img'];
		}

		return $ruta_img;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	/* establecer conexión */

	public function getConection()
	{

		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	// devuelve las etiquetas de un producto
	public function getEtiquetas($id)
	{
		if ($id == null) return false;
		$this->getConection();
		/* consulta a la tabla que relaciona una etiqueta con un producto */
		$sql = "SELECT etiqueta.* FROM productoTieneEtiqueta 
				JOIN etiqueta ON productoTieneEtiqueta.idEtiqueta = etiqueta.idEtiqueta
				WHERE productoTieneEtiqueta.idProducto = " . $id;
		$result = mysqli_query($this->conection, $sql);
		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {

				$this->etiquetas[$i] = new Etiqueta($row['idEtiqueta'], $row['nombre'], $row['alergeno'], $row['img']);

				$i++;
			}
		}

		return $this->etiquetas;
	}


	/* vincular un producto con una categoría */
	public function guardar_producto_categoria($lastId, $idCategoria)
	{
		$this->getConection();
		$sql = "INSERT INTO productoTieneCategoria (producto_idProducto, categoria_idCategoria) VALUES (" . $lastId . " , '" . $idCategoria . "')";

		mysqli_query($this->conection, $sql);
	}

	/* vincular un producto con un alergeno */
	public function guardar_producto_alergeno($idProducto, $idAlergeno)
	{
		$this->getConection();
		$sql = "INSERT INTO productoTieneEtiqueta (idEtiqueta, idProducto) VALUES (" . $idAlergeno . " , '" . $idProducto . "')";
		mysqli_query($this->conection, $sql);
	}

	/* vincular un producto con una etiqueta */
	public function guardar_producto_etiqueta($idProducto, $idEtiqueta)
	{
		$this->getConection();
		$sql = "INSERT INTO productoTieneEtiqueta (idEtiqueta, idProducto) VALUES (" . $idEtiqueta . " , '" . $idProducto . "')";

		mysqli_query($this->conection, $sql);
	}


	// guardar un producto

	public function guardar_producto()
	{
		$this->getConection();


		$sql = "INSERT INTO producto (nombre,precio,img,estado) VALUES ('" . $this->nombre . "', '" . $this->precio . "', '" . $this->img . "', '" . $this->estado . "')";

		$result = mysqli_query($this->conection, $sql);
		// renombrar el nombre de la imagen
		if ($result) {
			/* coger el id y renombrar el nombre de la imagen */
			$lastId = $this->conection->insert_id;
			$nombre_img = $lastId . $this->img;
			$sql = "UPDATE producto SET img = '" . $nombre_img . "' WHERE idProducto = " . $lastId;
			mysqli_query($this->conection, $sql);
		}

		return $lastId;
	}


	// editar producto
	public function editar_producto($id, $nombre, $precio, $img, $estado)
	{
		$this->getConection();
		$sql = "UPDATE producto SET nombre = '" . $nombre . "', precio = '" . $precio . "', img = '" . $img . "', estado = '" . $estado . "' WHERE idProducto = " . $id;

		mysqli_query($this->conection, $sql);
	}


	// publicar un producto
	public function publicar_producto($id)
	{
		$this->getConection();
		$sql = "UPDATE producto SET estado = '1' WHERE idProducto = " . $id;

		mysqli_query($this->conection, $sql);
	}

	// despublicar un producto
	public function despublicar_producto($id)
	{
		$this->getConection();
		$sql = "UPDATE producto SET estado = '0' WHERE idProducto = " . $id;

		mysqli_query($this->conection, $sql);
	}

	// eliminar producto
	public function eliminar_producto($idProducto)
	{
		$this->getConection();
		$sql = "DELETE FROM producto WHERE idProducto = " . $idProducto;
		mysqli_query($this->conection, $sql);
	}

	// eliminar producto de una categoría
	public function eliminar_producto_categoria($idProducto, $idCategoria)
	{
		$this->getConection();
		$sql = "DELETE FROM productoTieneCategoria WHERE producto_idProducto = " . $idProducto . " AND categoria_idCategoria = " . $idCategoria;
		mysqli_query($this->conection, $sql);
	}
}
