<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
   .blink {
        animation: blinker 2s linear infinite;
        color: red;
      }
      @keyframes blinker {
        50% {
          opacity: 0;
        }
      }
      #overlay{   
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
/*  background: rgba(0,0,0,0.6);*/
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
</style>

<div class="main-content" >
<div class="page-content">
<div class="container-fluid" style="margin-top:0px;">
<div class="container-inner">
   <!-- end page title -->
   <div class="container-outer">
      <div class="row">
         <!-- <span style="color:red;">Note: Technical Issue founded we wil on the working!.please try after some time.!</span> -->
         <div class="col-xl-3 zoom">
            <a href="<?php echo base_url();?>Dashboard/my_brokerage">
               <!-- card -->
               <div class="card card-h-50 shadow-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-wallet me-3"
                        style="color: #ffff;"></i>My Brokerage [<?php echo date('M')."-".date('Y');?>]</h6>
                        </div>
                  <!-- card body -->
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-10">
                           <h6 class="mb-3">
                              ₹<span id="Brokerage_earn" class="counter-value"
                                 data-target="<?php if (isset($_SESSION['Total_Brokerage'])){echo $_SESSION['Total_Brokerage'];}?>">0</span>
                           </h6>
                        </div>
                     </div>
                     <div class="text-nowrap">
                        <span class="badge bg-soft-success text-success font-size-13"
                           id="Brokerage_earn1" >₹</span>
                        <span class="ms-1 text-muted font-size-13">Previous Month</span>
                     </div>
                     <!-- <span style="font-size: 12px;">Note: Current Month Brokerage</span> -->
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
            </a>
         </div>
         <!-- end col -->
         <div class="col-xl-3 zoom">
            <a href="<?php echo base_url();?>Dashboard/no_client">
               <!-- card -->
               <div class="card card-h-50 shadow-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-account me-3"
                        style="color: #ffff;"></i>Number of Clients</h6>
                        </div>
                  <!-- card body -->
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-10">
                           <h6 class="mb-3">
                              <span class="counter-value" data-target="<?php if(isset($_SESSION['No_of_client'])){echo $_SESSION['No_of_client'];}?>">0</span>
                           </h6>
                        </div>
                     </div>
                     <div class="text-nowrap">
                        <span class="badge bg-soft-success text-success"><?php if(isset($_SESSION['No_of_client'])){echo $_SESSION['No_of_client'];}?></span>
                        <span class="ms-1 text-muted font-size-13">Total Client</span>
                     </div>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
            </a>
         </div>
         <!-- end col-->
         <div class="col-xl-3 zoom">
            <a href="<?php echo base_url();?>Dashboard/lead_conversion">
               <!-- card -->
               <div class="card card-h-50 shadow-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book-open me-3"
                        style="color: #ffff;"></i>Account Opening Process </h6>
                        </div>
                  <!-- card body -->
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-10">
                           <h6 class="mb-3">
                              <span class="counter-value" data-target="<?php if(isset($_SESSION['My_account_opening_authorize'])){echo number_format((float)$_SESSION['My_account_opening_authorize'], 2, '.', '');}?>"></span>%
                           </h6>
                        </div>
                     </div>
                     <!-- <div class="text-nowrap">
                        <?php 
                           $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                           $ap_code=$_SESSION['APBackOffice_user_code'];
                           $sql_login = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Login'"; 
                           
                           $sql_authorize = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Authorize'";
                           ?>
                        <div class="row">
                           <div class="col-6">
                              <span class="badge bg-soft-warning text-warning">Login (<?php echo $KYC_db_odbc->query($sql_login)->num_rows();?>)</span>
                           </div>
                           <div class="col-6">
                              <span class="badge bg-soft-success text-success">Authorize (<?php echo $KYC_db_odbc->query($sql_authorize)->num_rows();?>)</span>
                           </div>
                        </div>
                     </div> -->
                     <div class="text-nowrap">
                        <?php
                           $sql_rejection = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Rejection'"; 
                           
                           $sql_finished = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='TechFinished'";
                           ?>
                        <div class="row">
                           <div class="col-6">
                              <span class="badge bg-soft-danger text-danger">Reject (<?php echo $KYC_db_odbc->query($sql_rejection)->num_rows();?>)</span>
                           </div>
                           <div class="col-6">
                              <span class="badge bg-soft-info text-info">Finish (<?php echo $KYC_db_odbc->query($sql_finished)->num_rows();?>)</span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
            </a>
         </div>
         <!-- end col -->
         <div class="col-xl-3 zoom">
            <a href="<?php echo base_url();?>Dashboard/Modification">
               <!-- card -->
               <div class="card card-h-50 shadow-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book me-3"
                        style="color: #ffff;"></i>Modification Online Process</h6>
                        </div>
                  <!-- card body -->
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-10">
                         <h6 class="mb-2">
                              <span class="counter-value" data-target=""></span>%
                           </h6>
                        </div>
                     </div>
                     <div class="text-nowrap">
                        <span class="badge bg-soft-success text-success"></span>
                        <span class="ms-1 text-muted font-size-13"></span>
                     </div>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
            </a>
         </div>
         <!-- end col -->
         <div class="col-md-6">
            <div class="row">
               <div class="col-xl-12">
                  <!-- card -->
                  <div class="card card-h-100 shadow-primary">
                     <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-users me-3"></i>Client Overview</h6>
                        </div>
                     <!-- card body -->
                     <div class="card-body">
                       
                        <div class="row align-items-center">
                           <div class="col-sm">
                              <!-- , "#5156be" -->
                              <div id="pie-chart"
                                 data-colors='["#2ab57d", "#4ba6ef", "#ffbf53"]'
                                 class="e-charts"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end col -->
               <!-- end col -->
            </div>
            <!-- end row -->
         </div>
         <div class="col-md-6">
          <div class="card text-black shadow-primary card-h-100">
            <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title blink" style="color:#ffff!important;"><i class="mdi mdi-newspaper me-3"
                        style="color: #ffff;"></i>News</h6>
                        </div>
                 <!-- card body -->

                 <div class="card-body p-2">
                  <!-- <small class="" style="color:red;">Note: Please check IPO deatil before IPO bidding!</small> -->


                     <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">         
                                                               
                         <div class="carousel-inner">
                           <?php if (!empty($results)){
                            $newArray = array_slice($results, 0, 5, true);
                            $i=0;
                            foreach ($newArray as  $value) {
                                 ?>
                             <div class="carousel-item <?php if($i==0){echo "active";}?>">
                                   <div class="text-center p-4">

                                     <i class=""><img src="<?php echo $value['urlToImage'];?>" height="80" width="125"></i>
                                       <h4 class="mt-3 lh-base fw-normal text-black"><b><?php echo $value['title'];?></b></h4>
                                       <p class="text-black font-size-13"><?php echo $value['description'];?></p>
                                       Source:<p class="text-black font-size-13"><b><?php echo $value['source']['name'];?></b></p>
                                         
                                   <a href="<?php echo $value['url'];?>" target='_blank'> <button class="btn btn-primary">Visit</button></a>
                                      
                                   </div>
                                   
                               </div>
                            
                            <?php
                            $i++;
                             } }

                            ?>
                           </div>

                         <!-- end carousel-inner -->
                         
                         <div class="carousel-indicators carousel-indicators-rounded">
                           <?php if (!empty($results)){
                              $newArray = array_slice($results, 0, 5, true);
                              $i=0;
                              foreach ($newArray as $value) {
                                 ?>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i;?>" class="<?php if($i==0){echo "active";}?>"
                                aria-current="true" aria-label="Slide 1" style="background-color:#b4c53c;"></button>
                                 <?php $i++;} }

                            ?>
                         </div>
                         <!-- end carousel-indicators -->
                     </div>
                     <!-- end carousel -->
                 </div>
                 <!-- end card body -->
             </div>
                    
         
            </div>
      </div>
      <!-- end row-->
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script type="text/javascript">
   $(document).ready(function() {
       $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>Dashboard/monthWise_revenue_days",
           cache: false,
           success: function(result) {
            $('#Brokerage_earn').html(result).hide().fadeIn(200);
               if (localStorage.getItem('counter') == 1) {
   
                   localStorage.removeItem("counter");
               }
               if (localStorage.getItem('counter') == null) {
                   // sweetalert();
                   // alertify.success(
                   //     "<i class='mdi mdi-face-agent me-2 py-3' style='font-size:20px;'></i>Welcome to the dashboard!"
                   //     );
               } else {
                   // window.localStorage.clear();localStorage.removeItem("counter");
               }
           }
   
       });

       $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Dashboard/monthWise_revenue_prevoius_month",
            cache: false,
            // beforeSend: function () {
            //    // $("#overlay").fadeIn(300);
            // },
             success: function(result) {
               $('#Brokerage_earn1').html("₹" + result).hide().fadeIn(200);
            }
            // complete: function () {
            //    $("#overlay").fadeIn(300);
            // },
   
       });
   });
   
   function sweetalert() {
       Swal.fire({
           icon: "success",
           title: "Login Successfully!",
           showConfirmButton: !1,
           timer: 1500
       })
   }
   
   window.addEventListener("unload", function() {
       var count = parseInt(localStorage.getItem('counter') || 0);
   
       localStorage.setItem('counter', ++count)
   }, false);
   var ts = localStorage.getItem('counter')
   if (localStorage.getItem('counter') == 4) {
   
   
   }
</script>
 <!-- echarts js -->
        <script src="<?php echo base_url();?>assets/libs/echarts/echarts.min.js"></script>
        <!-- echarts init -->
        <script src="<?php echo base_url();?>assets/js/pages/echarts_modify.init.js"></script>