$(document).ready(function (e) {
<<<<<<< HEAD
	$('#user_list').select2();
=======
   $('#user_list').select2();
>>>>>>> 4f0c93636259f42c11568a04a200dc7ed3429f24
   var table = $('#company_staff_count_datatable').DataTable({
      'ajax': {
         'url': bases_url + 'projects/display_all_company_staff',
         'type': "POST",
         'data': function (data) {
            // Read values
            var id = $('#id').val();
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
               var display_status_name = '<span><a href=' + bases_url + 'Projects/get_staff_info?id="' + btoa(row['project_id']) + '"&received_company_name="' + btoa(row['received_company_name']) + '" class="badge btn btn-primary btn-sm">' + staff_count + '</a></span>';
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
               var display_status_name = "<a href=" + bases_url + 'Projects/my_projects/' + btoa(row['project_id']) + '/' + btoa(row['id']) + '/' + btoa(row['received_company_name']) + "><i class='fa-solid fa-eye'></i></i></a>";
               return display_status_name;
            },
         },
      ],
      "order": [
         [0, 'desc']
      ]
   });
   $('#slot_allocation').keyup(function () {
      table.ajax.reload();
      var id = $('#id').val();
      var slot_count = $('#slot_allocation').val();
      var workalloc = $('#workalloc').val();
      $.ajax({
         url: bases_url + 'projects/display_all_company_staff',
         type: 'post',
         dataType: "json",
         data: {
            id: id,
            slot_count: slot_count,
            workalloc: workalloc
         },
         success: function (response) {
<<<<<<< HEAD
            $('#total_staff_count').text(response.total_staff_count);
=======
            $('#total_staff_count').val(response.total_staff_count);
>>>>>>> 4f0c93636259f42c11568a04a200dc7ed3429f24
         },
      });
   });
   $('#workalloc').change(function () {
      table.ajax.reload();
      var id = $('#id').val();
      var slot_count = $('#slot_allocation').val();
      var workalloc = $('#workalloc').val();
      $.ajax({
         url: bases_url + 'projects/display_all_company_staff',
         type: 'post',
         dataType: "json",
         data: {
            id: id,
            slot_count: slot_count,
            workalloc: workalloc
         },
         success: function (response) {
<<<<<<< HEAD
            $('#total_staff_count').text(response.total_staff_count);
=======
            $('#total_staff_count').val(response.total_staff_count);
>>>>>>> 4f0c93636259f42c11568a04a200dc7ed3429f24
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
            }
         }
         if (user_list == "") {
            Swal.fire({
               title: 'Warning',
               text: "Please Select User",
<<<<<<< HEAD
               icon: 'error',
               showCancelButton: true,
               confirmButtonColor: '#FD7E14',
               confirmButtonText: 'Yes!',
               cancelButtonText: 'No.'
=======
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#FD7E14',
               confirmButtonText: 'OK!',
>>>>>>> 4f0c93636259f42c11568a04a200dc7ed3429f24
            });
         } else {
            if (company_name) {
               $.ajax({
                  dataType: 'json',
                  type: 'POST',
                  url: bases_url + 'projects/save_company_allocation_data',
                  data: {
                     company_name: company_name,
                     user_list: user_list,
                     project_id: id,
                  },
                  success: function (response) {
<<<<<<< HEAD
                  	if(response.status=='success'){
                  		Swal.fire(
								  'Good job!',
								  	response.message,
								  'success'
								).then((result) => {
								  if (result.isConfirmed) {
								    location.reload();
								  }
								})
								setTimeout(function(){location.reload()},3000);
                  	} else if(response.status=='failure'){
                  		
                  		Swal.fire({
								  title: 'Oops...',
								  text: response.message,
								  icon: 'error',
								  confirmButtonColor: '#3085d6',
								  confirmButtonText: 'Ok'
								}).then((result) => {
								  if (result.isConfirmed) {
								    setTimeout(function(){location.reload()},2000);
								  }
								})
                  	}
                  	
=======
                     if(response.status=='success'){
                        Swal.fire(
                          'Good job!',
                           response.message,
                          'success'
                        ).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        })
                        setTimeout(function(){location.reload()},3000);
                     } else if(response.status=='failure'){
                        
                        Swal.fire({
                          title: 'Oops...',
                          text: response.message,
                          icon: 'error',
                          confirmButtonColor: '#3085d6',
                          confirmButtonText: 'Ok'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            setTimeout(function(){location.reload()},2000);
                          }
                        })
                     }
                     
>>>>>>> 4f0c93636259f42c11568a04a200dc7ed3429f24
                     // swal({
                     //    title: 'success',
                     //    text: response.message,
                     //    icon: 'success',
                     //    showCancelButton: true,
                     //    confirmButtonColor: '#FD7E14',
                     //    confirmButtonText: 'Yes!',
                     //    cancelButtonText: 'No.'
                     // }).then(() => {
                     //    if (result.value) {
                     //       location.reload();
                     //    }
                     // });
                     // location.reload();
                  }
               });
            }
         }
      }
   });
});