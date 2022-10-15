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
        $this->db->order_by("sort_order");

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


function getprojectrecord(){

		$this->db->select('bmp.id,bmp.project_name,bmp.project_breif,bpt.project_type,bpts.project_type as task_type,bmp.created_at,bmp.created_by,bmp.file_name,bmp.file_path,us.username');
        $this->db->from('bdcrm_master_projects as bmp');
		$this->db->join('bdcrm_project_type bpt','bmp.task_type = bpt.id','left');
        $this->db->join('bdcrm_project_types bpts','bmp.project_type = bpts.id','left');
        $this->db->join('users us','bmp.created_by = us.id','left');
		$this->db->where('bmp.status','1');
        $this->db->order_by("bmp.id", "DESC");
		$query=$this->db->get();
        $data = $query->result_array();

        $fData=[];
        foreach ($data as $key => $value) {
            $project_id = $value['id'];
            $info = $this->getCompanyInfoByProjectId($project_id);
            $value['company_count'] = $info['company_count'];
            $value['no_of_staff'] = $info['no_of_staff'];
            $fData[] = $value;
        }
     return $fData;
    }


    function getCompanyInfoByProjectId($project_id){
            $this->db->select('COUNT(DISTINCT received_company_name) as company_count,COUNT(id) as no_of_staff');
            $this->db->from('bdcrm_uploaded_feildss');
            $this->db->where('project_id',$project_id);
            $querys=$this->db->get();
            return $datas =  $querys->row_array();
    }


    function get_project_input_fields($project_id)
    {
		$this->db->select('bdcrm_master_projects_fields.field_id,bdcrm_feilds.label_name,bdcrm_feilds.input_name');
		$this->db->from('bdcrm_master_projects_fields');
        $this->db->join('bdcrm_feilds','bdcrm_feilds.id=bdcrm_master_projects_fields.field_id','left');
        $this->db->where('bdcrm_master_projects_fields.project_id',$project_id);	

		$this->db->group_by('bdcrm_master_projects_fields.id');
        $this->db->order_by('bdcrm_master_projects_fields.id');
		$query=$this->db->get();
        $data=$query->result_array();
        foreach($data as $data_key =>$data_val)
        {
            $fdata[]=$data_val['input_name'];
           
        }
        return $fdata;
       
    }


    function getProjectInfo($project_id){
        $this->db->select('buf.*,bmp.project_name,bcn.name as country_name,bnp.prefix as salutation');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bcn','buf.provided_country = bcn.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        

        $this->db->where('bmp.id',$project_id);
        $this->db->where('bmp.status',1);
        $query=$this->db->get();
        return $data = $query->result_array();
    }

    function getProjectInfoByStaffId($pid,$sid){

        $this->db->select('buf.*,bmp.project_name,bmp.project_breif');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->where('buf.project_id',$pid);
        $this->db->where('buf.id',$sid);
        $this->db->where('bmp.status',1);
        $query=$this->db->get();
        $data = $query->result_array();
        $info = $this->getCompanyInfoByProjectId($pid);
        $data[0]['company_count']=$info['company_count'];
        $data[0]['no_of_staff']=$info['no_of_staff'];
        return $data;
    }

    function getStaffInfoDetails($project_id,$company_name){
        $this->db->select('first_name,last_name,company_disposition');
        $this->db->from('bdcrm_uploaded_feildss');
        $this->db->where('project_id',$project_id);
        $this->db->where('received_company_name',$company_name);
        $querys=$this->db->get();
        return $datas =  $querys->result_array();
    }

    function getCompanyInfoDetails($project_id){
        $this->db->select('received_company_name,company_disposition');
        $this->db->from('bdcrm_uploaded_feildss');
        $this->db->distinct('received_company_name');
        $this->db->where('project_id',$project_id);
        $querys=$this->db->get();
        return $datas =  $querys->result_array();
    }
}
