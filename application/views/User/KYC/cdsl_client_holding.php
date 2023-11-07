<?php

if(isset($_SESSION['APBackOffice_client_Holding_data']))
{
   $columns=$_SESSION['APBackOffice_client_Holding_data'][0];
   $back_data=$_SESSION['APBackOffice_client_Holding_data'][1];
   // echo "<pre>";
   // print_r($_SESSION['APBackOffice_client_Holding_data']);exit();
}
?>
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18"></h4>
                  <!-- <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">APBackOffice</a></li>
                        <li class="breadcrumb-item active">HelpDesk</li>
                     </ol>
                  </div> -->
               </div>
            </div>
         </div>
         <!-- end page title -->
         <?php include("alert.php"); ?> 
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-car-brake-hold me-2" style="color:#fff;"></i>CDSL Client Holding Detail</h6>
                        </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>KYC/cdsl_client_holding">
                        <div class="row card-title mb-0 flex-grow-1">
                           <div class="col-md-6">
                              <div class="mb-2">
                                    <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                    <div class="mb-3">
                                       <input type="text" class="form-control" name="client_code" id="client_code" required>
                                    </div>
                              </div>
                           </div>
                           <!-- <div class="col-md-3">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-fromdate-input">From Date:</label>
                                 <input class="form-control" type="date" value="2022-04-01" id="from_date" name="from_date">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">To Date:</label>
                                 <input class="form-control" type="date" value="<?php echo date('Y-m-d')?>" id="to_date" name="to_date">
                              </div>
                           </div>     -->
                           <div class="col-md-3">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- End Form -->
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-2" style="text-align: center;">
                          Code :<span
                              style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_client_code'])){echo $_SESSION['APBackOffice_client_code'];}?></b></span>
                      </div>
                      <div class="col-5">
                          Name :<span
                              style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_client_name'])){echo $_SESSION['APBackOffice_client_name'];}?></b></span>
                      </div>
                      <!-- <div class="col-4">
                          Branch :<span
                              style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                      </div> -->
                  </div>
                  <!-- Start DataTable -->
                   <div class="card-body">
                     <div style="text-align-last: end;">
                        <a href="<?php echo base_url('KYC/cdsl_holding_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                        <a href="<?php echo base_url('KYC/holding_pdf_download'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                                            height="25"></a>
                     </div>
                     <!-- <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100"> -->
                        <div style="overflow-x:auto;">
                           <table id="datatable" class="table table-bordered width=device-width, initial-scale=1">
                           <thead>
                              <tr>
                                 <th>Scrip Name</th>
                                 <th>ISIN</th>
                                 <th>free Balance</th>
                                 <th>Pledge Balance</th>
                                 <th>Pending Dmt</th>
                                 <th>Lock In</th>
                                 <th>Pending Remat</th>
                                 <th>Total</th>
                                 <th>Price</th>
                                 <th>Value</th>
                                 <th>Ear Mark</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if(!empty($back_data)){
                                  foreach ($back_data as $data_row) {
                                    $total_sum=array((int)$data_row[5],(int)$data_row[8],(int)$data_row[4],(int)$data_row[6]);
                                    $sum_totalvalue=array_sum($total_sum);
                                    // $value_multiply = (int)$sum_totalvalue * (int)$data_row[16];
                                    $value_multiply = (float)$sum_totalvalue * (float)$data_row[16];

                                    if($sum_totalvalue!=0)
                                    {      // start if

                                 ?> 

                              <tr>
                                 <td><?php echo $data_row[14]; //scrip name?></td>
                                 <td><?php echo $data_row[13]; // ISIN?></td>
                                 <td><?php echo $data_row[5];//free Balance?></td>
                                 <td><?php echo $data_row[8];//Pledge Balance?></td>
                                 <td><?php echo $data_row[4]; //Pending Dmt?></td>
                                 <td><?php echo $data_row[6]; //Lock In?></td>
                                 <td><?php //Pending Remat?></td>
                                 <!-- <td><?php echo $data_row[15]; //Total?></td> -->
                                 <td><?php echo $sum_totalvalue; //Total?></td>
                                 <td><?php echo $data_row[16]; //Price?></td>
                                 <!-- <td><?php echo $data_row[7];//Value?></td> -->
                                 <td><?php echo $value_multiply;//Value?></td>
                                 <td><?php //Ear Mark?></td>
                              </tr>
                            <?php 
                                 }//end if
                              } } ?> 

                           </tbody>
                        </table>
                     </div>
                  </div> 
                  <!-- End DataTable -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <script type="text/javascript">
   $(document).ready( function () {
      $('#datatable1').DataTable( {
      responsive: true
      
      } );
} );
</script> -->