<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    

<style>
    #code{width:100%;height:200px}
.grey-bg {  
background-color: #F5F7FA;
}
</style>
<div class="content-page">
<div class="content"
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
            <center><h4 class="page-title" style="color: black">Staff Informations of Project : <?= $received_company_name;?></h4></center>
            </div>
        </div>
    </div>
 <p><?php echo $this->session->flashdata("error");?></p>
 <p><?php echo $this->session->flashdata("success");?></p>
<div class="grey-bg container-fluid" style="font-size: 100%">
<section id="minimal-statistics">
    <div class="row">
    <div class="col-3">
            <div class="page-title-box">
               <label>Enter count</label>
               <input type="text" value="" class="form-control" id="count">
               <input type="hidden" value="<?= $received_company_name;?>" class="form-control" name="company_name" id="company_name">
               <input type="hidden" value="<?= $id;?>" class="form-control" name="project_id" id="company_name">
            </div>
        </div>
        <div class="col-3">
            <div class="page-title-box">
               <label>Select Status</label>
               <select  class="form-control" id="workalloc" onchange="getworkalloc(this.value)">
               <option value="">Select Work Type</option>
                <option value="Assigned">Assigned</option>
                <option value="Unassigned">Unassigned</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="page-title-box">
               <label>Select Users</label>
               <select  class="form-control users" id="users[]" multiple name="users[]"> 
                <option value="">Select Users</option>
                <?php 
                foreach($users as $user_key => $user_row)
                {?>
                <option value="<?= $user_row['id']; ?>"><?= $user_row['username']; ?></option>
                <?php }
                ?>
                </select>
            </div>
        </div>
        <div class="float-right">
        <button type="submit" value="" class="btn btn-primary form-control" id="btn-search-by-count" style="margin-top:30px;width:125%">Assign</button>
        
        </div> 
    </div>
    
        <br><br><br>
<div style="overflow-y: auto;">
<input type="hidden"  value="<?= $id;?>" id="staff_id">
<input type="hidden"  value="<?= $received_company_name; ?>" id="received_company_name">
    <table id="company_staff_count_datatable" class="table table-striped table-bordered "  cellspacing="0" width="100%">
    <thead>
        <tr>
        <th>ID</th>
            <th>Project</th>
            <th>Staff </th>
            <th>Industry</th>
            <th>Email</th>
            <th>Company</th>
            <th>Company Dispo</th>
            <th>Company Web Dispo</th>
            <th>Website</th>
            <th>Emp Size</th>
            <th>Revenue</th>
            <th>Job Title</th>
            <th>Address</th>
            <th>Country</th>
            <th>Region</th>
            <th>Web Staff Disposition</th>
            <th>Web Voice Disposition</th>
            <th>Ass. To</th>
            <th>Ass. By</th>
            <th>Created At</th>
            <th>Assigned At</th>
        </tr>
        </thead>
        
</table>
</div>
</section>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- <script src="   https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> -->

<script type="text/javascript">
    $(".users").select2({
         placeholder: " Select Users",
         allowClear: true
         });
    var frontend_path = "<?=base_url()?>";
$(document).ready(function (e) {
    var table = $('#company_staff_count_datatable').DataTable({
        'ajax': {
           'url':frontend_path + 'projects/getprojectrecord',
           'type':"POST",
           'data': function(data){
            data.staffid=$('#staff_id').val();
            data.received_company_name=$('#received_company_name').val();
            data.count=$('#count').val();
            data.workalloc=$('#workalloc').find(":selected").val();
           }
        },
   });

   table.on('order.dt search.dt', function () {
      table.column(0, {
         search: 'applied',
         order: 'applied'
      }).nodes().each(function (cell, i) {
         cell.innerHTML = i + 1;
      });
   }).draw();


$("#count").keyup(function(){
    table.ajax.reload(null, false);
});

function getworkalloc($value)
{
    table.ajax.reload(null, false);
}
});
</script>
