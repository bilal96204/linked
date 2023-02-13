<?php


class Linkedbar
{

	//Acceso a BD
	private $table = 'negocio';
	private $conection;
	private array $negocios = array();
	private array $alergenos = array();
	private array $etiquetas = array();


	function __construct()
	{
		$this->getConection();
	}


	public function getConection()
	{
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	public function getNegocios()
	{
		$sql = "SELECT * FROM " . $this->table;
		$result = $this->conection->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;


			while ($row = $result->fetch_assoc()) {
				$this->negocios[$i] = new Negocio($row['idNegocio'], $row['nombre'], $row['email'], $row['tlf'], $row['direccion'], $row['activo'], $row['cif_nif'], $row['descripcion'], $row['img_bar']);
				$i++;
			}
		}


		return $this->negocios;
	}

	public function getAlergenos()
	{
		$this->getConection();
		$sql = "SELECT * FROM etiqueta WHERE alergeno = 1";
		$result = $this->conection->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$this->alergenos[$i] = new Etiqueta($row['idEtiqueta'], $row['nombre'], $row['alergeno'], $row['img']);

				$i++;
			}
			return $this->alergenos;
		}
	}

	public function getEtiquetas()
	{
		$this->getConection();
		$sql = "SELECT * FROM etiqueta WHERE alergeno = 0";
		$result = $this->conection->query($sql);


		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$this->etiquetas[$i] = new Etiqueta($row['idEtiqueta'], $row['nombre'], $row['alergeno'], $row['img']);
				$i++;
			}
			return $this->etiquetas;
		}
	}

	public function comprobar_permiso_producto($idNegocio, $idProducto)
	{
		$this->getConection();
		/* consulta sql join para sacar el id del negocio */
		$sql = 'SELECT negocio.idNegocio FROM negocio
		JOIN categoria ON negocio.idNegocio = categoria.idNegocio
		JOIN productoTieneCategoria ON productoTieneCategoria.categoria_idCategoria = categoria.idCategoria
		JOIN producto ON producto.idProducto = productoTieneCategoria.producto_idProducto
		WHERE producto.idProducto = ' . $idProducto . '';
		$result = $this->conection->query($sql);
		$row = $result->fetch_assoc();
		if (!$row) return false;
		$permiso = $row['idNegocio'] == $idNegocio ? true : false;
		return $permiso;
	}



	// devuelve un producto por su id
	public function getProductoById($id)
	{
		$this->getConection();
		$sql = "SELECT * FROM producto WHERE idProducto = '$id';";
		$result = $this->conection->query($sql);
		$row = $result->fetch_assoc();
		$producto = new Producto($row['idProducto'], $row['nombre'], $row['precio'], $row['img'], $row['estado']);
		return $producto;
	}





	public function verNegocioPorId($id)
	{



		if (is_null($id)) return false;

		$sql = "SELECT * FROM " . $this->table . " WHERE idNegocio = $id";

		$result = $this->conection->query($sql);

		$row = $result->fetch_assoc();

		$negocio = new Negocio($row['idNegocio'], $row['nombre'], $row['email'], $row['tlf'], $row['direccion'], $row['activo'], $row['cif_nif'], $row['descripcion'], $row['img_bar']);


		return $negocio;
	}

	// Pedro
	public function login($password, $email)
	{

		// Consulta a la base de datos.
		$sql = "SELECT * FROM `gestor` WHERE `email` = '$email'";
		// Resultado de la consulta.
		$result = $this->conection->query($sql);

		// Si la consulta no devuelve nada, la función devuelve false.

		if ($result->num_rows < 1) return false;


		// Se guarda la fila.
		$row = $result->fetch_assoc();

		// Si la contraseña (encriptada) no coincide con la introducida, la función devuelve false.
		if (!password_verify($password, $row['password'])) {
			return false;
		};

		// Si no ha habido errores y la ejecución de la función ha llegado al final,
		// se crea una variable de sesión que guarda un objeto gestor.
		$_SESSION['gestor'] = $row['idGestor'];

		return new Gestor($row['idGestor'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['dni'], $row['password'], $row['tlf'], $row['email'], $row['direccion']);
		$_SESSION['gestor'] = $row['idGestor'];

		return new Gestor($row['idGestor'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['dni'], $row['password'], $row['tlf'], $row['email'], $row['direccion']);
	}

	public function close()
	{
		$_SESSION['gestor'] = null;
		session_destroy();
	}

	public function getGestorById($id)
	{

		if (is_null($id)) return false;

		$sql = " SELECT * FROM `gestor` WHERE `idGestor` = '$id';";
		$result = $this->conection->query($sql);

		$row = $result->fetch_assoc();
		$gestor =  new Gestor($row['idGestor'], $row['nombre'], $row['apellido1'], $row['apellido2'], $row['dni'], $row['password'], $row['tlf'], $row['email'], $row['direccion']);

		return $gestor;
	}

	public function guardarUsuario($nombre, $apellido1, $apellido2, $dni, $password, $telefono, $email, $direccion)
	{

		$hash = password_hash($password, PASSWORD_DEFAULT);

		$this->getConection();
		$sql = "INSERT INTO `gestor` (`nombre`, `apellido1`, `apellido2`, `dni`, `password`, `tlf`, `email`, `direccion`) VALUES ('" . $nombre . "','" . $apellido1 . "','" . $apellido2 . "','" . $dni . "','" . $hash . "','" . $telefono . "','" . $email . "','" . $direccion . "');";

		if ($this->conection->query($sql)) {
			$ultimo_id = $this->conection->insert_id;
			$_SESSION['gestor'] = $ultimo_id;
			return new Gestor($ultimo_id, $nombre, $apellido1, $apellido2, $dni, $password, $telefono, $email, $direccion);
		} else {
			return false;
		}
	}
}
