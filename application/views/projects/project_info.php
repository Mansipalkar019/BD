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
                <center><h4 class="page-title" style="color: black">Staff Informations of Project : <?= $ProjectInfo[0]['project_name'];?></h4></center>
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
            <input type="text" name="slot_allocation" id="slot_allocation" class="form-control company_allocation">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="page-title-box">
                       <label>Select Status</label>
                       <select  class="form-control company_allocation" id="workalloc" name="workalloc">
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
                <select class="form-control select2 company_allocation" id="user_list" name="user_list">
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
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<!-- <script src="   https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> -->

<script type="text/javascript">
    var frontend_path = "<?=base_url()?>";
$(document).ready(function (e) {
    var table = $('#company_staff_count_datatable').DataTable({
        'ajax': {
           'url':frontend_path + 'projects/display_all_company_staff',
           'type':"POST",
           'data': function(data){
              // Read values
                var id= $('#id').val();
                var slot_count = $('#slot_allocation').val();
                var workalloc = $('#workalloc').val();
              // Append to data
              data.id = id;
              data.slot_count = slot_count;
              data.workalloc = workalloc;
           }
        },
     
      "columns": [{
            "data": null
         },
        {
            "data": "staff_count",
            render: function (data, type, row) {
               let staff_count = row.staff_count;
                var display_status_name = '<span><a href='+frontend_path+'Projects/get_staff_info?id="'+btoa(row['project_id'])+'"&received_company_name="'+btoa(row['received_company_name'])+'" class="badge btn btn-primary btn-sm">'+staff_count+'</a></span>';
               return display_status_name;
            },
         },
         {
            "data": "received_company_name"
         },
         {
            "data": "created_date"
         },
         {
            "data": "user_name"
         },
         {
            "data": "project_id",
            render: function (data, type, row) {
               
               let project_id = row.project_id;
                var display_status_name = "<a href="+frontend_path+'Projects/my_projects/'+btoa(row['project_id'])+'/'+btoa(row['id'])+'/'+btoa(row['received_company_name'])+"><i class='fa-solid fa-eye'></i></i></a>";
               return display_status_name;
            },
         },
      ],
      "order": [
         [0, 'desc']
      ]
   });

    $('#slot_allocation').keyup(function(){
        table.ajax.reload();
         var id= $('#id').val();
                var slot_count = $('#slot_allocation').val();
                var workalloc = $('#workalloc').val();
         $.ajax({
          url: frontend_path +'projects/display_all_company_staff',
          type: 'post',
          dataType: "json",
          data: {id: id,slot_count:slot_count,workalloc:workalloc},
          success: function( response ) { 
            $('#total_staff_count').text(response.total_staff_count);
          },
        });
    });
    $('#workalloc').change(function(){
        table.ajax.reload();
        var id= $('#id').val();
                var slot_count = $('#slot_allocation').val();
                var workalloc = $('#workalloc').val();
         $.ajax({
          url: frontend_path +'projects/display_all_company_staff',
          type: 'post',
          dataType: "json",
          data: {id: id,slot_count:slot_count,workalloc:workalloc},
          success: function( response ) { 
            $('#total_staff_count').text(response.total_staff_count);
          },
        });
    });
   table.on('order.dt search.dt', function () {
      table.column(0, {
         search: 'applied',
         order: 'applied'
      }).nodes().each(function (cell, i) {
         cell.innerHTML = i + 1;
      });
   }).draw();
    


  $('#btn-search-by-date').click(function () {
   var company_name = [];
   var slot_allocation = $('#slot_allocation').val();
   var user_list = $('#user_list').val();
   var id = $('#id').val();
   if (slot_allocation == "") {
      swal({
         title: 'Warning',
         text: "Please Enter Slot Allocation Count",
         icon: 'error',
         showCancelButton: true,
         confirmButtonColor: '#FD7E14',
         confirmButtonText: 'Yes!',
         cancelButtonText: 'No.'

      });
   } else {
      for (var i = 0; i < slot_allocation; i++) {
         d = table.rows({
            search: 'applied'
         }).nodes()[i];
         if (d) {
            var td = d.getElementsByTagName("td")[2];
            // var assigned_td = d.getElementsByTagName("td")[4];
            // var assigned_td_1 = assigned_td.innerHTML;
            // if (assigned_td_1) {
            //    slot_allocation++;
            // } else {
            var td_text = td.innerHTML;
            company_name.push(td_text);
            // }
            console.log(company_name);
         }
      }
      if (user_list == "") {
         swal({
            title: 'Warning',
            text: "Please Select User",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#FD7E14',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No.'
         });
      } else {
         if (company_name) {
            $.ajax({
               dataType: 'json',
               type: 'POST',
               url: frontend_path + 'projects/save_company_allocation_data',
               data: {
                  company_name: company_name,
                  user_list: user_list,
                  project_id: id,
               },

               success: function (response) {
                  swal({
                     title: 'success',
                     text: response.message,
                     icon: 'success',
                     showCancelButton: true,
                     confirmButtonColor: '#FD7E14',
                     confirmButtonText: 'Yes!',
                     cancelButtonText: 'No.'
                  }).then(() => {
                     if (result.value) {
                        location.reload();
                     }
                  });
                  location.reload();
               }
            });
         }

      }

   }


});
});
</script>
