<?php
class Index extends CI_Controller 
{
	protected $categories_menu;

	public function __construct()
        {
                parent::__construct();
                $this->load->library('Parcours_json');
        }

        public function index()
        {
        		$data['categ'] = $this->parcours_json->get_categ();
        		$data['coord'] = $this->parcours_json->get_coord();
               	$this->load->view('index', $data);
        }
}
