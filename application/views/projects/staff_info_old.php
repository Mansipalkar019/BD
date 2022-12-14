<?php //$this->load->view("includes/header.php");
//$this->load->view("includes/navbar.php");
//$this->load->view("includes/left-sidebar.php");
//$this->load->view("includes/right-sidebar.php");?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
       

<style>
.grey-bg {  
background-color: #F5F7FA;
}
.select2-selection--multiple .select2-selection__choice {
    background-color:black !important;
    border-radius: 12px !important;
    }
</style>
<form action="<?php echo base_url()?>Projects/getsInfo" method="post">
  
<div class="content-page">
<div class="content">
<div class="container-fluid">
    <?php if($this->session->userdata('designation_id') == 8 || $this->session->userdata('designation_id') == 2 || $this->session->userdata('designation_id') == 1) {?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <center><h4 class="page-title" style="color: black">Staff Informations of Project : <?= $received_company_name;?></h4></center>
            </div>
            <?php if(!empty($this->session->flashdata("error"))){?>
            <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $this->session->flashdata("error"); ?>
            </div>
            <?php }
            ?>

            <?php if(!empty($this->session->flashdata("success"))){?>
            <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $this->session->flashdata("success"); ?>
            </div>
            <?php }
            ?>
        </div>
    </div>
   
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
        <div class="col-2">  
        <div class="page-title-box"> 
               <button type="submit" value="" class="btn btn-danger form-control btn-sm" id="btn-search-by-count" style="margin-top:30px;">Submit</button>
        </div>
        </div>
       
    </div>
    <?php } ?>
<div class="grey-bg container-fluid" style="font-size: 100%">
<section id="minimal-statistics">
<div style="overflow-y: auto;">
<input type="hidden"  value="<?= $id;?>" id="staff_id">
<input type="hidden"  value="<?= $received_company_name; ?>" id="received_company_name">
    <table id="datatable1" class="table table-striped table-bordered data-table"  cellspacing="0" width="100%" style="font-size: 88%;">
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
</form>
<?php //$this->load->view("includes/footer.php"); ?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="   https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      
<script type="text/javascript">
     $(".users").select2({
         placeholder: " Select Users",
         allowClear: true
         });
  var simpletable = $('#datatable1').DataTable({
    "responsive": true,
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'language': {
        'processing': '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>',
        searchPlaceholder: ""
        
    },
   'ajax': {
       'url': "<?= base_url() ?>Projects/getprojectrecord",
       'method': "POST",
       'dataType':'json',
       "data": function (data) {
         data.staffid=$('#staff_id').val();
         data.received_company_name=$('#received_company_name').val();
         data.count=$('#count').val();
         data.workalloc=$('#workalloc').find(":selected").val();
       }
   }, 
   createdRow: function (row, data, index) {
        $('td', row).eq(2).addClass('text-capitalize');
    },
});

$("#count").keyup(function(){
    simpletable.ajax.reload(null, false);
});

function getworkalloc($value)
{
    simpletable.ajax.reload(null, false);
}
//simpletable.column([12]).visible(false);
</script>
