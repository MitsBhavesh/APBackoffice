<!-- Start DataTable -->
<?php
if(isset($_SESSION['APBackOffice_MoreReport_Ledgerdata']))
{
   $columns=$_SESSION['APBackOffice_MoreReport_Ledgerdata'][0];
   $back_data=$_SESSION['APBackOffice_MoreReport_Ledgerdata'][1];
   // echo "<pre>";
   // print_r($back_data);exit();
}
   include("check_number_convert.php");
   ?>
<style>
   .table td, .table th {
   font-size: 11px;
   padding: 0.35rem 0.35rem;
   /*font-family:    Arial, Verdana, sans-serif;*/
   }

</style>
<br>
<div class="row">
    <div class="col-2" style="text-align: center;">
      Code :<span style="padding:20px;color:blue;"><b><?php echo $back_data[0][26];?></b></span>
    </div>
    <div class="col-5">
      Name :<span style="padding:20px;color:blue;"><b><?php echo $back_data[0][33];?></b></span>
    </div>
</div>
<div class="card-body">
   <div class="row">
      <div class="col-12">
         <div class="">
            <div class="card-body">
                 <div style="text-align-last: end;">
                    <a href="<?php echo base_url('Reports/report_ledger_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                     <a href="<?php echo base_url('Reports/report_Ledger_pdf_download'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                                            height="25"></a>
                 </div>
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