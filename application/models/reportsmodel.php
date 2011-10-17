<?php


class ReportsModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

    public function findReportForProject($projectId = 0) {
        $where = '';
        $data = array();
        if ($projectId != 0) {
            $where = "where p.id = {$projectId}";
        }

        $sql = "select p.id, p.project_name, c.category, ut.user_id, ut.week, SUM(ut.hours) as hours, ut.day, ut.year from user_time ut
                left join projects p on p.id = ut.project_id
                left join category c on c.id = ut.category_id
                $where group by ut.project_id, ut.user_id order by p.id, ut.week";



        $result = $this->db->query($sql);
        

        foreach($result->result() as $row) {
            $data[$row->project_name][$row->user_id][] = $row->hours;
            
        }    

        return $data;

        return $result->result();
    }

}
