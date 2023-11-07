<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- end page title -->
         <?php include("alert.php"); ?> 
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="bx bx-credit-card me-3"
                        style="color: #ffff;"></i>Client Wise Debit Credit</h6>
                  </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>Accounts/Client_wise_dr_cr">
                        <div class="row card-title mb-0 flex-grow-1">
                             <small class="alert alert-warning">Note: If you want all client code list do not enter client code field.</small>
                           <div class="col-md-3">

                              <div class="mb-2"> <label class="form-label" for="formrow-todate-input">Company code:</label>
                                    <div class="mb-3">
                                       <select name="exchange_code" id="exchange_code" class="form-select" required>
                                          <option value="">Select Company Code</option>
                                          <option value="1">Equity</option>
                                          <option value="2">Derivative</option>
                                          <option value="3">Currency</option>
                                          <option value="4">Commodity</option>
                                          <option value="5">Equity+Derivative</option>
                                          <option value="6">Equity+Derivative+Currency+MFSS+SLBM</option>
                                          <option value="7">Equity+Derivative+Currency+Commodity</option>
                                          <option value="10" selected>Equity+Der+Currency+MFSS+SLBM+NBFC</option>
                                          <option value="11">Equity+Der+Currency+Commodity+MFSS+SLBM+NBFC</option>
                                          <option value="8">MFSS</option>
                                          <option value="9">SLBM</option>
                                          <option value="0">Equity+Derivative+MFSS+SLBM</option>
                                          <option value="12">Equity+Der+Currency+Commodity+MFSS+SLBM+NBFC+NSE_COM+BSE_COM</option>
                                          <option value="13">Equity+Derivative+Currency+MFSS+SLBM+NSE_COM+BSE_COM (default)</option>
                                       </select>
                                    </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mb-2">
                                    <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                    <div class="mb-3">
                                       <input type="text" class="form-control" name="client_code" value="<?php if(isset($_SESSION['ApbackOffice_code_Client_wise_dr_cr'])){echo $_SESSION['ApbackOffice_code_Client_wise_dr_cr'];}?>" placeholder="Enter Client Code">
                                    </div>
                              </div>
                           </div>
                           
                           <div class="col-md-1">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                              </div>
                           </div>
                         
                        </div>

                     </form>
                     <!-- End Form -->
                  </div>
                  <!-- Start DataTable -->
                  <div class="card-body">
                     <div class="row">
                        <div style="text-align-last: end;">
                           
                        </div>
                        <div style="text-align-last: end;">
                           <a href="<?php echo base_url('Accounts/Client_wise_dr_cr_excel'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                           <a href="<?php echo base_url('Accounts/Client_wise_dr_cr_pdf'); ?>"><img src="<?php echo base_url(); ?>assets/pdf.png" width="25" height="25"></a>
                        </div>
                     </div>
                     <table id="datatable1" class="table table-bordered dt-responsive w-100">
                        <thead>
                           <tr>
                              <!-- <th>A1</th> -->
                              <th>CLIENT NAME</th>
                              <th>CLIENT ID</th>
                              <th>LEDGER</th>
                              <th>Vrtual Block</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($back_data)){
                                 foreach ($back_data as $data_row) {
                              ?>
                           <tr>
                              <!-- <td><?php echo $data_row[0];?></td> -->
                              <td><?php echo $data_row[2];?></td>
                              <td><?php echo $data_row[1];?></td>
                              <td><?php echo $data_row[3];?></td>
                              <td><?php echo $data_row[4];?></td>
                             
                           </tr>
                        <?php } } ?>

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
<script type="text/javascript">
   $(document).ready( function () {
      $('#datatable1').DataTable( {
      responsive: true
      } );
} );
</script>