<?php
class Etiqueta
{

	private $idEtiqueta;
	private $nombre;
	private $alergeno;
	private $img;




	//Acceso a datos

	private $conection;

	//Métodos----------------------------
	public function __construct($idEtiqueta, $nombre, $alergeno, $img)
	{
		$this->idEtiqueta = $idEtiqueta;
		$this->nombre = $nombre;
		$this->alergeno = $alergeno;
		$this->img = $img;
	}

	public function getIdEtiqueta()
	{
		return $this->idEtiqueta;
	}
	public function setIdEtiqueta(int $idEtiqueta)
	{
		$this->idEtiqueta = $idEtiqueta;
	}

	public function getNombre()
	{
		return $this->nombre;
	}
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}


	public function getalergeno()
	{
		return $this->alergeno;
	}
	public function setAlergeno(int $alergeno)
	{
		$this->alergeno = $alergeno;
	}

	public function getimg()
	{
		return $this->img;
	}
	public function setimg($img)
	{
		$this->img = $img;
	}




	public function getConection()
	{
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}




	public function guardar_etiqueta()
	{
		$this->getConection();

		/* Comprobando si el nombre de la etiqueta ya existe en la base de datos. */
		$result =  $this->conection->query("SELECT * FROM etiqueta WHERE nombre = '" . $this->nombre . "'");
		$array = array();

		while ($fila = $result->fetch_assoc()) {
			$nombre = $fila['nombre'];
			$array[] = $nombre;
		}

		if (in_array($this->nombre, $array)) {
			return false;
		}
		// Si el nombre no existe, los datos pueden ser guardados.

		$sql = "INSERT INTO etiqueta (nombre, alergeno, img) VALUES ('" . $this->nombre . "', '" . $this->alergeno . "', '" . $this->img . "')";

		$this->conection->query($sql);
		return $this->conection->insert_id;
	}

	// guardar etiqueta en un producto
	public function guardar_etiqueta_producto($idProducto, $idEtiqueta)
	{
		$this->getConection();
		$sql = "INSERT INTO productoTieneEtiqueta (idEtiqueta, idProducto) VALUES ('" . $idProducto . "', '" . $idEtiqueta . "')";
		$this->conection->query($sql);
	}

	// eliminar etiqueta de un producto
	public function eliminar_etiqueta($idEtiqueta, $idProducto)
	{
		$this->getConection();

		$sql = "DELETE FROM productoTieneEtiqueta WHERE idEtiqueta = " . $idEtiqueta . " AND idProducto = " . $idProducto;

		$this->conection->query($sql);
	}
}
