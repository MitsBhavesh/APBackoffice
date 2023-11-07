<?php
if(isset($_SESSION['APBackOffice_client_dp_data']))
{
   $result=$_SESSION['APBackOffice_client_dp_data'];
   // echo "<pre>";
   // print_r($result);exit();
}

function calculateFiscalYearForDate($month)
{
   if($month > 4)
   {
      $y = date('Y');
      $pt = date('Y', strtotime('+1 year'));
      $fy = $y."-04-01".",".$pt."-03-31";
   }
   else
   {
      $y = date('Y', strtotime('-1 year'));
      $pt = date('Y');
      $fy = $y."-04-01".",".$pt."-03-31";
   }
   return $fy;
} 
$curr_date_month = date('m');
$calculate_fiscal_year_for_date = calculateFiscalYearForDate($curr_date_month);
$calculate_fiscal_year_for_date=explode(",", $calculate_fiscal_year_for_date);
$from_date=$calculate_fiscal_year_for_date[0];
$todate=$calculate_fiscal_year_for_date[1];
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book-information-variant me-2" style="color:#fff;"></i>Client DP Detail</h6>
                        </div>
                        <!-- Start DataTable -->
                        <div class="card-body">
                            <div style="text-align-last: end;">
                                <a href="<?php echo base_url('KYC/dp_excel_download'); ?>"><img
                                        src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                        height="25"></a>
                            </div><br />
                            <div style="overflow-x:auto;">
                                <table id="datatable" class="table table-bordered width=device-width, initial-scale=1">
                                    <thead>
                                        <tr>
                                            <th>Branch Code</th>
                                            <th>Trading Client ID</th>
                                            <th>Boid</th>
                                            <th>BO Name</th>
                                            <th>BO Pan No</th>
                                            <th>BO Account Status</th>
                                            <th>Bo Sub Status</th>
                                            <th>Module DESC</th>
                                            <th>Account Open Date</th>
                                            <th>Bo-Closour Date</th>
                                            <th>BO D.O.B</th>
                                            <th>Bo Add1</th>
                                            <th>Bo Add2</th>
                                            <th>Bo Add3</th>
                                            <th>Bo Add city</th>
                                            <th>Bo Add State</th>
                                            <th>Bo Add Country</th>
                                            <th>Bo Add Pin</th>
                                            <th>Mobile No</th>
                                            <th>Emailid</th>
                                            <th>Bank name</th>
                                            <th>Bank Acc No</th>
                                            <th>IFSC</th>
                                            <th>Micr code</th>
                                            <th>Second Holder name</th>
                                            <th>Second Holder Pan</th>
                                            <th>Third Holder name</th>
                                            <th>Third Holder Pan</th>
                                            <th>Poa Name</th>
                                            <th>Poa Enable</th>
                                            <th>Nominee Name</th>
                                            <th>Risk Category</th>
                                            <th>Guardian Pan No </th>
                                            <th>Income Range</th>
                                            <!-- <th>Boid</th>
                                            <th>Name</th>
                                            <th>Trading Code</th>
                                            <th>Branch Code</th>
                                            <th>Pan No</th>
                                            <th>DateofBirth</th>
                                            <th>Mobile No</th>
                                            <th>Emailid</th>
                                            <th>Income Range</th>
                                            <th>Bo Add1</th>
                                            <th>Bo Add2</th>
                                            <th>Bo Add3</th>
                                            <th>Bo Add city</th>
                                            <th>Bo Add State</th>
                                            <th>Bo Add Country</th>
                                            <th>Bo Add Pin</th>
                                            <th>Bank Acc No</th>
                                            <th>IFSC</th>
                                            <th>Micr code</th>
                                            <th>Bank name</th>
                                            <th>Category</th>
                                            <th>status</th>
                                            <th>Bosub Status</th>
                                            <th>Form No</th>
                                            <th>Poa Enable</th>
                                            <th>Poa Name</th>
                                            <th>Risk Category</th>
                                            <th>Second Holder name</th>
                                            <th>Second Pan</th>
                                            <th>Third Holder name</th>
                                            <th>Nominee Name</th> -->
                                        </tr>
                                    </thead>

                                <tbody>
                                    <?php
                                    // $value = $result[0];
                                    $i = 0;
                                    if(!empty($result))
                                    {      
                                        foreach($result as $key => $value)
                                        {


                                    ?>
                                         <tr>
                                            <td><?php echo $result[$i]['BRANCH_CODE']; //BRANCH CODE ?></td>
                                            <td><?php echo $result[$i]['TRADING_CLIENT_ID']; //TRADING_COCD name ?></td>
                                            <td><?php echo "'".$result[$i]['BO_ID']; //boid ?></td>
                                            <td><?php echo $result[$i]['FIRST_HOLD_NAME']; //boname ?></td>
                                            <td><?php echo $result[$i]['ITPA_NO']; //bo pan no ?></td>
                                            <td><?php echo $result[$i]['STATUS']; //bo STATUS ?></td>
                                            <td><?php echo $result[$i]['BO_SUB_STAT']; //BO SUB STAT ?></td>
                                            <td><?php  //Module Desc ?></td>
                                            <td><?php  echo $result[$i]['ACC_OPEN_DAT'];//Account Opening Date?></td>
                                            <td><?php  echo $result[$i]['ACC_CLOSE_DAT'];//Bo Clouser Date?></td>
                                            <td><?php echo $result[$i]['BO_DOB']; //BO DOB ?></td>
                                            <td><?php echo $result[$i]['BO_ADD1']; //BO ADD1 ?></td>
                                            <td><?php echo $result[$i]['BO_ADD2']; //BO ADD2 ?></td>
                                            <td><?php echo $result[$i]['BO_ADD3']; //BO ADD3 ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_CITY']; //BO ADD CITY ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_STATE']; //BO ADD STATE ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_COUNTRY']; //BO ADD COUNTRY ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_PIN']; //BO ADD PIN ?></td>
                                            <td><?php echo $result[$i]['MOBILE_NO']; //MOBILE NO ?></td>
                                            <td><?php echo $result[$i]['EMAIL_ID']; //EMAIL ID ?></td>
                                            <td><?php echo $result[$i]['BANK_NAM']; //BANK NAME ?></td>
                                            <td><?php echo $result[$i]['BANK_ACC_NO']; //BANK ACC NO ?></td>
                                            <td><?php echo $result[$i]['BEN_BANK_COD']; //BEN_BANK_COD ifsc ?></td>
                                            <td><?php echo $result[$i]['MICR_CODE']; //MICR CODE ?></td>
                                            <td><?php echo $result[$i]['SECOND_HOLD_NAM']; //SECOND HOLD NAME ?></td>
                                            <td><?php echo $result[$i]['PAN_NO_2'];//SECOND HOLD PAN ?></td>
                                            <td><?php echo $result[$i]['THIRD_HOLD_NAM']; //THIRD HOLD NAM ?></td>
                                            <td><?php echo $result[$i]['PAN_NO_3'];//THIRD HOLD PAN ?></td>
                                            <td><?php echo $result[$i]['POA_NAME']; //POA NAME ?></td>
                                            <td><?php echo $result[$i]['POA_ENABLED']; //POA ENABLED ?></td>
                                            <td><?php echo $result[$i]['NOMIN_NAM']; //Nominee name ?></td> 
                                            <td><?php echo $result[$i]['Risk_catg']; //Risk catg ?></td>
                                            <td><?php echo $result[$i]['Guardian_PANNO']; //GUARDIAN PAN NO ?></td>
                                            <!-- <td><?php echo $result[$i]['INCOM_COD']; //INCOM COD ?></td> -->
                                            <td>
                                                <!-- <?php echo $result[$i]['INCOM_COD']; //INCOM COD ?> -->
                                                 <?php
                                                    if(str_replace(" ", "", $result[$i]['INCOM_COD']) == "1")
                                                    {
                                                     
                                                      echo "UPTO RS 1 LAKH";
                                                     
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "2")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "1 LAKHS TO 2 LAKHS";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "3")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "2 LAKHS TO 5 LAKHS";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "4")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "5 LAKHS AND ABOVE";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "5")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "NOT AVAILABLE";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "6")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "1,00,001 TO 5,00,000";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "7")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "5,00,001 TO 10,00,000";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "8")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "10,00,001 TO 25,00,000  ";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "9")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "MORE THEN 25,00,000";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "10")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "25,00,001 TO 1,00,00,000";
                                                    }
                                                    elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "10")
                                                    {
                                                         // $s1=str_replace("J","JV",$data_row[6]);
                                                         // echo $s1;
                                                      echo "25,00,001 TO 1,00,00,000";
                                                    }
                                                    else
                                                    {
                                                        echo "MORE THAN 1,00,00,000";
                                                    }
                                                ?> 
                                            </td>

                                            <!-- <td><?php echo "'".$result[$i]['BO_ID']; //boid ?></td>
                                            <td><?php echo $result[$i]['FIRST_HOLD_NAME']; //boname ?></td>
                                            <td><?php echo $result[$i]['TRADING_CLIENT_ID']; //TRADING_COCD name ?></td>
                                            <td><?php echo $result[$i]['BRANCH_CODE']; //BRANCH CODE ?></td>
                                            <td><?php echo $result[$i]['ITPA_NO']; //pan no ?></td>
                                            <td><?php echo $result[$i]['BO_DOB']; //BO DOB ?></td>
                                            <td><?php echo $result[$i]['MOBILE_NO']; //MOBILE NO ?></td>
                                            <td><?php echo $result[$i]['EMAIL_ID']; //EMAIL ID ?></td>
                                            <td><?php echo $result[$i]['INCOM_COD']; //INCOM COD ?></td>
                                            <td><?php echo $result[$i]['BO_ADD1']; //BO ADD1 ?></td>
                                            <td><?php echo $result[$i]['BO_ADD2']; //BO ADD2 ?></td>
                                            <td><?php echo $result[$i]['BO_ADD3']; //BO ADD3 ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_CITY']; //BO ADD CITY ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_STATE']; //BO ADD STATE ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_COUNTRY']; //BO ADD COUNTRY ?></td>
                                            <td><?php echo $result[$i]['BO_ADD_PIN']; //BO ADD PIN ?></td>
                                            <td><?php echo $result[$i]['BANK_ACC_NO']; //BANK ACC NO ?></td>
                                            <td><?php echo $result[$i]['BEN_BANK_COD']; //BEN_BANK_COD ifsc ?></td>
                                            <td><?php echo $result[$i]['MICR_CODE']; //MICR CODE ?></td>
                                            <td><?php echo $result[$i]['BANK_NAM']; //BANK NAM ?></td>
                                            <td><?php echo $result[$i]['ACC_CATEGORY']; //ACC CATEGORY?></td>
                                            <td><?php echo $result[$i]['STATUS']; //bo STATUS ?></td>
                                            <td><?php echo $result[$i]['BO_SUB_STAT']; //BO SUB STAT ?></td>
                                            <td><?php echo $result[$i]['FOR_RS']; //bo FOR_RS ?></td>
                                            <td><?php echo $result[$i]['POA_ENABLED']; //POA ENABLED ?></td>
                                            <td><?php echo $result[$i]['POA_NAME']; //POA NAME ?></td>
                                            <td><?php echo $result[$i]['Risk_catg']; //Risk catg ?></td>
                                            <td><?php echo $result[$i]['SECOND_HOLD_NAM']; //SECOND HOLD NAM ?></td>
                                            <td><?php echo $result[$i]['PAN_OF_ADDIT_HOLD']; //PAN OF ADDIT HOLD ?></td>
                                            <td><?php echo $result[$i]['THIRD_HOLD_NAM']; //THIRD HOLD NAM ?></td>
                                            <td><?php echo $result[$i]['NOMIN_NAM']; //Nominee name ?></td> -->
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
                    </div>
                    <!-- End DataTable -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>