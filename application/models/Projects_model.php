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


// function getprojectrecord(){

// 		$this->db->select('bmp.id,bmp.project_name,bmp.project_breif,bpt.project_type,bpts.project_type as task_type,bmp.created_at,bmp.created_by,bmp.file_name,bmp.file_path,us.username');
//         $this->db->from('bdcrm_master_projects as bmp');
// 		$this->db->join('bdcrm_project_type bpt','bmp.task_type = bpt.id','left');
//         $this->db->join('bdcrm_project_types bpts','bmp.project_type = bpts.id','left');
//         $this->db->join('users us','bmp.created_by = us.id','left');
// 		$this->db->where('bmp.status','1');
//         $this->db->order_by("bmp.id", "DESC");
// 		$query=$this->db->get();
//         $data = $query->result_array();

//         $fData=[];
//         foreach ($data as $key => $value) {
//             $project_id = $value['id'];
//             $info = $this->getCompanyInfoByProjectId($project_id);
//             $value['company_count'] = $info['company_count'];
//             $value['no_of_staff'] = $info['no_of_staff'];
//             $fData[] = $value;
//         }
//      return $fData;
//     }

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
        $this->db->last_query(); 

        $data=$query->result_array();
        foreach($data as $data_key =>$data_val)
        {
            $fdata[]=$data_val['input_name'];
           
        }
        return $fdata;
    }


    function get_staff_info($project_id="",$received_company_name="",$rowno="",$rowperpage="",$workstatus=""){
        $this->db->select('cmpallo.*,buf.*,bmp.project_name,bcn.name as country_name,bnp.prefix as salutation,users.username,md.designation_name');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bcn','buf.provided_country = bcn.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->join('companywise_allocation cmpallo','buf.id = cmpallo.staff_id','left');
        $this->db->join('users users','cmpallo.assigned_by=users.id','left');
        $this->db->join('master_designation md','md.id=users.designation','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$received_company_name);
        $this->db->where('bmp.status',1);

        if($this->session->userdata('designation_id') != 8)
        {
            $this->db->where('users.designation',$this->session->userdata('designation_id'));  
        }
        if($workstatus==1)
        {
            $this->db->where('cmpallo.assigned_by !=""');  
        }
        elseif($workstatus==2){
            $this->db->where('cmpallo.assigned_by IS NULL');   
        }
        $this->db->limit($rowperpage,$rowno);
        $this->db->group_by('buf.id');
        $query=$this->db->get();
        //echo $this->db->last_query();die();
        return $data = $query->result_array();
    }

    function get_no_staff_info($project_id="",$received_company_name="",$rowno="",$rowperpage="",$workstatus=""){
        $this->db->select('cmpallo.*,buf.*,bmp.project_name,bcn.name as country_name,bnp.prefix as salutation,users.username,md.designation_name');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bcn','buf.provided_country = bcn.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->join('companywise_allocation cmpallo','buf.id = cmpallo.staff_id','left');
        $this->db->join('users users','cmpallo.assigned_by=users.id','left');
        $this->db->join('master_designation md','md.id=users.designation','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$received_company_name);
        $this->db->where('bmp.status',1);
        if($this->session->userdata('designation_id') != 8)
        {
            $this->db->where('users.designation',$this->session->userdata('designation_id'));  
        }
        if($workstatus==1)
        {
            $this->db->where('cmpallo.assigned_by !=""');  
        }
        elseif($workstatus==2){
            $this->db->where('cmpallo.assigned_by IS NULL');   
        }
        $this->db->limit($rowperpage,$rowno);
        $this->db->group_by('buf.id');
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function get_all_staff_info($project_id="",$received_company_name="",$rowno="",$rowperpage="",$workstatus=""){
        $this->db->select('cmpallo.*,buf.*,bmp.project_name,bcn.name as country_name,bnp.prefix as salutation,users.username,md.designation_name');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bcn','buf.provided_country = bcn.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->join('companywise_allocation cmpallo','buf.id = cmpallo.staff_id','left');
        $this->db->join('users users','cmpallo.assigned_by=users.id','left');
        $this->db->join('master_designation md','md.id=users.designation','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$received_company_name);
        $this->db->where('bmp.status',1);
        if($this->session->userdata('designation_id') != 8)
        {
            $this->db->where('users.designation',$this->session->userdata('designation_id'));  
        }
        if($workstatus==1)
        {
            $this->db->where('cmpallo.assigned_by !=""');  
        }
        elseif($workstatus==2){
            $this->db->where('cmpallo.assigned_by IS NULL');   
        }
        $this->db->limit($rowperpage,$rowno);
        $this->db->group_by('buf.id');
        $query=$this->db->get();
        return $this->db->count_all_results();     
    }
    function getProjectInfo($project_id="",$slot_count="",$workalloc=""){
        $this->db->select('GROUP_CONCAT(DISTINCT(buf.received_company_name)) as received_company_name,count(buf.received_company_name) as staff_count,buf.created_date,GROUP_CONCAT(DISTINCT(buf.project_id)) as project_id,buf.id,bmp.project_name,GROUP_CONCAT(buf.id) as bdcrm_uploaded_feildss_id,GROUP_CONCAT(companywise_allocation.assigned_by) as assigned_by,CONCAT(users.first_name," ",users.last_name) as user_name');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('companywise_allocation','buf.id = companywise_allocation.staff_id','left');
        $this->db->join('users','companywise_allocation.assigned_by = users.id','left');
        $this->db->where('bmp.id',$project_id);
        $this->db->where('bmp.status',1);
        if(!empty($slot_count)){
            $this->db->limit($slot_count);
        }
        if($workalloc=="Assigned"){
             $this->db->where('companywise_allocation.assigned_by !=""');
        }
         if($workalloc=="Unassigned"){
             $this->db->where('companywise_allocation.assigned_by IS NULL');
        }
        $this->db->group_by('buf.received_company_name');
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
        $this->db->select('bmp.*,buf.first_name,buf.last_name,buf.updated_status,buf.received_company_name as comp_name,buf.project_id,buf.id');
        $this->db->from('bdcrm_uploaded_feildss buf');
        $this->db->join('bdcrm_company_disposition bmp','buf.company_disposition = bmp.id','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$company_name);
        $querys=$this->db->get();
        return $datas =  $querys->result_array();
    }

    function getAllStaffInfoDetails($project_id){
        $this->db->select('bmp.*,buf.first_name,buf.last_name,buf.updated_status,buf.received_company_name as comp_name,buf.project_id,buf.id');
        $this->db->from('bdcrm_uploaded_feildss buf');
        $this->db->join('bdcrm_company_disposition bmp','buf.company_disposition = bmp.id','left');
        $this->db->where('buf.project_id',$project_id);
        $querys=$this->db->get();
        return $datas =  $querys->result_array();
    }

    function getCompanyInfoDetails($project_id){
        $this->db->select('bmp.*,buf.received_company_name,buf.updated_status,count(buf.received_company_name) as staffcount,buf.project_id,buf.id');
        $this->db->distinct('received_company_name');
        $this->db->from('bdcrm_uploaded_feildss buf');
        $this->db->join('bdcrm_company_disposition bmp','buf.company_disposition = bmp.id','left');
        $this->db->where('project_id',$project_id);
        $this->db->group_by('received_company_name');
        $querys=$this->db->get();
         
        return $datas =  $querys->result_array();
    }

    function getPreLastInfo($project_id,$rowid,$cmp_name){
            $this->db->select('min(id) as myfirst,max(id) as mylast,project_id,received_company_name');
            $this->db->from('bdcrm_uploaded_feildss');
            $this->db->where('project_id',$project_id);
            //$this->db->where('received_company_name',$cmp_name);
            $querys=$this->db->get();
            //echo $this->db->last_query();die();
            return $datas =  $querys->row_array();  
    }

 

    
}
