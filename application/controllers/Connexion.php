<?php

class Connexion extends CI_Controller
{   
    protected $menuOnglet;

    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('connexion')['pseudo'] != false)
            Redirect();
        
        $this->load->library('form_validation');
        $this->load->model('connexion_model');
    }
    
    public function index()
    {                       
        $this->form_validation->set_rules('pseudo', '"Pseudo"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|encode_php_tags');
        $data['connexion_ok'] = $this->session->flashdata('connexion_ok');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('connexion', $data);
        }
        else
        {
            $pseudo = $this->input->post('pseudo');
            $mdp = hash('sha256', $this->input->post('mdp'));
            $tab = $this->connexion_model->verifierIdentifiant($pseudo, $mdp);

            if($tab['erreur'] == '')
            {
                $sess_array = array('id'=>$tab['result']->id , 'pseudo'=>$tab['result']->login, 'mail'=>$tab['result']->mail);
                $this->session->set_userdata('connexion', $sess_array);
                $this->session->set_flashdata('connexion_ok', 'Connexion réussie. Bienvenue !');
                Redirect();
            }
            else
            {               
                $data['erreur'] = $tab['erreur'];
                $this->load->view('connexion', $data);
            }
        }
    }
}