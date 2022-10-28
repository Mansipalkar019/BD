$company_name = $this->input->post('company_name');
        $user_list = $this->input->post('user_list');
        $project_id = $this->input->post('project_id');
        $perUser = count($user_list);
        $company_count = count($company_name);
        $break = round(count($company_name) / $perUser);
        if(!empty($break)){
            $user_list_last_key = array_key_last($user_list);
            $start = 0;
            foreach ($user_list as $user_list_key => $user_list_row) {
                if($user_list_last_key == $user_list_key){
                    if(!empty($company_name)){
                        foreach ($company_name as $company_name_key => $company_name_row) {
                            $company_name_id_info = $this->model->selectWhereData('bdcrm_uploaded_feildss',array('received_company_name' => $company_name_row,'project_id'=>$project_id),array('id','project_id'),false);
                            if(!empty($company_name_id_info[0])){
                                foreach ($company_name_id_info as $company_name_id_info_key => $company_name_id_info_row) {
                                    $insert_companywise_allocation = array(
                                        'project_id'=> $project_id,
                                        'staff_id' =>$company_name_id_info_row['id'],
                                        'user_id'=> $user_list_row,
                                        'assigned_by'=> $this->session->userdata('id'),
                                    );
                                 
                                    $this->model->insertData('companywise_allocation',$insert_companywise_allocation);
                                }
                            }
                        }
                       
                    }
                    break;
                } else {
                    for ($i=$start; $i < $break ; $i++) { 
                        $company_name_id_info = $this->model->selectWhereData('bdcrm_uploaded_feildss',array('received_company_name' => $company_name[$i],'project_id'=>$project_id),array('id','project_id'),false);
                        if(!empty($company_name_id_info[0])){
                            foreach ($company_name_id_info as $company_name_id_info_key => $company_name_id_info_row) {
                                $insert_companywise_allocation = array(
                                    'project_id'=> $project_id,
                                    'staff_id' =>$company_name_id_info_row['id'],
                                    'user_id'=> $user_list_row,
                                    'assigned_by'=> $this->session->userdata('id') ,
                                );
                               
                                $this->model->insertData('companywise_allocation',$insert_companywise_allocation);
                            }
                           
                        }
                        unset($company_name[$i]);
                    }
                    $start = $start+$break;
                    $break = $break+$break;
                }
            }
            $response['message'] = "Company Allocation Inserted Successfully";
            $response['status'] = "success";
        } else {
            $response['message'] = "Userlist Cannot Be Greater Than Companies";
            $response['status'] = "failure";
        }
        echo json_encode($response);