<?php

class listeParcours extends CI_Controller
{   
    protected $menuOnglet;

    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('connexion')['pseudo'] != false)
            Redirect();
        
        $this->load->model('ListeParcours_model');
    }
    
    public function index()
    {                       
        $this->load->view('listeParcours');
    }
}