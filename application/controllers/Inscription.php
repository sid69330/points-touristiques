<?php
class Inscription extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('inscription_model');
    }

    public function index()
    {
		$this->form_validation->set_rules('pseudo', '"Pseudo"', 'trim|required|min_length[3]|max_length[30]|is_unique[user.login]encode_php_tags');
		$this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|max_length[255]|is_unique[user.mail]|encode_php_tags');
		$this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|min_length[5]|encode_php_tags');
		$this->form_validation->set_rules('mdp2', '"Ressaisir"', 'required|matches[mdp]|encode_php_tags');
		$data['inscription_ok'] = $this->session->flashdata('inscription_ok');

		if($this->form_validation->run() == FALSE)
			$this->load->view('inscription', $data);
		else
		{
			$pseudo = $this->input->post('pseudo');
			$email = $this->input->post('email');
			$mdp = hash('sha256', $this->input->post('mdp'));

			$this->inscription_model->ajoutUtilisateur($pseudo, $email, $mdp);
			$this->session->set_flashdata('inscription_ok', 'Inscription réussie. Vous pouvez maintenant vous connecter à votre compte.');
			Redirect('/inscription');
		}
    }
}
