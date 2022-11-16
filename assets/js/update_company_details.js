$("#update_company_details_form").submit(function(e) {
    var class_list =[]
    e.preventDefault();
    var formData = new FormData($("#update_company_details_form")[0]);
    var attributeForm = $(this);
    var txtemail = $("#staff_email").val();
    var country = $("#country").val();
    var region_name = $("#region_name").val();
    var company_name=$('#company_name').val();
    var address_1=$('#address_1').val();
    var city_name=$('#city_name').val();
    var postal_code=$('#postal_code').val();
    var state_name=$('#state_name').val();         
    var address_source_url=$('#address_source_url').val(); 
    var ca1=$('#ca1').val(); 
    var ca2=$('#ca2').val(); 
    var ca3=$('#ca3').val(); 
    var ca4=$('#ca4').val(); 
    var ca5=$('#ca5').val(); 
    var company_disposition=$("#company_disposition option:selected").val(); 
    var company_web_dispositon=$("#company_web_dispositon option:selected").val(); 
    var company_voice_disposition=$("#company_voice_disposition option:selected").val();
    var company_genaral_notes=$('#company_genaral_notes').val();
    var company_remark=$('#company_remark').val();
    var country_code=$('#country_code').val();
    var tel_number=$('#tel_number').val();
    var alternate_number=$('#alternate_number').val();
    var industry=$("#industry").val(); 
    var revenue=$('#revenue').val();
    var revenue_cur=$("#revenue_cur option:selected").val(); 
    var no_of_emp=$("#no_of_emp").val(); 
    var website_url=$("#website_url").val();
    if(txtemail == '') {
        var email="Please Enter Email";
        class_list.push(email);
	}
    if (IsEmail(txtemail) == false && txtemail != '') {
        var class_name="Email is not valid";
        class_list.push(class_name);
	}
    if(country == '') {
        var country="Please Enter Country";
        class_list.push(country);
	}
    if (region_name == '') {
        var region_name="Please Enter Region";
        class_list.push(region_name);
	}
    if (company_name == '') {
        var company_name="Please Enter Company Name";
        class_list.push(company_name);
	}
    if (address_1 == '') {
        var address_1="Please Enter Address";
        class_list.push(address_1);
	}
    if (city_name == '') {
        var city_name="Please Enter City Name";
        class_list.push(city_name);
	}
    if (postal_code == '') {
        var postal_code="Please Enter Postal Code";
        class_list.push(postal_code);
	}
    if (state_name == '') {
        var state_name="Please Enter State Name";
        class_list.push(state_name);
	}
    if (address_source_url == '') {
        var address_source_url="Please Enter Address Source URL";
        class_list.push(address_source_url);
	}
    if (ca1 == '') {
        var ca1="Please Enter ca1";
        class_list.push(ca1);
	}
    if (ca2 == '') {
        var ca2="Please Enter ca2";
        class_list.push(ca2);
	}
    if (ca3 == '') {
        var ca3="Please Enter ca3";
        class_list.push(ca3);
	}
    if (ca4 == '') {
        var ca4="Please Enter ca4";
        class_list.push(ca4);
	}
    if (ca5 == '') {
        var ca5="Please Enter ca5";
        class_list.push(ca5);
	}
    if (company_disposition == '') {
        var company_disposition="Please Enter Company Disposition";
        class_list.push(company_disposition);
	}
    if (company_web_dispositon == '') {
        var company_web_dispositon="Please Enter Company Web Dispositon";
        class_list.push(company_web_dispositon);
	}
    if (company_voice_disposition == '') {
        var company_voice_disposition="Please Enter Company voice Disposition";
        class_list.push(company_voice_disposition);
	}
    if (company_genaral_notes == '') {
        var company_genaral_notes="Please Enter Company General Notes";
        class_list.push(company_genaral_notes);
	}

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