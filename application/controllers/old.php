<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Master  extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model");
    }



    

    public function add_departments()
    {

        $data['main_content'] = "main/add_department";
        $data['getAllDepartments'] = $this->model->getData('master_department', array('status' => '1'));
        $this->load->view("includes/template", $data);
    }

    // Added By Raj Namdev

    public function add_designations(){
        $data['main_content'] = "main/add_designation";
        $data['getAllDesignations'] = $this->model->getData('master_designation', array('status' => '1'));
        $this->load->view("includes/template", $data);
    }

    public function submit_designations(){
        
        $this->form_validation->set_rules("designation_name","Designation Name","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));

        if($this->form_validation->run()==true){
            $designationName = $this->security->xss_clean($this->input->post("designation_name"));
            $data = array(
                "designation_name" => $designationName,
            );
            $addDesig = $this->model->insertData('master_designation',$data);
            if($addDesig){
                $this->session->set_flashdata("success","Designation has been added successfully");
            }
        }
        else{

            $data = array('error' => validation_errors());
            $this->session->set_flashdata("error",$data['error']);
        }
        redirect(base_url("master/add_designations"));

    }


    

    public function submit_projects()
    {
        $this->form_validation->set_rules("project_name","Project Name","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));

        if($this->form_validation->run()==true){
            $project_name = $this->security->xss_clean($this->input->post("project_name"));
            $data = array(
                "project_name" => $project_name,
            );

            $addProjects = $this->model->insertData('master_project',$data);
            if($addProjects){
                $this->session->set_flashdata("success","");

            }
        }
        else
        {
            $data = array(
                'error' => validation_errors()
            );
            $this->session->set_flashdata("error",$data['error']);
        }
         redirect(base_url("master/add_projects"));

    }

    public function submit_departments(){
        
        $this->form_validation->set_rules("department_name","Department Name","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));
        $this->form_validation->set_rules("sort_name","Sort Name","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));

        if($this->form_validation->run()==true){
            $departmentName = $this->security->xss_clean($this->input->post("department_name"));
            $sortName = $this->security->xss_clean($this->input->post("sort_name"));

            $data = array(
                "department_name" => $departmentName,
                "sort_name" => $sortName
            );

            $addDept = $this->Model->add_departments($data);
            if($addDept){
                $this->session->set_flashdata("success","");

            }
        }
        else
        {
            $data = array(
                'error' => validation_errors()
            );
            $this->session->set_flashdata("error",$data['error']);
            redirect(base_url("master/add_departments"));
        }
        
    }
   
    // Added By Raj Namdev

    public function add_projects(){
        $data['main_content'] = "main/add_project";
        $data['getAllProjects'] = $this->model->getData('master_project', array('status' => '1'));
        $this->load->view("includes/template", $data);

    }

    // Added By Raj Namdev

     public function add_users(){
        $data['main_content'] = "main/add_users";
        $data['getAllDesignations'] = $this->model->getData('master_designation', array('status' => '1'));
        $data['getAllUsers'] = $this->getUserWithDesig();
        $this->load->view("includes/template", $data);
    }


    public function getUserWithDesig(){
        $sql = "SELECT u.*,ds.designation_name FROM `users` as u 
                left join master_designation as ds on u.designation = ds.id where u.status=1";
        return $this->model->getSqlData($sql);
    }
    public function submit_users(){

        $this->form_validation->set_rules("firstname","First Name","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));
        $this->form_validation->set_rules("email","Email","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));
        $this->form_validation->set_rules("username","Username","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));
        $this->form_validation->set_rules("lastname","Lastname","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));
         $this->form_validation->set_rules("password","Password","trim|required|min_length[2]|max_length[100]|xss_clean",array("required"=>"%s is required"));

        if($this->form_validation->run()==true){
            $firstname = $this->security->xss_clean($this->input->post("firstname"));
            $lastname = $this->security->xss_clean($this->input->post("lastname"));
            $designation = $this->security->xss_clean($this->input->post("designation"));
            $email = $this->security->xss_clean($this->input->post("email"));
            $username = $this->security->xss_clean($this->input->post("username"));
            $password = sha1($this->security->xss_clean($this->input->post("password")));
            
            $data = array(
                "username" => $username,
                "password" => $password,
                "first_name" =>$firstname,
                "last_name" => $lastname,
                "designation" => $designation
            );
             $addUsers = $this->model->insertData('users',$data);
            if($addUsers){
                $this->session->set_flashdata("success","User has been Added Successfully");

            }
        }
        else
        {
            $data = array(
                'error' => validation_errors()
            );

            $this->session->set_flashdata("error",$data['error']);
        }
        redirect(base_url("master/add_users"));

    }



    // Added By Akash Masal



}
