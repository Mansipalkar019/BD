<?php

class Projects_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        try {
            $query = $this->db->select("*")
                ->from("master_department")
                ->where("status", 0)
                ->get();
                
            if ($query->num_rows() > 0) {
                $rows = $query->result_array();
                return $rows;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }


//mansi
public function get_task_fields($tasktypeid)
	{
        $this->db->select('bdcrm_default_feilds_access.*,bdcrm_feilds.input_name');
        $this->db->from('bdcrm_default_feilds_access');
        $this->db->join('bdcrm_feilds','bdcrm_feilds.id=bdcrm_default_feilds_access.feild_id','left');
		$this->db->where('bdcrm_default_feilds_access.task_type_id',$tasktypeid);
		$this->db->group_by('bdcrm_default_feilds_access.id');
        $this->db->order_by('bdcrm_default_feilds_access.id',"DESC");
        $query=$this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array();
    }

}
