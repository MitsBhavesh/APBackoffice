<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- <?php print_r($res_ipo_list);?> -->
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         
           <?php include("alert.php"); ?>
         <div class="row">
            <div class="col-xl-12">
               <div class="card border-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                     <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-print me-3"
                        style="color: #ffff;"></i>Physical IPO</h6>
                  </div>
                  <div class="card-body">
                     <div class="row">
                         <div class="col-12">
                            Branch Code:<span
                                                        style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- <h4 class="mt-0 header-title" style="text-align:center">IPO Bulk File</h4> -->
                            <form method="POST" action="<?php echo base_url(); ?>IPO/Read_Data" class="card-box" enctype="multipart/form-data" onsubmit="return ipo_validation();">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_name">IPO </label>
                                        <select name="bulk_ipo_name" id="bulk_ipo_name" class="form-select"  >
                                            <option value="Please Select IPO">Please Select IPO</option>
                                            <!-- <option value="JUPITER">JUPITER</option>
                                            <option value="EMS">EMS</option> -->
                                            <!-- <option value="CONCORD">CONCORD</option> -->
                                            <!-- <option value="IKIO">IKIO</option> -->
                                            <!-- <option value="NXST">NXST</option> -->
                                            <!-- <option value="MANKIND">MANKIND</option> -->
                                            <!-- <option value="AVALON">AVALON</option> -->
                                            <!-- <option value="USK">USK</option> -->
                                             <!-- <option value="GSLSU">GSLSU</option> -->
                                            <?php
                                            foreach ($res_ipo_list as $ipo_list_value)
                                            {

                                            foreach ($ipo_list_value as $value)
                                            {  
                                            ?>
                                            <option value="<?php echo $value['symbol']; ?>">
                                            <?php echo $value['symbol'];?>
                                            </option>
                                        <?php
                                        }
                                        }
                                        ?>
                                        </select>
                                        <small class="text-muted form-text" id="error_bulk_ipo_name" style="color: red !important;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_qty">Quantity </label>
                                        <select name="bulk_ipo_qty" id="bulk_ipo_qty" class="form-select"></select>
                                        <small class="text-muted form-text" id="error_bulk_ipo_qty" style="color: red !important;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_price">Price</label>
                                        <input type="text" class="form-control" id="bulk_ipo_price" name="bulk_ipo_price" readonly required >
                                        <small class="text-muted form-text" id="error_bulk_ipo_price" style="color: red !important;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_Amount">Amount</label>
                                        <input type="text" class="form-control" id="bulk_ipo_Amount" name="bulk_ipo_Amount"  readonly="">
                                        <small class="text-muted form-text" id="error_bulk_ipo_Amount" style="color: red !important;"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-md-3 form-group">
                                        <label for="online_sub_category">Sub Category</label> 
                                                    <select id="online_sub_category" class="form-select" name="online_sub_category">
                                          <option value="Select sub-category">Select sub-category</option>
                                          <option value="IND" selected>INDIVIDUAL</option>
                                          <!-- <option value="POL" id="polid" disabled="">POLICY</option> -->
                                          <option value="HNI">HNI</option>
                                          <!-- <option value="SHA">SHAREHOLDER</option> -->
                                          <!-- <option value="FI">BANKS AND FINANCIAL INSTITUTIONS</option> -->
                                          <!-- <option value="IC">INSURANCE COMPANIES</option> -->
                                          <!-- <option value="MF">MUTUAL FUNDS</option> -->
                                          <!-- <option value="FII">FII</option> -->
                                          <!-- <option value="OTH">OTHERS</option> -->
                                          <!-- <option value="CO">CO-BODIES CORPORATE</option> -->
                                          <!-- <option value="NOH">NOH</option> -->
                                          <!-- <option value="EMP">EMPLOYEE</option> -->
                                          <!-- <option value="POL">POLICY</option> -->
                                       </select>
                                         <small class="text-muted form-text" id="error_bulk_ipo_category" style="color: red !important;"></small>
                                    </div>
                                    <div class=" col-md-3 form-group">
                                        <label for="bulk_ipo_upload_csv_file">Upload <b>.CSV</b> file </label>
                                        <div class="input-group">
                                            <input type="file" name="bulk_ipo_file" id="bulk_ipo_file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            
                                        </div>
                                        <span style="color: #cc3333 !important;">Note: Only allowed .CSV File.</span>
                                        <small class="text-muted form-text" id="error_bulk_ipo_file" style="color: red !important;"></small>
                                    </div>
                                    <div class="col-md-2 form-group" style="align-self: center;">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-primary">Upload File </button>  
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="download demo">Download Demo File</label>
                                        <div class="input-group">
                                            <a href="<?php echo base_url()?>assets/demo.csv" download><i class="mdi mdi-file-excel" aria-hidden="true" style="color: green;margin-top: auto;font-size: 25px;"></i></a>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                           <div class="alert alert-warning mb-0" >
                              <h6 class="alert-heading mt-0 font-11">Note : </h6>
                              <p>IPO Series Provide Only Arhamshare. (Please Contact to IPO Department.)</p>
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

function get_ipo_new()
{
    // alert("asdsad");
    // return false;
  var off_ipo = document.getElementById("bulk_ipo_name").value;   //offline ipo

  $("#polid").attr('disabled', true); 
   if(off_ipo == "LICI")
   {
      $("#polid").attr('disabled', false); 
   }
   else
   {
      // $("#online_sub_category").val('IND');
   }
  // alert(off_ipo); return false;
   if(off_ipo == "Please Select IPO")
   {
      $('#bulk_ipo_qty').html("");
       $('#bulk_ipo_price').val("");
        $('#bulk_ipo_Amount').val(""); 
        document.getElementById('error_bulk_ipo_name').innerHTML = "Please Select IPO";
        return false;
   }
   else
    {
        var sub_cat = document.getElementById('online_sub_category').value;
        // alert(sub_cat);
        // alert(off_ipo);
        // alert(sub_cat); return false;
        //Price
          $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>IPO/Ipo_Price",
           data: { off_ipo:off_ipo},
           success: function(data1){
           // alert(data1);
            $('#bulk_ipo_price').val(data1); 
             
              ipo_validation();
              $("#bulk_ipo_price").val(data1);

                if(sub_cat == "IND" && off_ipo == "ADANIENTPP")
                {
                    $('#bulk_ipo_price').val('1574');
                }
                // if(off_ipo == "GSLSU")
                // {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('140');
                //     }
                // }
                // if(off_ipo == "CONCORD")
                //   {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('741');
                //     }
                //     // mul_amt();
                //   }
                  // if(off_ipo == "JUPITER")
                  // {
                  //   if(sub_cat == "IND" || sub_cat =="HNI")
                  //   {
                  //       $('#bulk_ipo_price').val('735');
                  //   }
                  //   // mul_amt();
                  // }
                  // if(off_ipo == "EMS")
                  // {
                  //   if(sub_cat == "IND" || sub_cat =="HNI")
                  //   {
                  //       $('#bulk_ipo_price').val('211');
                  //   }
                  //   // mul_amt();
                  // }


                // if(off_ipo == "IKIO")
                //   {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('285');
                //     }
                //   }
                // if(off_ipo == "NXST")
                //   {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('100');
                //     }
                //   }
                // if(off_ipo == "MANKIND")
                //   {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('1080');
                //     }
                //   }
                // if(off_ipo == "USK")
                // {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('35');
                //     }
                // }
                // if(off_ipo == "AVALON")
                // {
                //     if(sub_cat == "IND" || sub_cat =="HNI")
                //     {
                //         $('#bulk_ipo_price').val('436');
                //     }
                // }
                mul_amt(); 
               if(off_ipo == "LICI")
               {
                // alert(sub_cat);
                  if(sub_cat == "IND")
                  {
                    $("#bulk_ipo_price").attr('readonly', true); 
                    // $("#bulk_ipo_price").val(data1 - 45);
                  }
                  else if (sub_cat == "HNI")
                  {
                    $('#bulk_ipo_price').val(data1); 
                  }
                  else
                  {
                    $("#bulk_ipo_price").attr('readonly', true); 
                    // $("#bulk_ipo_price").val(data1 - 60);
                  }
               }
              
              }
          });
          
          if(sub_cat == 'HNI')
          {
            $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>IPO/HNI_QTY_SERIES",
           data: { off_ipo:off_ipo,sub_cat:sub_cat},
           success: function(data){
           // alert(data);
           // document.write(data);
           $('#bulk_ipo_qty').html(data);  // show data in user/ipo.php hni
           mul_amt();
           ipo_validation();
              } 
          });

            mul_amt();
        }
        else
        {
    // alert("12345");
           //Qty 
          $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>IPO/Ipo_Qty",
           data: { off_ipo:off_ipo},
           success: function(data){
           // alert(data);
           // document.write(data);
           $('#bulk_ipo_qty').html(data);  // show data in user/ipo.php
            // $('#bulk_ipo_qty').html('<option>100</option>,<option>200</option>,<option>300</option>,<option>400</option>,<option>500</option>,<option>600</option>,<option>700</option>,<option>800</option>,<option>900</option>,<option>1000</option>,<option>1100</option>,<option>1200</option>,<option>1300</option>,<option>1400</option>'); //GLSUR
            // $('#bulk_ipo_qty').html('<option>428</option>,<option>856</option>,<option>1284</option>,<option>1712</option>,<option>2140</option>,<option>2568</option>,<option>2996</option>,<option>3424</option>,<option>3852</option>,<option>4280</option>,<option>4708</option>,<option>5136</option>,<option>5564</option>');   //USK
            // $('#bulk_ipo_qty').html('<option>428</option>,<option>856</option>,<option>1284</option>,<option>1712</option>,<option>2140</option>,<option>2568</option>,<option>2996</option>,<option>3424</option>,<option>3852</option>,<option>4280</option>,<option>4708</option>,<option>5136</option>,<option>5564</option>');   //AVALON
            // $('#bulk_ipo_qty').html('<option>13</option>,<option>26</option>,<option>39</option>,<option>52</option>,<option>65</option>,<option>78</option>,<option>91</option>,<option>104</option>,<option>117</option>,<option>130</option>,<option>143</option>,<option>156</option>,<option>169</option>,<option>182</option>');  //MANKIND
            // $('#bulk_ipo_qty').html('<option>150</option>,<option>300</option>,<option>450</option>,<option>600</option>,<option>750</option>,<option>900</option>,<option>1050</option>,<option>1200</option>,<option>1350</option>,<option>1500</option>,<option>1650</option>,<option>1800</option>,<option>1950</option>');  //NEXUS
           // $('#bulk_ipo_qty').html('<option>52</option>,<option>104</option>,<option>156</option>,<option>208</option>,<option>260</option>,<option>312</option>,<option>364</option>,<option>416</option>,<option>468</option>,<option>520</option>,<option>572</option>,<option>624</option>,<option>676</option>');  //IKIO
              // if(off_ipo == 'CONCORD')
              // {
              //   $('#bulk_ipo_qty').html('<option>20</option>,<option>40</option>,<option>60</option>,<option>80</option>,<option>100</option>,<option>120</option>,<option>140</option>,<option>160</option>,<option>180</option>,<option>200</option>,<option>220</option>,<option>240</option>,<option>260</option>');  //CONCORD
              // }
           // if(off_ipo == 'JUPITER')
           // {
           //  $('#bulk_ipo_qty').html('<option>20</option>,<option>40</option>,<option>60</option>,<option>80</option>,<option>100</option>,<option>120</option>,<option>140</option>,<option>160</option>,<option>180</option>,<option>200</option>,<option>220</option>,<option>240</option>,<option>260</option>');  //JUPITER
           // }
           // if(off_ipo == 'EMS')
           // {
           //  $('#bulk_ipo_qty').html('<option>70</option>,<option>140</option>,<option>210</option>,<option>280</option>,<option>350</option>,<option>420</option>,<option>490</option>,<option>560</option>,<option>630</option>,<option>700</option>,<option>770</option>,<option>840</option>,<option>910</option>');  //JUPITER
           // }
           mul_amt();
           ipo_validation();
              } 
          });


          mul_amt();
       }
  }
}

function mul_amt()
    {
      var off_qty = document.getElementById("bulk_ipo_qty").value;
      var off_price = document.getElementById("bulk_ipo_price").value;

      // alert(off_qty);
      var amt = off_qty * off_price;
       // alert(amt);
      $('#bulk_ipo_Amount').val(amt); 
}

    

function ipo_validation() 
{
    var off_ipo = document.getElementById("bulk_ipo_name").value;   //offline ipo
    var file_upload = document.getElementById('bulk_ipo_file').value;

    var error = 0;
  // alert(off_ipo); return false;
   if(off_ipo == "Please Select IPO")
   {
      $('#bulk_ipo_qty').html("");
        $('#bulk_ipo_price').val("");
            $('#bulk_ipo_Amount').val(""); 
        document.getElementById('error_bulk_ipo_name').innerHTML = "Please Select IPO";
        // return false;
        error++;
   }
   else
   {
    document.getElementById('error_bulk_ipo_name').innerHTML = "";
   } 

   //online qty
    var qty = document.getElementById('bulk_ipo_qty').value;
    if(qty  == "")
    {
    document.getElementById('error_bulk_ipo_qty').innerHTML = "Please Select Quantity";
    error++;
    }
    else
    {
     document.getElementById('error_bulk_ipo_qty').innerHTML = "";

    }
    //online Bid Price
    var bid_price = document.getElementById('bulk_ipo_price').value;
    if(bid_price  == "")
    {
    document.getElementById('error_bulk_ipo_price').innerHTML = "Please Enter Bid Price";
    error++;
    }
    else
    {
    document.getElementById('error_bulk_ipo_price').innerHTML = "";
    } 

    //online Bid Amount
    var bid_amount = document.getElementById('bulk_ipo_Amount').value;
    if(bid_amount  == "")
    {
    document.getElementById('error_bulk_ipo_Amount').innerHTML = "Please Enter Bid Amount";
    error++;
    }
    else
    {
    document.getElementById('error_bulk_ipo_Amount').innerHTML = "";
    }   
    
    if (file_upload == "")
   {
    document.getElementById('error_bulk_ipo_file').innerHTML = "Upload File";
      error++;
      // return false;
   }
   else
   {
        document.getElementById('error_bulk_ipo_file').innerHTML = "";
   }

   var sub_cat = document.getElementById('online_sub_category').value;
    // alert(off_ipo);
    // alert(sub_cat); return false;
    if(sub_cat == 'HNI')
    {
        error = 0;
    }
    
   if(error != 0)
   {
    return false;
   }
   else
   {
    return true;
   }
   
}


$("#bulk_ipo_qty").on('change', function(){
        mul_amt();          //if qty change then chang ipo amt
    });
    // $("#bulk_ipo_name").on('change', function(){
    //  get_ipo();          //if qty change then chang ipo amt
    // });
$('#bulk_ipo_name').change(function(){
    // alert("chage");
// get_ipo_new();
get_ipo_new();
});
$('.form-control').keyup(function(){
    // alert("keyup");
ipo_validation();
// get_ipo();
});
$('.form-control').change(function(){
    // alert("chage");
ipo_validation();
// get_ipo();
});
$('#online_sub_category').change(function(){
    // alert("chage");
get_ipo_new();
// get_ipo();
});
</script>