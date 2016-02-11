<?php

class SaveParcours extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		//$this->load->library('Parcours_json');
	}

	public function index()
	{
		return json_encode(array('Hello world !'));
	}
}

?>