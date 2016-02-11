<?php

class SaveParcours extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		//$this->load->library('Parcours_json');
	}

	public function index()
	{
		$a = json_decode($_POST['points']);
		$b = [];
		// var_dump($a);
		foreach ($a as $key => $value) {
			$b[] = $value;
		}
	}
}

?>