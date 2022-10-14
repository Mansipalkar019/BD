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

    public function my_projects()
    {
        $data['webDispo'] = $this->model->getData('bdcrm_web_disposition', array('status' => '1'));
        $data['compDispo'] = $this->model->getData('bdcrm_company_disposition', array('status' => '1'));
        $data['VoiceDispo'] = $this->model->getData('bdcrm_caller_disposition', array('status' => '1'));
        $data['country'] = $this->model->getData('bdcrm_countries', array('status' => '1'));
        $data['currency'] = $this->model->getData('bdcrm_currency', array('status' => '1'));
        $this->load->view("main/add_info", $data);
    }

    public function project_list()
    {
        $main_content = "projects/project_list";
        $projectlist = $this->model->getData('bdcrm_master_projects', array('status' => '1'));
        foreach ($projectlist as $data_key => $data_row) {
            $projectlist[$data_key]['countryname'] = $this->model->selectWhereData('bdcrm_countries', array('id' => $data_row['country']), array('name'));
            $projectlist[$data_key]['project_type'] = $this->model->selectWhereData('bdcrm_project_types', array('id' => $data_row['project_type']), array('project_type'));
            $projectlist[$data_key]['task_type'] = $this->model->selectWhereData('bdcrm_project_type', array('id' => $data_row['task_type']), array('project_type'));
        }
        $data = array(
            'projectlist' => $projectlist,
            'main_content' => $main_content
        );
        // echo "<pre>";
        // print_r($data);die();
        $this->load->view("includes/template", $data);
    }

    public function getprojectrecord()
    {

        $data[] = json_encode($_POST);

        $rowno = $_POST['start'];
        $rowperpage = $_POST['length'];
        $search_text = $_POST['search']['value'];
        $totalData = $this->Projects_model->getprojectrecord($rowno, $rowperpage, $search_text);
        $count_filtered = $this->Projects_model->get_projectrecord_count_filtered($rowno, $rowperpage, $search_text);
        $count_all = $this->Projects_model->get_projectrecord_count_all($rowno, $rowperpage, $search_text);
        $data_array = array();

        foreach ($totalData as $category_details_key => $data_row) {
            $download_excel = '<span><a class="btn btn-danger" href="' . base_url() . $data_row['file_path'] . '">' . $data_row['file_name'] . '</a></span>&nbsp;&nbsp;';

            $nestedData = array();
            $nestedData[] = ++$category_details_key;
            $nestedData[] = $data_row['noofcompanyname'];
            $nestedData[] = $data_row['noofstaff'];
            $nestedData[] = $data_row['project_name'];
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = $data_row['project_type'];
            $nestedData[] = $data_row['task_type'];
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = $data_row['project_breif'];
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = $download_excel;
            $nestedData[] = $data_row['username'];
            $nestedData[] = '';
            $nestedData[] = '';
            $nestedData[] = $data_row['created_at'];

            $data_array[] = $nestedData;
        }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => intval($count_all),
            "recordsFiltered" => intval($count_filtered),
            "data" => $data_array,
        );

        // Output to JSON format
        echo json_encode($output);
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


    public function upload_project()
    {

        $this->form_validation->set_rules("project_name", "Project Name", "trim|min_length[5]|max_length[100]|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("project_type", "Project Type", "trim|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("task_type", "Task Type", "trim|xss_clean", array("required" => "%s is required"));
        $this->form_validation->set_rules("project_breif", "Project Breif", "trim|min_length[2]|max_length[100]|xss_clean", array("required" => "%s is required"));
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
                //$country=$this->security->xss_clean($this->input->post("country"));
                $created_by = $this->session->userdata('id');
                $valid = 1;
                $error = [];
                for ($i = 1; $i < count($file_data); $i++) {

                    $lower = strtolower($file_data[$i][16]);
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
                for ($i = 1; $i < count($file_data); $i++) {
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
                   
                   $new[] = $file_datas[$i];
                   

                }
                if ($valid > 0) {

                    $projects_info = array('project_name' => $project_name, 'project_type' => $project_type, 'task_type' => $task_type, 'project_breif' => $project_breif, 'created_by' => $created_by, 'created_at' => date('Y-m-d H:i:s'), 'file_path' => $filepath, 'file_name' => $filename);
                    $addProjectInfo  = $this->model->insertData('bdcrm_master_projects', $projects_info);

                   
                    if (!empty($_POST['feild_access'])) {
                        foreach ($_POST['feild_access'] as $field_access => $filed_access_key) {
                            $projects_info = array(
                                'field_id' => $filed_access_key,
                                'project_id' => $addProjectInfo,
                                'created_on' => date('Y-m-d H:i:s'),

                            );
                            $addProjectinputfields = $this->model->insertData('bdcrm_master_projects_fields', $projects_info);
                        }
                        foreach ($new as $key => $val) {
                             $val['project_id'] = $addProjectInfo;
                            $this->model->insertData('bdcrm_uploaded_feildss', $val);
                        }
                    } else {
                        $this->session->set_flashdata("error", "Didn't Set Feilds Access for the Uploaded Project, Please Reupload & Set the feilds Access.");
                        redirect(base_url("projects/new_projects"), $data);
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

    public function upload_projectss()
    {
        if (!empty($_FILES['uploaded_file']['name'])) {

            $config['upload_path'] = './uploads/projects/';
            $config['allowed_types'] = 'csv';
            $config['file_ext_tolower'] = TRUE;
            $config['max_size'] = '10000';
            $config['max_filename_increment'] = 11111;
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploaded_file')) {
                echo "Wrong";
                return;
            } else {

                $uploadedData = $this->upload->data();
                $file_name = base_url() . "uploads/projects/" . $uploadedData['file_name'];
                $opts = array('http' => array('follow_location' => false));


                if (($handle = fopen($file_name, "r", false, stream_context_create($opts))) !== false) {
                    $file_data = fgetcsv($handle, 1000, ',');

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
        $tasktypeid = $this->input->post('tasktypeid');
        $tasktypefields = $this->Projects_model->get_task_fields($tasktypeid);

        // echo "<pre>";
        // print_r($tasktypefields); die; 
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
}
