<?php

session_start();

require_once 'config/config.php';
require_once '../model/db.php';
require_once '../model/Etiqueta.php';
require_once '../model/Producto.php';
require_once '../model/Categoria.php';
require_once '../model/Negocio.php';
require_once '../model/Gestor.php';
require_once '../model/Linkedbar.php';

if (!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = 'controller/' . $_GET["controller"] . '.php';

if (!file_exists($controller_path)) $controller_path = 'controller/' . constant("DEFAULT_CONTROLLER") . '.php';

require_once $controller_path;

$controladorName = $_GET["controller"];

$controlador = new $controladorName();

$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();

// Leer vistas
require_once 'view/template/header.php';
require_once 'view/' . $controlador->view . '.php';
require_once 'view/template/footer.php';

?>