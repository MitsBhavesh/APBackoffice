<?PHP
header('Access-Control-Allow-Origin: *');
?>
<!doctype html>
<html lang="en">


<!-- Mirrored from minia.django.themesbrand.com/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 08 Nov 2021 08:04:38 GMT -->

<head>

    <meta charset="utf-8" />
    <title>APBackOffice | Sub-Broker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="APBackOffice" name="description" />
    <meta content="Arhamshare" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Authorize Person BackOffice">
    <meta name="keywords" content="apoffice,Arhamshare,sub-broker arhamshare">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">

    <!-- plugin css -->
    <link href="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/lgallery/lightgallery.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
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
    <!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/digital.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
        <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
        <script src="<?php echo base_url();?>assets/lgallery/js/lg-video.js"></script>
        <script src="<?php echo base_url();?>assets/lgallery/js/lg-rotate.js"></script>
    <style type="text/css">
    .zoom {
        box-sizing: border-box;

        transition: transform .2s;

        /*margin: 0 auto;*/
    }

    .zoom:hover {
        -ms-transform: scale(1.02);
        /* IE 9 */
        -webkit-transform: scale(1.02);
        /* Safari 3-8 */
        transform: scale(1.02);
    }

    .demo-gallery>ul {
        margin-bottom: 0;
    }

    .demo-gallery>ul>li {
        float: left;
        margin-bottom: 15px;
        margin-right: 20px;
        width: 200px;
    }

    .demo-gallery>ul>li a {
        border: 3px solid #FFF;
        border-radius: 3px;
        display: block;
        overflow: hidden;
        position: relative;
        float: left;
    }

    .demo-gallery>ul>li a>img {
        -webkit-transition: -webkit-transform 0.15s ease 0s;
        -moz-transition: -moz-transform 0.15s ease 0s;
        -o-transition: -o-transform 0.15s ease 0s;
        transition: transform 0.15s ease 0s;
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
        height: 100%;
        width: 100%;
    }

    .demo-gallery>ul>li a:hover>img {
        -webkit-transform: scale3d(1.1, 1.1, 1.1);
        transform: scale3d(1.1, 1.1, 1.1);
    }

    .demo-gallery>ul>li a:hover .demo-gallery-poster>img {
        opacity: 1;
    }

    .demo-gallery>ul>li a .demo-gallery-poster {
        background-color: rgba(0, 0, 0, 0.1);
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        -webkit-transition: background-color 0.15s ease 0s;
        -o-transition: background-color 0.15s ease 0s;
        transition: background-color 0.15s ease 0s;
    }

    .demo-gallery>ul>li a .demo-gallery-poster>img {
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        opacity: 0;
        position: absolute;
        top: 50%;
        -webkit-transition: opacity 0.3s ease 0s;
        -o-transition: opacity 0.3s ease 0s;
        transition: opacity 0.3s ease 0s;
    }

    .demo-gallery>ul>li a:hover .demo-gallery-poster {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .demo-gallery .justified-gallery>a>img {
        -webkit-transition: -webkit-transform 0.15s ease 0s;
        -moz-transition: -moz-transform 0.15s ease 0s;
        -o-transition: -o-transform 0.15s ease 0s;
        transition: transform 0.15s ease 0s;
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
        height: 100%;
        width: 100%;
    }

    .demo-gallery .justified-gallery>a:hover>img {
        -webkit-transform: scale3d(1.1, 1.1, 1.1);
        transform: scale3d(1.1, 1.1, 1.1);
    }

    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster>img {
        opacity: 1;
    }

    .demo-gallery .justified-gallery>a .demo-gallery-poster {
        background-color: rgba(0, 0, 0, 0.1);
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        -webkit-transition: background-color 0.15s ease 0s;
        -o-transition: background-color 0.15s ease 0s;
        transition: background-color 0.15s ease 0s;
    }

    .demo-gallery .justified-gallery>a .demo-gallery-poster>img {
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        opacity: 0;
        position: absolute;
        top: 50%;
        -webkit-transition: opacity 0.3s ease 0s;
        -o-transition: opacity 0.3s ease 0s;
        transition: opacity 0.3s ease 0s;
    }

    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .demo-gallery .video .demo-gallery-poster img {
        height: 48px;
        margin-left: -24px;
        margin-top: -24px;
        opacity: 0.8;
        width: 48px;
    }

    .demo-gallery.dark>ul>li a {
        border: 3px solid #04070a;
    }

    .home .demo-gallery {
        padding-bottom: 80px;
    }

    .table td,
    .table th {
        font-size: 11px !important;
        padding: 0.35rem 0.35rem;
    }
    </style>
</head>

<body data-layout="horizontal">
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <button type="button"
                        class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                        data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?php echo base_url();?>assets/images/logo6.png" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url();?>assets/images/logo6.png" alt="" height="24">
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?php echo base_url();?>assets/images/logo6.png" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url();?>assets/images/logo6.png" alt="" height="24">
                            </span>
                        </a>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item dropdown-toggle me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="fw-medium header-item me-2">
                            <?php if(isset($_SESSION['finacial_year_apbackoffice'])){$year=$_SESSION['finacial_year_apbackoffice'];$yearnew=$year-1;echo "Financial Year ".$yearnew."-".$year;}else{$year=date("Y");$yearnew=$year-1;echo "Financial Year ".$yearnew."-".$year;}?></span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings icon-lg"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        </button>

                        <div class="dropdown-menu dropdown-menu-md p-4">
                            <form method="post" action="<?php echo base_url();?>APBackOffice/Select_year">
                                <div class="mb-2">
                                    <label class="form-label" for="fincial_Year">Financial Year</label>
                                        <select class="form-select" name="finacial_year">
                                            <option value="2024" <?= (($_SESSION['finacial_year_apbackoffice'] == 2024)?'selected':''); ?>>2023-2024</option>
                                            <option value="2023" <?= (($_SESSION['finacial_year_apbackoffice'] == 2023)?'selected':''); ?>>2022-2023</option>
                                            <option value="2022" <?= (($_SESSION['finacial_year_apbackoffice'] == 2022)?'selected':''); ?>>2021-2022</option>
                                            <option value="2021" <?= (($_SESSION['finacial_year_apbackoffice'] == 2021)?'selected':''); ?>>2020-2021</option>
                                            <option value="2020" <?= (($_SESSION['finacial_year_apbackoffice'] == 2020)?'selected':''); ?>>2019-2020</option>

                                        </select>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn w-md btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-soft-light border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <!--   <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar"> -->
                            <span
                                class="d-none d-xl-inline-block ms-1 fw-medium" style="color:#2ab57d;"><?php echo strtoupper($_SESSION['APBackOffice_user_code']); ?></span>

                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="<?php echo base_url();?>APBackOffice/profile"><i
                                    class="mdi mdi-account font-size-16 align-middle me-1"></i> Partner Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>APBackOffice/Change_Password"><i
                                    class="mdi mdi-lock font-size-16 align-middle me-1"></i> Change Password</a>
                            <a class="dropdown-item" href="<?php echo base_url();?>APBackOffice/logout"><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="topnav">
            <!-- <marquee class="nav-link" style="background-color:#d8e9e2;color: black;">Arhamshare</marquee> -->
            <div class="container-fluid">

                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="<?php echo base_url();?>Dashboard"
                                    id="topnav-dashboard" role="button">
                                    <i class="mdi mdi-desktop-mac-dashboard me-2"></i><span
                                        data-key="t-dashboards">Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement"
                                    role="button">
                                    <i class="mdi mdi-account-multiple me-2"></i>
                                    <span data-key="t-elements">Accounts</span>
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                   <!--  <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                            role="button">
                                            <span data-key="t-email">Receipt/Payout request</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="<?php echo base_url();?>Accounts/payment_request_wallet"
                                                class="dropdown-item" data-key="t-read-email">Payment request</a>
                                            <a href="<?php echo base_url();?>Accounts/receipt_request"
                                                class="dropdown-item" data-key="t-inbox">Receipt request</a>
                                        </div>
                                    </div> -->
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                            role="button">
                                            <span data-key="t-email">Contract/Bill</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="<?php echo base_url();?>Accounts/CommanContractBill"
                                                class="dropdown-item" data-key="t-inbox">Common Contract Bill</a>
                                          <!--   <a href="<?php echo base_url();?>Accounts/PlainPaperBill"
                                                class="dropdown-item" data-key="t-inbox">Plain Paper Bill</a> -->
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                            role="button">
                                            <span data-key="t-invoices">Incom Tax</span>
                                            <div class="arrow-down"></div>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                            <!-- <a href="<?php echo base_url();?>Accounts/fo_profit_loss"
                                                class="dropdown-item" data-key="t-invoice-list">FNO P&L</a> -->

                                            <a href="<?php echo base_url();?>Accounts/profit_and_loss"
                                                class="dropdown-item" data-key="t-invoice-detail">Profit & Loss</a>
                                            <a href="<?php echo base_url();?>Accounts/pnl_link_generator" class="dropdown-item" data-key="t-invoice-detail">PNL Link</a>
                                            <!-- <a href="<?php echo base_url();?>Accounts/arham_link_generator" class="dropdown-item" data-key="t-invoice-detail">Link Generator</a> -->
                                                
                                           <!--  <a href="<?php echo base_url();?>Accounts/profit_loss" class="dropdown-item"
                                                data-key="t-invoice-detail">P&L</a> -->
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                            role="button">
                                            <span data-key="t-invoices">Common Report</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                            <a href="<?php echo base_url();?>Accounts/risk_common_report"
                                                class="dropdown-item" data-key="t-invoice-list">Risk Common Report </a>
                                            <a href="<?php echo base_url();?>Accounts/Collect_view"
                                                class="dropdown-item" data-key="t-invoice-detail">Collection Report</a>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url();?>Accounts/Global_Brokerage_Summary"
                                        class="dropdown-item" data-key="t-calendar">Global Brokerage Summary</a>
                                    <a href="<?php echo base_url();?>Accounts/Client_wise_dr_cr" class="dropdown-item"
                                        data-key="t-chat">Client wise Debit Credit</a>
                                    <a href="<?php echo base_url();?>Accounts/Legder_detail" class="dropdown-item"
                                        data-key="t-chat">Ledger</a>
                                    <a href="<?php echo base_url();?>Accounts/Late_payment_charges"
                                        class="dropdown-item" data-key="t-chat">Late Pay Charges</a>
                                    <a href="<?php echo base_url();?>Accounts/Ageing" class="dropdown-item"
                                        data-key="t-chat">Ageing</a>
                                        <a href="<?php echo base_url();?>Accounts/Emandate_physical" class="dropdown-item"
                                        data-key="t-chat">e-Mandate</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="mdi mdi-clipboard-account me-2"></i><span data-key="t-apps">KYC</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                      <!--   <a href="<?php echo base_url();?>KYC/cdsl_client_detail" class="dropdown-item" data-key="t-chat">CDSL Client Detail </a> -->
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                                role="button">
                                                <span data-key="t-email">CDSL Client Detail</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-email">
                                                <a href="<?php echo base_url();?>KYC/dp_detail" class="dropdown-item" data-key="t-inbox">DP Detail</a>
                                                <a href="<?php echo base_url();?>KYC/trading_detail" class="dropdown-item" data-key="t-inbox">Trading Detail</a>
                                            </div>
                                        </div>

                                        <a href="<?php echo base_url();?>KYC/cdsl_client_holding" class="dropdown-item" data-key="t-chat">CDSL Client Holding</a>
                                        <a href="<?php echo base_url();?>KYC/dp_ledger" class="dropdown-item" data-key="t-chat">DP Ledger</a>
                                       <!--  <a href="<?php echo base_url();?>KYC" class="dropdown-item" data-key="t-chat">Beneficiary Holding </a>
                                        <a href="<?php echo base_url();?>KYC/collection_report" class="dropdown-item" data-key="t-chat">Collection Report</a> -->
                                        <a href="<?php echo base_url();?>KYC/margin_pledge" class="dropdown-item" data-key="t-chat">Margin Pledge</a>
                                        <a href="<?php echo base_url();?>KYC/PhysicalKYC" class="dropdown-item" data-key="t-chat">Physical KYC</a>
                                        <a href="<?php echo base_url();?>KYC/nominee_link_generator" class="dropdown-item" data-key="t-chat">Nomination</a>
                                        <a href="<?php echo base_url();?>KYC/trading_preference" class="dropdown-item" data-key="t-chat">Trading Preference</a>
                                    </div>
                               <!--  <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="<?php echo base_url();?>KYC/cdsl_client_detail" class="dropdown-item"
                                        data-key="t-chat">CDSL Client Detail </a>
                                    <a href="<?php echo base_url();?>KYC/cdsl_client_holding" class="dropdown-item"
                                        data-key="t-chat">CDSL Client Holding</a>
                                    <a href="<?php echo base_url();?>KYC" class="dropdown-item"
                                        data-key="t-chat">Beneficiary Holding </a>
                                    <a href="<?php echo base_url();?>KYC" class="dropdown-item"
                                        data-key="t-chat">Collection Report</a>
                                    <a href="<?php echo base_url();?>KYC" class="dropdown-item" data-key="t-chat">Margin
                                        Pledge</a>
                                </div> -->
                            </li>
                            <!--  <li class="nav-item dropdown">
                                     <a class="nav-link dropdown-toggle arrow-none" href="<?php echo base_url();?>Compliance" id="topnav-uielement" role="button">
                                        <i class="mdi mdi-layers me-2"></i>
                                        <span data-key="t-elements">Compliance</span> 
                                    </a>
                                </li> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="mdi mdi mdi-graphql me-2"></i><span data-key="t-apps">RMS</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <!-- <a href="#" class="dropdown-item" data-key="t-chat">Short Margin</a> -->
                                    <a href="<?php echo base_url();?>Call_process" class="dropdown-item" data-key="t-chat">Call Confirmation</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" target="_blank"
                                    href="https://wealthelite.in/client-login" id="topnav-uielement" role="button">
                                    <i class="mdi mdi-bullseye-arrow me-2"></i><span data-key="t-apps">WMS</span>
                                </a>
                            </li>
                           <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="fas fa-rupee-sign me-2"></i><span data-key="t-apps">IPO</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="<?php echo base_url();?>IPO/online" class="dropdown-item" data-key="t-chat"><i
                                            class="mdi mdi-connection me-2"></i>Online</a>
                                            <a href="<?php echo base_url();?>IPO/Physical" class="dropdown-item" data-key="t-chat"><i
                                            class="fas fa-print me-2"></i>Physical</a>
                                            <a href="<?php echo base_url();?>AP_SME_IPO" class="dropdown-item" data-key="t-chat"><i class="fas fa-print me-2"></i>SME Physical IPO</a>
                                            <a href="<?php echo base_url();?>BSE_IPO" class="dropdown-item" data-key="t-chat"><i class="fas fa-print me-2"></i>BSE IPO</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-grid">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg><span data-key="t-apps">Knowledge center</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <!-- <a href="<?php echo base_url();?>Video_library" class="dropdown-item"
                                        data-key="t-calendar">Video Library</a> -->
                                    <a href="<?php echo base_url();?>F_formats" class="dropdown-item"
                                        data-key="t-chat">KYC Forms & Format</a>
                                    <a href="<?php echo base_url();?>Check_List" class="dropdown-item"
                                        data-key="t-chat">KYC Check List</a>
                                    <a href="<?php echo base_url();?>Faq" class="dropdown-item"
                                        data-key="t-chat">FAQs</a>
                                        
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="mdi mdi-more me-2"></i><span data-key="t-apps">More</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="<?php echo base_url();?>Reports" class="dropdown-item" data-key="t-chat"><i
                                            class="mdi mdi-book-sync-outline me-2"></i>Reports</a>
                                    <!--            <a href="https://wealthelite.in/client-login" target="_blank" class="dropdown-item" data-key="t-calendar">WMS</a> -->
                                    <!-- <a href="<?php echo base_url();?>Digital" class="dropdown-item" data-key="t-chat"><i
                                            class="mdi mdi-digital-ocean me-2"></i>Digital Marketing</a> -->
                                    <a href="<?php echo base_url();?>Research" class="dropdown-item"
                                        data-key="t-chat"><i class="mdi mdi-layers me-2"></i>Research</a>
                                    <a href="<?php echo base_url();?>Accounts/smart_reports" class="dropdown-item"
                                        data-key="t-chat"><i class="mdi mdi-smart-card-outline me-2"></i>Smart
                                        Report</a>
                                        
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="<?php echo base_url();?>HelpDesk"
                                    id="topnav-uielement" role="button">
                                    <i class="mdi mdi-desk me-2"></i>
                                    <span data-key="t-elements">HelpDesk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
             var current_year = new Date().getFullYear()
             var amount_of_years = 30

              for (var i = 0; i < amount_of_years+1; i++) {
                var year = (current_year-i).toString();
                var element = '<option value="' + year + '">' + year + '</option>';
                $('select[name="financial_year" ]').append(element)
              }
            })
        </script>
