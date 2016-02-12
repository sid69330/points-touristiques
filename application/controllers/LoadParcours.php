<?php
/*
    Controleur permettant de récupérer les parcours enregistré pour la personne connectée dans le menu gauche
*/
class LoadParcours extends CI_Controller
{   
    protected $menuOnglet;

    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('connexion')['pseudo'] == false)
            Redirect();
        
        $this->load->library('favori_parcours');
        $this->load->model('listeParcours_model');
    }
    
    public function index()
    {  
        $id = $this->session->userdata('connexion')['id'];
        $data['result'] = $this->listeParcours_model->chercherParcours($id);
        $data['nbParcours'] = $this->favori_parcours->recup_nb_parcours($this->session->userdata('connexion')['id']);

        echo json_encode($data);
    }
}