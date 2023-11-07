<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>APBackOffice | Arhamshare PVT. LTD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Arhamshare PVT. LTD" name="description" />
        <meta content="Arhamshare PVT. LTD" name="author" />
         <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">
        <!-- Sweet Alert-->
        <link href="<?php echo base_url();?>assets_new/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?php echo base_url();?>assets_new/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url();?>assets_new/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url();?>assets_new/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">
        <script src="<?php echo base_url();?>assets_new/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets_new/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets_new/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets_new/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets_new/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>assets_new/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?php echo base_url();?>assets_new/js/pages/sweet-alerts.init.js"></script>
        <script src="<?php echo base_url();?>assets_new/js/app.js"></script>
         <?php  
         // print_r($dec_response);exit();
            if($dec_response['status']=="success")
            {
        ?>
         <script type="text/javascript">
            $( document ).ready(function() {
                Swal.fire({
                icon: "success",
                text:"Application No:<?php print_r($application_no);?>---Bid Reference No:<?php print_r($bidref_no);?>",
                title: "IPO Bidding Successfully",
                showConfirmButton: !1,
                timer: 60000
           }).then(function() {
            window.location.href = "http://apoffice.arhamshare.com/IPO/online";
            })
            });
        </script>
        <?PHP
  }
  else
  {?>
    <script type="text/javascript">
            $( document ).ready(function() {
                Swal.fire({
                icon: "error",
                title: "IPO Bidding Failed",
                text:"please wait...20 second after auto redirection.",
                showConfirmButton: !1,
                timer: 20000
           }).then(function() {
            window.location.href = "http://apoffice.arhamshare.com/IPO/online";
            })
            });
        </script>
  <?php
  }
?>
</body>
</html>