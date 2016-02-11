<?php
class Index extends CI_Controller 
{
	protected $categories_menu;

	public function __construct()
    {
        parent::__construct();
        $this->load->library('favori_parcours');
    }

    public function index()
    {
    	$data['nbParcours'] = $this->favori_parcours->recup_nb_parcours($this->session->userdata('connexion')['id']);
    	$data['nbParcoursFavori'] = $this->favori_parcours->recup_nb_parcours_favori($this->session->userdata('connexion')['id']);

       	$this->load->view('index', $data);
    }
}