<?php
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
      ?>
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- end page title -->
         <?php include("alert.php"); ?>
         <?php
                     include("check_number_convert.php");
                     ?>
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                     <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-wallet-plus me-3"
                        style="color: #ffff;"></i>Account Summary</h6>
                  </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>Accounts/Account_Summary">
                        <div class="row card-title mb-0 flex-grow-1">
                           <div class="col-md-2">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Company code:</label>
                                 <div class="mb-3">
                                    <select name="company_code" id="company_code" class="form-select">
                                       <option
                                          value="BSE_CASH,NSE_CASH"
                                          <?php if(isset($_SESSION['ApbackOffice_client_company_code_account_summary'])){$_SESSION['ApbackOffice_client_company_code_account_summary'] == 'BSE_CASH,NSE_CASH' ? ' selected="selected"' : '';}else{echo 'selected';}?>>
                                         BSE_CASH,NSE_CASH
                                       </option>
                                       <option value="NSE_FNO"
                                          <?php if(isset($_SESSION['ApbackOffice_client_company_code_account_summary'])){$_SESSION['ApbackOffice_client_company_code_account_summary'] == 'NSE_FNO' ? ' selected="selected"' : '';}?>>
                                          NSE_FNO
                                       </option>
                                       <option value="CD_NSE"
                                          <?php if(isset($_SESSION['ApbackOffice_client_company_code_account_summary'])){$_SESSION['ApbackOffice_client_company_code_account_summary'] == 'CD_NSE' ? ' selected="selected"' : '';}?>>
                                          CD_NSE
                                       </option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Trance Type:</label>
                                 <div class="mb-3">
                                    <select name="Trance_Type" id="Trance_Type" class="form-select">
                                       <option
                                          value="J"
                                          <?php if(isset($_SESSION['ApbackOffice_trance_type_account_summary1'])){$_SESSION['ApbackOffice_trance_type_account_summary1'] == 'J' ? ' selected="selected"' : '';}?>>
                                          JV
                                       </option>
                                       <option value="R"
                                          <?php if(isset($_SESSION['ApbackOffice_trance_type_account_summary1'])){$_SESSION['ApbackOffice_trance_type_account_summary1'] == 'R' ? ' selected="selected"' : '';}?>>
                                          Recipt
                                       </option>
                                       <option value="P"
                                          <?php if(isset($_SESSION['ApbackOffice_trance_type_account_summary1'])){$_SESSION['ApbackOffice_trance_type_account_summary1'] == 'P' ? ' selected="selected"' : '';}?>>
                                          Payment
                                       </option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                 <input class="form-control" type="date"
                                    value="<?php if(isset($_SESSION['ApbackOffice_client_f_date_account_summary'])){echo $_SESSION['ApbackOffice_client_f_date_account_summary'];}else{echo $from_date;}?>"
                                    id="from_date" name="from_date">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">To Date</label>
                                 <input class="form-control" type="date"
                                    value="<?php if(isset($_SESSION['ApbackOffice_client_t_date_account_summary'])){echo $_SESSION['ApbackOffice_client_t_date_account_summary'];}else{echo $todate;}?>"
                                    id="to_date" name="to_date">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                 <div class="mb-3">
                                    <input type="text" class="form-control" name="client_code"
                                       value="<?php if(isset($_SESSION['ApbackOffice_client_code_account_summary'])){echo $_SESSION['ApbackOffice_client_code_account_summary'];}?>"
                                       placeholder="Enter Client Code">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" class="btn btn-primary w-md"
                                    style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                              </div>
                              <div class="mb-2" style="padding-top: 30px;">
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- End Form -->
                  </div>
                  <!-- Start DataTable -->
                  <!-- Start DataTable -->
                  <div class="col-12">
                     <div class="">
                        <div style="text-align-last: end;">
                           <a href="<?php echo base_url('Accounts/Account_Summary_excel'); ?>"><img
                              src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                              height="25"></a>
                           <a href="<?php echo base_url('Accounts/Account_Summary_pdf'); ?>"><img
                              src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                              height="25"></a>
                        </div>
                        <div class="row">
                           <div class="col-6">
                              Name :<span
                                 style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['ApbackOffice_client_name_account_summary'])){echo $_SESSION['ApbackOffice_client_name_account_summary'];}?></b></span>
                           </div>
                           <div class="col-6">
                              Branch :<span
                                 style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                           </div>
                        </div>
                        <div class="card-body">
                           <table id="datatable" class="table table-bordered dt-responsive w-100">
                                                <thead>
                                    <tr>
                                        <!-- <th style="width: 50px;">Trading Date</th> -->
                                        <th>Voucher Date</th>
                                        <th>Voucher No</th>
                                        <th>Segment</th>
                                        <th>Particulars</th>
                                        <th>Chq No</th>
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
                                    $i = 0;
                                    $yestarday_balance = 0;
                                    $yestarday_balance_2 = 0;
                                    foreach ($back_data as $key_index => $data_row) {
                                                    
                                                    // $balance = $balance + $back_data[$i][6];
                                    if (str_contains($back_data[$i][13], 'FUND TRANSFER') || str_contains($back_data[$i][13], 'Inter Exchange')) { 
                                          }
                                          else{   
                                    if($back_data[$i][12] != "" || $back_data[$i][11] != "")
                                    {
                                        $debit = $debit + floatval($back_data[$i][12]);
                                        $credit = $credit + floatval($back_data[$i][11]);
                                    ?>
                                    <tr>
                                       <td>
                                           <span style="display: none;">
                                               <?php 
                                               if($back_data[$i][7] != "" && $back_data[$i][7]!=" ")
                                               {
                                                   echo ($back_data[$i][7] != " ")?date_format(date_create(str_replace(",", "", $back_data[$i][7])),"Y/m/d"):""; 
                                               }
                                               ?>
                                               </span>
                                               <?php 
                                               if($back_data[$i][7] != "" && $back_data[$i][7]!=" ")
                                               {
                                                   echo ($back_data[$i][7] != " ")?date_format(date_create(str_replace(",", "", $back_data[$i][7])),"d-m-Y"):""; 
                                               }
                                               ?>
                                       </td>
                                       <td><?php echo $back_data[$i][4]; ?></td>
                                       <td><?php echo $back_data[$i][0]; ?></td>
                                       <td><?php echo $back_data[$i][13]; ?></td>
                                       <td><?php if(empty($back_data[$i][9])){echo $back_data[$i][10];}else{echo $back_data[$i][9];} ?></td>
                                       <td class="t1 arh_rgt"><?php echo $back_data[$i][12]; ?></td>
                                       <td class="t2 arh_rgt"><?php echo $back_data[$i][11]; ?></td>
                                       <td class="t3 arh_rgt" value="">

                                           <?php 
                                           // echo "##".$back_data[$i][12]."##";

                                           if($back_data[$i][12] == 0)
                                           {
                                               $yestarday_balance -= $back_data[$i][11];
                                               $yestarday_balance_2 += $back_data[$i][11];
                                               // $total_balance += $back_data[$i][2];
                                               echo Ledger_balance($yestarday_balance);
                                               ?>
                                               <input type="hidden" class="t3t" value="<?php echo $yestarday_balance; ?>">
                                               <?php
                                           }
                                           else
                                           {
                                                // $yestarday_balance=$back_data[$i][12]
                                               $yestarday_balance += $back_data[$i][12];
                                               $yestarday_balance_2 -= $back_data[$i][12];
                                               // $total_balance += $back_data[$i][12];
                                               echo Ledger_balance($yestarday_balance);
                                               ?>
                                               <input type="hidden" class="t3t" value="<?php echo $yestarday_balance; ?>">
                                               <?php
                                           }
                                           $total_balance += $yestarday_balance;
                                           // echo $yestarday_balance;
                                          ?>
                                       </td>
                                    </tr>
                                    <?php  
                                        }
                                        }

                                    $i++;
                                    }
                                    }
                                    else
                                    {?>
                                        <tr>No Data Found</tr>
                                    <?php
                                    }
                                    // echo "just<br>";
                                    // print_r($total_balance);
                                    ?>
                                    </tbody>
                                       <!-- <tr>
                                            <td style="font-weight: bold;"><?php echo "Total"; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td><?php echo ""; ?></td>
                                            <td class="ft1 arh_rgt"></td>
                                            <td class="ft2 arh_rgt"></td>
                                            <td class="ft3 arh_rgt"></td>
                                        </tr> -->
                                    <tr>
                                        <td style="font-weight: bold;"><?php echo "Ledger Balance"; ?></td>
                                        <td><?php echo ""; ?></td>
                                        <td><?php echo ""; ?></td>
                                        <td><?php echo ""; ?></td>
                                        <td><?php echo ""; ?></td>
                                        <td class="arh_rgt" style="font-weight: bold;"><?php 
                                        echo $debit; 
                                        ?></td>
                                        <td class="arh_rgt" style="font-weight: bold;"><?php 
                                        echo $credit; 
                                        ?></td>
                                        <td class="arh_rgt" style="font-weight: bold;"><?php
                                        // print_r("###".$yestarday_balance."###");
                                        if(isset($yestarday_balance_2))
                                        { 
                                            $yestarday_balance_2 = $yestarday_balance_2 <= 0 ? abs($yestarday_balance_2) : -$yestarday_balance_2 ;
                                            echo Ledger_balance($yestarday_balance_2);
                                        }
                                        else
                                        {
                                            echo 0;
                                        }
                                        ?></td>
                                    </tr>
                                </table>
                        </div>
                     </div>
                  </div>
       
                  <!-- End DataTable -->
                  <!-- End DataTable -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
