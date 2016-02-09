<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion_model extends CI_Model
{   
    //----------------------- Page connexion -----------------------
    
    public function verifierIdentifiant($identifiant, $mdp)
    {
        $tab['erreur'] = '';
        
        $this->db->select('login, mail, name, wakthrough');
        $this->db->from('ways');
        $this->db->where('owner', $own);
        $query = $this->db->get();
        
        $nb = $query->num_rows();
        $result = $query->result();
        
        if($nb == 0)
            $tab['erreur'] = "Vous n'avez pas encore créé d'itinéraire";
        
        return $tab;
    }
}
