<?php
if(isset($_SESSION['APBackOffice_collection_data']))
{
  // echo "<pre>";
  // print_r($_SESSION['APBackOffice_collection_data']);
  // exit();
  $columns=$_SESSION['APBackOffice_collection_data'][0];
  $back_data=$_SESSION['APBackOffice_collection_data'][1];

}
?>
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:30px;">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Collection Report</h4>
               </div>
            </div>
         </div>
         <!-- end page title -->
         <?php include("alert.php"); ?> 
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;">Collection Report</h6>
                        </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>KYC/collection_report">
                        <div class="row card-title mb-0 flex-grow-1">
                           <div class="col-md-3">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                 <div class="mb-3">
                                    <input type="text" class="form-control" name="client_code" required="">
                                 </div>
                              </div>
                           </div>
                            <div class="col-md-3">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Exchange Code:</label>
                                 <div class="mb-3">
                                     <select name="exchange_code" id="exchange_code" class="form-select">
                                       <option value="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF"<?php if(isset($_SESSION['exchange_code'])){$_SESSION['exchange_code'] == 'BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF' ? ' selected="selected"' : '';}else{echo 'selected';}?>>Group 1</option>
                                       <option value="MCX,ICEX"<?php if(isset($_SESSION['exchange_code'])){$_SESSION['exchange_code'] == 'MCX,ICEX' ? ' selected="selected"' : '';}?>>Group 2</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                            <div class="col-md-3">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">To Date:</label>
                                 <div class="mb-3">
                                    <input class="form-control" type="date"  max="<?= date('Y-m-d'); ?>" value="<?php echo date('Y-m-d')?>" id="to_date" name="to_date">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_submit" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                              </div>
                           </div>
                        </div> 
                     </form>
                     <!-- End Form -->
                  </div>
                  <!-- Start DataTable -->
                  <div class="card-body">
                     <div style="text-align-last: end;">
                        <a href="<?php echo base_url('KYC/collection_report_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                     </div><br/>
                     <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                     <thead>
                        <tr>
                           <th>BRANCH_CODE</th>
                           <th>ACCOUNTCODE</th>
                           <th>ACCOUNTNAME</th>
                           <th>BRANCH_NAME</th>
                           <th>MOBILENO</th>
                           <th>LASTRDATE</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(!empty($back_data)){
                           foreach ($back_data as $data_row) {
                           
                           ?>
                        <tr>
                           <td><?php echo $data_row[0];?></td>
                           <td><?php echo $data_row[1];?></td>
                           <td><?php echo $data_row[2];?></td>
                           <td><?php echo $data_row[3];?></td>
                           <td><?php echo $data_row[60];?></td>
                           <td><?php echo $data_row[65];?></td>
                        </tr>
                        <?php 
                           }
                           } 
                           ?>
                     </tbody>
                  </table>
                  </div>
                  <!-- End DataTable -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>