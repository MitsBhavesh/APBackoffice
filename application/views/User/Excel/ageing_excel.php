<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<table id="myTable1" style="display: none;">
    <thead>
        <?php
              if (!empty($ageing_data) && isset($ageing_data[0])) 
              {

           ?>
        <tr>
            <th>COMPANY CODE</th>
            <th>CLIENTNAME </th>
            <th>CLIENT_ID </th>
            <th>TOTAL AMOUNT </th>
            <th><?php print_r($ageing_data[0][9]); ?></th>
            <th><?php print_r($ageing_data[0][10]); ?></th>
            <th><?php print_r($ageing_data[0][12]); ?></th>
            <th><?php print_r($ageing_data[0][13]); ?></th>
            <th><?php print_r($ageing_data[0][14]); ?></th>
            <th><?php print_r($ageing_data[0][15]); ?></th>
        </tr>
        <?php
              }
           ?>
    </thead>
    <tbody>

        <?php
   // include("check_number_convert.php");

              if (!empty($ageing_data)) 
              {
                 $i = 0;
                 foreach ($ageing_data as $value)
                 {
           ?>
        <tr>
            <td><?php print_r($value[0]); ?></td>
            <td><?php print_r($value[22]); ?></td>
            <td><?php print_r($value[11]); ?></td>
            <td><?php print_r($value[2]); ?></td>
            <td><?php print_r($value[3]); ?></td>
            <td><?php print_r($value[4]); ?></td>
            <td><?php print_r($value[5]); ?></td>
            <td><?php print_r($value[6]); ?></td>
            <td><?php print_r($value[7]); ?></td>
            <td><?php print_r($value[8]); ?></td>

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
        filename: "ageing_report",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Accounts/Ageing";

});
</script>