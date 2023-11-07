<?php
if(isset($_SESSION['APBackOffice_client_holding_data']))
{
   $columns=$_SESSION['APBackOffice_client_holding_data'][0];
   $back_data=$_SESSION['APBackOffice_client_holding_data'][1];
   // echo "<pre>";
   // echo "jfghklfgl";exit();
   // print_r($_SESSION['APBackOffice_client_holding_data']);exit();
}
// print_r($back_data);
// exit;
if(isset($_SESSION['APBackOffice_client_client_master_data']))
{
    $clientmaster_columns = $_SESSION['APBackOffice_client_client_master_data'][0];
    $clientmaster_back_data = $_SESSION['APBackOffice_client_client_master_data'][1];

    // echo "<pre>"; 
    // print_r($clientmaster_columns); 
    // print_r($clientmaster_back_data); 
    // echo "</pre>"; 
    // exit(); 

    // print_r($back_data[0][19].$back_data[0][21]);
    // exit();
}
if(isset($_SESSION['APBackOffice_client_global_summary_data']))
{
    $columns_global_summary = $_SESSION['APBackOffice_client_global_summary_data'][0];
    $back_data_global_summary = $_SESSION['APBackOffice_client_global_summary_data'][1];
    // echo "<pre>";
    // print_r($columns_global_summary);
    // print_r($back_data_global_summary);
    // exit();
    if(!empty($back_data_global_summary))
    {
        $Net_Rate = array_column($back_data_global_summary, 9,34);
    }
    else
    {
        $Net_Rate = array();   
    }
    // echo "<pre>";
    // print_r($Net_Rate);
    // exit();
}
if(isset($_SESSION['APBackOffice_User_Session_Data']))
{  
  
   $ClientCode=$_SESSION['APBackOffice_User_Session_Data'];
    // print_r($ClientCode);exit();
   // $ClientCode=$_SESSION['APBackOffice_User_Session_Data'];
}
// print_r($ClientCode);exit();
// ++++++++++++++++++++ Start Get the file data in array ++++++++++++++++++++
$var = 0;
// $today_date=date('dmY');
$today_date=date('dmY');
$trg_count = 1;
while($var != 1 && $trg_count != 10) {
// $target_dir="E:/TestFile/APPSEC_COLLVAL_".$today_date.".csv";
$target_dir="E:/PLEDGE/Pledge_AP/Pledge_file/APPSEC_COLLVAL_".$today_date.".csv";
// print_r($target_dir);return;
    if(file_exists($target_dir))
    {
        // echo "hiii";
        if (($open = fopen($target_dir, "r")) !== FALSE) 
        {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
            {        
                $array[] = $data; 
            }
            fclose($open);
        }
        // echo "<pre>";
        // echo "Today <br><br>";
        // print_r($array);
        // break;

    }
    else
    {
        $date = date('Y-m-d');
        $today_date = date('dmY', strtotime($date. ' - '.$trg_count.' days'));
        // echo $today_date;
        // echo "<br>";
    }
  $trg_count++;
} 
// ++++++++++++++++++++ End Get the file data in array ++++++++++++++++++++

// ++++++++++++++++++++ Start Mutual fund file get data file ++++++++++++++++++++
// $KYC_db = $this->load->database('margin_pledge', TRUE);
// foreach ($back_data as $value_app_bk) {
//     // print_r($value_app_bk);
//     // exit;
//     $dbisin_query="EXEC Proc_GetMarginIsinMfValue '".$value_app_bk[9]."'";
//     $dbisin_result =$KYC_db->query($dbisin_query)->result_array();
//     // print_r($dbisin_result);
//     if(!empty($dbisin_result))
//     {
//         // echo "asdsadsadad<br>";
//         $app_arr_to_pledge = array($value_app_bk[9],'0','0','0',$dbisin_result[0]['HAIRCUT'],$dbisin_result[0]['NetAsset_Value']);
//         array_push($array, $app_arr_to_pledge);
//     }
//     // break;
// }
// // print_r($array);
// // exit;
// ++++++++++++++++++++ End Mutual fund file get data file ++++++++++++++++++++++
?>

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- end page title -->
         <?php include("alert.php"); ?>
      <!-- Start Margin Pledge Model Success, Failed, Pledge Request-->
             <!-- Start Success Model -->
              <?php 
                 if(isset($_SESSION['APBackOffice_Success_MarginPledge']))
                 {
              ?>
                   <!-- <div class="modal fade successbs-example-modal-center" id="Margin_pledge_successmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title mt-0" >Margin Pledge Process Success!</h5>
                                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <br>
                                  <i class="fa fa-check-square-o" style="color: #54cc96;font-size: 50px;padding-bottom: 10px; margin: auto;"></i>
                                  <p style="margin: auto;">&bull; RequestID : <?php print_r($_SESSION['APBackOffice_Success_MarginPledge']); ?>  </p>  
                                  <p style="margin: auto;">&bull; Margin Pledge Request is successful .</p>
                          </div>
                      </div>
                    </div> -->
                    <div class="modal fade" id="Margin_pledge_successmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Margin Pledge Process Success!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <br>
                                <i class="fa fa-check-square-o" style="color: #54cc96;font-size: 50px;padding-bottom: 10px; margin: auto;"></i>
                                <p style="margin: auto;">&bull; RequestID : <?php print_r($_SESSION['APBackOffice_Success_MarginPledge']); ?>  </p>  
                                <p style="margin: auto;">&bull; Margin Pledge Request is successful .</p>
                               
                            </div>
                        </div>
                    </div>
              <?php
                    // unset($_SESSION['APBackOffice_Success_MarginPledge']);
                 }
              ?>
            <!-- End Success Model-->
            <!-- Start Failed Model -->
              <?php 
               if(isset($_SESSION['APBackOffice_Danger_MarginPledge']))
               {
            ?>
                <!--  <div class="modal fade failedbs-example-modal-center" id="margin_pledge_failmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            
                                <h5 class="modal-title mt-0" >Margin Pledge Not Processed</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <br>
                            <i class="fa fa-window-close-o" style="color: #f18888;font-size: 50px;padding-bottom: 10px; margin: auto;"></i>
                           
                            <p style="margin: auto;">&bull; Error Message : <?php print_r($_SESSION['APBackOffice_Danger_MarginPledge']); ?>  </p> 
                            
                            <p style="margin: auto;">&bull;Your margin pledge could not be processed.</p>
                            
                        </div>
                    </div>
                  </div> -->
                   <div class="modal fade" id="margin_pledge_failmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Margin Pledge Not Processed</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <br>
                                <i class="fa fa-window-close-o" style="color: #f18888;font-size: 50px;padding-bottom: 10px; margin: auto;"></i>
                               
                                <p style="margin: auto;">&bull; Error Message : <?php print_r($_SESSION['APBackOffice_Danger_MarginPledge']); ?>  </p> 
                                
                                <p style="margin: auto;">&bull;Your margin pledge could not be processed.</p>
                            </div>
                        </div>
                    </div>
            <?php
                  unset($_SESSION['APBackOffice_Danger_MarginPledge']);
               }
            ?>
            <!-- End Failed Model -->
            <!-- Start New Multi Pledge Model -->
              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title mt-0" id="myLargeModalLabel">
                                 <label for="html" style="border: unset;font-size: 16px;">CONFIRM PLEDGE</label>
                                     <?php if(isset($pleadge_not_found)){ echo "Pledge not found!"; } ?>
                             </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                           <form method="post" id="myform" action="<?php echo base_url('KYC/MarginPledge_Request')?>" enctype="multipart/form-data" onsubmit="return validation_of_PledgeReasonCode();">
                             <div class="modal-body">
                                 <div class="table-responsive">
                                     
                                     <table class="table table-striped mb-0" id="model_table">
                                         <thead>
                                             <tr>
                                                 <th>Scrip Name</th>
                                                 <th>Qty</th>
                                                 <th>Pledge Qty</th>
                                                 <th>Total value</th>
                                                 <th>Pledged value</th>
                                                 <th style="display:none;">scrip name</th>
                                             </tr>
                                         </thead>
                                         <tbody class="FinalPledgeModal">
                                            
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                             <div class="modal-footer"> 
                             <!--    <div style="padding-right: 500px;" class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="pledge_reason" name="pledge_reason" value="04" data-parsley-multiple="groups" data-parsley-mincheck="2" onchange="alert('Margin Pledge for trading on the Stock Exchange')">
                                    <label class="custom-control-label" for="pledge_reason" style="color:#354f4a;float: left;"><p style="display: table-cell;width: 1px;white-space: nowrap;">Pledge Reason</p></label>
                                    
                                
                                    <small id="esign_closeaccount_error" style="color: red;margin-left: -23px;"></small>
                                </div> -->
                                <div style="padding-right: 500px;">
                                    <input type="checkbox" class="custom-control-input" id="pledge_reason" name="pledge_reason" value="04" data-parsley-multiple="groups" data-parsley-mincheck="2" onchange="alert('Margin Pledge for trading on the Stock Exchange')">
                                    <label class="custom-control-label" for="pledge_reason"><p>Pledge Reason</p></label>

                                    <small id="esign_closeaccount_error" style="color: red;"></small>
                                </div>
                                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary" id="btn_plg_submit">Pledge</button>
                             </div>
                         </form>
                      </div>
                  </div>
              </div>
         <!-- End Margin Pledge  Model Success, Failed, Pledge Request-->
         <div class="row">
            <div class="col-12">
               <div class="card">
                <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-margin me-2" style="color:#fff;"></i>Margin Pledge</h6>
                        </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>KYC/margin_pledge">
                        <div class="row card-title mb-0 flex-grow-1">
                           <div class="col-md-6">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                 <div class="mb-3">
                                
                                   <input type="text" class="form-control" name="client_code" required="" value="<?php if(isset($_SESSION['APBackOffice_User_Session_Data'][9])){ print_r($_SESSION['APBackOffice_User_Session_Data'][9]);}?>">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_margin" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
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
                     <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px; ">
                        <thead>
                           <tr>
                              <th>Scrip Name</th>
                              <th>ISIN</th>
                              <th>POA</th>
                              <th>NONPOA</th>
                              <th>Margin</th>
                              <th>Net</th>
                              <th>Net Rate</th>
                              <th>Closing Price</th>
                              <th>Amount</th>
                              <th>Margin Pledge</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $i = 0;
                              $colqty = 0;
                              $inshort = 0;
                              $outshort = 0;
                              $net = 0;
                              $scriptvalue = 0;
                              $amount = 0;
                              $broker_t = 0;
                              $nonpoa = 0;
                              $poa = 0;
                              //add empty($array) for blank array
                              // print_r($back_data);
                              if(isset($back_data) && !empty($array))
                              {
                              $temp_back_data = $back_data;
                              foreach ($temp_back_data as $key_index => $data_row) {
                                // print_r($data_row);
                              foreach ($array as $value) {
                               // echo "<br>";
                               // print_r($temp_back_data[$i][9]);
                               // echo "<br>";
                               // print_r($temp_back_data[$i][9]." = ".$value[2]." + ".$temp_back_data[$i][32]);
                               // exit;
                              
                              // if(($temp_back_data[$i][9]==$value[2] || $temp_back_data[$i][9]==$value[0]) && $temp_back_data[$i][32]!=0)// 0 poa value not display

                              // all 0 poa value display
                              if(($temp_back_data[$i][9]==$value[2] || $temp_back_data[$i][9]==$value[0]))
                              {
                                  $colqty = $colqty + $temp_back_data[$i][29];
                                  $inshort = $inshort + $temp_back_data[$i][5];
                                  $outshort = $outshort + $temp_back_data[$i][6];
                                  $net = $net + $temp_back_data[$i][38];
                                  $scriptvalue = $scriptvalue + $temp_back_data[$i][30];
                                  $amount = $amount + $temp_back_data[$i][2];
                                  $broker_t = $broker_t + $temp_back_data[$i][20];
                                  $nonpoa = $nonpoa + $temp_back_data[$i][36];
                                  $poa = $poa + floor($temp_back_data[$i][32]);
                              
                                  // Check For Pledge
                                  // $ClientCode = $_SESSION['Arham_User_Session_Data'][9];
                                   // ##################### CHANGE CODE FOR CLIENT CODE ################
                                  // $ClientCode=$_SESSION['APBackOffice_User_Session_Data'];

                                  //#####################  ADD THIS CODE FOR CLIENT CODE ################
                                  $ClientCode=$_SESSION['APBackOffice_client_code'];
                                  $PathLastHold = "E:/PLEDGE/Pledge_AP/MarginPledge_QtyEffect/".$ClientCode."_".$temp_back_data[$i][9]."_LastHold.txt";
                                  // print_r($PathLastHold);
                                  $PledgeQtyTo = $temp_back_data[$i][32];
                                  if(file_exists($PathLastHold))
                                  {
                                    $dataAsLast = file_get_contents($PathLastHold);
                                    if(!empty($dataAsLast))
                                    {
                                      $dataAsLast = explode(",", $dataAsLast);
                                      if(isset($dataAsLast[0]) && isset($dataAsLast[3]))
                                      {
                                        if($dataAsLast[1] == $temp_back_data[$i][32])
                                        {
                                          unlink($PathLastHold);
                                        }
                                        else
                                        {
                                          $PledgeQtyTo =  $dataAsLast[1];
                                        }
                                        
                                      }
                                    }
                                   }
                              ?>   
                           <tr>
                              <td><?php echo $temp_back_data[$i][26]; ?></td>
                              <td><?php echo $temp_back_data[$i][9]; ?></td>
                              <td class="t9 arh_rgt">
                                 <?php
                                    echo floor($PledgeQtyTo);
                                    ?>
                              </td>
                              <td class="t8 arh_rgt"><?php echo $temp_back_data[$i][36]; ?></td>
                              <!-- none poa -->
                              <td class="t1 arh_rgt"><?php echo abs(floor($PledgeQtyTo)-floor($temp_back_data[$i][38])); ?></td>
                              <!-- <td class="t2 arh_rgt"><?php echo $temp_back_data[$i][5]; ?></td> -->
                              <!-- <td class="t3 arh_rgt"><?php echo $temp_back_data[$i][6]; ?></td> -->
                              <td class="t4 arh_rgt"><?php echo $temp_back_data[$i][38]; ?></td>
                              <td class="t4 arh_rgt"><?php echo $Net_Rate[$temp_back_data[$i][9]] ?? '0'; ?></td>
                              <td class="t5 arh_rgt"><?php echo $temp_back_data[$i][30]; ?></td>
                              <td class="t6 arh_rgt"><?php echo $temp_back_data[$i][2]; ?></td>
                              <td>
                                 <?php 
                                    if(empty($array))
                                    {
                                      echo "Not Available";
                                    }
                                    else
                                    {
                                    ?>
                                 <center>
                                    <input class="form-control select_plgqty" type="number" value="" id="<?php echo $temp_back_data[$i][9]; ?>" name="<?php echo $temp_back_data[$i][9]; ?>" min="0"  style="width: 100px;height: 35px;" max="<?= $PledgeQtyTo; ?>" <?php echo ((floor($PledgeQtyTo) == '0'))?'disabled':''; ?>>
                                    <input class="form-control select_plgqty" type="hidden" value="<?php echo abs($PledgeQtyTo-$temp_back_data[$i][38]); ?>" id="<?php echo $temp_back_data[$i][9]; ?>_margin_qty" name="<?php echo $temp_back_data[$i][9]; ?>_margin_qty">
                                    <input class="form-control select_plgqty" type="hidden" value="<?php echo $Net_Rate[$temp_back_data[$i][9]] ?? '0'; ?>" id="<?php echo $temp_back_data[$i][9]; ?>_net_rate" name="<?php echo $temp_back_data[$i][9]; ?>_net_rate">
                                    <input class="form-control select_plgqty" type="hidden" value="<?php echo $PledgeQtyTo; ?>" id="<?php echo $temp_back_data[$i][9]; ?>_validate_poaqty" name="<?php echo $temp_back_data[$i][9]; ?>_validate_poaqty">
                                    <b><small class="text-muted form-text err_<?php echo $temp_back_data[$i][9]; ?>" id="error_select_pledge_qty" style="color: red !important;"></small></b>
                                 </center>
                                 <?php
                                    unset($temp_back_data[$i]);
                                    break;
                                    }  
                                    ?>
                              </td>
                           </tr>
                           <?php  
                              }//if end
                               }// execel file data loop end
                               $i++;
                               }
                               }
                              else
                               {?>
                           <!-- <tr>No Data Found</tr> -->
                           <?php
                              }
                              ?>
                        </tbody>
                        <tfoot>
                           <tr>
                              <td style="font-weight: bold;"><?php echo "Total"; ?></td>
                              <td><?php echo ""; ?></td>
                              <td class="ft9 arh_rgt_bold"></td>
                              <td class="ft7 arh_rgt_bold"></td>
                              <td class="ft1 arh_rgt_bold"></td>
                              <!-- <td class="ft2 arh_rgt_bold"></td> -->
                              <!-- <td class="ft3 arh_rgt_bold"></td> -->
                              <td class="ft4 arh_rgt_bold"></td>
                              <td ></td>
                              <!-- net rate td add -->
                              <td></td>
                              <td></td>
                              <td ></td>
                           </tr>
                           <tr>
                              <td style="font-weight: bold;"><?php echo "Grand Total"; ?></td>
                              <td><?php echo ""; ?></td>
                              <td class="arh_rgt_bold"><?php echo floor($poa); ?></td>
                              <td class="arh_rgt_bold"><?php echo $nonpoa; ?></td>
                              <td class="arh_rgt_bold"><?php echo $colqty; ?></td>
                              <!-- <td class="arh_rgt_bold"><?php echo $inshort; ?></td>  -->
                              <!-- <td class="arh_rgt_bold"><?php echo $outshort; ?></td>  -->
                              <td class="arh_rgt_bold"><?php echo $net; ?></td>
                              <td></td>
                              <!-- net rate td add -->
                              <td></td>
                              <td class="arh_rgt_bold"><?php echo $amount; ?></td>
                              <td></td>
                           </tr>
                        </tfoot>
                  </table>
                  <br/>
                    <div style="text-align: right;">
                        <button type="submit"  id="btn_marginpledge" class="btn btn-primary mr-2 ml-2" class="waves-effect waves-light"style="width: 170px;" onclick="PledgeCheck(2);">Submit</button> 
                        <button type="submit" name="btn_modelmarginPledge" id="btn_modelmarginPledge" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" style="width: 170px;display: none;">Submit</button>

                        <!-- Large modal button -->
                       <!--  <button type="submit" name="btn_modelmarginPledge" id="btn_modelmarginPledge" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Submit</button> -->
                    </div>
                  </div>
                  <!-- End DataTable -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Start Margin Pledge Holding Get data -->
<script type="text/javascript">
    
$(":input").bind('keyup mouseup', function () {
   // alert('hi');
    PledgeCheck(1);
});
function PledgeCheck(id)
{
        var pledge_data = <?php echo json_encode($array); ?>;
        // alert(pledge_data);
        $.ajax({
        url: "<?php echo base_url();?>KYC/Get_Valid_PledgeQTY",
        type: "POST",
        data: {} ,
        success: function (response) {
          // document.write(response);
          // var testdata='{"a1":"INE018E01016 ,0","a2":"IN0020200427 ,18","a3":"INE528G01035 ,12"}';
          const myObj = JSON.parse(response);
          // alert(response);

          var ValStatus = 0;
          var FillStatus = 0;
          var mi = 0;

          var totValue = 0;
          var totPledgeValue = 0;
          var ChkPledgeBid = 0;
          // FinalPledgeModal
           $.map(myObj, function(val, key) {
                if(mi == 0)
                {
                    $('.FinalPledgeModal').html("");
                }
                mi++;
              const myArray = val.split(",");
              // alert(myArray);
              var ValInp = $("#"+myArray[0]).val();

              // alert(ValInp);
              // alert("'"+ValInp+"'");
              var PoaQty = parseInt(myArray[1]);
              // alert(PoaQty);
              var Closing_price = myArray[2];
              var isin_name=myArray[3];
              // alert(isin_name);
              // var Pledge_price=0;
              // make code total value
              var total_amount=ValInp * Closing_price;
               
              // make code pledge value
              var Pledge_price= $("#script_pledge_value").val();
              var total_pledge_amount = ValInp * Pledge_price;

              //net qty
              var netqty=myArray[4];
              // alert(netqty);
              // alert(Pledge_price);
              // alert("'"+PoaQty+"'");
              // alert(myArray[0]+':'+ValInp+':'+PoaQty);
              if(ValInp !== undefined)
              {
                 if(ValInp != "" && PoaQty != '')
                 {
                   var validate_poaqty = $("#"+myArray[0]+"_validate_poaqty").val();
                   // alert(validate_poaqty);
                   ValInp = parseInt(ValInp);
                   if(ValInp <= validate_poaqty)
                   {
                       // alert("aa2");
                       if(ValInp > PoaQty || ValInp <= 0)
                       {
                         // alert("Invalid Qty");
                         $(".err_"+myArray[0]).html('Invalid Qty!');
                         ValStatus++;
                       }
                       else
                       {
                           FillStatus++;
                           // $('#btn_marginpledge').show();
                           $(".err_"+myArray[0]).html('');
                           // here make code for modal box for ISIN
                           var isin = myArray[0];
                           // alert(isin);
                           var total_pledge_value = 0;
                           for (var pi = pledge_data.length; pi >= 0; pi--) 
                           {
                               // alert(pledge_data[pi]);
                               if(pledge_data[pi] !== undefined)
                               {
                                       // alert(pledge_data[pi]);
                                   if(pledge_data[pi][2] == isin)
                                   {
                                       total_pledge_value = (100 - pledge_data[pi][4])* pledge_data[pi][3] / 100;
                                       total_pledge_value = total_pledge_value * ValInp;

                                       totPledgeValue += total_pledge_value;
                                   }
                               }
                           }
                           totValue += total_amount;
                           // alert(ValInp);
                           
                           // if(myArray[0] == "INE028A01039")
                           // {
                           //     total_pledge_value = 0;                            
                           // }

                            if(total_pledge_value > 0)
                            {
                                var MrgQty = $("#"+myArray[0]+"_margin_qty").val();
                                var NetRate = $("#"+myArray[0]+"_net_rate").val();
                                // alert(myArray[0]+" . "+net_rate);
                                // alert(NetRate);
                                // change poaqty in model avaible_qty=myArray[1]
                               ChkPledgeBid++;
                               $('.FinalPledgeModal').append("<tr><td><input type='hidden' id='isin' name='isin[]' value='"+myArray[0]+"' readonly>"+myArray[0]+"</td><td><input type='hidden' id='avaible_qty' name='avaible_qty[]' value='"+validate_poaqty+"' readonly>"+validate_poaqty+"</td><td><input type='hidden' id='select_plgqty' name='select_plgqty[]' value='"+ValInp+"' readonly>"+ValInp+"</td><td><input type='hidden' id='total_amount' name='total_amount[]' value='"+total_amount+"' readonly>"+total_amount.toFixed(2)+"</td><td><input type='hidden' id='total_pledge_value' name='total_pledge_value[]' value='"+total_pledge_value+"' readonly>"+total_pledge_value.toFixed(2)+"</td><td style='display:none;'><input type='hidden' id='isin_name' name='isin_name[]' value='"+isin_name+"' readonly>"+isin_name+"</td><td style='display:none;'><input type='text' id='netqty' name='netqty[]' value='"+netqty+"' readonly>"+netqty+"</td><input type='hidden' id='margin_qty' name='margin_qty[]' value='"+MrgQty+"' readonly><input type='hidden' id='net_rate' name='net_rate[]' value='"+NetRate+"' readonly></tr>");     
                           }
                                        
                       }
                   }
                   else
                   {
                        // alert('noooo');
                       $(".err_"+myArray[0]).html('Invalid Qty!');
                       ValStatus++;
                   }
                 }
               }
             
          });
          
          if(ChkPledgeBid == 0)
          {
            ChkPledgeBid = "Invalid";
            // FillStatus = 0;

          }

          $('.FinalPledgeModal').append("<tr><th>Total</th><td></td><td></td><td style='display:none;'></td><th><input type='hidden' id='finalValue' name='finalValue[]' value='"+totValue+"' readonly>"+totValue.toFixed(2)+"</th><th><input type='hidden' id='finalPledgeValue' name='finalPledgeValue[]' value='"+totPledgeValue+"' readonly>"+totPledgeValue.toFixed(2)+"</th></tr>");




           // alert(ValStatus); 
           if(ValStatus == 0 && FillStatus != 0 && ChkPledgeBid != "Invalid")
           {
                if(id == 2)
                {
                    $("#btn_modelmarginPledge").click();
                }
           }
           else
           {
               if(id == 2)
               {
                    // alert(ChkPledgeBid);
                   if(FillStatus == 0)
                   {
                        alert("Please enter qty for pledge!");
                   }
                   else if(ChkPledgeBid == "Invalid")
                   {
                        alert("This Scrip is not approved. Kindly Select another scrip!");
                   }
               }
           }

        },
    });           
}
</script>
<!-- End Margin Pledge Holding Get data -->
<!-- Start Margin Pledge Success Failed -->
<script type="text/javascript">
    $(window).on('load',function(){
        // alert('hi');
      if(!sessionStorage["APBackOffice_Danger_MarginPledge"]){
         $('#margin_pledge_failmodal').modal('show');
      }
      
      if (!sessionStorage.getItem('APBackOffice_Success_MarginPledge')){
         $('#Margin_pledge_successmodal').modal('show');
      }
   });
</script>
<!-- End Margin Pledge Success Failed -->
<!-- start validation of margin pledge for pledge reason code -->
<script type="text/javascript">
    function validation_of_PledgeReasonCode()
    {
        alert('jghfkj');
        var margin_error = 0;
        var pledge_reason = $('#pledge_reason:checked').val();
        alert(pledge_reason);
        if(pledge_reason != "04")
        {
            $("#esign_closeaccount_error").html("Please agree T&C.");
            margin_error++;
        }
        else
        {
            $("#esign_closeaccount_error").html("");
        }
        if(margin_error != 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    $(document).ready(function(){
        $("#myform").keyup(function(){
           // alert('hhhhhhh');
           validation_of_PledgeReasonCode();
        });
    });
</script>
<!-- end  validation of margin pledge for pledge reason code-->



