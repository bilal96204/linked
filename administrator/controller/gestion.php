<?php

class gestion
{


	public $view;
	public $linkedbar;
	public $title;


	public function __construct()
	{
		$this->view = 'login';
		$this->linkedbar = new Linkedbar();
	}

	public function login()
	{

		$this->view = 'login';
		$this->title = 'Inicio de Sesión';
	}

	public function logearUsuario()
	{

		if (isset($_SESSION['gestor'])) {
			$this->verGestor();
			return $this->linkedbar->getGestorById($_SESSION['gestor']);
		} else {
			$logeo = $this->linkedbar->login($_POST['password'], $_POST['email']);
			if (isset($logeo)) {
				$this->verGestor();
				return $logeo;
			} else {
				$this->login();
			}
		}
	}

	public function cerrarSesion()
	{

		$this->linkedbar->close();

		$this->login();
	}

	// CELIA
	public function crear_usuario()
	{
		$this->view = 'form_usuario';
		$this->title = 'Crear usuario';
	}

	// CELIA
	public function guardar_usuario()
	{
		$this->view = 'usuario_insertado';
		$this->title = 'Ha habido un error';

		if ($this->linkedbar->guardarUsuario($_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['dni'], $_POST['password'], $_POST['telefono'], $_POST['email'], $_POST['direccion'])) {
			$this->logearUsuario($_POST['password'], $_POST['email']);
		} else {
			$this->view = 'usuario_insertado';
			$this->title = 'Ha habido un error';
		}

		return $this->linkedbar->getGestorById($_SESSION['gestor']);
	}


	public function olvido()
	{
		$this->view = 'olvido';
	}


	public function verGestor()
	{

		if (isset($_SESSION['gestor'])) {
			$this->view = 'verGestor';
			$this->title = 'Tus Datos';
			return $this->linkedbar->getGestorById($_SESSION['gestor']);
		} else {
			$this->login();
		}
	}

	// CELIA
	public function editarGestor()
	{
		$this->view = 'editar_usuario';
		$this->title = "Editar usuario";

		return $this->linkedbar->getGestorById($_SESSION["gestor"]);
	}

	// CELIA
	public function guardar_edicion()
	{
		$this->view = 'usuario_editado';

		$gestor = $this->linkedbar->getGestorById($_SESSION['gestor']);

		if(password_verify($_POST['oldPassword'], $gestor->getPassword())){
			$hash = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
			$Gestor = new Gestor($_SESSION['gestor'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['dni'], $hash, $_POST['telefono'], $_POST['email'], $_POST['direccion']);

			return $Gestor->guardarEdicion();
		}


	}


	public function verNegocio()
	{

		if (!isset($_SESSION['gestor'])) {
			$this->view = 'login';
			$this->title = 'Inicio de Sesión';
		} else {
			$this->view = 'verNegocio';
			$this->title = $this->linkedbar->verNegocioPorId($_GET['id'])->getNombre();
			return $this->linkedbar->verNegocioPorId($_GET['id']);
		}
	}
}
