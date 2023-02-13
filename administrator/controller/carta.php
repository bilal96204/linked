<?php





class carta
{

	public $view;
	public $title;
	private $linkedbar;


	public function __construct()
	{
		$this->view = 'gestionar_menu';
		$this->linkedbar = new Linkedbar();
	}



	public function gestionar_menu($idNegocio = null)
	{
		$this->title = "Gestionar Menu";

		$this->view = 'gestionar_menu';
		return $this->linkedbar->getAlergenos();
		/* if(isset($_GET["id"])) $idNegocio = $_GET["id"];
		$negocio=$this->linkedbar->verNegocioPorId($idNegocio);
		
		return $negocio; */
	}
}
