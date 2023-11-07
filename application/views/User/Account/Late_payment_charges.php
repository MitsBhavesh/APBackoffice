<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
        
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-contactless-payment me-3"
                        style="color: #ffff;"></i>Late Payment Charges</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Late_payment_charges">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <small class="alert alert-warning">Note: If you want all list to enter without client code .</small>
                                    <div class="col-md-2">
                                        <div class="mb-2"> <label class="form-label" for="formrow-todate-input">Company
                                                code:</label>
                                            <div class="mb-3">
                                                <select name="exchange_code" id="exchange_code" class="form-select">
                                                    <option
                                                        value="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF">
                                                        Group 1</option>
                                                    <option value="MCX,ICEX">Group 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-fromdate-input">From Date:</label>
                                            <input class="form-control" type="date"
                                                value="<?php if(isset($_SESSION['ApbackOffice_client_form_late_payment'])){echo $_SESSION['ApbackOffice_client_form_late_payment'];}else{$year=date('Y');echo ($year-1).'-'.'04-01';}?>" id="from_date" name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date:</label>
                                            <input class="form-control" type="date" value="<?php if(isset($_SESSION['ApbackOffice_client_todate_form_late_payment'])){echo $_SESSION['ApbackOffice_client_todate_form_late_payment'];}else{echo date('Y-m-d');}?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code" value="<?php if(isset($_SESSION['ApbackOffice_Late_payment_charges_code'])){echo $_SESSION['ApbackOffice_Late_payment_charges_code'];}?>" 
                                                    placeholder="Enter Client Code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary w-md"
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
                                    <a href="<?php echo base_url('Accounts/Late_payment_charges_excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                </div>
                            </div>
                            <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>TODATE</th>
                                        <th>DR INTEREST</th>
                                        <th>CR INTEREST</th>
                                        <th>ACCOUNT CODE</th>
                                        <th>VODATE</th>
                                        <th>COCD</th>
                                        <th>RUNING BALANCE</th>
                                        <th>INTEREST RATE</th>
                                        <th>DAYS</th>
                                        <th>NARRATION</th>
                                        <th>DR AMT</th>
                                        <th>CR AMT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($back_data)){
                               foreach ($back_data as $data_row) {
                                if($data_row[10]!="0")
                                {
                                    

                              ?>

                                    <tr>
                                        <td><?php echo $data_row[0];?></td>
                                        <td><?php echo $data_row[1];?></td>
                                        <td><?php echo $data_row[2];?></td>
                                        <td><?php echo $data_row[3];?></td>
                                        <td><?php echo $data_row[4];?></td>
                                        <td><?php echo $data_row[5];?></td>
                                        <td><?php echo $data_row[6];?></td>
                                        <td><?php echo $data_row[7];?></td>
                                        <td><?php echo $data_row[8];?></td>
                                        <td><?php echo $data_row[9];?></td>
                                        <td><?php echo $data_row[10];?></td>
                                        <td><?php echo $data_row[11];?></td>
                                    </tr>
                                    <?php } } }  ?>

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
        responsive: true,

    });
});
</script>