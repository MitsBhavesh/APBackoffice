 <!-- ============================================================== -->
 <!-- Start right Content here -->
 <!-- ============================================================== -->
 <div class="main-content">

     <div class="page-content">
         <div class="container-fluid" style="margin-top:0px;">
             <div class="container-inner">
                 <!-- start page title -->
                 
                 <div class="row">
                     <div class="col-12">
                         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                             <h4 class="mb-sm-0 font-size-18">My Brokerage Chart</h4>
                             
                             <div class="page-title-right">
                                 <a href="<?php echo base_url()?>Dashboard/my_brokerage"><i
                                         class="mdi mdi-keyboard-backspace"></i> Back</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- end page title -->
                 <div class="container-outer">

                     <div class="row">
                         <div class="col-xl-12">

                             <div class="card">

                                 <div class="card-header">
                                     <h4 class="card-title mb-0">My Brokerage Month Wise</h4>
                                     <span style="color:grey;">Note:If your earning not showing or wrong then refresh the page ! Thank you!</span>
                                     <div style="text-align-last: end;">
                                    <a href="<?php echo base_url('Dashboard/monthWise_brokerage_excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                </div>
                                 </div>
                                <div class="col-xl-2">
                                    <button type="button" class="btn btn-primary" onclick='window.location.reload(true);'>Refresh </button>
                                </div>

                                <div class="card-body">
                                     <canvas id="bar" height="300"
                                         data-colors='["rgba(41, 181, 125, 0.8)", "rgba(41, 181, 125, 0.9)"]'></canvas>
                                </div>
                             </div>
                         </div> <!-- end col -->
                     </div> <!-- end row -->

                 </div> <!-- container-fluid -->
             </div>
         </div>
     </div>
 </div>
 <!-- End Page-content -->
 <script src="<?php echo base_url();?>assets/libs/chart.js/Chart.bundle.min.js"></script>
 <!-- chartjs init -->
        <script src="<?php echo base_url();?>assets/js/pages/chartjs.init.js"></script>