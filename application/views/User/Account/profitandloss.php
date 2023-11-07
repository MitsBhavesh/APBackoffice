<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="col-xl-12">
                            <div class="tab-content text-muted mt-xl-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-price-one" role="tabpanel"
                                    aria-labelledby="v-pills-tab-one">

                                    <!-- Start Technical Research  -->
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-header"
                                                style="background-color: #0b5639!important;padding: 9px!important;">
                                                <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-layer-group me-3"
                        style="color: #ffff;"></i>Profit/Loss &
                                                    Other Charges</h6>

                                            </div>
                                            <div class="card-header align-items-center d-flex">
                                                <!-- Start Form -->
                                                <form method="post"
                                                    action="<?php echo base_url();?>Accounts/profit_and_loss" enctype="multipart/form-data">
                                                    <div class="row card-title mb-0 flex-grow-1">
                                                        <div class="col-md-4">
                                                            <div class="mb-2">
                                                                <label class="form-label"
                                                                    for="formrow-todate-input">Client Code:</label>
                                                                <div class="mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="client_code"
                                                                        value="<?php if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss'])){echo $_SESSION['ApbackOffice_client_code_profit_and_loss'];}?>"
                                                                        placeholder="Enter client code" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- <div class="col-md-3">
                                                            <div class="mb-2">
                                                                <label class="form-label"
                                                                    for="formrow-todate-input">To Date:</label>
                                                                <input class="form-control" type="date"
                                                                    value="<?php if(isset($_SESSION['ApbackOffice_client_todate_form_profit_and_loss'])){echo $_SESSION['ApbackOffice_client_todate_form_profit_and_loss'];}else{echo date('Y-m-d');}?>"
                                                                    id="to_date" name="to_date">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-md-4">
                                                            <div class="mb-2">
                                                                <label class="form-label"
                                                                    for="formrow-todate-input">With Expense:</label>
                                                                <select name="exp" id="exp" class="form-select">

                                                                    <?php if(isset($_SESSION['ApbackOffice_client_exp_profit_and_loss'])){?>

                                                                    <option
                                                                        <?php if($_SESSION['ApbackOffice_client_exp_profit_and_loss']=="Y"){ ?>
                                                                        selected="selected" <?php }?>
                                                                        value='<?php if($_SESSION['ApbackOffice_client_exp_profit_and_loss']=="Y"){ echo $_SESSION['ApbackOffice_client_exp_profit_and_loss'];}?>'>
                                                                        <?php echo "Yes";?></option>
                                                                    <option
                                                                        <?php if($_SESSION['ApbackOffice_client_exp_profit_and_loss']=="N"){ ?>
                                                                        selected="selected" <?php }?>
                                                                        value='<?php if($_SESSION['ApbackOffice_client_exp_profit_and_loss']=="N"){ echo $_SESSION['ApbackOffice_client_exp_profit_and_loss'];}?>'>
                                                                        <?php echo "No";?></option>

                                                                    <?php  }else{?>
                                                                    <option value="Y" selected>Yes</option>
                                                                    <option value="N">No</option>

                                                                    <?php  }?>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3" style="padding-top: 30px;">
                                                                <button type="submit" class="btn btn-primary w-md"
                                                                    style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                                            </div>
                                                        </div>
                                                        <!-- <a href="<?php echo base_url();?>Accounts/pnl_link_generator">PNL Link Generator</a> -->
                                                    </div>
                                                </form>
                                                <!-- End Form -->
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        Name :<span
                                                            style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['ApbackOffice_client_name_profit_and_loss'])){echo $_SESSION['ApbackOffice_client_name_profit_and_loss'];}?></b></span>
                                                    </div>
                                                    <div class="col-6">
                                                        Branch :<span
                                                            style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['APBackOffice_user_code'])){echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></span>
                                                    </div>
                                                    <div class="col-6">
                                                        PAN :<span
                                                            style="padding:20px;color:blue;"><b><?php if(isset($_SESSION['ApbackOffice_client_pan_profit_and_loss'])){$var = substr_replace($_SESSION['ApbackOffice_client_pan_profit_and_loss'], str_repeat("X", 4), 6, 4);echo strtoupper($_SESSION['ApbackOffice_client_pan_profit_and_loss']);}?></b></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        <a class="ex"
                                                            href="<?php echo base_url('Accounts/ledger_PNL') ?>">
                                                            <div class="card text-center card_hov zoom border-primary"
                                                                style="margin-top: 0px;">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">Client Ledger</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php if($BSE_CASH=="1"){?>
                                                    <div class="col-xl-3">
                                                        <a class="ex" href="<?php echo base_url('Accounts/EQ_PNL') ?>">
                                                            <div class="card text-center card_hov zoom border-primary"
                                                                style="margin-top: 0px;">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">Equity</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php }?>
                                                 <?php if($CD_NSE=="1"){?>
                                                    <div class="col-xl-3">
                                                        <a class="ex" href="<?php echo base_url('Accounts/CDS_PNL') ?>">
                                                            <div class="card text-center card_hov zoom border-primary"
                                                                style="margin-top: 0px;">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">Currency Derivatives</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                     <?php }?>
                                                 <?php if($NSE_FNO=="1"){?>
                                                    <div class="col-xl-3">
                                                        <a class="ex" href="<?php echo base_url('Accounts/FO_PNL') ?>">
                                                            <div class="card text-center card_hov zoom border-primary"
                                                                style="margin-top: 0px;">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">Future & Options</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php }?>
                                                    <div class="col-xl-3">
                                                        <a class="ex"
                                                            href="<?php echo base_url('Accounts/pnlSummary') ?>">
                                                            <div class="card text-center card_hov zoom border-primary">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">P&L Summary</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                     <?php if($MCX=="1"){?>
                                                    <div class="col-xl-3">
                                                        <a class="ex"
                                                            href="<?php echo base_url('Accounts/COMMODITY_PNL') ?>">
                                                            <div class="card text-center card_hov zoom border-primary">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">Commodity</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                     <?php }?>
                                                    <!-- <div class="col-xl-3">
                                                        <a class="ex"
                                                            href="<?php echo base_url('Accounts/MUTUAL_FUNDS') ?>">
                                                            <div class="card text-center card_hov zoom border-primary">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">Mutual Funds</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div> -->
                                                   <!--  <div class="col-xl-3">
                                                        <a class="ex"
                                                            href="<?php echo base_url('Accounts/Other_charges') ?>">
                                                            <div class="card text-center card_hov zoom border-primary">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div
                                                                            class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                            <i class="fa fa-download"
                                                                                style="color: #1a7e58;"></i>
                                                                        </div>
                                                                        <h5 class="mb-0">CDSL & Other Charges</h5>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div> -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Technical Research -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>