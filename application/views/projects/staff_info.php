<<<<<<< HEAD
=======
<?php //$this->load->view("includes/header.php");
//$this->load->view("includes/navbar.php");
//$this->load->view("includes/left-sidebar.php");
//$this->load->view("includes/right-sidebar.php");?>
>>>>>>> 652e4bd4690baaf84224790a185064b46788ca0c
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style>
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
                <center><h4 class="page-title" style="color: black">Staff Informations of Project : <?= $received_company_name;?></h4></center>
            </div>
        </div>
    </div>
 <p><?php echo $this->session->flashdata("error");?></p>
 <p><?php echo $this->session->flashdata("success");?></p>
<div class="grey-bg container-fluid" style="font-size: 100%">
<br>
<div class="row">
    <div class="col-sm-2">
         <input type="text" class="form-control" value="" placeholder="Records Counts" name="records_counts">
    </div>
 
     <div class="col-sm-3">
           <select class='form-control form-control-sm' id="country"  name='country' multiple="" onchange="getcountrycode(this.value)">
            <option>Please Select User</option>
           <?php 
           foreach($getAllUsers as $val){ ?>
            <option value="<? $val['id']; ?>"><?= $val['first_name'].' '.$val['last_name'];?></option>
           <?php }

           ?>
          </select>
    </div>
   
    <div class="col-sm-2">
         <input type="button" class="form-control" value="" placeholder="Ex: B2B-19" name="project_name" required="">
    </div>

</div>
<br>


<section id="minimal-statistics">
<div style="overflow-y: auto;">
<input type="hidden"  value="<?= $id;?>" id="staff_id">
<input type="hidden"  value="<?= $received_company_name; ?>" id="received_company_name">
    <table id="datatable1" class="table table-striped table-bordered data-table"  cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Project Name</th>
            <th>Staff Name</th>
            <th>Company Received</th>
            <th>Provided Job Title</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Country</th>
            <th>Assigned By</th>
            <th>Designation</th>
            <th>Created At</th>
        </tr>
        </thead>
       
</table>
</div>
</section>
</div>
</div>
</div>
</div>
<<<<<<< HEAD

=======
<?php //$this->load->view("includes/footer.php"); ?>
<script >
    
   // window.onload = function exampleFunction() {
   //         swal("Good job!", "You clicked the button!", "success");
>>>>>>> 652e4bd4690baaf84224790a185064b46788ca0c

</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="   https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
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
       }
   }, 
   createdRow: function (row, data, index) {
        $('td', row).eq(2).addClass('text-capitalize');
    },
});
</script>
<script >
    $("#country").select2({
         placeholder: " Select Country",
         allowClear: true
         });
     </script>
      
      