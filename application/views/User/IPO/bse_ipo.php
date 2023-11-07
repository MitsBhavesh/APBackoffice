<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->


<?php
// print_r($ipo_data);
// exit();
?>
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
      
           <?php include("alert.php"); ?>
         <div class="row">
            <div class="col-xl-12">
               <div class="card border-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                     <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-connection me-3"
                        style="color: #ffff;"></i>Apply Online IPO</h6>
                  </div>
                  <div class="card-body">
                     Branch Code:<span
                                                        style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                      <div class="row">
                        <div class="col-md-12">
                           <div class="alert alert-warning mb-0" >
                              <h6 class="alert-heading mt-0 font-11">Note : </h6>
                              <p>IPO window will remain open from 10 AM till 5:00 PM on trading days. You can accept the UPI mandate request till noon one day after the IPO window closes. If you don't receive the UPI request till the end of the day due to delays from the bank, Kindly delete and apply again.</p>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <form method="post" id ="myform1" action="<?php echo base_url('BSE_IPO/BidData')?>" name="update_profile" enctype="multipart/form-data" onsubmit="return bk_online_validation();">
                                                         <div class="row">
                                                            <div class="col-lg-6">
                                                               <div class="card m-b-30">
                                                                  <div class="card-body">
                                                                     <div class="modal bs-example-modal" tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog" role="document" style="margin-top: 1px;">
                                                                           <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                 <h5 class="modal-title mt-0">IPO Details</h5>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                 <fieldset class="form-group">
                                                                                     <label for="online_ipo">Client Code</label>
                                                                                    <input type="text" class="form-control client_code_check" id="client_code" placeholder="Enter client code" name="client_code">
                                                                                    <small style="color:red;font-size: 15px;" id="client_code_error"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_ipo">IPO </label>
                                                                                   <select name="online_ipo" id="online_ipo" class="form-select">
                                                                                       <option value="Please Select BSE IPO" disabled selected>Please Select BSE IPO</option>
                                                                                               <?php
                                                                                                // $ipo_data = json_decode($ipo_data);
                                                                                                foreach ($ipo_data as $ipo_list_value)
                                                                                                {
                                                                                                   if ($ipo_list_value->category == "IND" && $ipo_list_value->asbanonasba == 1 && $ipo_list_value->issuetype =='BB')
                                                                                                   { // Book Built Issue IPO  ?>
                                                                                                      <option value="<?php echo $ipo_list_value->symbol;?>">
                                                                                                        
                                                                                                         <?php print_r($ipo_list_value->symbol); ?>
                                                                                                      </option>
                                                                                                   <?php  
                                                                                                   }
                                                                                             } ?>
                                                                                    </select>
                                                                                    <small class="text-muted form-text" id="error_online_ipo" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_qty"> Quantity</label> 
                                                                                    <select name="online_qty" id="online_qty21" class="form-select">
                                                                                    </select>
                                                                                    <small class="text-muted form-text" id="error_online_qty" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <!-- <label for="online_price">Price</label> -->
                                                                                    <div class="custom-control custom-checkbox">
                                                                                       <input type="checkbox" class="custom-control-input on_cut_price on_cut_price_bse" id="customCheck3" checked="">
                                                                                       <label class="custom-control-label" for="customCheck3">Cut-off Price</label>
                                                                                   </div>
                                                                                    <!-- <input type="text" class="form-control" id="online_price" placeholder="Bid Price" name="online_price" value="" readonly> -->
                                                                                    <input type="number" name="online_price" id="online_price"  min="<?php echo $ipo_list_value->ceilingprice ?? '';?>" max="<?php echo $ipo_list_value->floorprice ?? '';?>" class="form-control view_textbox" placeholder="Bid Price" value="" readonly>
                                                                                    <small class="text-muted form-text" id="error_online_price" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_Amount">Amount</label>
                                                                                    <input type="text" class="form-control" id="online_Amount21" placeholder="Bid Amount" name="online_Amount" value="" readonly>
                                                                                    <small class="text-muted form-text" id="error_online_Amount" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                
                                                                                 <fieldset class="form-group"> 
                                                                                    <label for="online_cdsl_Amount"> CDSL Number</label> 
                                                                                    <input type="text" class="form-control txt_online_cdsl_Amount" id="online_cdsl_Amount" placeholder="CDSL Number" style="color:blue;" name="online_cdsl_Amount" readonly>
                                                                                    <small class="text-muted form-text" id="error_online_cdsl_Amount" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <!-- Add Sub Category -->
                                                                                 <fieldset class="form-group"> 
                                                                                    <label for="online_sub_category">Sub Category</label> 
                                                                                    <select id="online_sub_category" class="form-select" name="online_sub_category">
                                                                                       <!-- <option value="Select sub-category">Select sub-category</option> -->
                                                                                       <option value="IND" selected="">INDIVIDUAL</option>
                                                                                       <option value="POL" id="polid" disabled>POLICY HOLDER</option>
                                                                                    </select>
                                                                                    <small class="text-muted form-text" id="err_sub_category" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                  <fieldset class="form-group"> 
                                                                                    <label for="ipotype_bse">BSE IPO Type</label> 
                                                                                    <select id="ipotype_bse" class="form-control" name="ipotype_bse">
                                                                                       <option value="1" selected="">Equity IPO</option>
                                                                                       <option value="2" id="SMEipoid" disabled>SME IPO</option>
                                                                                    </select>
                                                                                    <small class="text-muted form-text" id="err_ipotype_bse" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <!-- <fieldset> 
                                                                                    <input type="text" class="form-control txt_online_nsdl_Amount" id="online_nsdl_Amount1" placeholder="NSDL Number1" name="online_nsdl_Amount1" value="" readonly>
                                                                                    <small class="text-muted form-text" id="error_online_nsdl_Amount1" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                
                                                                                 <fieldset> 
                                                                                    <input type="text" class="form-control txt_online_nsdl_Amount" id="online_nsdl_Amount2" placeholder="NSDL Number2" name="online_nsdl_Amount2" value="" readonly>
                                                                                    <small class="text-muted form-text" id="error_online_nsdl_Amount2" style="color: red !important;"></small>
                                                                                 </fieldset> -->
                                                                              </div>
                                                                           </div>
                                                                           
                                                                        </div>
                                                                        
                                                                     </div>
                                                                      
                                                                  </div>
                                                               </div>
                                                              
                                                            </div>
                                                            
                                                            <div class="col-lg-6">
                                                               <div class="card m-b-30">
                                                                  <div class="card-body">
                                                                     
                                                                     <div class="modal bs-example-modal" tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog" role="document" style="margin-top: 1px;">
                                                                           <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                 <h5 class="modal-title mt-0">Personal Detail</h5>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_pan">Pan</label>
                                                                                    <input type="text" class="form-control online_Pan_Number" placeholder="Enter Pan Number" id="online_Pan_Number" name="online_pan" readonly style="color:blue;">
                                                                                    <small class="text-muted form-text" id="error_online_pan" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_name">Name</label>
                                                                                    <input type="text" class="form-control online_name" id="online_name" placeholder="Enter Name" name="online_name" readonly style="color:blue;">
                                                                                    <small class="text-muted form-text" id="error_online_name" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_mob_no">Mobile Number</label>
                                                                                    <input type="text" class="form-control online_mob_no" id="online_mob_no" placeholder="Enter Mobile Number" name="online_mob_no" readonly style="color:blue;">
                                                                                    <small class="text-muted form-text" id="error_online_mob_no" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_email">Email</label>
                                                                                    <input type="text" class="form-control online_email" id="online_email" placeholder="Enter Email ID" name="online_email" readonly style="color:blue;">
                                                                                    <small class="text-muted form-text" id="error_online_email" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                                 <fieldset class="form-group">
                                                                                    <label for="online_bnk_upi">Bank UPI</label>
                                                                                    <input type="text" class="form-control" id="online_bnk_upi" placeholder="Enter Bank UPI" name="online_bnk_upi" value="" required="">
                                                                                   
                                                                                    <small class="text-muted form-text" id="error_online_bnk_upi" style="color: red !important;"></small>
                                                                                 </fieldset>
                                                                              </div>
                                                                           </div>
                                                                           
                                                                        </div>
                                                                        
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            
                                                         </div>
                                                         <!-- <div class="col-md-12">
                                                            <fieldset class="form-group">
                                                               <div class="custom-control custom-checkbox">
                                                                  <input type="checkbox" class="custom-control-input" id="ipo_terms" required>
                                                                  <label class="custom-control-label" for="ipo_terms">I hereby undertake that I have read the Red Herring Prospectus and I am an eligible UPI bidder as per the applicable provisions of the SEBI (Issue of Capital and Disclosure Requirement) Regulation, 2018.</label>
                                                              </div>
                                                            </fieldset>
                                                            <hr style="margin-bottom: -21px; display: none;">
                                                         </div> -->
                                                         <div class="col-md-12" style="text-align: center;">
                                                            <fieldset class="form-group">
                                                               <hr style="margin: auto; display: none;">
                                                               <button type="submit" class="btn btn-primary glow mr-1 mb-1" name="edit_btn" id="bidding_btn" disabled>Bidding</button>
                                                            </fieldset>
                                                            <hr style="margin-bottom: -21px; display: none;">
                                                         </div>
                            </form>
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

         var client_code = $(this).val();
         // Start ajax
         $('.client_code_check').empty();
         $('.txt_online_cdsl_Amount').empty();
         $('.online_Pan_Number').empty();
         $('.online_name').empty();
         $('.online_mob_no').empty();
         $('.online_email').empty();
         $('#client_code_error').html("");
         $('#bidding_btn').prop('disabled', true);
         $.ajax({
            // Make sure this is the correct path
            url: "<?php echo base_url();?>IPO/Get_data_From_code",
            type: "POST",
            data: {
               client_code: client_code
            },
            success: function(response) {
               // alert(response);
               if(response==0)
               {
                  $('.client_code_check').val("");
                  $('.txt_online_cdsl_Amount').val("");
                  $('.online_Pan_Number').val("");
                  $('.online_name').val("");
                  $('.online_mob_no').val("");
                  $('.online_email').val("");
                  $('#client_code_error').html("Invalid Client Code");
                  $('#bidding_btn').prop('disabled', true);
               }
               else
               {
                  var data = response.replace("[","");
                  var data1 =data.replace("]","");
                  var obj = jQuery.parseJSON(data1);
                  $('#client_code_error').html("");
                  // console.log(obj);
                  $('.txt_online_cdsl_Amount').val(obj.Boid);
                  $('.online_Pan_Number').val(obj.PAN);
                  $('.online_name').val(obj.CLIENT_NAME);
                  $('.online_mob_no').val(obj.mobile);
                  $('.online_email').val(obj.email);
                  $('#bidding_btn').prop('disabled', false);

                }
            }
         });
      });
   });
</script>
<script type="text/javascript">
   
     $("#online_ipo").on('change', function()
     {
        var IPO_name =  document.getElementById('online_ipo').value;
        var IPO_type =  document.getElementById('ipotype_bse').value; //regular or SME
        // alert(IPO_name);
        // return false;
        //BSE ipo qty
        $.ajax({
            type: "POST",
            data: {IPO_name:IPO_name,IPO_type:IPO_type},
            url : "<?php echo base_url('BSE_IPO/Bse_qty');?>",
            success: function(data)
            { 
               // alert(data);
               // document.write(data);
               $('#online_qty21').html(data);
               // $("#online_qty").val(data);
               bse_mul_amt();
            }
         });

      //BSE ipo price
      $.ajax({
         type: "POST",
         data: {IPO_name:IPO_name},
         url : "<?php echo base_url('BSE_IPO/Bse_price');?>",
         success: function(data1)
         { 
            // document.write(data1);
            var obj = JSON.parse(data1);
            // console.log(obj.cuttoff);
            $("#online_price").val(obj.cuttoff);
            // min value and max value of cutoff
            $("#online_price").attr("min",obj.floorprice); //min
            $("#online_price").attr("max",obj.ceilingprice); //max
            // as global = window.var name
            // alert(obj.ceilingprice);
            cutOffPrice = obj.cuttoff;
            maxPrice = obj.ceilingprice;
            bse_mul_amt();

            // checkbox (cutt-off price) cutOffPrice
           
         }
      });
    });

     $(document).on("click", ".on_cut_price_bse", function(){
                 // alert('check');
      if ($("#customCheck3").is(":checked")) {                   
         // alert(cutOffPrice);
         $("#online_price").prop("readonly",true);
         $('#online_price').val(cutOffPrice);
      }
      else {
         // alert("max");
         $("#online_price").prop("readonly",false);
         $('#online_price').val(maxPrice);
      }
      bse_mul_amt();
   });

   // Qty onchange to multiply
    $("#online_qty21").change(function(){
     bse_mul_amt();
   }); 
</script>

<script type="text/javascript">
function bse_mul_amt()
{
   var online_ipo = document.getElementById("online_ipo").value;   //offline ipo
   // alert(online_ipo);
   if(online_ipo != "Please Select BSE IPO")
   {

      var online_qty = document.getElementById("online_qty21").value;
      var online_price = document.getElementById("online_price").value;

      // var total_amount = online_qty * online_price;
      var total_amount = parseFloat(online_qty.replace(/,/g, '')) *
      parseFloat(online_price.replace(/,/g, ''));
      
      $('#online_Amount21').val(total_amount); 

   }
   else
   {
      $('#online_Amount21').val("");   
   }
}

// function  bse_sme_qty()
// {
   
// }
</script>
