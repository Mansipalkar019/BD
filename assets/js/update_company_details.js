$("#update_company_details_form").submit(function(e) {
    var class_list =[]
    e.preventDefault();
    var formData = new FormData($("#update_company_details_form")[0]);
    var attributeForm = $(this);
    var session_user_id=$('#session_user_id').val();
    // var txtemail = $("#staff_email").val();
    var country = $("#country").val();
    // var region_name = $("#region_name").val();
    // var company_name=$('#company_name').val();
    var address_1=$('#address_1').val();
    
    var city_name=$('#city_name').val();
    // var postal_code=$('#postal_code').val();
    var state_name=$('#state_name').val();         
    var address_source_url=$('#address_source_url').val(); 
    var company_remark=$('#company_remark').val();
    var staff_email=$('#staff_email').val();
    var staff_email_harvesting=$('#staff_email_harvesting').val();
    var assumed_email=$('#assumed_email').val();
    var job_title=$("#job_title").val();
    var title=$("#title").val(); 
    var website_url=$("#website_url").val();
    var staff_direct_tel=$("#staff_direct_tel").val();

    
    if (IsEmail(staff_email) == false && staff_email != '') {
        var class_name="Email is not valid";
        class_list.push(class_name);
	}

    if (staff_tel(staff_direct_tel) == false && staff_direct_tel != '') {
        var class_name="*Enter Valid Direct Tel: Numbers X Number.";
        class_list.push(class_name);
    }
   
    if (address_1 != '') {
        if (country == '') {
            var country="Country is required";
            class_list.push(country);
        }
        
	}

    if(country == 'USA')
    {
        if(state_name == '')
        {
            var state_name="State/County is required";
            class_list.push(state_name);
        }
        if (address_1 == '') {
            var address_1="Address is required";
            class_list.push(address_1);
        }
    }else if(country == 'Canada')
    {
        if(state_name == '')
        {
            var state_name="State/County is required";
            class_list.push(state_name);
        }
        if (address_1 == '') {
            var address_1="Address is required";
            class_list.push(address_1);
        }
    }else if(country == 'United Kingdom')
    {
        if(state_name == '')
        {
            var state_name="State/County is required";
            class_list.push(state_name);
        }
        if (address_1 == '') {
            var address_1="Address is required";
            class_list.push(address_1);
        }  
    }else if(country == 'India')
    {
        if(state_name == '')
        {
            var state_name="State/County is required";
            class_list.push(state_name);
        }
        if (address_1 == '') {
            var address_1="Address is required";
            class_list.push(address_1);
        }
    }else if(country == 'Australia')
    {
        if(state_name == '')
        {
            var state_name="State/County is required";
            class_list.push(state_name);
        }
        if (address_1 == '') {
            var address_1="Address is required";
            class_list.push(address_1);
        }
    }
   
    
    if(session_user_id == 3 || session_user_id == 6)
    {
        if (city_name == '') {
            var city_name="City Name is required";
            class_list.push(city_name);
        }
        if (address_1 != '' && address_source_url == '') {
            var address_source_url="Address Source URL is Required";
            class_list.push(address_source_url);
	    }
    }

    if (address_1 != '' && address_source_url == '') {
        var address_source_url="Address Source URL is Required";
        class_list.push(address_source_url);
    }

    if (address_1 == '' || website_url == '') {
        if(company_remark != '')
        {
            var company_remark="Co. Remark is Required";
            class_list.push(company_remark);
        }
	}

 //    if (address_1 != '' || company_remark == '') {
 //        if (website_url == '') {
 //            var website_url="Website URL is required";
 //            class_list.push(website_url);
 //        }
      
	// }

 //    if (website_url != '' && company_remark == '') {
 //        if (address_1 == '') {
 //            var address_1="Address is required";
 //            class_list.push(address_1);
 //        }
      
	// }
    if (job_title == '') {
        var job_title="Job Title is required";
        class_list.push(job_title);
	}
    if (title == '') {
        var title="Title is required";
        class_list.push(title);
	}
    if (staff_email == '' && assumed_email == '') {
        var staff_remark1="Staff Email is Required";
        class_list.push(staff_remark1);
        
    }
     if (staff_email == '') {
        var staff_remark2="Staff Remark is Required";
        class_list.push(staff_remark2);
        
    }
      if (assumed_email == '') {
        var staff_remark2="Staff Remark is Required";
        class_list.push(staff_remark2);
        
    }

    // if (staff_email == '' && assumed_email == '') {
    //     var staff_email="Staff Email is Required";
    //     class_list.push(staff_email);
    //     var assumed_email="Assumed Email is Required";
    //     class_list.push(assumed_email);
    // }
    // if (staff_email != '' && assumed_email == '') {
    //     var assumed_email="Assumed Email URL is Required";
    //     class_list.push(assumed_email);
    // }
    // if (staff_email == '' && assumed_email != '') {
    //     var staff_email="Staff Email is Required";
    //     class_list.push(staff_email);
    // }
   if (address_1 == '') {
        var address_1="Address is required";
        class_list.push(address_1);
    }
    if (staff_email_harvesting == '') {
        var staff_email_harvesting="Email Source URL is required";
        class_list.push(staff_email_harvesting);
    }
    // if (website_url == '') {
    //     var website_url="Website Url is required";
    //     class_list.push(website_url);
    // }

    

    if(class_list != '')
    {
        $("#valid_error").empty();
        jQuery.each(class_list, (index, item) => {
            
          $("#valid_error").css("padding","20px");
          $("#valid_error").css("border","1px solid #D0D0D0");
          $("#valid_error").css("font-size","13px");
          $("#valid_error").css("font-weight","700");
          $("#valid_error").css("overflow","scroll");
          $("#valid_error").css("height","100px");
          $("#valid_error").append("<span class='label label-important' style='color:#FF0000'>"+item+'</span><br>');
        });
    }
    else{
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
                console.log(response);
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
    }
   
    return false;
 });

 function IsEmail(email) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    if (!pattern.test(email)) {
        return false;
    }
    else {
        return true;
    }
}

function staff_tel(telno){
    var isValid = false;
    var regex = /^[Xx0-9\s]*$/;
    isValid = regex.test(telno);
    return isValid;
   }