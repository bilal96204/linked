
<?php


class Negocio
{


	private $id;
	private $nombre;
	private $email;
	private $telefono;
	private $direccion;
	private $activo;
	private $cif_nif;

	private $descripcion;
	private $img;

	private array $categorias = array(); // array de objetos categoria del negocio
	private array $empleados = array(); //array de objetos gestor asociados al negocio cuyo rol=2


	private $conection;

	//Métodos----------------------------
	public function __construct($id, $nombre, $email, $telefono, $direccion, $activo, $cif_nif, $descripcion, $img)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->activo = $activo;
		$this->cif_nif = $cif_nif;
		$this->descripcion = $descripcion;
		$this->img = $img;

		$this->getConection();
		$this->getCategorias($this->id);
		$this->getEmpleados();
	}


	// Getters
	public function getId()
	{
		return $this->id;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function getTelefono()
	{
		return $this->telefono;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getDireccion()
	{
		return $this->direccion;
	}
	public function getCifNif()
	{
		return $this->cif_nif;
	}
	public function getImagen()
	{
		return $this->img;
	}
	public function isActivo()
	{
		return $this->activo;
	}



	public function getDescripcion()
	{
		return $this->descripcion;
	}
	public function getImg()
	{
		return $this->img;
	}
	public function getConection()
	{
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}


	public function getCategorias($id)
	{
		$this->getConection();
		$sql = "SELECT * FROM categoria WHERE idNegocio = '$id'";

		$result = $this->conection->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$this->categorias[$i] = new Categoria($row['idCategoria'], $row['nombre'], $row['img'], $row['estado'], $row['orden'], $row['idNegocio']);
				$i++;
			}
			return $this->categorias;
		}
	}

	public function getEmpleados()
	{
	}
}

?>