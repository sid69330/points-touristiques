<?php
/*
    Controlleur permettant de mettre et retirer un parcours de ses favoris (page non accessible depuis l'accueil car finalement non intégrée)
*/
class Createfav extends CI_Controller
{   
        protected $menuOnglet;

        public function __construct()
        {
                parent::__construct();
        }

        public function index()
        {
        	$this->db->select('W.id, W.owner, W.favorite');
                $this->db->from('walkthrough W');
                $this->db->where('W.owner', $this->session->userdata('connexion')['id']);
                $this->db->where('W.id', $this->input->post('parcours'));
                $result = $this->db->get()->result();

                if(count($result) == 1)
                {

                        $result = $result[0];
                        $fav = $result->favorite?0:1;

                        $data = array(
                        'favorite' => $fav,
                        );

                        $this->db->where('id', $this->input->post('parcours'));
                        $this->db->update('walkthrough', $data); 
               	  	
        	        $color = $result->favorite?'blanche':'jaune';
                	echo $color;
                }
                //echo 'ok';
        }
}