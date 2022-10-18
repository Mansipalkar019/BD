$("#update_company_details_form").submit(function(e) {
   
    e.preventDefault();
    var formData = new FormData($("#update_company_details_form")[0]);
    var attributeForm = $(this);
    jQuery.ajax({
        dataType: "json",
        type: "POST",
        url: attributeForm.attr("action"),
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        mimeType: "multipart/form-data",
        beforeSend: function() {
           
        },
        success: function(response) {
          if (response.status == 'success') {
             swal({
              title: "success",
              text: response.status.msg,
              icon: "success",
              dangerMode: true,
              timer: 1500
           });
           location.reload();
            } else if (response.status == 'failure') {
             error_msg(response.error);
             swal({
              title: "Warning",
              text: response.error.msg,
              icon: "warning",
              dangerMode: true,
              timer: 1500
           });
            }  
        },
        error: function(error, message) {},
    });
    return false;
 });