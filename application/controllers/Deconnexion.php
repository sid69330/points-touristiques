<?php

class Deconnexion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('connexion')['pseudo'] == false)
			Redirect();
	}
	
	public function index()
	{	
		$this->session->unset_userdata('connexion');
		Redirect();
	}
}