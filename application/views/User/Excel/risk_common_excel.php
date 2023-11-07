<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<table id="myTable1" style="display: none;">
    <thead>
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Ledger</th>
            <th>Margin</th>
            <th>SOH</th>
            <th>Benificiary Stock</th>
            <th>Collateral</th>
            <th>IN Short</th>
            <th>OUT Short</th>
            <th>Grossledger</th>
            <th>Net Stock</th>
            <th>Net Ledger</th>
            <th>Free Stock SOH</th>
            <th>Net Risk</th>
            <th>Last Trade Date</th>
            <th>Last Receipt</th>
            <th>Last Payment</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($back_data))
            {
               $i = 0;
               foreach ($back_data as $value) 
               {
         ?>
        <tr>
            <td><?php echo $value[1]; ?></td>
            <td><?php echo $value[2]; ?></td>
            <td><?php echo $value[3]; ?></td>
            <td><?php echo $value[4]; ?></td>
            <td><?php echo $value[5]; ?></td>
            <td><?php echo $value[6]; ?></td>
            <td><?php echo $value[7]; ?></td>
            <td><?php echo $value[8]; ?></td>
            <td><?php echo $value[9]; ?></td>
            <td><?php echo $value[10]; ?></td>
            <td><?php echo $value[11]; ?></td>
            <td><?php echo $value[12]; ?></td>
            <td><?php echo $value[13]; ?></td>
            <td><?php echo $value[14]; ?></td>
            <td><?php echo $value[15]; ?></td>
            <td><?php echo $value[16]; ?></td>
            <td><?php echo $value[17]; ?></td>
        </tr>
        <?php      
               }

            }
         ?>
    </tbody>
</table>

<script type="text/javascript">
$(document).ready(function() {

    $("#myTable1").table2excel({
        exclude: ".noExl",
        name: "Developer data",
        filename: "risk_common_report",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/risk_common_report_form";

});
</script>