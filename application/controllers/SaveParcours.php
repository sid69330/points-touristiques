<?php

class SaveParcours extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		//$this->load->library('Parcours_json');
	}

	public function index()
	{
		$jsonPath = $_SERVER['DOCUMENT_ROOT'].'/assets/json/data.json';
		if(file_exists($jsonPath))
			$json = json_decode(file_get_contents($jsonPath));
		else
		{
			echo '-1';
			exit;
		}
		
		$return = array();
		$i = 0;
		$tabPoints = array();
		$points = json_decode($_POST['points']);
		
		foreach($points as $key => $value)
		{
			array_push($tabPoints, $value->id);
		}
		foreach($json->features as $key => $value)
		{
			if(in_array($value->properties->id, $tabPoints))
			{
				$return[$i]['id'] = $value->properties->id;
				$return[$i]['type'] = $value->properties->type;
				$return[$i]['detail'] =  str_replace(["\'", '"'], '', $value->properties->type_detail);
				$return[$i]['name'] = str_replace(["\'", '"'], '', $value->properties->nom);
				$return[$i]['adress'] = str_replace(["\'", '"'], '', $value->properties->adresse);
				$return[$i]['email'] = $value->properties->email;
				$return[$i]['facebook'] = $value->properties->facebook;
				$return[$i]['zip'] = $value->properties->codepostal;
				$return[$i]['city'] = str_replace(["\'", '"'], '', $value->properties->commune);
				$return[$i]['phone'] = $value->properties->telephone;
				$return[$i]['points']['latitude'] = $value->geometry->coordinates[1];
				$return[$i]['points']['longitude'] = $value->geometry->coordinates[0];
				$i++;
			}
		}
		if(count($return) > 0)
		{
			$data = array(
			   'name' => $_POST['libelle'],
			   'owner' => $this->session->userdata('connexion')['id'],
			   'walkthrough' => json_encode($return)
			);
			$this->db->insert('walkthrough', $data);

			echo '0';
		}
		else
			echo '-1';
	}
}

?>