<?php 
    $controller_name = $this->router->fetch_class();
    $method_name = $this->router->fetch_method();
?>
<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <b>2007 - <?=date("Y")?> &copy; BDCRM</b>
            </div>
            <div class="col-md-6 text-right">
                <b>Design & Developed By <a href="https://www.stzsoft.com">STZSOFT</a></b>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->



<!-- Right bar overlay-->
<!-- <div class="rightbar-overlay"></div>

    <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
        <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Choose Demos
    </a> -->

<!-- Vendor js -->
<script src="<?php echo base_url(); ?>assets/js/vendor.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/morris-js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script> -->
     <script src="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/sweetalerts.init.js"></script>
   
    <script src="<?php echo base_url(); ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/buttons.print.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.scroller.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/libs/datatables/dataTables.fixedColumns.min.html"></script> -->
    <script src="<?php echo base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/pdfmake/vfs_fonts.js"></script>
    <!-- Datatables init -->
    <script src="<?php echo base_url(); ?>assets/js/pages/datatables.init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- App js -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script> -->
    <script type="text/javascript">
          var bases_url="<?=base_url() ?>";
    </script>
    <?php 
        if($controller_name=='Projects' && $method_name == 'ProjectInfo'){ 
    ?>
    <script src="<?php echo base_url(); ?>assets/js/view_js/projects/project_info.js"></script>
    <?php } ?>
    

    <!-- Nested Table  -->
    
    <!-- App js -->



</body>

</html>