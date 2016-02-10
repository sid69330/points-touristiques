<?php
class Index extends CI_Controller 
{
	protected $categories_menu;

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
       	$this->load->view('index');
    }
}