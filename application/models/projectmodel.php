<?php


class ProjectModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


    public function findProjects()
    {
        $this->db->select('id, project_name, project_desc');
        $this->db->where('status', 1);
        $this->db->from('projects');
        
        $result = $this->db->get();
        
        return $result->result();        
    }
    
    public function findUsers() {
        $this->db->select('id, user_name');
        $this->db->from('user');

        $result = $this->db->get();
        return $result->result();

    }


    public function findCategories()
    {
        $this->db->select('id, category, category_desc');
        $this->db->where('status', 1);
        $this->db->from('category');
        
        $result = $this->db->get();

        return $result->result();
    }

    public function findProjectCategories()
    {
    
    }

    public function createProject()
    {

    }

    public function createCategory()
    {

    }

    public function createProjectCategory()
    {

    }
    

    public function updateUserHours($week, $day, $project, $category)
    {
        foreach ($day as $id => $hours) {
            $data = array(
                'user_id' => 1112,
                'project_id' => $project,
                'category_id' => $category,
                'day' => $id,
                'week' => $week,
                'hours' => $hours,
                'year' => date('Y')
            );

            $this->db->insert('user_time', $data);
        }
        return true;
    }
}
