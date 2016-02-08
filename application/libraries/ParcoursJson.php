<?php
//if(!defined('BASEPATH')) exit('No direct script access allowed');

class ParcoursJson
{
	public function __construct($params){

	}

	public function get_categ(){
		$categs = [];
		$return = [];
		$jsonPath = dirname(__FILE__).'/../../assets/json/data.json';
		if(file_exists($jsonPath))
			$json = json_decode(file_get_contents($jsonPath));
		else
			return;

		foreach($json->features as $key => $value){
			if(!in_array($value->properties->type, $categs))
				$categs[] = $value->properties->type;
		}
		
		sort($categs);

		foreach($categs as $categ){
			$return[$categ] = ucfirst(strtolower(str_replace('_', ' ', $categ)));
		}

		return $return;
	}

	public function get_coord(){
		$return = [];
		$jsonPath = dirname(__FILE__).'/../../assets/json/data.json';
		if(file_exists($jsonPath))
			$json = json_decode(file_get_contents($jsonPath));
		else
			return;

		foreach($json->features as $key => $value){
			$return[$value->properties->type]['detail'] = $value->properties->type_detail;
			var_dump($value->properties);
		}

		return $return;
	}
}

$a = new ParcoursJson();
$a->get_coord();
?>