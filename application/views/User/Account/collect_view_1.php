<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Collection</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Collect_view">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    value="<?php if(isset($_SESSION['Collection_client_code'])){echo $_SESSION['Collection_client_code'];}?>"
                                                    placeholder="Enter client code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date:</label>
                                            <input class="form-control" type="date" value="<?php echo date('Y-m-d')?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>
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
                                    <div class="col-md-2">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary w-md"
                                                style="background-color: #0b5639;border-color: #acc840;">Generate</button>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <a class="btn btn-info"
                                                href="<?php echo base_url();?>Accounts/Collect_view">?</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- Start DataTable -->
                        <div class="card-body">
                            <div class="row">
                                <div style="text-align-last: end;">
                                    <a href="<?php echo base_url('Accounts/Collection_Excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                </div>
                            </div>
                            <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>Client ID</th>
                                        <th>Client Name</th>
                                        <th>Net Collection</th>
                                        <th>Margin</th>
                                        <th>Collatral</th>
                                        <th>Extra Collatral</th>
                                        <th>Short Margin</th>
                                        <th>COCD LIST</th>
                                        <th>ToBeCollected</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($back_data)){
                              foreach ($back_data as $data_row) {?>

                                    <tr>
                                        <td><?php echo $data_row[1];?></td>
                                        <td><?php echo $data_row[2];?></td>
                                        <td><?php echo $data_row[28];?></td>
                                        <td><?php echo $data_row[4];?></td>
                                        <td><?php echo $data_row[5];?></td>
                                        <td><?php echo $data_row[55];?></td>
                                        <td><?php echo $data_row[7];?></td>
                                        <td><?php echo $data_row[32];?></td>
                                        <td><?php echo $data_row[62];?></td>
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