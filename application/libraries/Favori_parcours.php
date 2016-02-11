<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Favori_parcours
{
	protected $ci;

	public function __construct()
	{
		$this->ci = $CI = &get_instance();
	}

	public function recup_nb_parcours($id_utilisateur)
	{
		$this->ci->db->select('count(*) as nb');
		$this->ci->db->from('walkthrough');
		$this->ci->db->where('owner', $id_utilisateur);

		return $this->ci->db->get()->result()[0]->nb;
	}

	public function recup_nb_parcours_favori($id_utilisateur)
	{
		$this->ci->db->select('count(*) as nb');
		$this->ci->db->from('walkthrough');
		$this->ci->db->where('owner', $id_utilisateur);
		$this->ci->db->where('favorite', 1);

		return $this->ci->db->get()->result()[0]->nb;
	}
}
?>