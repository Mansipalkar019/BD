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




    public function get_task_fields($tasktypeid){
        $this->db->select('id,label_name');
        $this->db->from('bdcrm_feilds');
        $this->db->where('status','1');
        $query=$this->db->get();
        $data =  $query->result_array();

        foreach ($data as $key => $value) {
            $feild_id= $value['id'];
            $label_name = $value['label_name'];
            $this->db->select('id,feild_id,task_type_id');
            $this->db->from('bdcrm_default_feilds_access');
            $this->db->where('feild_id',$feild_id);
            $this->db->where('task_type_id',$tasktypeid);
            $this->db->where('status',1);
            $querys=$this->db->get();
            $datas =  $querys->row_array();
          
            if(!empty($datas)){
                $fdata[$key]= $datas;
                $fdata[$key]['access'] = 1;
                $fdata[$key]['label_name'] = $label_name;
            }else{
                $fdata[$key]['id'] = $feild_id;
                $fdata[$key]['feild_id'] = $feild_id;
                $fdata[$key]['task_type_id'] = $tasktypeid;
                $fdata[$key]['access'] = 0;
                $fdata[$key]['label_name'] = $label_name;
            }

        }

        return $fdata;
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
