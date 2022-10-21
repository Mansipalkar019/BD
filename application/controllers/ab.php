<div class="row row1">
            <div class="col">
               <!-- check input access for first_name,last_name -->
               <?php 
                  $div_count=div_access($project_info,array('first_name','last_name'));
                  $access12 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access12; ?>>
                   <?php if(in_array('suffix',$project_info)){ ?>
                  <div class="col">
                     <label for="title" class="col-form-label">Title:</label>
                         <select class='form-control form-control-sm' id="title"  name='title'>
                            <option value=''>select a title</option>
                            <?php 


                            foreach ($name_prefix as $key => $val) { ?>
                            <option value='<?= $val['id']; ?>'
                              <?php if($allInfo[0]['suffix'] == $val['id']){ echo "selected"; } ?>><?= $val['prefix']; ?></option>
                            <?php }
                            ?>
                         </select>
                     </div>
                    <?php } ?> 

                  <?php if(in_array('first_name',$project_info)){ ?>
                  <div class="col">
                     <label for="first_name" class="col-form-label">First Name:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['first_name'])) ?  $allInfo[0]['first_name'] : ''  ?>" title="" id="first_name"  name='first_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('last_name',$project_info)){ ?>
                  <div class="col">
                     <label for="last_name" class="col-form-label">Last Name:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['last_name'])) ?  $allInfo[0]['last_name'] : ''  ?>"  id="last_name"  name='last_name' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for job_title -->
               <?php 
                  $div_count=div_access($project_info,array('job_title'));
                  $access13 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center"  <?= $access13; ?>>
                  <?php if(in_array('job_title',$project_info)){ ?>
                  <div class="col">
                     <label for="job_title" class="col-form-label">Job Title:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['provided_job_title'])) ?  $allInfo[0]['provided_job_title'] : ''  ?>" title="" id="job_title"  name='job_title' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_job_function -->
               <?php 
                  $div_count=div_access($project_info,array('staff_job_function'));
                  $access14 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access14; ?>>
                  <?php if(in_array('staff_job_function',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_job_function" class="col-form-label">Job Function:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_job_function'])) ?  $allInfo[0]['staff_job_function'] : ''  ?>" title="" id="staff_job_function"  name='staff_job_function' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_job_function -->
               <?php 
                  $div_count=div_access($project_info,array('staff_email'));
                  $access15 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access15; ?>>
                  <?php if(in_array('staff_email',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_email" class="col-form-label">Staff Email:</label>
                  </div>
                  <div class="col">
                     <div class="input-group">
                        <input type="email" value="<?=  (!empty($allInfo[0]['staff_email'])) ?  $allInfo[0]['staff_email'] : ''  ?>" title="" id="staff_email"  name='staff_email' class="form-control form-control-sm">
                        <div class="input-group-text">
                           <input class="form-check-input mt-0" type="checkbox" value="" id="staff_email_verified" >
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_department -->
               <?php 
                  $div_count=div_access($project_info,array('staff_department'));
                  $access16 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access16; ?>>
                  <?php if(in_array('staff_department',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_department" class="col-form-label">Staff Department:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_department'])) ?  $allInfo[0]['staff_department'] : ''  ?>" title="" id="staff_department"  name='staff_department' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_department -->
               <?php 
                  $div_count=div_access($project_info,array('staff_url'));
                  $access17 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access17; ?>>
                  <?php if(in_array('staff_url',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_url" class="col-form-label">Staff Source URL:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_url'])) ?  $allInfo[0]['staff_url'] : ''  ?>" title="" id="staff_url"  name='staff_url' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_department -->
               <?php 
                  $div_count=div_access($project_info,array('assumed_email'));
                  $access18 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access18; ?>>
                  <?php if(in_array('assumed_email',$project_info)){ ?>
                  <div class="col">
                     <label for="assumed_email" class="col-form-label">Assumed Email:</label>
                  </div>
                  <div class="col">
                     <input type="email" value="<?=  (!empty($allInfo[0]['assumed_email'])) ?  $allInfo[0]['assumed_email'] : ''  ?>" title="" id="assumed_email"  name='assumed_email' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_email_harvesting -->
               <?php 
                  $div_count=div_access($project_info,array('staff_email_harvesting'));
                  $access19 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access19; ?>>
                  <?php if(in_array('staff_email_harvesting',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_email_harvesting" class="col-form-label">Email Source URL:</label>
                  </div>
                  <div class="col">
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_email_harvesting'])) ?  $allInfo[0]['staff_email_harvesting'] : ''  ?>" title="Clearbit" id="staff_email_harvesting"  name='staff_email_harvesting' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_direct_tel,staff_mobile -->
               <?php 
                  $div_count=div_access($project_info,array('staff_direct_tel','staff_mobile'));
                  $access20 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access20; ?>>
                  <?php if(in_array('staff_direct_tel',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_direct_tel" class="col-form-label">Direct Tel:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_direct_tel'])) ?  $allInfo[0]['staff_direct_tel'] : ''  ?>" title="" id="staff_direct_tel"  name='staff_direct_tel' class="form-control form-control-sm">
                  </div>
                  <!-- <div class="col">
                     <label for="staff_extension" class="col-form-label">Extension:</label>
                     <input type="text" value="" title="" id="staff_extension"  name='staff_extension' class="form-control form-control-sm">
                     </div> -->
                  <div class="col">
                     <label for="staff_mobile" class="col-form-label">Mobile:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['staff_mobile'])) ?  $allInfo[0]['staff_mobile'] : ''  ?>" title="" id="staff_mobile"  name='staff_mobile' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for ca1,ca2,ca3,ca4,ca5 -->
               <?php 
                  $div_count=div_access($project_info,array('ca1','ca2','ca3','ca4','ca5'));
                  $access2 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access2; ?>>
                  <?php if(in_array('sa1',$project_info)){ ?>
                  <div class="col">
                     <label for="sa1" class="col-form-label">SA1:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['sa1'])) ?  $allInfo[0]['sa1'] : ''  ?>" title="" id="sa1"  name='sa1' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('sa2',$project_info)){ ?>
                  <div class="col">
                     <label for="sa2" class="col-form-label">SA2:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['sa2'])) ?  $allInfo[0]['sa2'] : ''  ?>" title="" id="sa2"  name='sa2' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('sa3',$project_info)){ ?>
                  <div class="col">
                     <label for="sa3" class="col-form-label">SA3:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['sa3'])) ?  $allInfo[0]['sa3'] : ''  ?>" title="" id="sa3"  name='sa3' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('sa4',$project_info)){ ?>
                  <div class="col">
                     <label for="sa4" class="col-form-label">SA4:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['sa4'])) ?  $allInfo[0]['sa4'] : ''  ?>" title="" id="sa4"  name='sa4' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
                  <?php if(in_array('sa5',$project_info)){ ?>
                  <div class="col">
                     <label for="sa5" class="col-form-label">SA5:</label>
                     <input type="text" value="<?=  (!empty($allInfo[0]['sa5'])) ?  $allInfo[0]['sa5'] : ''  ?>" title="" id="sa5"  name='sa5' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <br><br><br>
            </div>
            <div class="col">
               <div class="alert alert-warning text-center p-1">
                  Staff Details
                  / <a class="text-underline" data-bs-toggle="modal" data-bs-target="#providedJobTitle" id="provided_job_title" href="#">P. JT</a>            
                  <div class="modal fade" id="providedJobTitle" tabindex="-1" aria-labelledby="providedJobTitleLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="providedJobTitleLabel">Provided Job Title</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body text-center">
                              <h5><span class="badge bg-danger"><?=  (!empty($allInfo[0]['provided_job_title'])) ?  $allInfo[0]['provided_job_title'] : ''  ?></span></h5>
                           </div>
                           <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- check input access for web_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('web_staff_disposition'));
                  $access21 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access21; ?>>
                  <?php if(in_array('web_staff_disposition',$project_info)){ ?>
                  <div class="col">
                     <label for="web_staff_disposition" class="col-form-label">Web Staff Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="web_staff_disposition"  name='web_staff_disposition'>
                        <option value=''>select Web Disposition</option>
                        <?php 
                        foreach ($webDispos as $key => $val) { ?>
                        <option value='<?= $val['dispositions']; ?>' <?php if($allInfo[0]['web_staff_disposition']==$val['dispositions']){?>selected<?php } ?>><?= $val['dispositions']; ?></option>
                        <?php }
                           ?>
                        <option value='Duplicate'>Duplicate</option>
                     </select>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for voice_staff_disposition -->
               <?php
                if($this->session->userdata('designation_id') == 3 ){ 
                  $div_count=div_access($project_info,array('voice_staff_disposition'));
                  $access22 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access22; ?>>
                  <?php if(in_array('voice_staff_disposition',$project_info)){ ?>
                  <div class="col">
                     <label for="voice_staff_disposition" class="col-form-label">Voice Staff Disposition:</label>
                  </div>
                  <div class="col">
                     <select class='form-control form-control-sm' id="voice_staff_disposition"  name='voice_staff_disposition'>
                        <option value=''>select Voice Staff Disposition</option>
                        <?php 
                        foreach ($VoiceDispos as $key => $val) { ?>
                        <option value='<?= $val['voice_dispositions']; ?>' <?php if($allInfo[0]['voice_staff_disposition']==$val['voice_dispositions']){?>selected<?php } ?>><?= $val['voice_dispositions']; ?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                
               </div>
               <?php } }?>
               <!-- <div class="row g-3 align-items-center justify-content-md-center">
                  <div class="col">
                      <label for="staff_interest_area" class="col-form-label">Interest Area:</label>
                  </div>
                  <div class="col">
                      <input type="text" value="" title="" id="staff_interest_area"  name='staff_interest_area' class="form-control form-control-sm">
                  </div>
                  </div> -->
               <!-- check input access for voice_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('staff_linkedin_count'));
                  $access23 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access23; ?>>
                  <?php if(in_array('staff_linkedin_count',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_linkedin_count" class="col-form-label">Linkedin Connections Count:</label>
                  </div>
                  <div class="col">
                     <input type="number" value="<?=  (!empty($allInfo[0]['staff_linkedin_con'])) ?  $allInfo[0]['staff_linkedin_con'] : ''  ?>" title="" id="staff_linkedin_count"  name='staff_linkedin_count' class="form-control form-control-sm">
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for voice_staff_disposition -->
               <?php 
                  $div_count=div_access($project_info,array('staff_note'));
                  $access24 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access24; ?>>
                  <?php if(in_array('staff_note',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_note" class="col-form-label">Staff Note:</label>
                  </div>
                  <div class="col mb-1">
                     <textarea title="" id="staff_note"  name='staff_note' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['staff_note'])) ?  $allInfo[0]['staff_note'] : ''  ?></textarea>
                  </div>
                  <?php } ?>
               </div>
               <!-- check input access for staff_remark-->
               <?php 
                  $div_count=div_access($project_info,array('staff_remark'));
                  $access25 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access25; ?>>
                  <?php if(in_array('staff_remark',$project_info)){ ?>
                  <div class="col">
                     <label for="staff_remark" class="col-form-label">Staff Remark:</label>
                  </div>
                  <div class="col">
                     <textarea title="" id="staff_remark"  name='staff_remark' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['staff_remark'])) ?  $allInfo[0]['staff_remark'] : ''  ?></textarea>
                  </div>
                  <?php } ?>
               </div>

                <!-- check input access for Rearcher_remark-->
                <?php 
                  $div_count=div_access($project_info,array('research_remark'));
                  $access25 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  if($userinfo == 3){
                  ?>
               <div class="row g-3 align-items-center justify-content-md-center" <?= $access25; ?>>
                  <?php if(in_array('research_remark',$project_info)){ ?>
                  <div class="col">
                     <label for="research_remark" class="col-form-label">Researcher Remark:</label>
                  </div>
                  <div class="col">
                     <textarea title="" id="research_remark"  name='research_remark' class="form-control form-control-sm" readonly><?=  (!empty($allInfo[0]['research_remark'])) ?  $allInfo[0]['research_remark'] : ''  ?></textarea>
                  </div>
                 
               </div>
               <?php } }else{?>
                  <div class="row g-3 align-items-center justify-content-md-center" <?= $access25; ?>>
                  <?php if(in_array('research_remark',$project_info)){ ?>
                  <div class="col">
                     <label for="research_remark" class="col-form-label">Researcher Remark:</label>
                  </div>
                  <div class="col">
                     <textarea title="" id="research_remark"  name='research_remark' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['research_remark'])) ?  $allInfo[0]['research_remark'] : ''  ?></textarea>
                  </div>
                 
               </div>
               <?php } }?>
               <!-- check input access for Rearcher_remark-->
               <?php 
                  $div_count=div_access($project_info,array('voice_remark'));
                  $access25 = ($div_count < 1) ? "style='display:none;'" :  '' ; 
                  if($userinfo == 3 || $userinfo == 8)
                  {?>
                  <div class="row g-3 align-items-center justify-content-md-center" <?= $access25; ?>>
                  <?php if(in_array('voice_remark',$project_info)){ ?>
                  <div class="col">
                     <label for="voice_remark" class="col-form-label">Voice Remark:</label>
                  </div>
                  <div class="col">
                     <textarea title="" id="voice_remark"  name='voice_remark' class="form-control form-control-sm"><?=  (!empty($allInfo[0]['voice_remark'])) ?  $allInfo[0]['voice_remark'] : ''  ?></textarea>
                  </div>
                  <?php } ?>
               </div>
                  <?php }?>
               
               <br><br><br>
            </div>
            
            <div class="col">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item" role="presentation">
                     <button style='font-size:12px' class="nav-link active" id="company-tab1" data-bs-toggle="tab" data-bs-target="#company1" type="button" role="tab" aria-controls="company1" aria-selected="true"><?php if(!empty($staff_list)){ echo 'All ('.count($staff_list).')'; }else{ 'All (0)'; } ?></button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button style='font-size:12px' class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-controls="company" aria-selected="true"><?=  (!empty($allInfo[0]['received_company_name'])) ?  $allInfo[0]['received_company_name'] : ''  ?><?=  (!empty($staff_list)) ?  ' ('.count($staff_list).')' : '(0)' ?></button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button style='font-size:12px' class="nav-link" id="project-tab" data-bs-toggle="tab" data-bs-target="#project" type="button" role="tab" aria-controls="project" aria-selected="false"><?=  (!empty($allInfo[0]['project_name'])) ?  $allInfo[0]['project_name'] : ''  ?> <?=  (!empty($allInfo[0]['company_count'])) ?  '('.$allInfo[0]['company_count'].')' : '(0)' ?></button>
                  </li>
               </ul>
               <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="company1" role="tabpanel" aria-labelledby="company-tab1">
                     <div class='table-responsive' style='height:333px;font-size:12px'>
                        <table class="table table-hover table-bordered table-sm p-0 m-0" width="100%" cellspacing="0" id="company_table">
                           <tr>
                              <th>#</th>
                              <th>Staff Name</th>
                              <th>Company Name<span class="badge badge-pill badge-dark"></span></th>
                              <th>Status</th>
                              <th>Co. Disposition</th>
                            
                           </tr>
                           <?php 
                           foreach($allstaffinfo as $allstaffinfo_key => $allstaffinfo_val) {?>
                              <tr  <?php if($allstaffinfo_val['first_name'] == $allInfo[0]['first_name']){ ?>style="background: yellow;" <?php } ?>>
                              <td><a href="<?php echo base_url().'Projects/my_projects/'.base64_encode($allstaffinfo_val['project_id']).'/'.base64_encode($allstaffinfo_val['id']).'/'.base64_encode($allstaffinfo_val['comp_name']);?>"><i class="fas fa-eye"></i></a></td>
                              <td><?= $allstaffinfo_val['first_name'].' '.$allstaffinfo_val['last_name']; ?></td>
                              <td><?= $allstaffinfo_val['comp_name']; ?></td>
                              <td><?php  if($allstaffinfo_val['updated_status'] != ''){?><span class="badge bg-success " style="padding: 5px;border-radius: 20px;"><i class="glyphicon glyphicon-ok"><span class="fa fa-check"></span></span><?php } ?></td>
                              <td><?= $allstaffinfo_val['company_dispostion']; ?></td>
                             
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane fade show" id="company" role="tabpanel" aria-labelledby="company-tab">
                     <div class='table-responsive' style='height:333px;font-size:12px'>
                        <table class="table table-hover table-bordered table-sm p-0 m-0" width="100%" cellspacing="0" id="company_table">
                           <tr>
                              <th>#</th>
                              <th>Staff Name</th>
                              <th>Co. Disposition</th>
                              <th>Status</th>   
                           </tr>
                           <?php 
                           foreach($staff_list as $staff_list_key => $staff_list_val) {?>
                              <tr  <?php if($staff_list_val['first_name'] == $allInfo[0]['first_name']){ ?>style="background: yellow;" <?php } ?>>
                              <td><a href="<?php echo base_url().'Projects/my_projects/'.base64_encode($staff_list_val['project_id']).'/'.base64_encode($staff_list_val['id']).'/'.base64_encode($staff_list_val['comp_name']);?>"><i class="fas fa-eye"></i></a></td>
                              <td><?= $staff_list_val['first_name'].' '.$staff_list_val['last_name']; ?></td>
                              <td><?= $staff_list_val['company_dispostion']; ?></td>
                              <td><?php  if($staff_list_val['updated_status'] != ''){?><span class="badge bg-success " style="padding: 5px;border-radius: 20px;"><i class="glyphicon glyphicon-ok"><span class="fa fa-check"></span></span><?php } ?></td>
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                     <div class='table-responsive' style='height:333px;font-size:12px'>
                        <table class="table table-hover table-bordered table-sm p-0 m-0" width="100%" cellspacing="0" id="project_table">
                           <tr>
                              <th>#</th>
                              <th>Company Name</th>
                              <th>No. of Staff</th>
                              <th>Co. Disposition</th>
                           </tr>
                           <?php 
                           foreach($company_list as $company_list_key => $company_list_val) {?>
                           <tr class="" <?php if($company_list_val['received_company_name'] == $allInfo[0]['received_company_name']){ ?>style="background: yellow;" <?php } ?>>
                              <td><a href="<?php echo base_url().'Projects/my_projects/'.base64_encode($company_list_val['project_id']).'/'.base64_encode($company_list_val['id']).'/'.base64_encode($company_list_val['received_company_name']);?>"><i class="fas fa-eye"></i></a></td>
                              <td><?= $company_list_val['received_company_name']; ?></td>
                              <td><?= $company_list_val['staffcount']; ?></td>
                              <td><?= $company_list_val['company_dispostion']; ?></td>
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>