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
        $this->db->select('bdcrm_default_feilds_access.*,bdcrm_feilds.label_name');
        $this->db->from('bdcrm_default_feilds_access');
        $this->db->join('bdcrm_feilds','bdcrm_feilds.id=bdcrm_default_feilds_access.feild_id','left');
		$this->db->where('bdcrm_default_feilds_access.task_type_id',$tasktypeid);
		$this->db->group_by('bdcrm_default_feilds_access.id');
        $this->db->order_by('bdcrm_default_feilds_access.id',"DESC");
        $query=$this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array();
    }

function getprojectrecord($rowno="",$rowperpage="",$search_text="")
    {
		$this->db->select('bdcrm_master_projects.*,COUNT(Distinct(bdcrm_uploaded_feildss.company_name)) as noofcompanyname,COUNT(bdcrm_uploaded_feildss.company_name) as noofstaff,bdcrm_uploaded_feildss.*,bdcrm_project_types.project_type as project_type,bdcrm_project_type.project_type as task_type,users.username');
        $this->db->from('bdcrm_master_projects');
		$this->db->join('bdcrm_uploaded_feildss','bdcrm_uploaded_feildss.project_id=bdcrm_master_projects.id','left');
        $this->db->join('bdcrm_project_types','bdcrm_project_types.id=bdcrm_master_projects.project_type','left');
        $this->db->join('bdcrm_project_type','bdcrm_project_type.id=bdcrm_master_projects.task_type','left');
        $this->db->join('users','users.id=bdcrm_master_projects.created_by','left');
		$this->db->where('bdcrm_master_projects.status','1');
        $this->db->limit($rowperpage,$rowno);
		if($search_text != '')
		{
			$this->db->where("(bdcrm_master_projects.project_name LIKE '%".$search_text."%')", NULL, FALSE); 
		}
		$this->db->group_by('bdcrm_master_projects.id');
        $this->db->order_by('bdcrm_master_projects.id',"DESC");
     
		$query=$this->db->get();
        return $query->result_array();
    }

function get_projectrecord_count_filtered($rowno="",$rowperpage="",$search_text="")
    {
		$this->db->select('bdcrm_master_projects.*,COUNT(Distinct(bdcrm_uploaded_feildss.company_name)) as noofcompanyname,COUNT(bdcrm_uploaded_feildss.company_name) as noofstaff,bdcrm_uploaded_feildss.*,bdcrm_project_types.project_type as project_type,bdcrm_project_type.project_type as task_type,users.username');
        $this->db->from('bdcrm_master_projects');
		$this->db->join('bdcrm_uploaded_feildss','bdcrm_uploaded_feildss.project_id=bdcrm_master_projects.id','left');
        $this->db->join('bdcrm_project_types','bdcrm_project_types.id=bdcrm_master_projects.project_type','left');
        $this->db->join('bdcrm_project_type','bdcrm_project_type.id=bdcrm_master_projects.task_type','left');
        $this->db->join('users','users.id=bdcrm_master_projects.created_by','left');
		$this->db->where('bdcrm_master_projects.status','1');
        $this->db->limit($rowperpage,$rowno);
		if($search_text != '')
		{
			$this->db->where("(bdcrm_master_projects.project_name LIKE '%".$search_text."%')", NULL, FALSE); 
		}
		$this->db->group_by('bdcrm_master_projects.id');
        $this->db->order_by('bdcrm_master_projects.id',"DESC");
        
		$query=$this->db->get();
		return $query->num_rows();
    }

function get_projectrecord_count_all($rowno="",$rowperpage="",$search_text="")
    {
		$this->db->select('bdcrm_master_projects.*,COUNT(Distinct(bdcrm_uploaded_feildss.company_name)) as noofcompanyname,COUNT(bdcrm_uploaded_feildss.company_name) as noofstaff,bdcrm_uploaded_feildss.*,bdcrm_project_types.project_type as project_type,bdcrm_project_type.project_type as task_type,users.username');
        $this->db->from('bdcrm_master_projects');
		$this->db->join('bdcrm_uploaded_feildss','bdcrm_uploaded_feildss.project_id=bdcrm_master_projects.id','left');
        $this->db->join('bdcrm_project_types','bdcrm_project_types.id=bdcrm_master_projects.project_type','left');
        $this->db->join('bdcrm_project_type','bdcrm_project_type.id=bdcrm_master_projects.task_type','left');
        $this->db->join('users','users.id=bdcrm_master_projects.created_by','left');
		$this->db->where('bdcrm_master_projects.status','1');
        $this->db->limit($rowperpage,$rowno);
		if($search_text != '')
		{
			$this->db->where("(bdcrm_master_projects.project_name LIKE '%".$search_text."%')", NULL, FALSE); 
		}
		$this->db->group_by('bdcrm_master_projects.id');
        $this->db->order_by('bdcrm_master_projects.id',"DESC");
		$query=$this->db->get();
		return $query->num_rows();
    }



}
