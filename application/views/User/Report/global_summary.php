<!-- Start DataTable -->
<?php 
// echo "<pre>";
// print_r($globalDetails); 
if(isset($_SESSION['APBackOffice_MoreReport_GlobalSummarydata']))
{
    // print_r($_SESSION['APBackOffice_MoreReport_Ledgerdata']);
    // exit();
   $columns=$_SESSION['APBackOffice_MoreReport_GlobalSummarydata'][0];
   $back_data=$_SESSION['APBackOffice_MoreReport_GlobalSummarydata'][1];
   // echo "<pre>";
   // print_r($back_data);exit();
}     
?>
<style>
   .table td, .table th {
    font-size: 11px !important;
    padding: 0.35rem 0.35rem;
   }
</style>
<div class="card-body">
    <div class="row">
        <div class="col-2" style="text-align: center;">
          Code :<span
              style="padding:20px;color:blue;"><b><?php echo $back_data[0][36];?></b></span>
        </div>
        <div class="col-5">
          Name :<span
              style="padding:20px;color:blue;"><b><?php echo $back_data[0][37];?></b></span>
        </div>       
    </div>
    <br>
   <div class="row">
        <h4> Global Summary</h4>
        <div class="col-12">
            <div class="">
                <div class="card-body">
                     <div style="text-align-last: end;">
                        <a href="<?php echo base_url('Reports/report_globalsummary_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                         <a href="<?php echo base_url('Reports/report_global_summery_pdf_download'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                                            height="25"></a>
                     </div>
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                                    <tr>
                                        <th>Script</th>
                                        <th>Open Qty</th>
                                        <th>Open rate</th>
                                        <th>Buy Qty</th>
                                        <th>Buy Rate</th>
                                        <th>Sale Qty</th>
                                        <th>Sale Rate</th>
                                        <th>Net Qty</th>
                                        <th>Net Rate</th>
                                        <th>Net Amount</th>
                                        <th>Closing Price</th>
                                        <th>Not Profit</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                       <?php 
                                    $opqty = 0;
                                    $buyqty = 0;
                                    $buyamount = 0;
                                    $saleqty = 0;
                                    $saleamount = 0;
                                    $netqty = 0;
                                    $netamount = 0;
                                    $netprofit = 0;
                                    if(!empty($back_data))
                                    {
                                        $i = 0;

                                        foreach ($back_data as $key_index => $data_row) 
                                        {
                                            $opqty += $back_data[$i][39];
                                            $buyqty += $back_data[$i][2];
                                            $buyamount += $back_data[$i][4];
                                            $saleqty += $back_data[$i][5];
                                            $saleamount += $back_data[$i][7];
                                            $netqty += $back_data[$i][8];
                                            $netamount += $back_data[$i][10];
                                            $netprofit += $back_data[$i][14];

                                            if($back_data[$i][28] != "IGST" && $back_data[$i][28] != "STAMP DUTY" && $back_data[$i][28] != "OTHER EXP" && $back_data[$i][28] != "STT" && $back_data[$i][28] != "CGST" && $back_data[$i][28] != "SGST" && $back_data[$i][28] != "TURN OVER CHARGE")
                                            {
                                            ?>
                                                <tr>
                                                    <td><?php echo $back_data[$i][38]; ?></td>
                                                    <!-- <td><?php echo $back_data[$i][28]; ?></td> -->
                                                    <td class="t1 arh_rgt"><?php echo $back_data[$i][39]; ?></td>
                                                    <td class="arh_rgt"><?php echo $back_data[$i][1]; ?></td>
                                                    <td class="t2 arh_rgt"><?php echo $back_data[$i][2]; ?></td>
                                                    <td class="arh_rgt"><?php echo $back_data[$i][3]; ?></td>
                                                    <td class="t4 arh_rgt"><?php echo $back_data[$i][5]; ?></td>
                                                    <td class="arh_rgt"><?php echo $back_data[$i][6]; ?></td>
                                                    <td class="t6 arh_rgt"><?php echo $back_data[$i][8]; ?></td>
                                                    <td class="arh_rgt"><?php echo $back_data[$i][9]; ?></td>
                                                    <td class="t7 arh_rgt"><?php echo $back_data[$i][10]; ?></td>
                                                    <td class="arh_rgt"><?php echo $back_data[$i][13]; ?></td>
                                                    <td class="t8 arh_rgt"><?php echo $back_data[$i][14]; ?></td>
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
                                    ?>                                  
                                    </tbody>
                                    <tfoot>
                                    <?php
                                    $i = 0;
                                    if(!empty($back_data))
                                    {
                                    foreach ($back_data as $key_index => $data_row) 
                                    {
                                        if($back_data[$i][28] == "IGST" or $back_data[$i][28] == "STAMP DUTY" or $back_data[$i][28] == "OTHER EXP" or $back_data[$i][28] == "STT" or $back_data[$i][28] == "CGST" or $back_data[$i][28] == "SGST" or $back_data[$i][28] == "TURN OVER CHARGE")
                                        {
                                    ?>
                                            <tr class="expense_tr">
                                                <td><?php echo $back_data[$i][38]; ?></td>
                                                <!-- <td><?php echo $back_data[$i][28]; ?></td> -->
                                                <td class="t1 arh_rgt"><?php echo $back_data[$i][39]; ?></td>
                                                <td class="arh_rgt"><?php echo $back_data[$i][1]; ?></td>
                                                <td class="t2 arh_rgt"><?php echo $back_data[$i][2]; ?></td>
                                                <td class="arh_rgt"><?php echo $back_data[$i][3]; ?></td>
                                                <td class="t4 arh_rgt"><?php echo $back_data[$i][5]; ?></td>
                                                <td class="arh_rgt"><?php echo $back_data[$i][6]; ?></td>
                                                <td class="t6 arh_rgt"><?php echo $back_data[$i][8]; ?></td>
                                                <td class="arh_rgt"><?php echo $back_data[$i][9]; ?></td>
                                                <td class="t7 arh_rgt"><?php echo $back_data[$i][10]; ?></td>
                                                <td class="arh_rgt"><?php echo $back_data[$i][13]; ?></td>
                                                <td class="t8 arh_rgt"><?php echo $back_data[$i][14]; ?></td>
                                            </tr>
                                    <?PHP
                                        }
                                        $i++;

                                    }
                                    }
                                    ?>
                                    <tr>
                                        <td style="font-weight: bold;"><?php echo "Total"; ?></td>
                                        <td class="ft1 arh_rgt_bold"></td>
                                        <td class="arh_rgt_bold"></td>
                                        <td class="ft2 arh_rgt_bold"></td>
                                        <td class="arh_rgt_bold"></td>
                                        <td class="ft4 arh_rgt_bold"></td>
                                        <td class="arh_rgt_bold"></td>
                                        <td class="ft6 arh_rgt_bold"></td>
                                        <td class="arh_rgt_bold"></td>
                                        <td class="ft7 arh_rgt_bold"></td>
                                        <td class="arh_rgt_bold"></td>
                                        <td class="ft8 arh_rgt_bold"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;"><?php echo "Grand Total"; ?></td>
                                        <td class="arh_rgt_bold"><?php echo $opqty; ?></td>
                                        <td></td>
                                        <td class="arh_rgt_bold"><?php echo $buyqty; ?></td>
                                        <td></td>                                       
                                        <td class="arh_rgt_bold"><?php echo $saleqty; ?></td>
                                        <td></td>
                                        <td class="arh_rgt_bold"><?php echo $netqty; ?></td>
                                        <td></td>
                                        <td class="arh_rgt_bold"><?php echo $netamount; ?></td>
                                        <td></td>
                                        <td class="arh_rgt_bold"><?php echo $netprofit; ?></td>
                                        <?php 
                                        $_SESSION['totalofnetamount'] = $netamount;
                                        $_SESSION['totalofnetprofit'] = $netprofit;
                                        ?>
                                    </tr>
                                </tfoot>
                    </table>
                </div>
            </div>
        </div> 
    </div> 
</div>
<!-- End DataTable -->