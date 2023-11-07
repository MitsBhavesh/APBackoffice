<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<table id="myTable1" style="display: none;">
     <thead>
        <tr>
            <th colspan="12"><?php echo $_SESSION['finacial_year_apbackoffice'];?></th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th>January</th>
            <th>February</th>
            <th>March</th>
            <th>April</th>
            <th>May</th>
            <th>June</th>
            <th>July</th>
            <th>August</th>
            <th>September</th>
            <th>October</th>
            <th>November</th>
            <th>December</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php if(isset($_SESSION['monthWise_Jan'])){echo $_SESSION['monthWise_Jan'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_Feb'])){echo $_SESSION['monthWise_Feb'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_March'])){echo $_SESSION['monthWise_March'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_April'])){echo $_SESSION['monthWise_April'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_May'])){echo $_SESSION['monthWise_May'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_June'])){echo $_SESSION['monthWise_June'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_July'])){echo $_SESSION['monthWise_July'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_August'])){echo $_SESSION['monthWise_August'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_September'])){echo $_SESSION['monthWise_September'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_Octomber'])){echo $_SESSION['monthWise_Octomber'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_November'])){echo $_SESSION['monthWise_November'];}?></td>
            <td><?php if(isset($_SESSION['monthWise_December'])){echo $_SESSION['monthWise_December'];}?></td>

        </tr>
        </tbody>
</table>

<script type="text/javascript">
$(document).ready(function() {

    $("#myTable1").table2excel({
        exclude: ".noExl",
        name: "Developer data",
        filename: "<?php echo $_SESSION['APBackOffice_user_code']?>_Brokerage_report_<?php echo $_SESSION['finacial_year_apbackoffice']?>",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
    window.location = "<?= base_url() ?>Dashboard/My_brokerage_chart";

});
</script>