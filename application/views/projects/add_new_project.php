<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    .chosen-container-single .chosen-single {
        background: 0 0 !important;
        box-shadow: none !important;
        border-radius: 4px;
        height: 3.5rem !important;
    }

    #services_chosen {
        width: 100% !important;
        height: 30px !important;
    }

    .select2-container {
        padding: 0;
    }
</style>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-6">
                    <div class="page-title-box">
                        <h4 class="page-title">Add New Project</h4>
                    </div>
                </div>
                <div class="col-6" >
                    <div class="page-title-box">
                    <a type='submit' href="<?php echo base_url(); ?>projects/project_list" class='btn btn-purple btn-sm waves-effect waves-light' style="float:right;background-color: #357a95;margin-top:20px;margin-right:3%;background-image: linear-gradient(to right,#ff4156,#FF9A49);">Project List</a>
                    </div>
                </div>
            </div>
            <!-- end page title -->
           
                <?php if (!empty($this->session->flashdata('error'))) {
                    $data[] = $this->session->flashdata('error'); 
                    if (!empty($data[0]['error'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php 
                            foreach ($data[0]['error'] as $key => $value) {
                                print_r($value['error']); ?>
                                <br>
                    <?php }
                        }
                    } ?>
                    </div>
                     <form class="form-horizontal" action='<?php echo base_url('projects/upload_project'); ?>' method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card-box">
                               
                                <p><?php echo $this->session->flashdata("success"); ?></p>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-md-2 control-label" style="color:black;">Project Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="" placeholder="Ex: B2B-19" name="project_name" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" style="color:black;">Project Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" required="" name="project_type" id="project_type">
                                                    <option value="">Please Select Project Type</option>
                                                    <?php
                                                    foreach ($ProjType as $key => $value) { ?>
                                                        <option value="<?= $value['id']; ?>"><?= $value['project_type']; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 control-label" style="color:black;">Project Brief</label>
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
                                                <select class="form-control" required="" name="task_type" id="task_type" onchange="gettasktype(this.value)" id="task_type">
                                                    <option value="">Please Select Task Type</option>
                                                    <?php
                                                    foreach ($TaskType as $key => $value) { ?>
                                                        <option value="<?= $value['id']; ?>"><?= $value['project_type']; ?></option>
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
                                <center><label class="control-label" id="labelfield" style="color:black;display:none;">
                                        <h5 style="color:black;" id="tasktypname"></h5>
                                    </label></center>

                                <div class="row taskinput">

                                </div>

                                <br><br>
                                <button type='submit' class='btn btn-purple waves-effect waves-light' style="margin-left: 30%;background-color: green;">Submit</button>
                        </form>
                    <a type="button" title="" value="Download Sample File" data-loading-text="Loading..." class="btn btn-purple waves-effect waves-light exceldownload" style="background-color:crimson;color:white;" href="<?php echo base_url() ?>uploads/sampledoc/bdcrm.xls">Download Sample File</a>

   
        </div>
    </div>
</div>

</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    //mansi


    function gettasktype(tasktypeid) {

        var task_type = jQuery('#task_type option:selected').text()
        var content = "Select Required Feilds For Task Type " + task_type;
        $("#tasktypname").text(content);

        $('#labelfield').css("display", "block")
        $.ajax({
            url: '<?php echo base_url(); ?>Projects/gettasktype',
            type: 'post',
            dataType: "json",
            data: {
                tasktypeid: tasktypeid
            },
            success: function(data) {
                $(".taskinput").empty();

                $.each(data, function(i, member) {
                    html11 = '';


                    if (member.input_name != '') {
                        if (member.access == 1) {
                            html11 += '<div class="form-control col-3"><input id="tasktypecheck_' + member.task_type_id + '" type="checkbox" name="feild_access[]" value="' + member.feild_id + '" checked> <label for="tasktypecheck_' + member.label_name + '" ><b ><h6 style="color:black;">&nbsp;&nbsp;' + member.label_name + '</h6></b></label></div>';

                        } else {
                            html11 += '<div class="form-control col-3"><input id="tasktypecheck_' + member.task_type_id + '" type="checkbox" name="feild_access[]" value="' + member.feild_id + '" ><label for="tasktypecheck_' + member.label_name + '"><b><h6>&nbsp;&nbsp;' + member.label_name + '</h6></b></label></div>';

                        }

                    } else {
                        html11 += "";
                    }

                    $('.taskinput').append(html11);
                });


            }
        });
    }

    $("#task_type").select2({
        placeholder: "Select Task Type",
        allowClear: true,
    });
    $("#project_type").select2({
        placeholder: "Select Project Type",
        allowClear: true,
    });
</script>