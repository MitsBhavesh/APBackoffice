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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-wallet-plus me-3"
                        style="color: #ffff;"></i>Legder Report
</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Legder_detail">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Company code:</label>
                                            <div class="mb-3">
                                                <select name="exchange_code" id="exchange_code" class="form-select">
                                                    <option
                                                        value="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF"
                                                        <?php if(isset($_SESSION['ApbackOffice_client_exchange_code_ledger_detail'])){$_SESSION['ApbackOffice_client_exchange_code_ledger_detail'] == 'BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF' ? ' selected="selected"' : '';}else{echo 'selected';}?>>
                                                        Group 1</option>
                                                    <option value="MCX,ICEX"
                                                        <?php if(isset($_SESSION['ApbackOffice_client_exchange_code_ledger_detail'])){$_SESSION['ApbackOffice_client_exchange_code_ledger_detail'] == 'MCX,ICEX' ? ' selected="selected"' : '';}?>>
                                                        Group 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    value="<?php if(isset($_SESSION['ApbackOffice_client_code_ledger_detail'])){echo $_SESSION['ApbackOffice_client_code_ledger_detail'];}?>"
                                                    placeholder="Enter Client Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                            <input class="form-control" type="date"
                                                value="<?php if(isset($_SESSION['ApbackOffice_client_f_date_ledger_detail'])){echo $_SESSION['ApbackOffice_client_f_date_ledger_detail'];}else{echo $from_date;}?>"
                                                id="from_date" name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date</label>
                                            <input class="form-control" type="date"
                                                value="<?php if(isset($_SESSION['ApbackOffice_client_t_date_ledger_detail'])){echo $_SESSION['ApbackOffice_client_t_date_ledger_detail'];}else{echo $todate;}?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Margin:</label>
                                            <div class="mb-3">
                                                <select name="margin" id="margin" class="form-select">
                                                    <?php if($_SESSION['ApbackOffice_client_margin_code_ledger_detail'] == 'Y'){?>
                                                    <option value="Y" selected>Yes</option>
                                                    <?php }else{
                                          echo '<option value="Y">Yes</option>';
                                          }
                                             if($_SESSION['ApbackOffice_client_margin_code_ledger_detail'] == 'N'){
                                          ?>
                                                    <option value="N" selected>No</option>
                                                    <?php }else{
                                          echo '<option value="N">No</option>';
                                          }?>
                                                </select>
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
                        <?php
                     include("check_number_convert.php");
                     ?>
                        <style>
                        .table td,
                        .table th {
                            font-size: 11px;
                            padding: 0.35rem 0.35rem;
                            /*font-family:    Arial, Verdana, sans-serif;*/
                        }
                        </style>
                        <div class="card-body">
                            <div class="row">
                                <div style="text-align-last: end;">
                                    <a href="<?php echo base_url('Accounts/ledger_detail_excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                <a href="<?php echo base_url('Accounts/ledger_detail_pdf'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                                            height="25"></a>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-6">
                                                Name :<span
                                                    style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['ApbackOffice_client_name_ledger_detail'])){echo $_SESSION['ApbackOffice_client_name_ledger_detail'];}?></b></span>
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
                                        </div>
                                    </div>
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
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable1').DataTable({
        responsive: true

    });
});
</script>