<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="bx bxs-wallet-alt me-3"
                        style="color: #ffff;"></i>Global Brokerage Summary</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Global_Brokerage_Summary">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Company code:</label>
                                            <div class="mb-3">
                                                <select name="company_code" id="company_code" class="form-select">
                                                    <option
                                                        value="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF">
                                                        Group 1</option>
                                                    <option value="MCX,ICEX">Group 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                           $first_day_this_month = date('Y-m-01');
                          
                           ?>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-fromdate-input">From Date:</label>
                                            <input class="form-control" type="date"
                                                value="<?php if(isset($_SESSION['ApbackOffice_client_f_date_global_borkerage'])){echo $_SESSION['ApbackOffice_client_f_date_global_borkerage'];}else{echo $first_day_this_month;}?>" id="from_date"
                                                name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date:</label>
                                            <input class="form-control" type="date" value="<?php if(isset($_SESSION['ApbackOffice_client_t_date_global_borkerage'])){echo $_SESSION['ApbackOffice_client_t_date_global_borkerage'];}else{echo date('Y-m-d');}?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>
                                    
                             
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    placeholder="Enter Client Code" value="<?php if(isset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code'])){echo $_SESSION['APBackOffice_Global_Brokerage_Summary_client_code'];}?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <button type="submit" name="btn_submit" class="btn btn-primary w-md"
                                                style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                        <!-- Start DataTable -->
                        <div class="card-body">
                            <div class="row">
                                <div style="text-align-last: end;">
                                    <a href="<?php echo base_url('Accounts/Global_Brokerage_Summary_excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                </div>
                            </div>
                            <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>COMPANY CODE</th>
                                        <th>BRANCH CODE NAME</th>
                                        <th>CLIENT ID</th>
                                        <th>CLIENT NAME</th>
                                        <th>NET BRK</th>
                                        <th>CLIENT BROKERAGE</th>
                                        <th>REMESHIRE BROKERAGE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($back_data)){
                              foreach ($back_data as $data_row) {
                              
                              ?>
                                    <tr>
                                        <td><?php echo $data_row[0];?></td>
                                        <td><?php echo $data_row[11];?></td>
                                        <td><?php echo $data_row[24];?></td>
                                        <td><?php echo $data_row[25];?></td>
                                        <td><?php echo $data_row[27];?></td>
                                        <td><?php echo $data_row[5];?></td>
                                        <td><?php echo $data_row[29];?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End DataTable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable1').DataTable({
        responsive: true

    });
});
</script>