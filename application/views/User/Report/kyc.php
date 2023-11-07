<?php
// echo "<pre>";
// print_r($clientmaster_back_data);
 if(isset($_SESSION['APBackOffice_client_client_master_data']))
   {
       $clientmaster_columns = $_SESSION['APBackOffice_client_client_master_data'][0];
       $clientmaster_back_data = $_SESSION['APBackOffice_client_client_master_data'][1];
   
       // echo "<pre>"; 
       // print_r($clientmaster_columns); 
       // print_r($clientmaster_back_data); 
       // echo "</pre>"; 
       // exit(); 
   }

   if(isset($_SESSION['APBackOffice_client_bank_detail']))
   {
       $clientbank_columns = $_SESSION['APBackOffice_client_bank_detail'][0];
       $clientbank_back_data = $_SESSION['APBackOffice_client_bank_detail'][1];
       // echo "<pre>"; 
       // print_r($clientbank_columns); 
       // print_r($clientbank_back_data); 
       // echo "</pre>"; 
       // exit(); 
   }
   
?>
<style>
   .table td, .table th {
   font-size: 11px !important;
   padding: 0.35rem 0.35rem;
   /*font-family:    Arial, Verdana, sans-serif;*/
   }
</style>
<div class="card-body">
   <div class="row">
      <div class="col-12">
         <!--  Start KYC code-->
         <div class="row">
            <div class="col-xl-9 col-lg-8">
               <!-- start card -->
              <!--  <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                           <div class="d-flex align-items-start mt-3 mt-sm-0">
                              <div class="flex-grow-1">
                                 <div>
                                    <h5 class="font-size-16 mb-1"><?php if(isset($clientmaster_back_data[0][4])){ echo $clientmaster_back_data[0][4]; } ?></h5>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-auto order-1 order-sm-2">
                           <div class="d-flex align-items-start justify-content-end gap-2">
                              <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                 <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Active</div>
                              </div>
                           </div>
                       </div>
                     </div>
                  </div>
               </div> -->
               <!-- end card -->
               <!-- start code -->
                <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                       <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                           <div class="d-flex align-items-start mt-3 mt-sm-0">
                              <div class="flex-grow-1">
                                 <div>
                                    <h5 class="font-size-16 mb-1"><?php if(isset($clientmaster_back_data[0][4])){ echo $clientmaster_back_data[0][4]; } ?></h5> 
                                    <small class=""><i class="fas fa-user"></i>&nbsp;&nbsp; <?php if(isset($clientmaster_back_data[0][569])){ echo $clientmaster_back_data[0][569]; } ?></small>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-auto order-1 order-sm-2">
                           <div class="d-flex align-items-start justify-content-end gap-2">
                              <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                 <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Active</div>
                              </div>
                           </div>
                       </div>
                     </div>
                                       <!--  <h4 class="card-title">Accordion Example</h4>
                                        <p class="card-title-desc">Click the accordions below to expand/collapse the accordion content.</p> -->
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="accordion" id="accordionExample">
                                             <!-- <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button fw-medium " type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                     <i class="fas fa-users"></i>&nbsp;&nbsp; Client List
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <table id="datatable" class="table table-bordered dt-responsive w-100">
                                                            <thead>
                                                               <tr>
                                                                  <th>Client Code</th>
                                                                  <th>Client Name</th>
                                                                  <th>Pancard</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody>
                                                               <tr>
                                                                  <td>A0342</td>
                                                                  <td>NILESH PRAVINBHAI MISTRY</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A0501</td>
                                                                  <td>DIPTI NILESH MISTRY</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A0502</td>
                                                                  <td>JITENDRABHAI BABUBHAI MAVADA</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A0520</td>
                                                                  <td>RASHMI RAKESH MEVADA</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A0772</td>
                                                                  <td>HETALBEN NILESHBHAI MEVADA</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A0868</td>
                                                                  <td>VANITABEN SANATBHAI DESAI</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A0915</td>
                                                                  <td>RINABEN D DESAI</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A1201</td>
                                                                  <td>HEENABEN DIPAKKUMAR MEWADA</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A1202</td>
                                                                  <td>SURYAPRASAD GOPALDAS MEVADA </td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                               <tr>
                                                                  <td>A1446</td>
                                                                  <td>ANKIT DIPAKBHAI CHEVLI</td>
                                                                  <td>IFSC Code</td>
                                                               </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>    -->                                       
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fas fa-user"></i>&nbsp;&nbsp;
                                                    Profile
                                                    </button>
                                                </h2>
                                                <!-- class="accordion-collapse collapse show" -->
                                                <div id="collapseOne" class="accordion-collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                         <div class="text-muted">
                                                         <!-- start profile code -->
                                                         <div class="card">
                                                            <div class="card-header">
                                                               <h5 class="card-title mb-0">Personal Detail</h5>
                                                            </div>
                                                            <div class="card-body">
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Client Code:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php if(isset($clientmaster_back_data[0][4])){ echo $clientmaster_back_data[0][4]; } ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>BOID:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php if(isset($clientmaster_back_data[0][583])){ echo $clientmaster_back_data[0][583]; } ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Name:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php if(isset($clientmaster_back_data[0][569])){ echo $clientmaster_back_data[0][569]; } ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Father Name:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php if(isset($clientmaster_back_data[0][37])){ echo $clientmaster_back_data[0][37]; } ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Pan Number:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php if(isset($clientmaster_back_data[0][189])){ echo $clientmaster_back_data[0][189]; } ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>DOB:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][241]; ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Mobile No.:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][200]; ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Email Id:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][178]; ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Category:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][348]; ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Gender:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][34]; ?></small>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-xl-4">
                                                                     <small class="text-muted"><b>Addresses:</b></small>
                                                                  </div>
                                                                  <div class="col-xl-8">
                                                                     <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][100]." ".$clientmaster_back_data[0][134]." ".$clientmaster_back_data[0][145]; ?></small>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <!-- end profile code -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="mdi mdi-bank"></i>&nbsp;&nbsp;
                                                    Bank 
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="text-muted">
                                                            <div class="card">
                                                               <div class="card-header">
                                                                  <h5 class="card-title mb-0">Bank Detail</h5>
                                                               </div>
                                                               <div class="card-body">
                                                                  <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                                                     <thead>
                                                                        <tr>
                                                                           <th>Bank Name</th>
                                                                           <th>Account No</th>
                                                                           <th>IFSC Code</th>
                                                                           <th>MICR Code</th>
                                                                           <th>Account Type</th>
                                                                           <th>Default</th>
                                                                        </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                        <?php 
                                                                           if(!empty($clientbank_back_data))
                                                                           {
                                                                               foreach ($clientbank_back_data as $key_index => $data_row) 
                                                                               {
                                                                           ?>   
                                                                        <tr>
                                                                           <td><?php echo $data_row[16]; ?></td>
                                                                           <td><?php echo $data_row[12]; ?></td>
                                                                           <td><?php echo $data_row[4]; ?></td>
                                                                           <td><?php echo $data_row[19]; ?></td>
                                                                           <td><?php echo $data_row[22]; ?></td>
                                                                           <td><?php echo $data_row[18]; ?></td>
                                                                        </tr>
                                                                        <?php  
                                                                           }
                                                                           }
                                                                           else
                                                                           {
                                                                           ?>
                                                                        <!-- <td>No data available</td> -->
                                                                        <?php
                                                                           }
                                                                           ?>
                                                                     </tbody>
                                                                  </table>                                                              
                                                               </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div><!-- end accordion -->
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>
               <!-- end code -->
            </div>
            <!-- end col -->
            <div class="col-xl-3 col-lg-4">
               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title mb-3">Segment</h5>
                     <div class="d-flex flex-wrap gap-2 font-size-16">
                        <?php foreach ($clientmaster_back_data as $value){?>
                           <a href="#" class="badge badge-soft-primary"><?php print_r($value[0]);}?></a>
                       <!--  <a href="#" class="badge badge-soft-primary">CSS</a>
                        <a href="#" class="badge badge-soft-primary">Javascript</a>
                        <a href="#" class="badge badge-soft-primary">Php</a>
                        <a href="#" class="badge badge-soft-primary">Python</a> -->
                     </div>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
               <div class="card" style="display: ;">
                  <div class="card-body">
                     <h5 class="card-title mb-3">DP Details</h5>
                     <div>
                        <div class="row">
                           <div class="col-sm-5">
                              <small class="text-muted"><b>Depository:</b></small>
                           </div>
                           <div class="col">
                              <small class="text-muted" style=""><b><?php echo $clientmaster_back_data[0][588]; ?></b></small>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-4">
                              <small class="text-muted"><b>BOID:</b></small>
                           </div>
                           <div class="col-sm-8">
                              <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][583]; ?></small>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-4">
                              <small class="text-muted"><b>BO Name:</b></small>
                           </div>
                           <div class="col-sm-8">
                              <small class="text-muted" style=""><?php echo $clientmaster_back_data[0][584]; ?></small>
                           </div>
                        </div>
                       <!--  <h4 class="mb-3">
                           <span class="counter-value" data-target="25"></span>%
                        </h4> -->
                     </div>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
              <!--  <div class="card">
                  <div class="card-body">
                     <h5 class="card-title mb-3">Similar Profiles</h5>
                     <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                           <div class="d-flex align-items-center">
                              <div class="avatar-sm flex-shrink-0 me-3">
                                 <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                              </div>
                              <div class="flex-grow-1">
                                 <div>
                                    <h5 class="font-size-14 mb-1">James Nix</h5>
                                    <p class="font-size-13 text-muted mb-0">Full Stack Developer</p>
                                 </div>
                              </div>
                           </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                           <div class="d-flex align-items-center">
                              <div class="avatar-sm flex-shrink-0 me-3">
                                 <img src="assets/images/users/avatar-3.jpg" alt="" class="img-thumbnail rounded-circle">
                              </div>
                              <div class="flex-grow-1">
                                 <div>
                                    <h5 class="font-size-14 mb-1">Darlene Smith</h5>
                                    <p class="font-size-13 text-muted mb-0">UI/UX Designer</p>
                                 </div>
                              </div>
                           </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                           <div class="d-flex align-items-center">
                              <div class="avatar-sm flex-shrink-0 me-3">
                                 <div class="avatar-title bg-soft-light text-light rounded-circle font-size-22">
                                    <i class="bx bxs-user-circle"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1">
                                 <div>
                                    <h5 class="font-size-14 mb-1">William Swift</h5>
                                    <p class="font-size-13 text-muted mb-0">Backend Developer</p>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
               </div> -->
               <!-- end card -->
            </div>
            <!-- end col -->
         </div>
         <!-- End KYC code -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready( function () {
      $('#datatable1').DataTable( {
      responsive: true
      
      } );
} );
</script>