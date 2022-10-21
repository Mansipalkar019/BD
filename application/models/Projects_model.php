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
        
        $data=$query->result_array();
       
        foreach($data as $data_key =>$data_val)
        {
            $fdata[]=$data_val['input_name'];
           
        }
        return $fdata;
    }


    function get_staff_info($project_id="",$received_company_name="",$rowno="",$rowperpage="",$workstatus=""){

        $this->db->select('bmp.id as project_id,bmp.project_name,bmp.project_breif,buf.received_company_name,buf.industry,buf.provided_job_title,buf.city,buf.address1,
        bc.name as country_name,buf.region,buf.web_staff_disposition,buf.web_staff_disposition,buf.provided_staff_email,buf.company_disposition,buf.web_disposition,buf.website_url,buf.no_of_emp,buf.revenue,buf.voice_staff_disposition,buf.id as staff_id,bnp.prefix as salutation,buf.first_name,buf.last_name,CONCAT(us.first_name,us.last_name) as assigned_to,CONCAT(usd.first_name,usd.last_name) as assigned_by,ca.status,buf.created_date,ca.created_at as assigned_at');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bc','buf.provided_country = bc.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->join('companywise_allocation ca','buf.id = ca.staff_id','left');
        $this->db->join('users us','ca.user_id=us.id','left');
        $this->db->join('users usd','ca.assigned_by=usd.id','left');
        $this->db->join('bdcrm_industries bin','buf.industry=bin.id','left');
        $this->db->join('bdcrm_staff_web_disposition bswd','buf.web_staff_disposition=bswd.id','left');
        
            

        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$received_company_name);
        $this->db->where('bmp.status',1);
        $where = '((ca.status IS NULL OR ca.status=1) AND (bmp.status=1))';
        $this->db->where($where);

        if($workstatus==1)
        {
            $this->db->where('ca.assigned_by !=""');  
        }
        elseif($workstatus==2){
            $this->db->where('ca.assigned_by IS NULL');   
        }
        $this->db->limit($rowperpage,$rowno);
        $this->db->group_by('buf.id');
        $query=$this->db->get();
      //echo $this->db->last_query();die();
        return $data = $query->result_array();
    }

    function get_no_staff_info($project_id="",$received_company_name="",$rowno="",$rowperpage="",$workstatus=""){

        $this->db->select('bmp.id as project_id,bmp.project_name,bmp.project_breif,buf.received_company_name,buf.industry,buf.provided_job_title,buf.city,buf.address1,
        bc.name as country_name,buf.region,buf.web_staff_disposition,buf.web_staff_disposition,buf.provided_staff_email,buf.company_disposition,buf.web_disposition,buf.website_url,buf.no_of_emp,buf.revenue,buf.voice_staff_disposition,buf.id as staff_id,bnp.prefix as salutation,buf.first_name,buf.last_name,CONCAT(us.first_name,us.last_name) as assigned_to,CONCAT(usd.first_name,usd.last_name) as assigned_by,ca.status,buf.created_date,ca.created_at as assigned_at');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bc','buf.provided_country = bc.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->join('companywise_allocation ca','buf.id = ca.staff_id','left');
        $this->db->join('users us','ca.user_id=us.id','left');
        $this->db->join('users usd','ca.assigned_by=usd.id','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$received_company_name);
        $this->db->where('bmp.status',1);
        $where = '((ca.status IS NULL OR ca.status=1) AND (bmp.status=1))';
        $this->db->where($where);
       // $this->db->where('cmpallo.status',1);
        if($workstatus==1)
        {
            $this->db->where('ca.assigned_by !=""');  
        }
        elseif($workstatus==2){
            $this->db->where('ca.assigned_by IS NULL');   
        }
        $this->db->limit($rowperpage,$rowno);
        $this->db->group_by('buf.id');
        $query=$this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function get_all_staff_info($project_id="",$received_company_name="",$rowno="",$rowperpage="",$workstatus=""){

        $this->db->select('bmp.id as project_id,bmp.project_name,bmp.project_breif,buf.received_company_name,buf.industry,buf.provided_job_title,buf.city,buf.address1,
        bc.name as country_name,buf.region,buf.web_staff_disposition,buf.web_staff_disposition,buf.provided_staff_email,buf.company_disposition,buf.web_disposition,buf.website_url,buf.no_of_emp,buf.revenue,buf.voice_staff_disposition,buf.id as staff_id,bnp.prefix as salutation,buf.first_name,buf.last_name,CONCAT(us.first_name,us.last_name) as assigned_to,CONCAT(usd.first_name,usd.last_name) as assigned_by,ca.status,buf.created_date,ca.created_at as assigned_at');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->join('bdcrm_countries bc','buf.provided_country = bc.id','left');
        $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->join('companywise_allocation ca','buf.id = ca.staff_id','left');
        $this->db->join('users us','ca.user_id=us.id','left');
        $this->db->join('users usd','ca.assigned_by=usd.id','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$received_company_name);
        $this->db->where('bmp.status',1);
        $where = '((ca.status IS NULL OR ca.status=1) AND (bmp.status=1))';
        $this->db->where($where);

        // $this->db->where('cmpallo.status',1);
       if($workstatus==1)
        {
            $this->db->where('ca.assigned_by !=""');  
        }
        elseif($workstatus==2){
            $this->db->where('ca.assigned_by IS NULL');   
        }
        $this->db->limit($rowperpage,$rowno);
        $this->db->group_by('buf.id');
        $query=$this->db->get();

        // echo $this->db->last_query(); die;
        return $this->db->count_all_results();     
    }
    function getProjectInfo($project_id){
        $this->db->select('GROUP_CONCAT(DISTINCT(buf.received_company_name)) as received_company_name,count(buf.received_company_name) as staff_count,buf.created_date,GROUP_CONCAT(DISTINCT(buf.project_id)) as project_id,buf.id,bmp.project_name,GROUP_CONCAT(buf.id) as bdcrm_uploaded_feildss_id');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        // $this->db->join('bdcrm_countries bcn','buf.provided_country = bcn.id','left');
        // $this->db->join('bdcrm_name_prefix bnp','buf.suffix = bnp.id','left');
        $this->db->where('bmp.id',$project_id);
        $this->db->where('bmp.status',1);
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
        $this->db->join('companywise_allocation ca','ca.staff_id = buf.id','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->where('buf.received_company_name',$company_name);
        $this->db->where('ca.assigned_by',$this->session->userdata('id'));
        $this->db->where('ca.status','1');
        $querys=$this->db->get();
        return $datas =  $querys->result_array();
    }

    function getAllStaffInfoDetails($project_id,$rowid,$cmp_name){
        $this->db->select('bmp.*,buf.first_name,buf.last_name,buf.updated_status,buf.received_company_name as comp_name,buf.project_id,buf.id');
        $this->db->from('companywise_allocation ca');
        $this->db->join('bdcrm_uploaded_feildss buf','ca.staff_id = buf.id','left');
        $this->db->join('bdcrm_company_disposition bmp','buf.company_disposition = bmp.id','left');
        $this->db->where('ca.assigned_by',$this->session->userdata('id'));
        $this->db->where('ca.status','1');
        $querys=$this->db->get();
        return $datas =  $querys->result_array();
    }

    function getCompanyInfoDetails($project_id,$rowid){
        $this->db->select('bmp.*,buf.received_company_name,buf.updated_status,count(buf.received_company_name) as staffcount,buf.project_id,buf.id');
        $this->db->distinct('received_company_name');
        $this->db->from('bdcrm_uploaded_feildss buf');
        $this->db->join('bdcrm_company_disposition bmp','buf.company_disposition = bmp.id','left');
        $this->db->join('companywise_allocation ca','ca.staff_id = buf.id','left');
        $this->db->where('buf.project_id',$project_id);
        $this->db->group_by('received_company_name');
        $this->db->where('ca.assigned_by',$this->session->userdata('id'));
        $this->db->where('ca.status','1');
        $querys=$this->db->get();
        //echo $this->db->last_query();die();
        return $datas =  $querys->result_array();
    }

    function getPreLastInfo($project_id,$rowid,$cmp_name){
            $this->db->select('min(buf.id) as myfirst,max(buf.id) as mylast,buf.project_id,buf.received_company_name');
            $this->db->from('bdcrm_uploaded_feildss buf');
            $this->db->where('buf.project_id',$project_id);
            $this->db->join('companywise_allocation ca','ca.staff_id = buf.id','left');
            //$this->db->where('received_company_name',$cmp_name);
           
            //echo $this->db->last_query();die();
            $this->db->where('ca.assigned_by',$this->session->userdata('id'));
            $this->db->where('ca.status','1');
            $querys=$this->db->get();
            return $datas =  $querys->row_array();  
    }

 

    
}
