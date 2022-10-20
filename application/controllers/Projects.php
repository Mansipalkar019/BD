<?php

defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Projects extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Projects_model'));
        if (empty($this->session->userdata('id'))) {
            redirect(base_url("login"));
        }
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
        $data['main_content'] = "main/dashboard";
        $this->load->view("includes/template", $data);
    }

  

    public function project_list()
    {
        $data['projects']=$this->Projects_model->getprojectrecord();
        $data['main_content'] = "projects/project_list";
        $this->load->view("includes/template", $data);
    }

  
    public function new_projects($id = 0)
    {
        $data['TaskType'] = $this->model->getData('bdcrm_project_type', array('status' => '1'));
        $data['country'] = $this->model->getData('bdcrm_countries', array('status' => '1'));
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
     
        $this->form_validation->set_rules("project_name", "Project Name", "trim|min_length[5]|max_length[100]|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("project_type", "Project Type", "trim|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("task_type", "Task Type", "trim|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("project_breif", "Project Breif", "trim|min_length[2]|xss_clean", array("required" => "%s is required"));
        if ($this->form_validation->run() == true) {

            if (!empty($_FILES['uploaded_file']['name'])) {

                $config['upload_path'] = './uploads/projects/';
                $config['allowed_types'] = 'csv';
                $config['file_ext_tolower'] = TRUE;
                $config['max_size'] = '10000';
                $config['max_filename_increment'] = 11111;
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload');
                $this->upload->initialize($config);
                $upload_file = $_FILES['uploaded_file']['name'];
                $filename = time() . $upload_file;
                $filepath = 'uploads/projects/' . $filename;
                $filepath1 = trim(FCPATH . $filepath);
                $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else if ($extension == 'xls') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet = $reader->load($_FILES['uploaded_file']['tmp_name']);

                //mansi
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
                $writer->save($filepath1);
                //mansi
                $file_data = $spreadsheet->getActiveSheet()->toArray();
                $project_name = $this->security->xss_clean($this->input->post("project_name"));
                $project_type = $this->security->xss_clean($this->input->post("project_type"));
                $task_type = $this->security->xss_clean($this->input->post("task_type"));
                $project_breif = $this->security->xss_clean($this->input->post("project_breif"));
                $created_by = $this->session->userdata('id');
                $valid = 1;
                $error = [];
                for ($i = 1; $i < count($file_data); $i++) {
                    $lower = trim(strtolower($file_data[$i][16]));
                    $check_country = $this->model->selectWhereData('bdcrm_countries', array('name' => $lower), array('name'));
                    $db_country_name = (!empty($check_country)) ? $check_country['name'] : '';
                    $check = strcmp(strtolower($db_country_name), $lower);
                    if ($check < '0') {
                        $valid = 0;
                        $line_number = $i + 1;
                        $comment = 'Invalid country on line' . ' ' . $line_number;
                        $data = array('error' => $comment, 'class' => 'danger');
                        $error[] = $data;
                    }
                }
                $data['error'] = $error;
                $new=[];
                $this->session->set_flashdata('error', $data);

               if($valid > 0) {
                for ($i = 1; $i < count($file_data); $i++) {
                    $fInfo = (!empty($file_data[$i][16])) ? $this->getCountryInfoByName($file_data[$i][16]) : '' ;
                    $suffix=$this->getSuffixInfoByName($file_data[$i][0]);
                    $suffix_id  = (!empty($suffix)) ? $suffix['id'] : ''; 
                    $file_datas[$i]['suffix'] = $suffix_id;
                    $file_datas[$i]['first_name'] =  $file_data[$i][0];
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
                    $file_datas[$i]['provided_country'] = $c_id = (!empty($fInfo)) ? $fInfo['id'] : '';
                    $file_datas[$i]['country_code'] = $phone_code = (!empty($fInfo)) ? $fInfo['phonecode'] : '';
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
                    $new[] = $file_datas[$i];
                   
                }
                    $projects_info = array('project_name' => $project_name, 'project_type' => $project_type, 'task_type' => $task_type, 'project_breif' => $project_breif, 'created_by' => $created_by, 'created_at' => date('Y-m-d H:i:s'), 'file_path' => $filepath, 'file_name' => $filename);
                    $addProjectInfo  = $this->model->insertData('bdcrm_master_projects', $projects_info);
                    if(!empty($_POST['feild_access']))
                    {
                        $field_accesses=$_POST['feild_access'];
                    }else{
                        $field_accesses= 1;
                    }
                    if ($field_accesses != 1) {
                        foreach ($field_accesses as $field_access => $filed_access_key) {
                            $projects_info = array(
                                'field_id' => $filed_access_key,
                                'project_id' => $addProjectInfo,
                                'created_on' => date('Y-m-d H:i:s'),

                            );
                            $addProjectinputfields = $this->model->insertData('bdcrm_master_projects_fields', $projects_info);
                        }
                            if($addProjectinputfields){
                                foreach ($new as $key => $val) {
                                    $val['project_id'] = $addProjectInfo;
                                    $this->model->insertData('bdcrm_uploaded_feildss', $val);
                                }
                                $this->session->set_flashdata("success", "Records Uploaded Successfully.");  
                                redirect(base_url("projects/project_list"), $data);
                            }
                        
                    } else {
                        $errors[0]['error'] = "Didn't Set Feilds Access for the Uploaded Project, Please Reupload & Set the feilds Access.";
                        $errors[0]['class']="Danger";
                        $data['error'] = $errors;
                        $this->session->set_flashdata("error", $data);
                       
                    }
                }
            }
            redirect(base_url("projects/new_projects"), $data);
        } else {
            $data = array(
                'error' => validation_errors()
            );
            $this->session->set_flashdata("error", $data['error']);
            redirect(base_url("projects/new_projects"));
        }
    }

    public function DeleteProjects($project_id){

        $deactivateProjects = $this->model->updateData("bdcrm_master_projects", array('status'=>0), array('id' => $project_id));
        if($deactivateProjects){

            $this->session->set_flashdata("success", "Project Successfully Deleted.");
            redirect(base_url("projects/project_list"));
        }else{
             $this->session->set_flashdata("error", "Something Went Wrong.");
             redirect(base_url("projects/project_list"));
        }
    }
   
    public function getCountryInfoByName($country){
            $country_name = strtolower($country);
            $sql = "SELECT id,phonecode FROM `bdcrm_countries` WHERE lower(name) = '$country_name' AND status='1'"; 
            $query = $this->db->query($sql);
            return $row = $query->row_array();
    }

    public function getSuffixInfoByName($suffix){
            $suffix = strtolower($suffix);
            $sql = "SELECT id FROM `bdcrm_name_prefix` WHERE lower(prefix) = '$suffix' AND status='1'"; 
            $query = $this->db->query($sql);
            $row = $query->row_array();
            return $row;
    }


    //mansi

    public function gettasktype()
    {
        $tasktypeid = $this->input->post('tasktypeid');
        $tasktypefields = $this->Projects_model->get_task_fields($tasktypeid);
        echo json_encode($tasktypefields);
    }

    public function exceldownload()
    {
        error_reporting(0);

        $fileName = "BDCRM_SAMPLE_FILE" . time() . 'bdcrm.xls';
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();

        $styleArray = array(
            'font'  => array(
                'color' => array('rgb' => '7820ab'),
                'size' => '9',
                'name'  => 'Verdana'
            )
        );
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Salutation');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'First Name');
        $objPHPExcel->getActiveSheet()->getStyle("B1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Last Name');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Provided Job Title');
        $objPHPExcel->getActiveSheet()->getStyle("D1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Job Title');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Linkedin Connection');
        $objPHPExcel->getActiveSheet()->getStyle("F1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Staff Url');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Received Company Name');
        $objPHPExcel->getActiveSheet()->getStyle("H1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Company Name');
        $objPHPExcel->getActiveSheet()->getStyle("I1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Address1');
        $objPHPExcel->getActiveSheet()->getStyle("J1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Address2');
        $objPHPExcel->getActiveSheet()->getStyle("K1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Address3');
        $objPHPExcel->getActiveSheet()->getStyle("L1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'City');
        $objPHPExcel->getActiveSheet()->getStyle("M1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'State');
        $objPHPExcel->getActiveSheet()->getStyle("N1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Postalcode');
        $objPHPExcel->getActiveSheet()->getStyle("O1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Provided Country');
        $objPHPExcel->getActiveSheet()->getStyle("P1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Country');
        $objPHPExcel->getActiveSheet()->getStyle("Q1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Region');
        $objPHPExcel->getActiveSheet()->getStyle("R1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Provided Email');
        $objPHPExcel->getActiveSheet()->getStyle("S1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Email');
        $objPHPExcel->getActiveSheet()->getStyle("T1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Assumed Email');
        $objPHPExcel->getActiveSheet()->getStyle("U1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Email Harvesting');
        $objPHPExcel->getActiveSheet()->getStyle("V1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Provided Direct Tel');
        $objPHPExcel->getActiveSheet()->getStyle("W1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Direct Tel');
        $objPHPExcel->getActiveSheet()->getStyle("X1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Provided Company Tel');
        $objPHPExcel->getActiveSheet()->getStyle("Y1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'Company Tel');
        $objPHPExcel->getActiveSheet()->getStyle("Z1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Alternate Company Tel');
        $objPHPExcel->getActiveSheet()->getStyle("AA1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'Extension');
        $objPHPExcel->getActiveSheet()->getStyle("AB1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'Mobile');
        $objPHPExcel->getActiveSheet()->getStyle("AC1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'Website');
        $objPHPExcel->getActiveSheet()->getStyle("AD1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'Address');
        $objPHPExcel->getActiveSheet()->getStyle("AE1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AF1', 'Remarks');
        $objPHPExcel->getActiveSheet()->getStyle("AF1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AG1', 'Industry');
        $objPHPExcel->getActiveSheet()->getStyle("AG1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AH1', 'General Notes');
        $objPHPExcel->getActiveSheet()->getStyle("AH1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AI1', 'CA1');
        $objPHPExcel->getActiveSheet()->getStyle("AI1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AJ1', 'CA2');
        $objPHPExcel->getActiveSheet()->getStyle("AJ1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AK1', 'CA3');
        $objPHPExcel->getActiveSheet()->getStyle("AK1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AL1', 'CA4');
        $objPHPExcel->getActiveSheet()->getStyle("AL1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AM1', 'CA5');
        $objPHPExcel->getActiveSheet()->getStyle("AM1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AN1', 'SA1');
        $objPHPExcel->getActiveSheet()->getStyle("AN1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AO1', 'SA2');
        $objPHPExcel->getActiveSheet()->getStyle("AO1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AP1', 'SA3');
        $objPHPExcel->getActiveSheet()->getStyle("AP1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AQ1', 'SA4');
        $objPHPExcel->getActiveSheet()->getStyle("AQ1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AR1', 'SA5');
        $objPHPExcel->getActiveSheet()->getStyle("AR1")->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->SetCellValue('AS1', 'Product Id');
        $objPHPExcel->getActiveSheet()->getStyle("AS1")->applyFromArray($styleArray);
        $filename = FCPATH . "uploads/projects/" . $fileName;
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save(trim($filename));

        $data = "uploads/projects/" . $fileName;
        echo json_encode($data);
    }



    public function my_projects($pid,$rid,$cmp_name='')
    {
        $project_id=base64_decode($pid);
        $project_id=base64_decode($pid);
        $rowid=base64_decode($rid);
        $cmp_name=base64_decode($cmp_name);
        $data['minmax'] =  $this->Projects_model->getPreLastInfo($project_id,$rowid,$cmp_name);
        $data['webDispo'] = $this->model->getData('bdcrm_web_disposition', array('status' => '1'));
        $data['compDispo'] = $this->model->getData('bdcrm_company_disposition', array('status' => '1'));
        $data['VoiceDispo'] = $this->model->getData('bdcrm_caller_disposition', array('status' => '1'));
        $data['StaffWebDispo'] = $this->model->getData('bdcrm_staff_web_disposition', array('status' => '1'));
        $data['StaffVoiceDispo'] = $this->model->getData('bdcrm_staff_voice_dispositions', array('status' => '1'));
        $data['country'] = $this->model->getData('bdcrm_countries', array('status' => '1'));
        $data['currency'] = $this->model->getData('bdcrm_currency', array('status' => '1'));
        $data['webDispos'] = $this->model->getData('bdcrm_staff_web_disposition', array('status' => '1'));
        $data['VoiceDispos'] = $this->model->getData('bdcrm_staff_voice_dispositions', array('status' => '1'));
        $data['name_prefix'] = $this->model->getData('bdcrm_name_prefix', array('status' => '1'));
        $data['project_info']=$this->Projects_model->get_project_input_fields($project_id);
        $data['allInfo'] =  $this->Projects_model->getProjectInfoByStaffId($project_id,$rowid);
        $data['staff_list']=$this->Projects_model->getStaffInfoDetails($project_id,$data['allInfo'][0]['received_company_name']);
        $data['company_list']=$this->Projects_model->getCompanyInfoDetails($project_id);
        $data['allstaffinfo'] = $this->Projects_model->getAllStaffInfoDetails($project_id,$rowid);
        $data['minmax']['current'] = $this->getIndexInfo($data['allstaffinfo'],$rowid)['current'];
        $data['minmax']['prev'] = $this->getIndexInfo($data['allstaffinfo'],$rowid)['prev'];
        $data['minmax']['next'] = $this->getIndexInfo($data['allstaffinfo'],$rowid)['next'];
        $data['userinfo']=$this->session->userdata('designation_id');
        // echo "<pre>";
        // print_r($data['staff_list']);die();
       
        $this->load->view("projects/add_info", $data);
    }
    public function getIndexInfo($staff,$rowid){
        foreach($staff as $k =>$val){
            if($val['id']==$rowid){
                $key = $k+1;
            }
        }
        $next = (!empty($staff[$key]['id'])) ? $staff[$key]['id'] : $rowid ;
        $final = $key-2;
        $prev  = (!empty($staff[$final]['id'])) ? $staff[$final]['id'] : $rowid ;
        $data = array('current'=>$key,'prev'=>$prev,'next'=>$next);
       
        return $data;
    }

    public function ProjectInfo($id){
         $id=base64_decode($id);
         $data['ProjectInfo'] = $this->Projects_model->getProjectInfo($id);
         $data['main_content'] = "projects/project_info";   
         $this->load->view("includes/template", $data);
    }

    public function getcountrycode()
    {
        $country = $this->input->post('country');
        $check_country = $this->model->selectWhereData('bdcrm_countries', array('id' => $country), array('phonecode'));
        echo json_encode($check_country);
    }

    public function update_company_details()
    {
        //print_r($_POST);die();
        $project_id=$this->input->post('project_id');
        $staff_id=$this->input->post('staff_id');
        $company_name=$this->input->post('company_name');
        $address_1=$this->input->post('address_1');
        $address_2=$this->input->post('address_2');
        $address_3=$this->input->post('address_3');
        $city_name=$this->input->post('city_name');
        $postal_code=$this->input->post('postal_code');
        $state_name=$this->input->post('state_name');
        $country=$this->input->post('country');
        $region_name=$this->input->post('region_name');
        $address_source_url=$this->input->post('address_source_url');
        $ca1=$this->input->post('ca1');
        $ca2=$this->input->post('ca2');
        $ca3=$this->input->post('ca3');
        $ca4=$this->input->post('ca4');
        $ca5=$this->input->post('ca5');
        $company_disposition=$this->input->post('company_disposition');
        $company_web_dispositon=$this->input->post('company_web_dispositon');
        $company_voice_disposition=$this->input->post('company_voice_disposition');
        $company_genaral_notes=$this->input->post('company_genaral_notes');
        $company_remark=$this->input->post('company_remark');
        $country_code=$this->input->post('country_code');
        $tel_number=$this->input->post('tel_number');
        $alternate_number=$this->input->post('alternate_number');
        $industry=$this->input->post('industry');
        $revenue=$this->input->post('revenue');
        $check_country = $this->model->selectWhereData('bdcrm_countries', array('id' => $country), array('name'));
        $company_details=array(
            'company_name'=>$company_name,
            'address1'=>$address_1,
            'address2'=>$address_2,
            'address3'=>$address_3,
            'city'=>$city_name,
            'postal_code'=>$postal_code,
            'state_county'=>$state_name,
            'country'=>$check_country['name'],
            'country_code'=>$country_code,
            'region'=>$region_name,
            'address_souce_url'=>$address_source_url,
            'ca1'=>$ca1,
            'ca2'=>$ca2,
            'ca3'=>$ca3,
            'ca4'=>$ca4,
            'ca5'=>$ca5,
            'company_disposition'=>$company_disposition,
            'web_disposition'=>$company_web_dispositon,
            'voice_disposition'=>$company_voice_disposition,
            'genral_notes'=>$company_genaral_notes,
            'remarks'=>$company_remark,
            'tel_number'=>$tel_number,
            'alternate_number'=>$alternate_number,
            'industry'=>$industry,
            'revenue'=>$revenue,
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_by'=>$this->session->userdata('designation_id'),
            'updated_status'=>'Updated',
         
        );
        // echo "<pre>";
        // print_r($company_details);
        if( $this->model->updateData('bdcrm_uploaded_feildss',$company_details,array('project_id'=>$project_id,'id'=>$staff_id)))
        {
            $response['status']='success';
            $response['error']=array('msg' => "Company Details Updated Successfully !");
        }
        else{
            $response['status']='failure';
            $response['error']=array('msg' => "Company Details Updated  UnSuccessfully !"); 

        }
        
     echo json_encode($response);
    }

    public function get_staff_info(){
         $data['id']=base64_decode($_GET['id']);
         $data['received_company_name'] = base64_decode($_GET['received_company_name']);
         $data['users'] = $this->model->getData('users', array('status' => '1'));
         $data['main_content'] = "projects/staff_info";

          // echo '<pre>'; print_r($data['ProjectInfo']); exit;
         $this->load->view("includes/template",$data);
    }

    public function getprojectrecord()
    {
        $data[] = json_encode($_POST);  
        $staffid = $_POST['staffid'];
        $received_company_name = $_POST['received_company_name'];
        if(!empty($_POST['count']))
        {
            $counter=$_POST['count'];
        }else{
            $counter = $_POST['length'];
        }
        $workstatus = '';
        if(!empty($_POST['workalloc']))
        {
           if($_POST['workalloc'] == 'Assigned')
           {
                $workstatus=1;
           }else{
                $workstatus =2;
           }
        }
        $rowno = $_POST['start'];
        $search_text = $_POST['search']['value'];   
        $totalData=$this->Projects_model->get_staff_info($staffid,$received_company_name,$rowno,$counter,$workstatus);
        $count_filtered=$this->Projects_model->get_no_staff_info($staffid,$received_company_name,$rowno,$counter,$workstatus);
        $count_all = $this->Projects_model->get_all_staff_info($staffid,$received_company_name,$rowno,$counter,$workstatus);
        $data_array=array();
        foreach($totalData as $category_details_key => $data_row)
        {

           $input_type = "<input type='hidden' name='staff_info[]' value="."'".$data_row['id']."'>";

           $staff_count = '<span><a class="badge btn btn-primary btn-sm" href="'.base_url().'Projects/my_projects/'.base64_encode($data_row['project_id']).'/'.base64_encode($data_row['id']).'/'.base64_encode($data_row['received_company_name']).'">'.$data_row['salutation'].'. '. $data_row['first_name'].' '.$data_row['last_name'].'</a></span>&nbsp;&nbsp;';
            $nestedData=array();
                $nestedData[] = ++$category_details_key;
                $nestedData[] = $input_type.$data_row['project_name'];
                $nestedData[] = $staff_count;
                $nestedData[] = $data_row['received_company_name'];
                $nestedData[] = $data_row['provided_job_title'];
                $nestedData[] = $data_row['address1'];
                $nestedData[] = $data_row['city'];
                $nestedData[] = $data_row['postal_code'];
                $nestedData[] = $data_row['country_name'];
                $nestedData[] = $data_row['username'];
                $nestedData[] = $data_row['designation_name'];
                $nestedData[] = date(('d-m-Y h:i A'),strtotime($data_row['created_date']));
                $nestedData[] = $data_row['staff_id'];
                $data_array[] = $nestedData;
              
       }
      $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => intval($count_all),
            "recordsFiltered" => intval($count_filtered),
            "data" => $data_array,
        );

        echo json_encode($output);
    }

    public function getsInfo(){
        
        $project_id = $this->input->post('project_id');
        $staff_info = $this->input->post('staff_info');
        $assignee_users = $this->input->post('users');
        $perUser = count($assignee_users);
        $Assignee_info = array_chunk($staff_info, ceil(count($staff_info) / $perUser));

        //    echo "<pre>";
        // print_r($assignee_users);


        for($i=0;$i<$perUser;$i++){

           $user_id = $assignee_users[$i];
           $final[] = array('user_id'=>$user_id,'staff_info'=>$Assignee_info[$i]);
          
        }

         
    







    }

}
