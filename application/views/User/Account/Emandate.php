<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <?php include("alert.php"); ?>
         <div class="row">
            <div class="col-12">
               
                  <div class="col-xl-12">
                     <div class="tab-content text-muted mt-xl-0" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-price-one" role="tabpanel"
                           aria-labelledby="v-pills-tab-one">
                           <div class="row">
                              <div class="col-sm-6">
                              <div class="card">
                                 <div class="card-header"
                                    style="background-color: #0b5639!important;padding: 9px!important;">
                                    <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-layer-group me-3"
                                       style="color: #ffff;"></i>e-Mandate Physical</h6>
                                 </div>
                                 <div class="card-header align-items-center d-flex">
                                    <!-- Start Form -->
                                    <form method="post"
                                       action="<?php echo base_url();?>Accounts/Emandate_physical" enctype="multipart/form-data">
                                       <div class="row card-title mb-0 flex-grow-1">
                                          <div class="col-md-12">
                                             <div class="mb-2">
                                                <label class="form-label"
                                                   for="formrow-todate-input">Client Code:</label>
                                                <div class="mb-3">
                                                   <input type="text" class="form-control"
                                                      name="client_code" id="client_code"
                                                      value="<?php if(isset($_SESSION['ApbackOffice_client_code_emandate'])){echo $_SESSION['ApbackOffice_client_code_emandate'];}?>"
                                                      placeholder="Enter client code" required>
                                                </div>
                                                <span style="color:red;" id="client_name_error"></span>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="mb-2">
                                                <label class="form-label"
                                                   for="formrow-todate-input">Bank A/C:</label>
                                                <select name="physical_bank_emandate" id="physical_bank_emandate" class="form-select">
                                                   <option value="0">Select valid bank</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="mb-2">
                                                <label class="form-label"
                                                   for="formrow-todate-input">Amount:</label>
                                                <input type="text" class="form-control"
                                                   name="physical_Amount" id="physical_Amount" required>
                                             </div>
                                             <small style="color:red;" id="client_Amount_error"></small>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="mb-3" style="padding-top: 30px;">
                                                <button type="submit" name="btn_submit" id="btn_submit_mandate" class="btn btn-primary w-md"
                                                   style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                    <!-- End Form -->
                                 </div>
                              </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="card">
                                 <div class="tab-content text-muted mt-xl-0" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-price-one" role="tabpanel"
                                       aria-labelledby="v-pills-tab-one">
                                       <div class="row">
                                          <div class="col-xl-12">
                                             <div class="card-header"
                                                style="background-color: #0b5639!important;padding: 9px!important;">
                                                <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-layer-group me-3"
                                                   style="color: #ffff;"></i>e-Mandate Online</h6>
                                             </div>
                                             <div class="card-header align-items-center d-flex">
                                                <!-- Start Form -->
                                                <form method="post"
                                                   action="<?php echo base_url();?>Accounts/Emandate_online" enctype="multipart/form-data">
                                                   <div class="row card-title mb-0 flex-grow-1">
                                                      <div class="col-md-12">
                                                         <div class="mb-2">
                                                            <label class="form-label"
                                                               for="formrow-todate-input">Client Code:</label>
                                                            <div class="mb-3">
                                                               <input type="text" class="form-control"
                                                                  name="client_code_online" id="client_code_online"
                                                                  value="<?php if(isset($_SESSION['ApbackOffice_client_code_emandate'])){echo $_SESSION['ApbackOffice_client_code_emandate'];}?>"
                                                                  placeholder="Enter client code" required>
                                                            </div>
                                                            <small style="color:red;" id="client_name_error_online"></small>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                         <div class="mb-2">
                                                            <label class="form-label"
                                                               for="formrow-todate-input">Bank A/C:</label>
                                                            <select name="bank_account_emandate" id="physical_bank_emandate_online" class="form-select">
                                                               <option value="0">Select valid bank</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                         <div class="mb-2">
                                                            <label class="form-label"
                                                               for="formrow-todate-input">Amount:</label>
                                                            <input type="text" class="form-control"
                                                               name="online_bank_amount" id="physical_Amount_online" required>
                                                         </div>
                                                         <small style="color:red;" id="client_Amount_error_online">Note:Amount enter for example: 100.00</small>
                                                      </div>
                                                      <div class="col-md-12">
                                                         <input type="radio" id="Debit" name="emandate_channel" value="Debit">
                                                         <label for="Debit">Debit</label>
                                                         <input type="radio" id="Net" name="emandate_channel" value="Net" checked>
                                                         <label for="Net">Net Banking</label><br>
                                                      </div>
                                                      <div class="col-md-12">
                                                         <div class="mb-3" style="padding-top: 30px;">
                                                            <button type="submit" name="btn_submit_mandate_online" id="btn_submit_mandate_online" class="btn btn-primary w-md"
                                                               style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </form>
                                                <!-- End Form -->
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
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $("#client_code").on('change', function() {
   
           var client_code = $(this).val().toUpperCase();
           // Start ajax
           $('#physical_bank_emandate').empty();
           $('#physical_Amount').empty();
           $.ajax({
               // Make sure this is the correct path
               url: "<?php echo base_url();?>Accounts/client_bank_data2",
               type: "POST",
               data: {
                   client_code: client_code
               },
               success: function(response) {
   
                   if(response==="0")
                   {
                       $('#client_name_error').html("Invalid Client Code");
                       return false;
                   }
                   else
                   {
                        $('#client_name_error').html("");
                       $('#physical_bank_emandate').append(response);
                   }
               }
           });
       });
       $("#physical_Amount").on('change', function() {
           var off_emandate_error = 0;
           var offline_amt_emandate = document.getElementById('physical_Amount').value;
   
           if(!/^[-+]?[0-9]+\.[0-9]+$/.test(offline_amt_emandate))
           {
             // alert(offline_amt_emandate);
             // document.getElementById('client_Amount_error').innerHTML = "Invalid Amount Please Enter Amount Type 100.00";
             off_emandate_error++;
           }
           else
           {
             document.getElementById('client_Amount_error').innerHTML = "";
           }
           if(off_emandate_error !== 0)
           {
            $( "#btn_submit_mandate" ).prop( "disabled", false );
             return false;
           }
           else
           {
             return true;
           } 
       });
   });
   $(document).ready(function() {
       $("#client_code_online").on('change', function() {
   
           var client_code_online = $(this).val().toUpperCase();
           // alert('hi');
           // Start ajax
           $('#physical_bank_emandate_online').empty();
           $('#physical_Amount_online').empty();
           $.ajax({
               // Make sure this is the correct path
               url: "<?php echo base_url();?>Accounts/client_bank_data2_online",
               type: "POST",
               data: {
                   client_code_online: client_code_online
               },
               success: function(response_online) {
                     // alert(response_online);
                   if(response_online==="0")
                   {
                       $('#client_name_error_online').html("Invalid Client Code");
                       return false;
                   }
                   else
                   {
                        $('#client_name_error_online').html("");
                       $('#physical_bank_emandate_online').append(response_online);
                   }
               }
           });
       });
       $("#physical_Amount_online").on('change', function() {
           var off_emandate_error_online = 0;
           var offline_amt_emandate_online = document.getElementById('physical_Amount_online').value;
   
           if(!/^[-+]?[0-9]+\.[0-9]+$/.test(offline_amt_emandate_online))
           {
             // alert(offline_amt_emandate);
             // document.getElementById('client_Amount_error').innerHTML = "Invalid Amount Please Enter Amount Type 100.00";
             off_emandate_error_online++;
           }
           else
           {
             document.getElementById('client_Amount_error_online').innerHTML = "";
           }
           if(off_emandate_error_online !== 0)
           {
            $( "#btn_submit_mandate_online" ).prop( "disabled", false );
             return false;
           }
           else
           {
             return true;
           } 
       });
   });
</script>