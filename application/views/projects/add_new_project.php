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
                                                    <select class="form-control" required="" name="task_type">
                                                        <?php
                                                        foreach ($TaskType as $key => $value) { ?>
                                                            <option><?= $value['project_type'];?></option>
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
                                   
                                     <button type='submit' class='btn btn-purple waves-effect waves-light' style="margin-left: 3%;background-color: green;">Submit</button>
                                    </form>
                                     <button  onclick="window.open('file.doc')"  class='btn btn-purple waves-effect waves-light'
                                     style="margin-left:30%;background-color:crimson;">Download Sample File</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>