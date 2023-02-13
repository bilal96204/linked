<?php

class Categoria
{

	private $id;
	private $nombre;
	private $img;
	private $estado;
	private $orden;
	private $idNegocio;

	private array $productos = array();
	//Acceso a datos

	private $conection;
	//Métodos----------------------------
	public function __construct($id, $nombre, $img, $estado, $orden, $idNegocio)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->img = $img;
		$this->estado = $estado;
		$this->orden = $orden;
		$this->idNegocio = $idNegocio;
		$this->getConection();
		$this->getProductos($this->id);
	}
	public function getConection()
	{
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}
	public function getId()
	{
		return $this->id;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getImg()
	{
		return $this->img;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function getOrden()
	{
		return $this->orden;
	}
	public function getIdNegocio()
	{
		return $this->idNegocio;
	}
	public function getProductos($id)
	{
		$this->getConection();
		$sql = "SELECT producto.* FROM productoTieneCategoria JOIN producto ON productoTieneCategoria.producto_idProducto=producto.idProducto WHERE productoTieneCategoria.categoria_idCategoria = '$id';";
		$result = $this->conection->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$this->productos[$i] = new Producto($row['idProducto'], $row['nombre'], $row['precio'], $row['img'], $row['estado']);
				$i++;
			}
			return $this->productos;
		}
	}
	public function guardar_categoria($nombre, $img, $estado, $orden, $idNegocio)
	{
		$this->getConection();
		$sql = "INSERT INTO categoria (nombre, img, estado, orden, idNegocio) VALUES ('$nombre', '$img', '$estado', '$orden', '$idNegocio')";

		if ($this->conection->query($sql) === false) {
			echo "Error: " . $sql . "<br>" . $this->conection->error;
		}
	}

	public function editar_categoria($id)
	{
	}

	public function borrar_categoria($id)
	{
	}
}
