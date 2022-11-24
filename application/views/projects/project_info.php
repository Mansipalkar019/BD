<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<style>
   #code{width:100%;height:200px}
   .grey-bg {  
   background-color: #F5F7FA;
   }
</style>
<div class="content-page">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box">
                  <center>
                     <h4 class="page-title" style="color: black">Staff Informations of Project : <?= $ProjectInfo[0]['project_name'];?></h4>
                  </center>
               </div>
            </div>
         </div>
         <p><?php echo $this->session->flashdata("error");?></p>
         <p><?php echo $this->session->flashdata("success");?></p>
         <input type="hidden" id="designation_name" name="designation_name" value="<?=$designation_name?>">
         <?php
            if($this->session->userdata('designation_name') == 'Superadmin' || $this->session->userdata('designation_name') == 'Project Manger' || $this->session->userdata('designation_name') == 'Team Leader') { $style=''; }else{ $style="style='display:none'";} ?> 
         <div id="have_access" <?= $style; ?>>
            <div class="row">
               <input type="hidden" id="id" name="id" value="<?=$id?>">
               <div class="col-md-2">
                  <label>Companies Count</label>
                  <input type="text" name="slot_allocation" id="slot_allocation" class="form-control company_allocation" style="width: 200px;">
               </div>
               <div class="col-md-1">
                  <label>Total Staff</label>
                  <input type="text" name="" id="total_staff_count" class="form-control company_allocation" value='0' readonly style="width: 100px;">
               </div>
               <!-- <div class="col-md-2">
                  <div class="form-group">
                     <div class="page-title-box">
                        <label>Select Status</label>
                        <select  class="form-control company_allocation" id="workalloc" name="workalloc" style="width: 200px;">
                           <option value="">Select Work Type</option>
                           <option value="Assigned">Assigned</option>
                           <option value="Unassigned">Unassigned</option>
                           <option value="Pending">Pending</option>
                        </select>
                       
                     </div>
                  </div>
                  </div> -->
               <div class="col-md-2">
                  <div class="form-group">
                     <div class="page-title-box">
                        <label>User List</label>
                        <select class="form-control select2 company_allocation" id="user_list" name="user_list[]" multiple>
                           <option value="">Select Assignee</option>
                           <?php foreach ($user_list as $user_list_key => $user_list_row) { ?>
                           <option value="<?=$user_list_row['id']?>"><?=$user_list_row['first_name']." ".$user_list_row['last_name']?></option>
                           <?php }?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <div>
                        <button class="btn btn-primary btn-sm" id="btn-search-by-date" style='margin-top:10%'>Assign</button>
                        <a class="btn btn-primary btn-sm" id="btn-search-by-date" style='margin-top:10%;color:white;' aria-hidden="true" data-toggle="collapse"
                           data-target="#collapseExample">Advance Search</a>
                        <!-- <div id="advance_search" class="modal fade" role="dialog">
                           <div class="modal-dialog">
                           
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Edit Service</h4>
                                 </div>
                                 <form id="basicForm" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate"
                                    onsubmit="return validate_update_services(this);">
                                    <div class="modal-body">
                                    
                                       <div class="form-group">
                                         
                                             <label>Select Project id</label>
                           
                                             <select  class="form-control project_id" id="project_id" name="project_id" style="width: 200px;">
                                             <option value="">Select Project id</option>
                                             <?php foreach ($id as $id_key => $id_row) { ?>
                                             <option value="<?=$id_row['id']?>"><?=$id_row['id']?></option>
                                             <?php }?>
                                             </select>
                                         
                                       </div>
                                  
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit" class="btn btn-success">Submit</button>
                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                              </div>
                              </form>
                           </div>
                           </div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="collapse" id="collapseExample">
            <div class="container" id="have_access">
               <div class="row">
                  <div class="">
                     <div class="form-group">
                        <div id="inputFormRow">
                           <div class="input-group mb-3">
                              <select  class="form-control project_id" id="project_id" name="project_id" style="width:80px;">
                                    <?php foreach ($projectid as $projectid_key => $projectid_row) { ?>
                                    <option value="<?=$projectid_row['id']?>"><?=$projectid_row['id']?></option>
                                    <?php }?>
                              </select>
                              <select  class="form-control operators" id="operators" name="operators" style="margin-left:15px;width:200px;">
                                 <option value="=">=</option>
                                 <option value="!=">!=</option>
                                 <option value="LIKE">LIKE</option>
                                 <option value="NOT LIKE">NOT LIKE</option>
                              </select>
                              <select  class="form-control received_company_name_key" id="received_company_name_key" name="received_company_name_key" style="margin-left:15px;width:200px;">
                                 <option value="">voice disposition</option>
                                 <?php foreach ($received_company_name as $received_company_name_key => $received_company_name_row) { ?>
                                 <option value="<?=$received_company_name_row['received_company_name']?>"><?=$received_company_name_row['received_company_name']?></option>
                                 <?php }?>
                              </select>
                              <button class="btn btn-success btn-sm" id="addRows1" style="margin-left:15px;height: 30px;"><i class="fa fa-plus"></i></button>
                           </div>
                        </div>
                        <div id="newRow"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="grey-bg container-fluid" style="font-size: 100%">
         <section id="minimal-statistics">
            <br>
            <div style="overflow-y: auto;">
               <table id="company_staff_count_datatable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Staff Count</th>
                        <?php
                           // $designation_name = $this->session->userdata('designation_name');
                           // if($designation_name!='Researcher'){ ?>
                        <th>Completed Staff Count</th>
                        <?php 
                           // }?>
                        <th>Company Received</th>
                        <th>Created At</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </section>
      </div>
   </div>
</div>
</div>