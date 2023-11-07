<?php

////////////////// START NEW CODE YEAR \\\\\\\\\\\\\\\\\\\\\\\
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
if(isset($_SESSION['finacial_year_apbackoffice']))
{
    $year=$_SESSION['finacial_year_apbackoffice'];
    $todate=$year."-03-31";
    $newYear=$year-1;
    $from_date=$newYear."-04-01";
}
else
{
    $year=date("Y");
    $todate=$year."-03-31";
    $newYear=$year-1;
    $from_date=$newYear."-04-01";
}
////////////////// END NEW CODE YEAR \\\\\\\\\\\\\\\\\\\\\\\
 
// if(isset($_SESSION['APBackOffice_DP_Ledger_data']))
// {
//    $columns=$_SESSION['APBackOffice_DP_Ledger_data'][0];
//    $back_data=$_SESSION['APBackOffice_DP_Ledger_data'][1];
//    // echo "<pre>";
//    // print_r($back_data);exit();
//   // if(!isset($_SESSION['APBackOffice_client_code']))
//   //  {
              
//    // }
// }
?> 
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18"></h4>
                  <!-- <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">APBackOffice</a></li>
                        <li class="breadcrumb-item active">HelpDesk</li>
                     </ol>
                  </div> -->
               </div>
            </div>
         </div>
         <!-- end page title -->
         <?php include("alert.php"); ?> 
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-layers me-2" style="color:#fff;"></i>Client DP Ledger(this page under maintenance)</h6>
                        </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>KYC/dp_ledger">
                        <div class="row card-title mb-0 flex-grow-1">
                           <div class="col-md-3">
                              <div class="mb-2">
                                    <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                    <div class="mb-3">
                                       <input type="text" class="form-control" name="client_code" id="client_code" required>
                                    </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                    <input class="form-control" type="date"
                                        value="<?php if(isset($_SESSION['ApbackOffice_client_f_date_ledger_detail'])){echo $_SESSION['ApbackOffice_client_f_date_ledger_detail'];}else{echo $from_date;}?>"
                                        id="from_date" name="from_date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label" for="formrow-todate-input">To Date</label>
                                    <input class="form-control" type="date"
                                        value="<?php if(isset($_SESSION['ApbackOffice_client_t_date_ledger_detail'])){echo $_SESSION['ApbackOffice_client_t_date_ledger_detail'];}else{echo $todate;}?>"
                                        id="to_date" name="to_date">
                                </div>
                           </div>
                           <div class="col-md-3">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
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
                  <?php
                  include("check_number_convert_kyc.php");
                  ?>
                  <div class="card-body">
                     <div style="text-align-last: end;">
                        <a href="<?php echo base_url('KYC/dp_ledger_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                        <a href="<?php echo base_url('KYC/dp_ledger_pdf_download'); ?>"><img src="<?php echo base_url();?>assets/pdf.png" width="25" height="25"></a>
                     </div>
                     <div style="overflow-x:auto;">
                        <table id="datatable" class="table table-bordered width=device-width, initial-scale=1">
                           <thead>
                              <tr>
                                 <th>Sr no</th>
                                 <th>Date</th>
                                 <th >Voucher</th>
                                 <th>CDSL No</th>
                                 <th>Code</th>
                                 <th>Narration</th>
                                 <th>Check No</th>
                                 <th>Receive Date</th>
                                 <th>Debit</th>
                                 <th>Credit</th>
                                 <th>Balance</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php 
                              $debit = 0;
                              $credit = 0;
                              $total_balance = 0;
                              if(!empty($back_data))
                              {
                                 $i=0;
                                 $j=1;
                                 $yestarday_balance = 0;
                                 foreach ($back_data as $data_row) 
                                 {
                                     if($back_data[$i][10] != "" || $back_data[$i][11] != "")
                                       {
                                              $debit = $debit + floatval($back_data[$i][10]);
                                              // print_r($debit);
                                              // echo "<br>";
                                              $credit = $credit + floatval($back_data[$i][11]);
                                              // print_r($credit);
                                 ?> 

                              <tr>
                                 <td><?php echo $j;?></td>
                                 <td>
                                    <!-- <?php echo $data_row[5]; //Date?> -->
                                    <span style="display: none;">
                                     <?php
                                                          
                                       if($data_row[12] != "" && $data_row[12]!=" ")
                                       {
                                           echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"Y/m/d"):""; 
                                       }
                                       ?>
                                       </span>
                                       <?php 
                                       if($data_row[12] != "" && $data_row[12]!=" ")
                                       {
                                           echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"d-m-Y"):""; 
                                       }
                                                            
                                     ?>
                                    
                                 </td>
                                 <td>
                                    <!-- <?php echo $data_row[6]; // Voucher?> -->
                                     <?php 
                                     if(str_replace(" ", "", $data_row[6]) == "SJ")
                                     {
                                      
                                       echo "Bill";
                                      
                                     }
                                     elseif(str_replace(" ", "", $data_row[6]) == "OP")
                                     {
                                          // $s1=str_replace("J","JV",$data_row[6]);
                                          // echo $s1;
                                       echo "OP";
                                     }
                                     else
                                     {
                                       echo "JV";
                                     }
                                    // Voucher
                                     ?>
                                       
                                 </td>
                                 <td>
                                    <!-- <?php echo $data_row[14];//CDSL No?> -->
                                       <?php
                                         $cdsl_no=$data_row[14];
                                         $newstring = substr($cdsl_no, 2);
                                         echo $newstring;
                                       ?> 
                                 </td>
                                 <td>
                                    <!-- <?php echo $data_row[6];//Code?> -->
                                     <?php
                                     if(str_replace(" ", "", $data_row[6]) == "SJ")
                                       {
                                         
                                          echo " ";
                                         
                                       }
                                       elseif(str_replace(" ", "", $data_row[6]) == "OP")
                                       {
                                             // $s1=str_replace("J","JV",$data_row[6]);
                                             // echo $s1;
                                          echo "OP";
                                       }
                                       else
                                       {
                                          echo "JV";
                                       }
                                    ?>  
                                 </td>
                                 <td><?php echo $data_row[1];//Narration?></td>
                                 <td><?php echo $data_row[2]; //Check No?></td>
                                 <td>
                                    <!-- <?php echo $data_row[12]; //Receive Date?> -->
                                     <span style="display: none;">
                                     <?php
                                                          
                                       if($data_row[12] != "" && $data_row[12]!=" ")
                                       {
                                           echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"Y/m/d"):""; 
                                       }
                                       ?>
                                       </span>
                                       <?php 
                                       if($data_row[12] != "" && $data_row[12]!=" ")
                                       {
                                           echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"d-m-Y"):""; 
                                       }
                                                            
                                     ?>
                                    
                                       
                                 </td>
                                 <td class="t1 arh_rgt"><?php echo $data_row[10];//Debit?></td>
                                 <td class="t2 arh_rgt"><?php echo $data_row[11]; //Credit?></td>
                                 <td class="t3 arh_rgt" value="">
                                 <?php 

                                    // print_r($back_data[$i][10]);
                                    if($back_data[$i][10] == 0 || $back_data[$i][10] == "")
                                    {
                                        $yestarday_balance += $back_data[$i][11];
                                        // $total_balance += $back_data[$i][1];
                                        echo Ledger_balance($yestarday_balance);
                                        ?>
                                                <input type="hidden" class="t3t"
                                                    value="<?php echo $yestarday_balance; ?>">
                                                <?php
                                    // echo Ledger_balance($yestarday_balance);
                                    }
                                    else
                                    {
                                    
                                    $yestarday_balance -= $back_data[$i][10];
                                    // $total_balance += $back_data[$i][2];
                                    echo Ledger_balance($yestarday_balance);
                                    ?>
                                                <input type="hidden" class="t3t"
                                                    value="<?php echo $yestarday_balance; ?>">
                                                <?php
                                    // echo Ledger_balance($yestarday_balance);
                                    }
                                    $total_balance += $yestarday_balance;
                                 ?>
                                 </td>
                                 <!-- <td><?php  //Balance?></td> -->
                              </tr>
                             <?php 
                                    }//if end
                                 $i++;
                                 $j++;
                                 }//foreech end 
                              }//first if end 
                              else
                              {?>
                                       <tr>No Data Found</tr>
                              <?php
                              }
                              // echo "just<br>";
                              // print_r($total_balance);
                              ?>
                           </tbody>
                              <tr>
                                 <td style="font-weight: bold;"><?php echo "Ledger Balance"; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td><?php echo ""; ?></td>
                                 <td class="arh_rgt" style="font-weight: bold;">
                                    <?php 
                                       echo $debit; 
                                    ?>
                                 </td>
                                 <td class="arh_rgt" style="font-weight: bold;">
                                    <?php 
                                       echo $credit; 
                                    ?>
                                 </td>
                                 <td class="arh_rgt" style="font-weight: bold;">
                                    <?php
                                    if(isset($yestarday_balance))
                                    { 
                                        $yestarday_balance = $yestarday_balance <= 0 ? abs($yestarday_balance) : -$yestarday_balance ;
                                        echo $yestarday_balance;

                                        // if($yestarday_balance > 0)
                                        // {
                                        //   echo "hi";
                                        // }
                                        // elseif($yestarday_balance < 0)
                                        // {
                                        //    echo "no";
                                        // }
                                        // else
                                        // {
                                        //    echo "0";
                                        // }
                                    }
                                    else
                                    {
                                        echo 0;
                                    }
                                    ?>
                                 </td>
                              </tr>
                        </table>
                     </div>
                  </div> 
                  <!-- End DataTable -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <script type="text/javascript">
   $(document).ready( function () {
      $('#datatable1').DataTable( {
      responsive: true
      
      } );
} );
</script> -->