<?php
   if(isset($_SESSION['Apb_client_holding_data']))
   {
      $columns = $_SESSION['Apb_client_holding_data'][0];
      $holdint_data = $_SESSION['Apb_client_holding_data'][1];
   
   } else {
      // echo "Please Enter Data";
   }
   
   if(isset($_SESSION['Apb_client_summary_data']))
   {
       $summary_columns = $_SESSION['Apb_client_summary_data'][0];
       $summary_back_data = $_SESSION['Apb_client_summary_data'][1];
   
   
       $group = array();
   
       foreach ($summary_back_data as $value_summary) {
           $group[$value_summary[2]][] = $value_summary;
       }
   }
   
   include("check_number_convert.php");
   ?>
<style>
.table td,
.table th {
    font-size: 9px;
    padding: 0.25rem 0.25rem;
    /*font-family:    Arial, Verdana, sans-serif;*/
}
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book-account-outline me-2" style="color:#fff;"></i>Smart Report</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/smart_reports">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    value="<?php if(isset($_SESSION['APBackOffice_client_code'])){echo $_SESSION['APBackOffice_client_code'];}?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                            <input class="form-control" type="date" value="<?php if(isset($_SESSION['ApbackOffice_from_date_smart'])){echo $_SESSION['ApbackOffice_from_date_smart'];}else{echo "2022-04-01";}?>" id="from_date"
                                                name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date</label>
                                            <input class="form-control" type="date" value="<?php if(isset($_SESSION['ApbackOffice_to_date_smart'])){echo $_SESSION['ApbackOffice_to_date_smart'];}else{echo date('Y-m-d');}?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary w-md"
                                                style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                        <div class="row">
                            <div class="col-6">
                                Name :<span
                                    style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['ApbackOffice_client_name'])){echo $_SESSION['ApbackOffice_client_name'];}?></b></span>
                            </div>
                            <div class="col-6">
                                Branch :<span
                                    style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                            </div>
                        </div>
                        <!-- Start DataTable -->
                        <div style="">
                            <div class="card-body">
                                <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                    <thead>
                                    <tr>
                                        <th style="width: 50px;">Trading Date</th>
                                        <th id="vouchardateclick">Voucher Date</th>
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
                                    if($back_data[$i][1] != "" || $back_data[$i][2] != "")
                                    {
                                        $debit = $debit + floatval($back_data[$i][1]);
                                        $credit = $credit + floatval($back_data[$i][2]);
                                    ?>
                                    <tr>
                                                    <td>
                                                        <span style="display: none;">
                                                            <?php
                                                            // if($back_data[$i][9] != "OPENING BALANCE")
                                                            // {
                                                             echo ($back_data[$i][19] != " " && $back_data[$i][19] != "")?date_format(date_create(str_replace(",", "", $back_data[$i][19])),"Y/m/d"):""; 
                                                            // }
                                                            ?>
                                                            </span>

                                                            <?php 
                                                            // if($back_data[$i][9] != "OPENING BALANCE")
                                                            // {
                                                                echo ($back_data[$i][19] != " " && $back_data[$i][19] != "")?date_format(date_create(str_replace(",", "", $back_data[$i][19])),"d-m-Y"):""; 
                                                            // }
                                                            ?>
                                                    </td>

                                                    <td>
                                                        <span style="display: none;">
                                                            <?php 
                                                            if($back_data[$i][3] != "" && $back_data[$i][3]!=" ")
                                                            {
                                                                echo ($back_data[$i][3] != " ")?date_format(date_create(str_replace(",", "", $back_data[$i][3])),"Y/m/d"):""; 
                                                            }
                                                            ?>
                                                            </span>
                                                            <?php 
                                                            if($back_data[$i][3] != "" && $back_data[$i][3]!=" ")
                                                            {
                                                                echo ($back_data[$i][3] != " ")?date_format(date_create(str_replace(",", "", $back_data[$i][3])),"d-m-Y"):""; 
                                                            }
                                                            ?>
                                                    </td>
                                                    <td><?php echo $back_data[$i][8]; ?></td>
                                                    <td><?php echo $back_data[$i][0]; ?></td>
                                                    <td><?php echo $back_data[$i][9]; ?></td>
                                                    <td><?php echo $back_data[$i][12]; ?></td>
                                                    <td class="t1 arh_rgt"><?php echo $back_data[$i][1]; ?></td>
                                                    <td class="t2 arh_rgt"><?php echo $back_data[$i][2]; ?></td>
                                                    <td class="t3 arh_rgt" value="">

                                                        <?php 
                                                        // echo "##".$back_data[$i][1]."##";
                                                        if($back_data[$i][1] == 0 || $back_data[$i][1] == "")
                                                        {

                                                            $yestarday_balance -= $back_data[$i][2];
                                                            $yestarday_balance_2 += $back_data[$i][2];
                                                            // $total_balance += $back_data[$i][2];
                                                            echo Ledger_balance($yestarday_balance);
                                                            ?>
                                                            <input type="hidden" class="t3t" value="<?php echo $yestarday_balance; ?>">
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            $yestarday_balance += $back_data[$i][1];
                                                            $yestarday_balance_2 -= $back_data[$i][1];
                                                            // $total_balance += $back_data[$i][1];
                                                            echo Ledger_balance($yestarday_balance);
                                                            ?>
                                                            <input type="hidden" class="t3t" value="<?php echo $yestarday_balance; ?>">
                                                            <?php
                                                        }
                                                        $total_balance += $yestarday_balance;
                                                        ?>
                                                    </td>
                                                </tr>
                                    <?php  
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
                                        <td><?php echo ""; ?></td>
                                        <td class="arh_rgt" style="font-weight: bold;"><?php 
                                        // echo $debit; 
                                        ?></td>
                                        <td class="arh_rgt" style="font-weight: bold;"><?php 
                                        // echo $credit; 
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
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card">
                                            <h4 style="margin-top: 11px; margin-bottom: -4px; margin-left: 10px;">
                                                Summary</h4>
                                            <hr>
                                            <?php  
                                 if(isset($_SESSION['Apb_client_summary_data']))
                                 {
                                 ?>
                                            <!-- Start Ledger Segment Data -->
                                            <?php
                                 $total_summary = 0;
                                 $found = 0;
                                 if(isset($group['Ledger']))
                                 {
                                 foreach ($group['Ledger'] as $key => $ledger_value) 
                                 {
                                 
                                     if($ledger_value[4] == "BSE_CASH" or $ledger_value[4] == "MF_BSE" or $ledger_value[4] == "NSE_CASH" or $ledger_value[4] == "NSE_SLBM")
                                     {
                                       if($ledger_value[3] != "" or $ledger_value[3] == "0")
                                       {
                                     ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted"><?php echo $ledger_value[4]; ?></small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <small class="text-muted"
                                                style="text-align-last: end;"><?php echo check_num_con($total_summary); ?></small>
                                            <hr style="margin: 0.5rem 0;">
                                            <?php 
                                 }
                                 ?>
                                            <!-- End Ledger Segment Data -->
                                            <!-- Start Ledger Icex Nse_Fno Data -->
                                            <?php
                                 $found = 0;
                                 foreach ($group['Ledger'] as $key => $ledger_value) 
                                 {
                                 
                                     if($ledger_value[4] == "ICEX" or $ledger_value[4] == "NSE_FNO")
                                     {
                                       if($ledger_value[3] != "" or $ledger_value[3] == "0")
                                       {
                                     ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small
                                                        class="text-muted"><?php print_r($ledger_value[4]); ?></small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <small class="text-muted"
                                                style="text-align-last: end;"><?php echo check_num_con($total_summary); ?></small>
                                            <hr style="margin: 0.5rem 0;">
                                            <?php 
                                 }
                                 ?>
                                            <!-- End Ledger ICEX Data -->
                                            <!-- START Ledger CD_NSE Data -->
                                            <?php
                                 $found = 0;
                                 foreach ($group['Ledger'] as $key => $ledger_value) 
                                 {
                                 
                                     if($ledger_value[4] == "CD_NSE")
                                     {
                                       if($ledger_value[3] != "" or $ledger_value[3] == "0")
                                       {
                                     ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small
                                                        class="text-muted"><?php print_r($ledger_value[4]); ?></small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <small class="text-muted"
                                                style="text-align-last: end;"><?php echo check_num_con($total_summary); ?></small>
                                            <hr style="margin: 0.5rem 0;">
                                            <?php 
                                 }
                                 ?>
                                            <!-- End Ledger CD_NSE Data -->
                                            <!-- Start Ledger MCX Data -->
                                            <?php
                                 $found = 0;
                                 foreach ($group['Ledger'] as $key => $ledger_value) 
                                 {
                                 
                                     if($ledger_value[4] == "MCX")
                                     {
                                       if($ledger_value[3] != "" or $ledger_value[3] == "0")
                                       {
                                     ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small
                                                        class="text-muted"><?php print_r($ledger_value[4]); ?></small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <small class="text-muted"
                                                style="text-align-last: end;"><?php echo check_num_con($total_summary); ?></small>
                                            <hr style="margin: 0.5rem 0;">
                                            <?php  
                                 }
                                 }
                                 ?>
                                            <!-- Start Ledger MCX Data -->
                                            <!-- Start Virtual Block Data -->
                                            <?php
                                 $virtual_block = 0;
                                 if(isset($group['Virtual Debit']))
                                 {
                                     if(!empty($group['Virtual Debit']))
                                     {
                                         foreach ($group['Virtual Debit'] as $key => $ledger_value) 
                                         {
                                 
                                             if($ledger_value[3] != "")
                                             {
                                                 $virtual_block += $ledger_value[3];
                                     ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Virtual Block</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 }
                                 }
                                 }
                                 ?>
                                            <?php
                                 $cdsl = 0;
                                 foreach ($group as $key_1 => $value_1) {
                                   
                                     foreach ($value_1 as $value_2) {
                                 
                                         if(in_array('CDSL', $value_2, TRUE) or in_array('cdsl', $value_2, TRUE))
                                         { ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">cdsl</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php print_r(check_num_con($value_2[3])); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 $total_summary += $value_2[3];
                                 }
                                 
                                 
                                 }
                                 
                                 }
                                 ?>
                                            <small class="text-muted"
                                                style="text-align-last: end;"><?php echo check_num_con($total_summary); ?></small>
                                            <hr style="margin: 0.5rem 0;">
                                            <!-- End Ledger Virtual Block Data -->
                                            <!-- Start Margin COLLETRAL Associate Ledger Data -->
                                            <?php
                                 $margin_summary = 0;
                                 $found = 0;
                                 if(!empty($group['Margin']))
                                 {
                                     foreach ($group['Margin'] as $key => $ledger_value) 
                                     {
                                 
                                         if($ledger_value[3] != "")
                                         {
                                             $margin_summary += $ledger_value[3];
                                 ?>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Margin</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small class="text-muted"
                                                        style="text-align-last: end;"><?php echo check_num_con($margin_summary); ?></small>
                                                </div>
                                            </div>
                                            <?php  
                                 }
                                 
                                 $colletral_summary = 0;
                                 $found = 0;
                                 if(!empty($group['COLLETRAL']))
                                 {
                                     foreach ($group['COLLETRAL'] as $key => $ledger_value) 
                                     {
                                 
                                         if($ledger_value[3] != "")
                                         {
                                             $colletral_summary += $ledger_value[3];
                                         ?>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Colletral</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($colletral_summary); ?></small>
                                                </div>
                                            </div>
                                            <?php  
                                 }
                                 
                                 
                                 $Associate_Ledger = 0;
                                 $found = 0;
                                 if(!empty($group['Associate Ledger']))
                                 {
                                     foreach ($group['Associate Ledger'] as $key => $ledger_value) 
                                     {
                                 
                                         if($ledger_value[3] != "")
                                         {
                                             $Associate_Ledger += $ledger_value[3];
                                         ?>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Associate Ledger</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($Associate_Ledger); ?></small>
                                                </div>
                                            </div>
                                            <?php  
                                 }
                                 ?>
                                            <small class="text-muted"
                                                style="text-align-last: end;"><?php echo check_num_con($total_summary); ?></small>
                                            <hr style="margin: 0.5rem 0;">
                                            <?php
                                 $Beneficiary = 0;
                                   $found = 0;
                                   if(!empty($group['Beneficiary']))
                                   {
                                       foreach ($group['Beneficiary'] as $key => $ledger_value) 
                                       {
                                 
                                           if($ledger_value[3] != "")
                                           {
                                               $Beneficiary += $ledger_value[3];
                                           ?>
                                            <?php
                                 $total_summary += $ledger_value[3]; 
                                 }
                                 $found++;
                                 }
                                 }
                                 if($found != 0)
                                 {
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Beneficiary</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($Beneficiary); ?></small>
                                                </div>
                                            </div>
                                            <?php  
                                 }
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Net</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($total_summary); ?></small>
                                                </div>
                                            </div>
                                            <hr style="margin: 0.5rem 0;">
                                            <!-- Start Margin COLLETRAL Associate Ledger Data -->
                                            <?php
                                 foreach ($group['UnConcile Credit'] as $key => $ledger_value) 
                                 {
                                 
                                    if($ledger_value[2] == "UnConcile Credit")
                                    {
                                       if($ledger_value[3] == "" or $ledger_value[3] == "0")
                                       {
                                           $ledger_value[3] = 0;
                                       }
                                       
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">UnConcile Credit</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 }
                                 }
                                 ?>
                                            <?php
                                 foreach ($group['Total Ledger'] as $key => $ledger_value) 
                                 {
                                 
                                    if($ledger_value[2] == "Total Ledger")
                                    {
                                       if($ledger_value[3] == "" or $ledger_value[3] == "0")
                                       {
                                          $ledger_value[3] = 0;
                                       }
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Total Ledger</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 }
                                 }
                                 ?>
                                            <?php
                                 foreach ($group['Ledger+Mrg-Coll'] as $key => $ledger_value) 
                                 {
                                 
                                    if($ledger_value[2] == "Ledger+Mrg-Coll")
                                    {
                                       if($ledger_value[3] == "" or $ledger_value[3] == "0")
                                       {
                                          $ledger_value[3] = 0;
                                       }
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Ledger+Mrg-Coll</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 }
                                 }
                                 ?>
                                            <?php
                                 foreach ($group['Pending Receipt'] as $key => $ledger_value) 
                                 {
                                 
                                    if($ledger_value[2] == "Pending Receipt")
                                    {
                                       if($ledger_value[3] == "" or $ledger_value[3] == "0")
                                       {
                                          $ledger_value[3] = 0;
                                       }
                                 ?>
                                            <div class="row">
                                                <div class="col-6" style="text-align: left;">
                                                    <small class="text-muted">Pending Receipt</small>
                                                </div>
                                                <div class="col-6" style="text-align-last: end;">
                                                    <small
                                                        class="text-muted"><?php echo check_num_con($ledger_value[3]); ?></small>
                                                </div>
                                            </div>
                                            <?php
                                 }
                                 }
                                 ?>
                                            <?php
                                 }
                                 else
                                 {
                                     echo "<small class=\"text-muted\">We could not find the resource you requsted.(Error !)</small>";
                                 }
                                 ?>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <div class="col-9">
                                        <div class="card">
                                            <h4 style="margin-top: 11px; margin-bottom: -4px; margin-left: 10px;">
                                                Holding</h4>
                                            <hr>
                                            <table id="datatables" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Script Name</th>
                                                        <th>ISIN</th>
                                                        <th>POA</th>
                                                        <th>NONPOA</th>
                                                        <th>Margin</th>
                                                        <th>In Short</th>
                                                        <th>Out Short</th>
                                                        <th>Net</th>
                                                        <th>Closing Price</th>
                                                        <th>Amount</th>
                                                        <!-- <th>Total</th> -->
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
                                       $nonpoa = 0;
                                       $poa = 0;
                                       if(!empty($holdint_data))
                                       {
                                       foreach ($holdint_data as $key_index => $data_row) {
                                           
                                       $colqty = $colqty + $holdint_data[$i][29];
                                       $inshort = $inshort + $holdint_data[$i][5];
                                       $outshort = $outshort + $holdint_data[$i][6];
                                       $net = $net + $holdint_data[$i][38];
                                       $scriptvalue = $scriptvalue + $holdint_data[$i][30];
                                       $amount = $amount + $holdint_data[$i][2];
                                       $nonpoa = $nonpoa + $holdint_data[$i][36];
                                       $poa = $poa + $holdint_data[$i][32];
                                       ?>
                                                    <tr>
                                                        <td><?php echo $holdint_data[$i][26]; ?></td>
                                                        <td><?php echo $holdint_data[$i][9]; ?></td>
                                                        <td class="t9 arh_rgt"><?php echo $holdint_data[$i][32]; ?></td>
                                                        <td class="t8 arh_rgt"><?php echo $holdint_data[$i][36]; ?></td>
                                                        <!-- none poa -->
                                                        <td class="t1 arh_rgt"><?php echo $holdint_data[$i][29]; ?></td>
                                                        <td class="t2 arh_rgt"><?php echo $holdint_data[$i][5]; ?></td>
                                                        <td class="t3 arh_rgt"><?php echo $holdint_data[$i][6]; ?></td>
                                                        <td class="t4 arh_rgt"><?php echo $holdint_data[$i][38]; ?></td>
                                                        <td class="t5 arh_rgt"><?php echo $holdint_data[$i][30]; ?></td>
                                                        <td class="t6 arh_rgt"><?php echo $holdint_data[$i][2]; ?></td>
                                                    </tr>
                                                    <?php  
                                       $i++;
                                       }
                                       }
                                       else
                                       {?>
                                                    <?php
                                       }
                                       ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td style="font-weight: bold;"><?php echo "Total"; ?></td>
                                                        <td><?php echo ""; ?></td>
                                                        <td class="ft9 arh_rgt_bold"></td>
                                                        <td class="ft8 arh_rgt_bold"></td>
                                                        <td class="ft1 arh_rgt_bold"></td>
                                                        <td class="ft2 arh_rgt_bold"></td>
                                                        <td class="ft3 arh_rgt_bold"></td>
                                                        <td class="ft4 arh_rgt_bold"></td>
                                                        <td class="ft5 arh_rgt_bold"></td>
                                                        <td class="ft6 arh_rgt_bold"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;"><?php echo "Grand Total"; ?></td>
                                                        <td><?php echo ""; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $poa; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $nonpoa; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $colqty; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $inshort; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $outshort; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $net; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $scriptvalue; ?></td>
                                                        <td class="arh_rgt_bold"><?php echo $amount; ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
    <script type="text/javascript">
    $(document).ready(function() {

        $('#datatable1').DataTable({

            responsive: true

        });
    });

    $(document).ready(function() {

        $('#datatables').DataTable({

            responsive: true

        });
    });
    </script>
    <style type="text/css">
    #datatables input {
        width: 100%;
        box-sizing: border-box;
    }
    </style>