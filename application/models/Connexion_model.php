<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion_model extends CI_Model
{   
    //----------------------- Page connexion -----------------------
    
    public function verifierIdentifiant($identifiant, $mdp)
    {
        $tab['erreur'] = '';
        
        $this->db->select('id, login, password, mail');
        $this->db->from('user');
        $this->db->where('password', $mdp);
        $this->db->where('(mail = "'.$identifiant.'" OR login = "'.$identifiant.'")');
        $query = $this->db->get();
        
        $nb = $query->num_rows();
        $result = $query->result();
        
        if($nb == 0)
            $tab['erreur'] = "Identifiant ou mot de passe incorrect.";
        else
            $tab['result'] = $result[0];
        
        return $tab;
    }
}