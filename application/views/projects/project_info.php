<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
   #code{width:100%;height:200px}
   .grey-bg {  
   background-color: #F5F7FA;
   }
   .select2-selection--multiple .select2-selection__choice {
   background-color:black !important;
   border-radius: 12px !important;
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
         <div class="grey-bg container-fluid" style="font-size: 100%">
            <section id="minimal-statistics">
               <div class="row">
                  <input type="hidden" id="id" name="id" value="<?=$id?>">
                  <div class="col-md-4">
                     <label>Slot Allocation Count</label>
                     <input type="text" name="slot_allocation" id="slot_allocation" class="form-control">
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <div class="page-title-box">
                           <label>Select Status</label>
                           <select  class="form-control" id="workalloc" name="workalloc">
                              <option value="">Select Work Type</option>
                              <option value="Assigned">Assigned</option>
                              <option value="Unassigned">Unassigned</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>User List</label>
                        <select class="form-control" id="user_list" name="user_list[]" multiple>
                           <option value=""></option>
                           <?php foreach ($user_list as $user_list_key => $user_list_row) { ?>
                           <option value="<?=$user_list_row['id']?>"><?=$user_list_row['first_name']." ".$user_list_row['last_name']?></option>
                           <?php }?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Total Staff Count</label>
                        <div>
                           <span id="total_staff_count"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="float-right">
                  <button class="btn btn-primary" id="btn-search-by-date">Submit </button>
               </div>
               <br><br><br>
               <div style="overflow-y: auto;">
                  <table id="company_staff_count_datatable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Staff Count</th>
                           <th>Company Received</th>
                           <th>Created At</th>
                           <th>Assigned Name</th>
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
