<?php

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