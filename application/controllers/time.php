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
			redirect("/time/dashboard/$username");
		} else {
			$this->index();
		}
	}

	public function dashboard($username = '') {

        $this->load->model('projectmodel');
        $projects = $this->projectmodel->findProjects();
        $categories = $this->projectmodel->findCategories();

        $data = array(
            'userId' => 1111,
            'username' => $username,
            'projects' => $projects,
            'categories' => $categories
        );


		$this->load->view('dashboard', $data);
	}

	public function forgotPassword() {
		echo 'not yet implmenented';
	}

    public function updateHours() {
       
        $totalHours = 0;
        $hours = $this->input->post('week');

        // find week
        error_reporting(0);
        foreach ($hours as $hour) {
            $week = date('W', strtotime($hour['weekOf']));
            $day = array (

                '0' => $hour['sunday'],
                '1' => $hour['monday'],
                '2' => $hour['tuesday'],
                '3' => $hour['wednesday'],
                '4' => $hour['thursday'],
                '5' => $hour['friday'],
                '6' => $hour['saturday']
            );
            $project = $hour['project'];
            $category = $hour['category'];
        

            try {
                $this->load->model('projectmodel');
                $this->projectmodel->updateUserHours($week, $day, $project, $category);
            } catch (Exception $e) {
                echo 'error';
            }       
        }
 
        $resultArray = array ('success' => true);
        echo json_encode($resultArray);
        return true;
    }

    public function createAccount() {
        $this->load->view('createAccount');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
