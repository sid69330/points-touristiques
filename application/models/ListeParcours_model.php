<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ListeParcours_model extends CI_Model
{   
    //----------------------- Page connexion -----------------------
    
    public function chercherParcours($identifiant)
    {
        $tab['erreur'] = '';
        
        $this->db->select('U.login, W.name, W.walkthrough as parcours');
        $this->db->from('walkthrough W');
        $this->db->join('user U', 'U.id = W.owner');
        $this->db->where('owner', $identifiant);
        $query = $this->db->get();
        
        $nb = $query->num_rows();
        $result = $query->result();
        if($nb == 0)
            $tab['erreur'] = "Vous n'avez pas de parcours d'enregistré";
        else
            $tab['result'] = $result;
        
        return $tab;
    }
}