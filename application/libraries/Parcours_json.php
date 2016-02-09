<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Parcours_json
{
	// public function __construct($params){

	// }

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
		$i = 0;
		$jsonPath = dirname(__FILE__).'/../../assets/json/data.json';
		if(file_exists($jsonPath))
			$json = json_decode(file_get_contents($jsonPath));
		else
			return;

		foreach($json->features as $key => $value){
			$return[$i]['type'] = $value->properties->type;
			$return[$i]['detail'] = $value->properties->type_detail;
			$return[$i]['nom'] = utf8_decode(str_replace(["\'", '"'], '', $value->properties->nom));
			$return[$i]['adresse'] = utf8_decode(str_replace(["\'", '"'], '', $value->properties->adresse));
			$return[$i]['codepostal'] = $value->properties->codepostal;
			$return[$i]['commune'] = utf8_decode(str_replace(["\'", '"'], '', $value->properties->commune));
			$return[$i]['telephone'] = $value->properties->telephone;
			$return[$i]['points']['latitude'] = $value->geometry->coordinates[1];
			$return[$i]['points']['longitude'] = $value->geometry->coordinates[0];
			$i++;
		}

		return $return;
	}
}
?>