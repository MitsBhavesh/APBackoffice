<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-asterisk me-3"
                        style="color: #ffff;"></i>Risk Common Report</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/risk_common_report_form">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <div class="col-md-4">
                                        <div class="mb-2"> <label class="form-label" for="formrow-todate-input">Company
                                                code:</label>
                                            <div class="mb-3">
                                                <select name="exchange_code" id="exchange_code" class="form-select"
                                                    required>
                                                    <option value="">Select Company Code</option>
                                                    <option value="1">Equity</option>
                                                    <option value="2">Derivative</option>
                                                    <option value="3">Currency</option>
                                                    <option value="4">Commodity</option>
                                                    <option value="5">Equity+Derivative</option>
                                                    <option value="6">Equity+Derivative+Currency+MFSS+SLBM</option>
                                                    <option value="7">Equity+Derivative+Currency+Commodit</option>
                                                    <option value="10" selected>Equity+Der+Currency+MFSS+SLBM+NBFC
                                                    </option>
                                                    <option value="11">Equity+Der+Currency+Commodity+MFSS+SLBM+NBFC
                                                    </option>
                                                    <option value="8">MFSS</option>
                                                    <option value="9">SLBM</option>
                                                    <option value="0">Equity+Derivative+MFSS+SLBM</option>
                                                    <option value="12">
                                                        Equity+Der+Currency+Commodity+MFSS+SLBM+NBFC+NSE_COM+BSE_COM
                                                    </option>
                                                    <option value="13">
                                                        Equity+Derivative+Currency+MFSS+SLBM+NSE_COM+BSE_COM (default)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    value="<?php if(isset($_SESSION['risk_commen_client_code'])){echo $_SESSION['risk_commen_client_code'];}?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary w-md"
                                                style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <small style="color: red;"><b>Note:</b> If client code field empty than fetch all
                                        list </small>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                        <!-- Start DataTable -->
                        <style>
                        .table td,
                        .table th {
                            font-size: 10px;
                            /*font-family:    Arial, Verdana, sans-serif;*/
                        }
                        </style>
                        <div class="card-body">
                            <div class="row">
                                <div style="text-align-last: end;">
                                    <a href="<?php echo base_url('Accounts/risk_common_report_excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered dt-responsive w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Client ID</th>
                                                        <th>Client Name</th>
                                                        <th>Ledger</th>
                                                        <th>Margin</th>
                                                        <th>SOH</th>
                                                        <th>Benificiary Stock</th>
                                                        <th>Collateral</th>
                                                        <th>IN Short</th>
                                                        <th>OUT Short</th>
                                                        <th>Grossledger</th>
                                                        <th>Net Stock</th>
                                                        <th>Net Ledger</th>
                                                        <th>Free Stock SOH</th>
                                                        <th>Net Risk</th>
                                                        <th>Last Trade Date</th>
                                                        <th>Last Receipt</th>
                                                        <th>Last Payment</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                              if(isset($back_data))
                              {
                                 $i = 0;
                                 foreach ($back_data as $value) 
                                 {
                           ?>
                                                    <tr>
                                                        <td><?php echo $value[1]; ?></td>
                                                        <td><?php echo $value[2]; ?></td>
                                                        <td><?php echo $value[3]; ?></td>
                                                        <td><?php echo $value[4]; ?></td>
                                                        <td><?php echo $value[5]; ?></td>
                                                        <td><?php echo $value[6]; ?></td>
                                                        <td><?php echo $value[7]; ?></td>
                                                        <td><?php echo $value[8]; ?></td>
                                                        <td><?php echo $value[9]; ?></td>
                                                        <td><?php echo $value[10]; ?></td>
                                                        <td><?php echo $value[11]; ?></td>
                                                        <td><?php echo $value[12]; ?></td>
                                                        <td><?php echo $value[13]; ?></td>
                                                        <td><?php echo $value[14]; ?></td>
                                                        <td><?php echo $value[15]; ?></td>
                                                        <td><?php echo $value[16]; ?></td>
                                                        <td><?php echo $value[17]; ?></td>
                                                    </tr>
                                                    <?php      
                                 }

                              }
                           ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End DataTable -->
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $('#datatable').DataTable({
                                responsive: true

                            });
                        });
                        </script>
                        <!-- End DataTable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>