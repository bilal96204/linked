<?php
class Gestor
{

	private $idGestor;
	private $nombre;
	private $apellido1;
	private $apellido2;
	private $dni;
	private $password;
	private $telefono;
	private $email;
	private $direccion;

	public array $negociosUnido = array(); // Array de negocios a los que está unido
	public array $negociosInvitado = array(); // Array de negocios a los que está invitado


	//Acceso a datos

	private $conection;
	//Métodos----------------------------
	public function __construct($idGestor, $nombre, $apellido1, $apellido2, $dni, $password, $telefono, $email, $direccion)
	{
		$this->idGestor = $idGestor;
		$this->nombre = $nombre;
		$this->apellido1 = $apellido1;
		$this->apellido2 = $apellido2;
		$this->dni = $dni;
		$this->password = $password;
		$this->telefono = $telefono;
		$this->email = $email;
		$this->direccion = $direccion;


		//$this->getConection();
		$this->getNegociosUnido();
		$this->getNegociosInvitado();
	}

	// Getters
	public function getId()
	{
		return $this->idGestor;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function getApellido1()
	{
		return $this->apellido1;
	}
	public function getApellido2()
	{
		return $this->apellido2;
	}
	public function getDNI()
	{
		return $this->dni;
	}
	public function getPassword()
	{
		return $this->password;
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

	public function getConection()
	{
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}


	public function getNegociosUnido()
	{
		$this->getConection();

		$sql = "SELECT n.* FROM negocio n JOIN gestorGestionaNegocio gn ON n.idNegocio = gn.idNegocio WHERE gn.idGestor = $this->idGestor AND gn.unido = 1; ";

		$result = $this->conection->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($this->negociosUnido, new Negocio($row['idNegocio'], $row['nombre'], $row['email'], $row['tlf'], $row['direccion'], $row['activo'], $row['cif_nif'], $row['img_bar'], $row['descripcion']));
			}
		}

		return $this->negociosUnido;
	}



	public function getNegociosInvitado()
	{
		$this->getConection();

		$sql = "SELECT n.* FROM negocio n JOIN gestorGestionaNegocio gn ON n.idNegocio = gn.idNegocio WHERE gn.idGestor = $this->idGestor AND gn.unido = 0;";

		$result = $this->conection->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($this->negociosInvitado, new Negocio($row['idNegocio'], $row['nombre'], $row['email'], $row['tlf'], $row['direccion'], $row['activo'], $row['cif_nif'], $row['img_bar'], $row['descripcion']));
			}
		}

		return $this->negociosInvitado;
	}

	// public function guardarUsuario()
	// {
	// }

	// public function logearUsuario($password, $email)
	// {
	// 	//comprobar en la base de datos
	// 	//si ok guardar objeto gestor en una variable de sesión y return ok
	// 	//si error return error	
	// }

	public function guardarEdicion()
	{

		$this->getConection();
		$sql = "UPDATE `gestor` SET
		`nombre` = '$this->nombre',
		`apellido1` = '" . $this->apellido1 . "',
		`apellido2` = '" . $this->apellido2 . "',
		`dni` = '" . $this->dni . "',
		`tlf` = '" . $this->telefono . "',
		`password` = '" . $this->password . "',
		`email` = '" . $this->email . "',
		`direccion` = '" . $this->direccion . "'
		WHERE `gestor`.`idGestor` = " . $this->idGestor . ";";

		//$ultimo_id = mysqli_insert_id($this->conection);

		if ($this->conection->query($sql) === true) {
			return true;
		} else {
			return false;
		}
		$this->conection->close();
		//editar en base de datos


	}
}
