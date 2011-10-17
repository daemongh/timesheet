<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()	{
		$this->load->view('admin');
	}

    public function reports() {
        $this->load->model('projectmodel');
        $projects = $this->projectmodel->findProjects();
        $categories = $this->projectmodel->findCategories();

        $data = array(
            'projects' => $projects,
            'categories' => $categories
        );


        $this->load->view('reports', $data);
    }

    public function displayReports($type = '', $subject = 0) {
        switch ($type) {
            case 'projects':
                $result = $this->projectReports($subject);
                break;
            case 'category':
                $result = $this->categoryReports($subject);
                break;
            case 'user':
                $result = $this->userReports($subject);
                break;
            default:
                $this->projectReports(0);
                break;
        }

        $this->load->view('report', $result);
    }


    public function projectReports($projectId) {
        $this->load->model('reportsmodel');
        $result = $this->reportsmodel->findReportForProject($projectId);

        return $result = array('report' => $result);
    }

    public function categoryReports($categoryId) {
        return $result = array('report' => 'category report here');

    }

    public function userReports($userId) {
        return $result = array('report' => 'user report here');

    }

    public function manageProjects() {
        $this->load->model('projectmodel');
        $projects = $this->projectmodel->findProjects();

        $this->load->view('projects', $projects);
    }

    public function deleteProject() {

    }

    public function createProject() {

    }



}
