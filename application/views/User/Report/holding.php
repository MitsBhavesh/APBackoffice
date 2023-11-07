<!-- Start DataTable -->
<?php 
include("check_number_convert.php");
include("datatlb_header.php");
?>
<style>
   .table td, .table th {
   font-size: 11px;
   /*font-family:    Arial, Verdana, sans-serif;*/
   }
</style>
<div class="card-body">
    <div class="row">
        <h6> Holding Report</h6>
        <div class="col-12">
            <div class="">
                <div class="card-body">
                    <div style="text-align-last: end;">
                        <a href="<?php echo base_url('Reports/report_holding_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                         <a href="<?php echo base_url('Reports/report_holding_pdf_download'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                                            height="25"></a>
                     </div>
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>Script Name</th>
                                <th>ISIN</th>
                                <th>POA</th>
                                <th>NONPOA</th>
                                <th>Colletral</th>
                                <th>In Short</th>
                                <th>Out Short</th>
                                <th>Net</th>
                                <th>Closing Price</th>
                                <th>Amount</th>
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
                                <td class="t8 arh_rgt"><?php echo $holdint_data[$i][36]; ?></td> <!-- none poa -->
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
<!-- End DataTable -->