<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<table id="exceltable" style="display: none;">
    <thead>
        <tr>
            <th>COMPANY_CODE</th>
            <th>END_DATE</th>
            <th>SCRIP_SYMBOL</th>
            <th>CNTR_COMPANY_CODE</th>
            <th>CNTR_MKT_TYPE</th>
            <th>CNTR_SETL_NO</th>
            <th>CNTR_TRADE_DATE</th>
            <th>CNTR_QTY</th>
            <th>CNTR_RATE</th>
            <th>CNTR_INDEX_RATE</th>
            <th>PL_AMT</th>
            <th>MKT_TYPE</th>
            <th>INDEXED_PL_AMT</th>
            <th>TERM</th>
            <th>TR_TYPE</th>
            <th>BRANCHID</th>
            <th>FAMILYID</th>
            <th>TOKEN</th>
            <th>CLIENT_NAME</th>
            <th>SCRIP_NAME</th>
            <th>ISIN</th>
            <th>CLPRICE</th>
            <th>SETL_NO</th>
            <th>TRADE_DATE</th>
            <th>QTY</th>
            <th>RATE</th>
            <th>INDEX_RATE</th>
            <th>CLIENT_ID</th>
            <th>START_DATE</th>
        </tr>
    </thead>
    <tbody>

        <?php 
                              $i = 0;
                                 if(!empty($back_data))
                                 {
                                    foreach ($back_data as $key_index => $data_row) 
                                    {
                                       // print_r($data_row);
                                       // return;
                              ?>
        <tr>
            <td><?php echo $back_data[$i][0]; ?></td>
            <td><?php echo $back_data[$i][1]; ?></td>
            <td><?php echo $back_data[$i][2]; ?></td>
            <td><?php echo $back_data[$i][3]; ?></td>
            <td><?php echo $back_data[$i][4]; ?></td>
            <td><?php echo $back_data[$i][5]; ?></td>
            <td><?php echo $back_data[$i][6]; ?></td>
            <td><?php echo $back_data[$i][7]; ?></td>
            <td><?php echo $back_data[$i][8]; ?></td>
            <td><?php echo $back_data[$i][9]; ?></td>
            <td><?php echo $back_data[$i][10]; ?></td>
            <td><?php echo $back_data[$i][11]; ?></td>
            <td><?php echo $back_data[$i][12]; ?></td>
            <td><?php echo $back_data[$i][13]; ?></td>
            <td><?php echo $back_data[$i][14]; ?></td>
            <td><?php echo $back_data[$i][15]; ?></td>
            <td><?php echo $back_data[$i][16]; ?></td>
            <td><?php echo $back_data[$i][17]; ?></td>
            <td><?php echo $back_data[$i][18]; ?></td>
            <td><?php echo $back_data[$i][19]; ?></td>
            <td><?php echo $back_data[$i][20]; ?></td>
            <td><?php echo $back_data[$i][21]; ?></td>
            <td><?php echo $back_data[$i][22]; ?></td>
            <td><?php echo $back_data[$i][23]; ?></td>
            <td><?php echo $back_data[$i][24]; ?></td>
            <td><?php echo $back_data[$i][25]; ?></td>
            <td><?php echo $back_data[$i][26]; ?></td>
            <td><?php echo $back_data[$i][27]; ?></td>
            <td><?php echo $back_data[$i][28]; ?></td>
        </tr>
        <?php
                                  $i++;
                                 }
                              }
                             ?>
    </tbody>
</table>

<script type="text/javascript">
$(document).ready(function() {

    $("#exceltable").table2excel({
        exclude: ".noExl",
        name: "Developer data",
        filename: "profit_and_loss_report",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/profit_loss_Form";

});
</script>