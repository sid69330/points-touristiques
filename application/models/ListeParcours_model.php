<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ListeParcours_model extends CI_Model
{   
    
    public function chercherParcours($identifiant)
    {
        $tab['erreur'] = '';
        
        $this->db->select('W.id, U.login, W.name, W.walkthrough as parcours, W.favorite');
        $this->db->from('walkthrough W');
        $this->db->join('user U', 'U.id = W.owner');
        $this->db->where('owner', $identifiant);
        $this->db->order_by('id', 'desc');
        
        return $this->db->get()->result();
    }
}