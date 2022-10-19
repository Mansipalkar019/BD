s<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    

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
                <center><h4 class="page-title" style="color: black">Staff Informations of Project : <?= $ProjectInfo[0]['project_name'];?></h4></center>
            </div>
        </div>
    </div>
 <p><?php echo $this->session->flashdata("error");?></p>
 <p><?php echo $this->session->flashdata("success");?></p>
<div class="grey-bg container-fluid" style="font-size: 100%">
<section id="minimal-statistics">
<div style="overflow-y: auto;">
    <table id="datatable" class="table table-striped table-bordered data-table"  cellspacing="0" width="100%">
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
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ProjectInfo as $key => $value) { ?>
              <tr>
                <td><?= $key+1;?></td>
                <td><?= $value['project_name'];?></td> 
                <td><span><a class="badge btn btn-primary btn-sm" href="<?php echo base_url().'Projects/my_projects/'.base64_encode($value['project_id']).'/'.base64_encode($value['id']).'/'.base64_encode($value['received_company_name']);?>" title="Open Record"><?= $value['salutation'].'. '. $value['first_name'].' '.$value['last_name'];?></a></span></td>
                <td><?= $value['received_company_name'];?></td>
                <td><?= $value['provided_job_title'];?></td>
                <td><?= $value['address1'];?></td>
                <td><?= $value['city'];?></td>
                <td><?= $value['postal_code'];?></td> 
                <td><?= $value['country_name'];?></td>
                <td><?= date(('d-m-Y h:i A'),strtotime($value['created_date']));?></td>
              </tr>
            <?php }
            ?>
        </tbody>
</table>
</div>
</section>
</div>
</div>
</div>
</div>

<script >
    
   // window.onload = function exampleFunction() {
   //         swal("Good job!", "You clicked the button!", "success");

   //          }
            
</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="   https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    var simpletable = $('datatable').DataTable();
</script>
