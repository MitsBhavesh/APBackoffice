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
         // print_r($bse_response);exit();
          $getdata = $bse_response->bids[0];
            if($getdata->errorcode == 0)
            {
        ?>
         <script type="text/javascript">
            $( document ).ready(function() {
                Swal.fire({
                icon: "success",
                text:"Application No:<?php print_r($orderno);?>---Bid Reference No:<?php print_r($bidid);?>",
                title: "IPO Bidding Successfully Don't refresh.! It's Takes Home Automatically.!",
                showConfirmButton: !1,
                timer: 60000
           }).then(function() {
            window.location.href = "https://apoffice.arhamshare.com/BSE_IPO";
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
                text:"Please Wait...20 second after Automatically Takes Home.!",
                showConfirmButton: !1,
                timer: 20000
           }).then(function() {
            window.location.href = "https://apoffice.arhamshare.com/BSE_IPO";
            })
            });
        </script>
  <?php
  }
?>
</body>
</html>