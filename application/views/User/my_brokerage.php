<style>
.table td,
.table th {
    font-size: 11px;
    padding: 0.35rem 0.35rem;
    /*font-family:    Arial, Verdana, sans-serif;*/
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-wallet me-3"
                        style="color: #ffff;"></i>My Brokerage</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Dashboard/My_brokerage">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <small class="alert alert-warning">Note: If you want today brokerage do not enter client code.</small>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    value="<?php if(isset($_SESSION['My_brokerage_client_code'])){echo $_SESSION['My_brokerage_client_code'];}?>"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <?php $first_day_this_month = date('Y-m-01');?>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-fromdate-input">From Date:</label>
                                            <input class="form-control" type="date"
                                                value="<?php if(isset($_SESSION['My_brokerage_FromDate'])){echo $_SESSION['My_brokerage_FromDate'];}else{echo $first_day_this_month;}?>" id="from_date"
                                                name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date:</label>
                                            <input class="form-control" type="date" value="<?php if(isset($_SESSION['My_brokerage_ToDATE'])){echo $_SESSION['My_brokerage_ToDATE'];}else{echo date('Y-m-d');}?>"
                                                id="to_date" name="to_date">
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
                                                href="<?php echo base_url();?>Dashboard/My_brokerage">?</a>
                                        </div>
                                    </div>


                                </div>
                            </form>


                            <!-- End Form -->
                        </div>
                        <div class="page-title-left">
                            <a href="<?php echo base_url()?>Dashboard/My_brokerage_chart"><i class="mdi mdi-chart-bar me-2"></i>Month Wise Brokerage Chart</a>
                        </div>
                        <div class="container-inner">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <table id="datatable"
                                            class="table table-bordered dt-responsive nowrap dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th> Client Code </th>
                                                    <th> Client Name </th>
                                                    <th> ACT BRK </th>
                                                    <th> REM BRK</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total=0;
                                                foreach ($back_data as $value){
                                                $total+= $value['4'];

                                              ?>
                                                <tr>
                                                    <td> <?php echo $value['1'];?> </td>
                                                    <td> <?php echo $value['2'];?> </td>
                                                    <td> <?php echo $value['3'];?> </td>
                                                    <td> <?php echo $value['4'];?> </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="color:blue;"><b><?php echo $total;?></b></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>