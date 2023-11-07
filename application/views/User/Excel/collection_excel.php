<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<table id="exceltable" style="display: none;">
    <thead>
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Net Collection</th>
            <th>Margin</th>
            <th>Collatral</th>
            <th>Extra Collatral</th>
            <th>Short Margin</th>
            <th>COCD LIST</th>
            <th>Ledger + Margin</th>
        </tr>
    </thead>
    
     <tbody>
                                    <?php if(!empty($back_data)){
                              foreach ($back_data as $data_row) {
                                ?>

                                    <tr>
                                        <td><?php echo $data_row[1];?></td>
                                        <td><?php echo $data_row[2];?></td>
                                        <td><?php $short=(int)$data_row[76]+(int)$data_row[77];$netcollection=$data_row[79]+(-$short)+$data_row[78]; echo $netcollection;?></td>
                                        <td><?php $short=(int)$data_row[76]+(int)$data_row[77]; echo $short;?></td>
                                        <td><?php echo $data_row[5];?></td>
                                        <td><?php echo $data_row[68];?></td>
                                        <td><?php $short=(int)$data_row[76]+(int)$data_row[77];echo $short;?></td>
                                        <td><?php echo $data_row[39]." ".$data_row[40]." ".$data_row[41]." ".$data_row[42]." ".$data_row[43]." ".$data_row[44]." ".$data_row[45]." ".$data_row[46]." ".$data_row[47]." ".$data_row[48]." ".$data_row[49]." ".$data_row[50]." ".$data_row[51]." ".$data_row[52]." ".$data_row[53]." ".$data_row[54]." ".$data_row[55]." ".$data_row[56]." ".$data_row[57]." ".$data_row[58];?></td>
                                        <td><?php echo $data_row[79];?></td>
                                    </tr>
                                    <?php } } ?>

                                </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {

    $("#exceltable").table2excel({
        exclude: ".noExl",
        name: "Developer data",
        filename: "Collection Reports",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/Collect_view";

});
</script>