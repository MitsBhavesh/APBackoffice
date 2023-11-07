<?php
if(isset($_SESSION['APBackOffice_client_Trading_data']))
{
   $columns=$_SESSION['APBackOffice_client_Trading_data'][0];
   $back_data=$_SESSION['APBackOffice_client_Trading_data'][1];
   // echo "<pre>";
   // print_r($_SESSION['APBackOffice_client_Trading_data']);exit();
}
?>

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18"> </h4>
               </div>
            </div>
         </div>
         <!-- end page title -->
         <?php include("alert.php"); ?> 
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book-information-variant me-2" style="color:#fff;"></i>Client Trading Detail</h6>
                        </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>KYC/trading_detail">
                        <div class="row card-title mb-0 flex-grow-1">
                           <div class="col-md-6">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                 <div class="mb-3">
                                    <input type="text" class="form-control" name="client_code" required="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_trading" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
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
                        <a href="<?php echo base_url('KYC/trading_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                     </div>
                     <!-- <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100"> -->
                     <div style="overflow-x:auto;">
                        <table id="datatable" class="table table-bordered width=device-width, initial-scale=1">
                        <thead>
                           <tr>
                              <th>Company Code</th>
                              <th>Remeshire Group</th>
                              <th>Remeshire Name</th>
                              <th>Client Id</th>
                              <th>Client Name</th>
                              <th>DP Id</th>
                              <th>Client DP Code</th>
                              <th>DP Name</th>
                              <th>Mobile No</th>
                              <th>Email Id</th>
                              <th>Resi Address 1</th>
                              <th>Resi Address 2</th>
                              <th>Resi Address 3</th>
                              <th>Bank Name</th>
                              <th>Bank Account No</th>
                              <th>Micr Code</th>
                           </tr>
                        </thead>

                        <tbody>
                           <?php
                              $i = 0;
                              if(!empty($back_data))
                              {//if start
                                 foreach($back_data as $key => $value)
                                 {//foreach start
                                    // echo "<pre>";
                                    // print_r($value);exit();

                           ?>
                              <tr>
                                 <td><?php echo $back_data[$i][0]; ?></td>
                                 <td><?php echo $back_data[$i][7]; ?></td>
                                 <td><?php echo $back_data[$i][8]; ?></td>
                                 <td><?php echo $back_data[$i][9]; ?></td>
                                 <td><?php echo $back_data[$i][10]; ?></td>
                                 <td><?php echo $back_data[$i][5]; ?></td>
                                 <td><?php echo "'".$back_data[$i][4]; ?></td>
                                 <td><?php echo $back_data[$i][6]; ?></td>
                                 <td><?php echo $back_data[$i][14]; ?></td>
                                 <td><?php echo $back_data[$i][15]; ?></td>
                                 <td><?php echo $back_data[$i][11]; ?></td>
                                 <td><?php echo $back_data[$i][12]; ?></td>
                                 <td><?php echo $back_data[$i][13]; ?></td>
                                 <td><?php echo $back_data[$i][3]; ?></td>
                                 <td><?php echo $back_data[$i][2]; ?></td>
                                 <td><?php echo $back_data[$i][1]; ?></td>
                              </tr>
                           <?php
                                 $i++;
                              }//end foreach end
                           }//if end

                           ?>
                        </tbody>
                      </table>
                     </div>
                  </div>
                  <!-- End Datatable -->
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

