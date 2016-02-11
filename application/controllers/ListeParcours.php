<?php

class ListeParcours extends CI_Controller
{   
    protected $menuOnglet;

    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('connexion')['pseudo'] == false)
            Redirect();
        
        $this->load->model('ListeParcours_model');
    }
    
    public function index()
    {  
        $id = $this->session->userdata('connexion')['id'];
        $data['tab'] = $this->ListeParcours_model->chercherParcours($id);

        $this->load->view('listeParcours', $data);
    }
}