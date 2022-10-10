<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add New Project</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
             <form class="form-horizontal" action='<?php echo base_url('projects/upload_project'); ?>' method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                  <p><?php echo $this->session->flashdata("error");?></p>
                                  <p><?php echo $this->session->flashdata("success");?></p>


                                <div class="row">
                                    <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 control-label" style="color:black;">Project Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" value="" 
                                                     placeholder="Enter Project Name" name="project_name" required="">
                                                </div>
                                            </div>

                                              <div class="form-group row">
                                                <label class="col-sm-2 control-label" style="color:black;">Project Type</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" required="" name="project_type">
                                                    <option value="">Please Select Project Type</option>
                                                    <?php
                                                        foreach ($ProjType as $key => $value) { ?>
                                                            <option><?= $value['project_type'];?></option>
                                                       <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 control-label" style="color:black;">Project Breif</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="project_breif" required="">
                                                    </textarea>
                                                    
                                                </div>
                                            </div>

                                    </div>
                                    <div class="col-lg-6">
                                           <div class="form-group row">
                                                <label class="col-sm-2 control-label" style="color:black;">Select Task Type</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" required="" name="task_type" onchange="gettasktype(this.value)" id="task_type">
                                                    <option value="">Please Select Task Type</option>
                                                        <?php
                                                        foreach ($TaskType as $key => $value) { ?>
                                                            <option value="<?= $value['id'];?>"><?= $value['project_type'];?></option>
                                                       <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                               <label class="col-md-2 control-label" style="color:black;">File Upload </label>
                                               <div class="col-md-10">
                                                   <input type="file" name="uploaded_file" class="form-control" value="" required="">
                                               </div>
                                            </div>
                                    </div>
                                    
                                </div>
                                <label class="control-label" id="labelfield" style="color:black;display:none;">Select Input Fields</label>
                                <div class="row taskinput">
                                
                                </div>
                                    
                            
                                <button type='submit' class='btn btn-purple waves-effect waves-light' style="margin-left: 3%;background-color: green;">Submit</button>
                                    </form>
                                     <button  onclick="window.open('file.doc')"  class='btn btn-purple waves-effect waves-light'
                                     style="margin-left:30%;background-color:crimson;float:right;">Download Sample File</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="row">
                    <div class="taskinput">
                                    
                    </div>
                    </div> -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>

//mansi


function gettasktype(tasktypeid) {
    $('#labelfield').css("display","block")
    $.ajax({
    url: '<?php echo base_url(); ?>Projects/gettasktype',
    type: 'post',
    dataType: "json",
    data:{
        tasktypeid:tasktypeid
    },
    success: function( data ) {  
    console.log(data);
    $(".taskinput").empty();
   
    $.each(data,function(i,member){
    html11='';
        
    if(member.input_name != '')
    {
        if(member.access == 1)
        {
            html11 +='<div class="col-3"><div class="checkbox checkbox-primary col-3"><input id="tasktypecheck_'+member.task_type_id+'" type="checkbox" name="feild_access[]" value="'+member.feild_id+'" checked><label for="tasktypecheck_'+member.input_name+'"><b><h6 style="margin-top:2%">'+member.input_name+'</h6></b></label></div></div>';  
        }else{
            html11 +='<div class="col-3"><div class="checkbox checkbox-primary col-3"><input id="tasktypecheck_'+member.task_type_id+'" type="checkbox" name="feild_access[]" value="'+member.feild_id+'"><label for="tasktypecheck_'+member.input_name+'"><b><h6 style="margin-top:2%">'+member.input_name+'</h6></b></label></div></div>';  
        }
   
       
    }
    else{
    html11 += "";
    }
    
    $('.taskinput').append(html11);  
    });
   
  
    }
    });
}
</script>