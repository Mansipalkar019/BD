<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Projects extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Projects_model'));
        if(empty($this->session->userdata('id'))){
            redirect(base_url("login"));
        }

    }

    public function index()
    {
        $data['main_content'] = "main/dashboard";
        $this->load->view("includes/template",$data);
    }

    public function my_projects(){
        $data['webDispo'] = $this->model->getData('bdcrm_web_disposition', array('status' => '1'));
        $data['compDispo'] = $this->model->getData('bdcrm_company_disposition', array('status' => '1'));
        $data['VoiceDispo'] = $this->model->getData('bdcrm_caller_disposition', array('status' => '1'));
        $data['country'] = $this->model->getData('bdcrm_countries', array('status' => '1'));
        $data['currency'] = $this->model->getData('bdcrm_currency', array('status' => '1'));
        $this->load->view("main/add_info",$data);
    }



    public function new_projects($id=0){
         $data['TaskType'] = $this->model->getData('bdcrm_project_type', array('status' => '1'));
         $data['ProjType'] = $this->model->getData('bdcrm_project_types', array('status' => '1'));
         $data['main_content'] = "projects/add_new_project";
         $data['getAllCountry'] = $this->model->getData('bdcrm_countries', array('status' => '1'));
         $this->load->view("includes/template", $data);
    }


    public function spreadhseet_format_download()
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="hello_world.xlsx"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'S.No');
        $sheet->setCellValue('B1', 'Product Name');
        $sheet->setCellValue('C1', 'Quantity');
        $sheet->setCellValue('D1', 'Price');

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }


       public function upload_project(){

        // echo "<pre>";
        // print_r($_POST['feild_access']);
        // die;
        $this->form_validation->set_rules("project_name", "Project Name", "trim|min_length[5]|max_length[100]|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("project_type", "Project Type", "trim|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("task_type", "Task Type", "trim|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("project_breif", "Project Breif", "trim|min_length[2]|max_length[100]|xss_clean", array("required" => "%s is required"));
        if($this->form_validation->run() == true){
           
      
            if(!empty($_FILES['uploaded_file']['name'])){
               
                    $config['upload_path'] = './uploads/projects/';
                    $config['allowed_types'] = 'csv';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '10000';
                    $config['max_filename_increment'] = 11111;
                    $config['remove_spaces'] = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);


                    $upload_file=$_FILES['uploaded_file']['name'];
                    $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
                    if($extension=='csv')
                    {
                        $reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    } else if($extension=='xls')
                    {
                        $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    } else
                    {
                        $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    }
                    $spreadsheet=$reader->load($_FILES['uploaded_file']['tmp_name']);
                    $file_data=$spreadsheet->getActiveSheet()->toArray();


                    $project_name = $this->security->xss_clean($this->input->post("project_name"));
                    $project_type = $this->security->xss_clean($this->input->post("project_type"));
                    $task_type = $this->security->xss_clean($this->input->post("task_type"));
                    $project_breif = $this->security->xss_clean($this->input->post("project_breif"));
                    $created_by = $this->session->userdata('id');
                    $projects_info = array('project_name'=> $project_name,'project_type'=>$project_type,'task_type'=>$task_type,'project_breif'=>$project_breif,'created_by'=>$created_by);
                    $addProjectInfo  = $this->model->insertData('bdcrm_master_projects',$projects_info); 

                    if(!empty($_POST['feild_access']))
                    {
                        foreach($_POST['feild_access'] as $field_access => $filed_access_key)
                        {
                            $projects_info=array(
                                'field_id'=>$filed_access_key,
                                'project_id'=>$addProjectInfo,
                                
                            );
                            $addProjectinputfields = $this->model->insertData('bdcrm_master_projects_fields',$projects_info); 
                           
                        }
                    }
                   
                    for($i=1;$i<count($file_data);$i++){
                        $file_datas[$i]['suffix'] =  $file_data[$i][0];
                        $file_datas[$i]['first_name'] =  $file_data[$i][1];
                        $file_datas[$i]['last_name'] = $file_data[$i][2];
                        $file_datas[$i]['provided_job_title'] = $file_data[$i][3];
                        $file_datas[$i]['updated_job_title'] = $file_data[$i][4];
                        $file_datas[$i]['staff_linkedin_con'] = $file_data[$i][5];
                        $file_datas[$i]['staff_url'] = $file_data[$i][6];
                        $file_datas[$i]['received_company_name'] = $file_data[$i][7];
                        $file_datas[$i]['company_name'] = $file_data[$i][8];
                        $file_datas[$i]['address1'] = $file_data[$i][9];
                        $file_datas[$i]['address2'] = $file_data[$i][10];
                        $file_datas[$i]['address3'] = $file_data[$i][11];
                        $file_datas[$i]['city'] = $file_data[$i][12];
                        $file_datas[$i]['state_county'] = $file_data[$i][13];
                        $file_datas[$i]['postal_code'] = $file_data[$i][14]; 
                        $file_datas[$i]['provided_country'] = $file_data[$i][15]; 
                        $file_datas[$i]['country'] = $file_data[$i][16];
                        $file_datas[$i]['region'] = $file_data[$i][17];
                        $file_datas[$i]['provided_staff_email'] = $file_data[$i][18];
                        $file_datas[$i]['staff_email'] = $file_data[$i][19];
                        $file_datas[$i]['assumed_email'] = $file_data[$i][20];
                        $file_datas[$i]['staff_email_harvesting'] = $file_data[$i][21];
                        $file_datas[$i]['provided_direct_tel'] = $file_data[$i][22];
                        $file_datas[$i]['staff_direct_tel'] = $file_data[$i][23];
                        $file_datas[$i]['provided_comp_tel_number'] = $file_data[$i][24];
                        $file_datas[$i]['tel_number'] = $file_data[$i][25]; 
                        $file_datas[$i]['alternate_number'] = $file_data[$i][26];
                        $file_datas[$i]['extention'] = $file_data[$i][27];
                        $file_datas[$i]['staff_mobile'] = $file_data[$i][28];
                        $file_datas[$i]['website_url'] = $file_data[$i][29];
                        $file_datas[$i]['address_url'] = $file_data[$i][30];
                        $file_datas[$i]['remarks'] = $file_data[$i][31];
                        $file_datas[$i]['industry'] = $file_data[$i][32];
                        $file_datas[$i]['genaral_note'] = $file_data[$i][33];
                        $file_datas[$i]['ca1'] = $file_data[$i][34];
                        $file_datas[$i]['ca2'] = $file_data[$i][35];
                        $file_datas[$i]['ca3'] = $file_data[$i][36];
                        $file_datas[$i]['ca4'] = $file_data[$i][37];
                        $file_datas[$i]['ca5'] = $file_data[$i][38];
                        $file_datas[$i]['sa1'] = $file_data[$i][39];
                        $file_datas[$i]['sa2'] = $file_data[$i][40];
                        $file_datas[$i]['sa3'] = $file_data[$i][41];
                        $file_datas[$i]['sa4'] = $file_data[$i][42];
                        $file_datas[$i]['sa5'] = $file_data[$i][43];
                        $addDept  = $this->model->insertData('bdcrm_uploaded_feildss',$file_datas[$i]);
                
                    }


                }
                redirect(base_url("projects/new_projects"));
            }else{
                // echo "<pre>";
                // print_r($_POST);
                // die;
                $data = array(
                    'error' => validation_errors()
                );
                 $this->session->set_flashdata("error", $data['error']);
                redirect(base_url("master/new_projects"));
            }

                          





}































    public function upload_projectss(){
        if(!empty($_FILES['uploaded_file']['name'])){

                    $config['upload_path'] = './uploads/projects/';
                    $config['allowed_types'] = 'csv';
                    $config['file_ext_tolower'] = TRUE;
                    $config['max_size'] = '10000';
                    $config['max_filename_increment'] = 11111;
                    $config['remove_spaces'] = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);

        if (!$this->upload->do_upload('uploaded_file')){
             echo "Wrong";
            return;
        }else{

            $uploadedData = $this->upload->data();
            $file_name = base_url() . "uploads/projects/" . $uploadedData['file_name'];
            $opts = array('http' => array('follow_location' => false));


            if(($handle = fopen($file_name, "r", false, stream_context_create($opts))) !== false){
                $file_data = fgetcsv($handle, 1000,',');

                    echo "<pre>";
                    print_r($file_data);
                    die;


                // foreach ($file_data as $key => $value) {

                //     echo "<pre>";
                //     print_r($file_data);
                //     die;
                  
                // }

                // $headers = [];
                // echo "<pre>";
                // print_r()





                    // $file_data[$i]['suffix'] = $file_data[$i]['suffix'];
                    // $file_data[$i]['first_name'] = 
                    // $file_data[$i]['lastname'] = 
                    // $file_data[$i]['provided_job_title'] = 
                    // $file_data[$i]['updated_job_title'] = 
                    // $file_data[$i]['staff_linkedin_con'] = 
                    // $file_data[$i]['staff_url'] = 
                    // $file_data[$i]['company_name'] = 
                    // $file_data[$i]['address1'] = 
                    // $file_data[$i]['address2'] = 
                    // $file_data[$i]['address3'] = 
                    // $file_data[$i]['city'] = 
                    // $file_data[$i]['state_county'] = 
                    // $file_data[$i]['postal_code'] = 
                    // $file_data[$i]['country'] = 
                    // $file_data[$i]['region'] = 

                    // $file_data[$i]['staff_email'] = //NTC
                    // $file_data[$i]['staff_email'] = 
                    // $file_data[$i]['staff_email_harvesting'] = 
                    // $file_data[$i]['staff_direct_tel'] = 
                    // $file_data[$i]['tel_number'] = 
                    // $file_data[$i]['alternate_number'] = 

                    // $file_data[$i]['staff_mobile'] = 
                    // $file_data[$i]['website_url'] = 
                    // $file_data[$i]['alternate_number'] = 
                    // $file_data[$i]['alternate_number'] = 
                    // $file_data[$i]['alternate_number'] = 
                    // $file_data[$i]['alternate_number'] = 
                    // $file_data[$i]['alternate_number'] = 



                // }
                

            }


        }
                    


    } 
}

//mansi

public function gettasktype()
    {
       $tasktypeid=$this->input->post('tasktypeid');
       $tasktypefields=$this->Projects_model->get_task_fields($tasktypeid);   
       echo json_encode($tasktypefields);  
    }

}

