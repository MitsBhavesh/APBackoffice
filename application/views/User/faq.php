 <!-- ============================================================== -->
 <!-- Start right Content here -->
 <!-- ============================================================== -->
 <div class="main-content">

     <div class="page-content">
         <div class="container-fluid">

             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-beaker-question-outline me-2" style="color:#fff;"></i>FAQs</h6>
                        </div>
                         <div class="card-body">
                             
                             <!-- end row -->
                             <div class="row ">
                             <?php
                               if(!empty($results))
                               {
                                  // print_r($results);exit();
                                 $i=1;
                                foreach ($results as  $value) 
                                   {
                                     // $Row_ID =$value['Row_id'];
                                     // $Title =$value['title'];
                                     // $Description =$value['description'];
                               ?>
                             
                                 <div class="col-xl-4 col-sm-6">
                                     <div class="card">
                                         <div class="card-body overflow-hidden position-relative">
                                             <div>
                                                 <i class="bx bx-help-circle widget-box-1-icon text-primary"></i>
                                             </div>
                                             <div class="faq-count">
                                                 <h5 class="text-primary">0<?php echo $i;?>.</h5>
                                             </div>
                                             <h5 class="mt-3"><?php echo $value['title'];?></h5>
                                             <?php echo $value['description'];?>
                                             
                                         </div>
                                         <!-- end card body -->
                                     </div>
                                     <!-- end card -->
                                 </div>
                                 <!-- end col -->
                             
                             <?php
                                  $i++;
                                  }
                                  }
                               ?>
                               </div>
                             <!-- end row -->
                         </div>
                         <!-- end  card body -->
                     </div>
                     <!-- end card -->
                 </div>
                 <!-- end col -->
             </div>
             <!-- end row -->

         </div> <!-- container-fluid -->
     </div>
     <!-- End Page-content -->
     <!-- end main content-->