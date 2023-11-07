<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<table id="exceltable" style="display: none;">
    <thead>
        <tr>
            <!-- <th>A1</th> -->
            <th>CLIENT ID</th>
            <th>CLIENT NAME</th>
            <th>LEDGER</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($back_data)){
               foreach ($back_data as $data_row) {
            ?>
        <tr>
            <!-- <td><?php echo $data_row[0];?></td> -->
            <td><?php echo $data_row[1];?></td>
            <td><?php echo $data_row[2];?></td>
            <td><?php echo $data_row[3];?></td>

        </tr>
        <?php } } ?>
    </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {

    $("#exceltable").table2excel({
        exclude: ".noExl",
        name: "Developer data",
        filename: "Client Debit Credit",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/Client_wise_dr_cr";

});
</script>