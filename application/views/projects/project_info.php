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
    <table id="company_datatable" class="table table-striped table-bordered data-table"  cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Staff Count</th>
            <!-- <th>Project Name</th>
            <th>Staff Name</th> -->
            <th>Company Received</th>
            <!-- <th>Provided Job Title</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Country</th> -->
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ProjectInfo as $key => $value) { ?>
              <tr>
                <td><?= $key+1;?></td>
               <td><span><a href='<?= base_url().'Projects/get_staff_info?id='.base64_encode($value['project_id']).'&received_company_name='.base64_encode($value['received_company_name']); ?>'class="badge btn btn-primary btn-sm"><?= $value['staff_count']?></a></span></td> 
               
                <td><?= $value['received_company_name'];?></td>
                <td><?= date(('d-m-Y h:i A'),strtotime($value['created_date']));?></td>
                <td><a href="<?php echo base_url().'Projects/my_projects/'.base64_encode($value['project_id']).'/'.base64_encode($value['id']).'/'.base64_encode($value['received_company_name']);?>"><i class="fa-solid fa-eye"></i></i></a></td>
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

<script type="text/javascript">
     var topRows = table.AsEnumerable().OrderBy(o=> o.Field<int>("IDColumn")).Take(2).ToList(); //IdColumn is your actual ID field


    var simpletable = $('#company_datatable').DataTable({
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
         
       }
   }, 
   createdRow: function (row, data, index) {
        $('td', row).eq(2).addClass('text-capitalize');
    },
});
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
