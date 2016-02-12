<?php
/*
	Controleur permettant de récupérer les catégories présentes dans le menu gauche
*/
class Categorie extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->library('Parcours_json');
	}

	public function index(){
		$categ = $this->parcours_json->get_categ();
		echo json_encode($categ);
	}
}

?>