<?php

class Connexion extends CI_Controller
{   
    protected $menuOnglet;

    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('connexion')['login'] != false)
            Redirect();
        
        $this->load->library('form_validation');
        $this->load->model('connexion_model');
    }
    
    public function index()
    {                       
        $this->form_validation->set_rules('login', '"Pseudo"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('password', '"Mot de passe"', 'encode_php_tags');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('connexion/formulaire', $data);
        }
        else
        {
            $pseudo = $this->input->post('login');
            $mdp = hash('sha256', $this->input->post('password'));
            $tab = $this->connexion_model->verifierIdentifiant($pseudo, $mdp);

            if($tab['erreur'] == '')
            {
                $sess_array = array('id'=>$tab['result']->id , 'pseudo'=>$tab['result']->login, 'mail'=>$tab['result']->mail);
                $this->session->set_userdata('connexion', $sess_array);
                Redirect($this->input->post('redirect'));
            }
            else
            {               
                $data['erreur'] = $tab['erreur'];
                $this->load->view('include/menu-haut', $menu);
                $this->load->view('connexion/formulaire', $data);
                //$this->load->view('include/footer');
            }
        }
    }
}