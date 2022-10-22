<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Company_staff_model extends CI_Model {
 
     public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getData($project_id="",$search="",$rowno="",$rowperpage="") {
         $this->db->select('GROUP_CONCAT(DISTINCT(buf.received_company_name)) as received_company_name,count(buf.received_company_name) as staff_count,buf.created_date,GROUP_CONCAT(DISTINCT(buf.project_id)) as project_id,buf.id,bmp.project_name,GROUP_CONCAT(buf.id) as bdcrm_uploaded_feildss_id');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->where('bmp.id',$project_id);
        $this->db->where('bmp.status',1);
        $this->db->group_by('buf.received_company_name');
        // $this->db->order_by('buf.id',"DESC");
            $this->db->limit($rowperpage, $rowno);  
            // if($search != ''){
            //   $this->db->where("(order_data.order_id LIKE '%".$search."%' OR op_user.user_name LIKE '%".$search."%' OR op_user.email LIKE '%".$search."%' OR op_user.contact_no LIKE '%".$search."%' OR tbl_order_status.status LIKE '%".$search."%'OR tbl_order_status_master.order_status LIKE '%".$search."%'OR tbl_payment.payment_type LIKE '%".$search."%')", NULL, FALSE); 
            // }        
            $query = $this->db->get();
            return $query->result_array();
    }

    // Select total records
    public function getrecordCount($project_id="",$search="",$rowno="",$rowperpage="") {
        $this->db->select('GROUP_CONCAT(DISTINCT(buf.received_company_name)) as received_company_name,count(buf.received_company_name) as staff_count,buf.created_date,GROUP_CONCAT(DISTINCT(buf.project_id)) as project_id,buf.id,bmp.project_name,GROUP_CONCAT(buf.id) as bdcrm_uploaded_feildss_id');
        $this->db->from('bdcrm_uploaded_feildss as buf');
        $this->db->join('bdcrm_master_projects bmp','buf.project_id = bmp.id','left');
        $this->db->where('bmp.id',$project_id);
        $this->db->where('bmp.status',1);
        $this->db->group_by('buf.received_company_name');
        // $this->db->order_by('buf.id',"DESC");
                    // $this->db->limit($rowperpage, $rowno);  
            // if($search != ''){
            //   $this->db->where("(order_data.order_id LIKE '%".$search."%' OR op_user.user_name LIKE '%".$search."%' OR op_user.email LIKE '%".$search."%' OR op_user.contact_no LIKE '%".$search."%' OR tbl_order_status.status LIKE '%".$search."%'OR tbl_order_status_master.order_status LIKE '%".$search."%'OR tbl_payment.payment_type LIKE '%".$search."%')", NULL, FALSE); 
            // }
        return $this->db->count_all_results();     
    }
}