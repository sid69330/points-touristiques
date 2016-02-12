<?php
/*
	Controleur permettant de récupérer l'ensemble des marqueurs présents sur la page d'accueil sur la maps google maps
*/
class Markers extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->library('Parcours_json');
	}

	public function index(){
		$coord = $this->parcours_json->get_coord();
		echo json_encode($coord);
	}
}

?>