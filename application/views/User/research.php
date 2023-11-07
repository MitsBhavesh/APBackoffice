<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
.card_hov :hover {
    background-color: #d8e1b5;
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <!-- start Research code -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card border-primary">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <!-- <h4 class="card-title">Research Plans</h4> -->
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-layers me-2"
                                    style="color: #ffff;"></i> Research Plans</h6>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="nav flex-column nav-pills pricing-tab-box" id="v-pills-tab"
                                        role="tablist" aria-orientation="vertical">
                                        <a class="nav-link mb-3 active" id="v-pills-tab-one" data-bs-toggle="pill"
                                            href="#v-price-one" role="tab" aria-controls="v-price-one"
                                            aria-selected="true">
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-check-circle h3 mb-0 me-4"></i>
                                                <div class="flex-1">
                                                    <h2 class="fw-medium"><span
                                                            class="text-muted font-size-15">Technical Research</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="tab-content text-muted mt-4 mt-xl-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-price-one" role="tabpanel"
                                            aria-labelledby="v-pills-tab-one">

                                            <!-- Start Technical Research  -->
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card">
                                                        <div class="card-header"
                                                            style="background-color: #0b5639!important;padding: 9px!important;">
                                                            <h6 class="card-title" style="color:#ffff!important;"><i
                                                                    class="fas fa-tools" style="color: #ffff;"></i>
                                                                Technical Research</h6>

                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Technical_Daily_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Daily</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Technical_Index_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Index</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Technical_Stock_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Stock</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Technical_DiwaliMonth_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 25px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Diwali Month</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Technical Research -->
                                        </div>
                                        <div class="tab-pane fade" id="v-price-two" role="tabpanel"
                                            aria-labelledby="v-pills-tab-two">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card">
                                                        <div class="card-header"
                                                            style="background-color: #0b5639!important;padding: 9px!important;">
                                                            <h6 class="card-title" style="color:#ffff!important;"><i
                                                                    class="fas fa-glass-martini"
                                                                    style="color: #ffff;"></i> Fundamental Research</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Fundamental_DailyMarket_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Daily Market</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Fundamental_Result_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Result</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Fundamental_Investment_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Investment</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Fundamental_SIP_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 25px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">SIP</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/Fundamental_DiwaliMonth_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 25px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Diwali Month</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-price-three" role="tabpanel"
                                            aria-labelledby="v-pills-tab-three">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card">
                                                        <div class="card-header"
                                                            style="background-color: #0b5639!important;padding: 9px!important;">
                                                            <h6 class="card-title" style="color:#ffff!important;"><i
                                                                    class="fas fa-search-plus"
                                                                    style="color: #ffff;"></i> Premium Product</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/PremiumProduct_ArhamMaximizer_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Arham Maximizer
                                                                                    </h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-xl-4 col-md-4 col-sm-6">
                                                                    <a class="ex"
                                                                        href="<?php echo base_url('Research/PremiumProduct_ArhamIQ_Report') ?>">
                                                                        <div class="card text-center card_hov zoom border-primary"
                                                                            style="margin-top: 0px;">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                        <i class="fa fa-download"
                                                                                            style="color: #1a7e58;"></i>
                                                                                    </div>
                                                                                    <h5 class="mb-0">Arham IQ</h5>
                                                                                    <p
                                                                                        class="text-muted mb-0 line-ellipsis">
                                                                                        Report</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end Research code -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->