<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<table id="exceltable" style="display: none;">
    <thead>
        <tr>
            <th>TODATE</th>
            <th>DR INTEREST</th>
            <th>CR INTEREST</th>
            <th>ACCOUNT CODE</th>
            <th>VODATE</th>
            <th>COCD</th>
            <th>RUNING BALANCE</th>
            <th>INTEREST RATE</th>
            <th>DAYS</th>
            <th>NARRATION</th>
            <th>DR AMT</th>
            <th>CR AMT</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($back_data)){
                               foreach ($back_data as $data_row) {

                              ?>

        <tr>
            <td><?php echo $data_row[0];?></td>
            <td><?php echo $data_row[1];?></td>
            <td><?php echo $data_row[2];?></td>
            <td><?php echo $data_row[3];?></td>
            <td><?php echo $data_row[4];?></td>
            <td><?php echo $data_row[5];?></td>
            <td><?php echo $data_row[6];?></td>
            <td><?php echo $data_row[7];?></td>
            <td><?php echo $data_row[8];?></td>
            <td><?php echo $data_row[9];?></td>
            <td><?php echo $data_row[10];?></td>
            <td><?php echo $data_row[11];?></td>
        </tr>
        <?php } } ?>

    </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {

    $("#exceltable").table2excel({
        exclude: ".noExl",
        name: "Developer data",
        filename: "Late Payment Charges",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/Late_payment_charges";

});
</script>