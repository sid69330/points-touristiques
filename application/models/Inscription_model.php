<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inscription_model extends CI_Model
{   
    //----------------------- Page connexion -----------------------
    
    public function ajoutUtilisateur($pseudo, $mail, $mdp)
    {
        $data = array
        (
            'login' => $pseudo,
            'mail' => $mail,
            'password' => $mdp
        );

        $this->db->insert('user', $data);
    }
}