<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Forgot Password | APBackOffice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">

    <!-- preloader css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/preloader.min.css" type="text/css" />
    <!-- alertifyjs Css -->
    <link href="<?php echo base_url();?>assets/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet"
        type="text/css" />
    <!-- alertifyjs default themes  Css -->
    <link href="<?php echo base_url();?>assets/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-12 col-lg-12 col-md-12">
                    <!-- style="height: unset;" -->
                    <!-- style="background: linear-gradient(45deg, #155983,#0673b5, #80a7c6);" -->
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"
                            style="background: linear-gradient(45deg,#0b5639,#0b5639, #cedf8c);"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <!-- margin-bottom: unset; -->
                        <div class="col-xxl-3 col-lg-4 col-md-5"
                            style="background-color: white;z-index: 0;margin: auto;">
                            <!-- padding: 4rem!important; -->
                            <!-- start auth full page content -->
                            <div class="auth-full-page-content d-flex p-sm-5 p-4"
                                style="background: white!important;min-height: auto;">
                                <div class="w-100">
                                    <div class="d-flex flex-column h-100">
                                        <!-- mb-md-5 -->
                                        <div class="mb-4  text-center">
                                            <img src="<?php echo base_url(); ?>assets/images/logo6.png" alt=""
                                                height="30">
                                        </div>
                                        <div class="auth-content my-auto"
                                            style="margin-bottom: unset !important;margin-top: unset !important;">
                                            <div class="text-center">
                                                <h5 class="mb-0">Forgot Password</h5>
                                                <p class="text-muted mt-2">Registered email to send your genrated password.!</p>
                                            </div>
                                            <?php include("alert.php"); ?>
                                            <form id="myformlogin" method="post"
                                                action="<?php echo base_url('APBackOffice/Forgot_Password'); ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Branch Code</label>
                                                    <input type="text" class="form-control" id="branch_code"
                                                        name="branch_code" placeholder="Enter Branch Code" required>
                                                    <small class="text-muted form-text fw-semibold"
                                                        id="error_branch_code" style="color: red !important;"></small>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">Email</label>
                                                        </div>
                      
                                                    </div>
                                                    
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="Enter email" required>
                                                        <button class="btn btn-light shadow-none ms-0" type="button"
                                                            id="email-addon"><i
                                                                class="fa fa-envelope"></i></button>
                                                    </div>
                                                    <small class="text-muted form-text fw-semibold" id="error_email"
                                                        style="color: red !important;"></small>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <input type="submit"
                                                        class="btn btn-primary w-100 waves-effect waves-light"
                                                        value="Submit"
                                                        style="background-color: #0b5639;border-color: #acc840;">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end auth full page content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script type="text/javascript">
    setTimeout(function() {
        $('.alert-dismissible').fadeOut(1000);
    }, 10000);
    </script>
    <!-- alertifyjs js -->
    <script src="<?php echo base_url();?>assets/libs/alertifyjs/build/alertify.min.js"></script>
    <!-- notification init -->
    <script src="<?php echo base_url();?>assets/js/pages/notification.init.js"></script>
    <script src="<?php echo base_url();?>assets/libs/pace-js/pace.min.js"></script>
    <!-- password addon init -->
    <script src="<?php echo base_url();?>assets/js/pages/pass-addon.init.js"></script>

</body>

</html>