<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<table id="exceltable" style="display: none;">
    <thead>
        <tr>
            <th>COMPANY CODE</th>
            <th>BRANCH CODE NAME</th>
            <th>CLIENT ID</th>
            <th>CLIENT NAME</th>
            <th>NET BRK</th>
            <th>CLIENT BROKERAGE</th>
            <th>REMESHIRE BROKERAGE</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($back_data)){
         foreach ($back_data as $data_row) {
         
         ?>
        <tr>
            <td><?php echo $data_row[0];?></td>
            <td><?php echo $data_row[11];?></td>
            <td><?php echo $data_row[24];?></td>
            <td><?php echo $data_row[25];?></td>
            <td><?php echo $data_row[27];?></td>
            <td><?php echo $data_row[5];?></td>
            <td><?php echo $data_row[29];?></td>
        </tr>
        <?php } } ?>
    </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {

    $("#exceltable").table2excel({
        exclude: ".noExl",
        name: "data",
        filename: "global brokerage summary",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/Global_Brokerage_Summary";

});
</script>