<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()	{
		$this->load->view('index');
	}

	public function login()	{
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// if everything is cool from authentication, 
		if (true) {
			$this->dashboard();
		} else {
			$this->index();
		}
	}

	public function dashboard() {
		$this->load->view('dashboard');
	}

	public function forgotPassword() {
		echo 'not yet implmenented';
	}

	public function createAccount() {
		echo 'not yet implemented';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
