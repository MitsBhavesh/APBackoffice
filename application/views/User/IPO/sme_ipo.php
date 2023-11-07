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
                        style="color: #ffff;"></i>SME Physical IPO</h6>
                  </div>
                  <div class="card-body">
                     <div class="row">
                         <div class="col-12">
                            Branch Code:<span
                                                        style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- <h4 class="mt-0 header-title" style="text-align:center">IPO Bulk File</h4> -->
                            <form method="POST" action="<?php echo base_url(); ?>AP_SME_IPO/Get_FileData" class="card-box" enctype="multipart/form-data" onsubmit="return ipo_validation();">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_name">IPO </label>
                                        <select name="sme_ipo_name" id="sme_ipo_name" class="form-select"  >
                                                     <option value="Please Select IPO">Select SME IPO</option>
                                                      <?php
                                                         if ($handle = opendir('//192.168.102.100\e\usermanagement\IPO_PDF\SME_SERIES')) 
                                                         {

                                                                while (false !== ($entry = readdir($handle))) {

                                                                    if ($entry != "." && $entry != "..") 
                                                                    {
                                                                            $arrPath = explode(".", $entry);
                                                                        echo "<option value='".$arrPath[0]."'>".$arrPath[0]."</option>";
                                                                    }
                                                                }

                                                                closedir($handle);
                                                            }
                                                         ?>
                                                        <!-- <option value="<?php echo $value['symbol']; ?>">
                                                         <?php echo $value['symbol'];?>
                                                               </option> -->
                                                               <!-- <option value="Insolation Energy">Insolation Energy</option> -->
                                                         <?php
                                                         //    }
                                                         // }
                                                      ?>
                                                  </select>
                                        <small class="text-muted form-text" id="error_bulk_ipo_name" style="color: red !important;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_qty">Quantity </label>
                                      <select name="sme_ipo_qty" id="sme_ipo_qty" class="form-select" >
                                            
                                           </select>
                                           <small class="text-muted form-text" id="error_sme_ipo_qty" style="color: red !important;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_price">Price</label>
                                       <input type="text" class="form-control" id="sme_ipo_price" name="sme_ipo_price" readonly required  value="">
                                           <small class="text-muted form-text" id="error_sme_ipo_price" style="color: red !important;"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bulk_ipo_Amount">Amount</label>
                                         <input type="text" class="form-control" id="sme_ipo_Amount" name="sme_ipo_Amount"  readonly="">
                                           <small class="text-muted form-text" id="error_sme_ipo_Amount" style="color: red !important;"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-md-3 form-group">
                                        <label for="sme_ipo_type">Exchange </label>
                                           <select name="sme_ipo_type" id="sme_ipo_type" class="form-select" >
                                            <option value="NSE" selected>NSE</option>
                                            <option value="BSE">BSE</option>
                                           </select>
                                           <small class="text-muted form-text" id="error_sme_ipo_qty" style="color: red !important;"></small>
                                    </div>
                                    <div class=" col-md-3 form-group">
                                        <label for="bulk_ipo_upload_csv_file">Upload <b>.CSV</b> file </label>
                                        <div class="input-group">
                                             <input type="file" name="sme_ipo_file" id="sme_ipo_file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            
                                        </div>
                                        <span style="color: #cc3333 !important;">*Note: Only allowed .CSV File.</span>
                                         <small class="text-muted form-text" id="error_sme_ipo_file" style="color: red !important;"></small>
                                    </div>
                                    <div class="col-md-2 form-group" style="align-self: center;">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-primary">Upload File </button>  
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-2 form-group">
                                        <label for="download demo">Download Demo File</label>
                                        <div class="input-group">
                                            <a href="<?php echo base_url()?>assets/demo.csv" download><i class="mdi mdi-file-excel" aria-hidden="true" style="color: green;margin-top: auto;font-size: 25px;"></i></a>
                                        </div>
                                    </div> -->
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

function sme_ipo_data()
{
    // alert("asdsad");
    // return false;
  var off_ipo = document.getElementById("sme_ipo_name").value;   //offline ipo

  // alert(off_ipo); return false;
   if(off_ipo == "Please Select IPO")
   {
      $('#sme_ipo_qty').html("");
       $('#sme_ipo_price').val("");
        $('#sme_ipo_Amount').val(""); 
        document.getElementById('error_sme_ipo_name').innerHTML = "Please Select IPO";
        return false;
   }
   else
    {
        //Qty
          $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>AP_SME_IPO/SME_QTY",
           data: { off_ipo:off_ipo},
           success: function(data1){
           // alert(data1); 
            $("#sme_ipo_qty").html(data1);
              mul_amt();
             }
          });

          //Price
          $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>AP_SME_IPO/SME_Price",
           data: { off_ipo:off_ipo},
           success: function(data1){
           // alert(data1); 
            $("#sme_ipo_price").val(data1);
                mul_amt();
             }
          });
          
      //     if(sub_cat == 'HNI')
      //     {
            // $.ajax({
      //      type: "POST",
      //      url: "<?php echo base_url(); ?>HelpDesk/IPOBulk_PDF/HNI_QTY_SERIES",
      //      data: { off_ipo:off_ipo,sub_cat:sub_cat},
      //      success: function(data){
      //      // alert(data);
      //      // document.write(data);
      //      $('#bulk_ipo_qty').html(data);  // show data in user/ipo.php hni
      //      mul_amt();
      //      ipo_validation();
      //         } 
      //     });

            // mul_amt();
    //  }
    //  else
    //  {
   //   // alert("12345");
      //      //Qty 
      //     $.ajax({
      //      type: "POST",
      //      url: "<?php echo base_url(); ?>HelpDesk/IPOBulk_PDF/Ipo_Qty",
      //      data: { off_ipo:off_ipo},
      //      success: function(data){
      //      // alert(data);
      //      // document.write(data);
      //      $('#sme_ipo_qty').html(data);  // show data in user/ipo.php
      //      mul_amt();
      //      ipo_validation();
      //         } 
      //     });


          mul_amt();
      //  }
  }
}

function mul_amt()
    {
      var off_qty = document.getElementById("sme_ipo_qty").value;
      var off_price = document.getElementById("sme_ipo_price").value;

      // alert(off_qty);
      var amt = off_qty * off_price;
       // alert(amt);
      $('#sme_ipo_Amount').val(amt); 
}

    


$("#sme_ipo_qty").on('change', function(){
        mul_amt();          //if qty change then chang ipo amt
    });

$('#sme_ipo_name').change(function(){
    // alert("chage");
sme_ipo_data();
mul_amt(); 
});
</script>