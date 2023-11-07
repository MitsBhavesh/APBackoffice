<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <?php include("alert.php"); ?>
          <div class="row">
            <div class="col-12">
              <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                      <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-account me-2" style="color:#fff;"></i>Physical KYC</h6>
                  </div>
                  <div class="card-header align-items-center d-flex">
                     <form method="post" action="<?php echo base_url();?>KYC/PhysicalKYC">
                        <div class="row card-title mb-0 flex-grow-1">
                            <div class="col-md-6">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Mobile Number:</label>
                                 <div class="mb-3">
                                   <input type="text" class="form-control" name="kyc_mob_no" required="" value="" pattern="[1-9]{1}[0-9]{9}" title="Invalid mobile number" maxlength="10">
                                 </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Email Id:</label>
                                 <div class="mb-3">
                                   <input type="email" class="form-control" name="kyc_email" required="" value="">
                                 </div>
                              </div>
                            </div>
                           <div class="col-md-6">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_acc_opn" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                              </div>
                           </div>
                        </div> 
                     </form>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="card-body">
                        <label for="" >KYC MODIFICATION</label>
                        <a href="http://192.168.102.203:81/eKYC_P/SignIn" class="btn btn-primary mr-2 ml-2" target="_blank"> KYC MODIFICATION</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>