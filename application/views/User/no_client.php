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
            <div class="container-inner">
                <div class="container-inner">
                    <!-- <a href="<?php echo base_url();?>Dashboard/no_client"> -->
                        <!-- card -->
                        <div class="card card-h-100">
                            <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-account me-3"
                        style="color: #ffff;"></i>No Of Client</h6>
                        </div>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Client_Id</th>
                                                <th>Client_Name</th>
                                                <th>PAN No</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($_SESSION['No_of_client_list']))
                                            {

                                            $No_of_client_list=$_SESSION['No_of_client_list'];
                                            // echo "<pre>";
                                            // print_r($No_of_client_list);
                                            // exit();
                                            $i = 1;
                                                foreach ($No_of_client_list as $value)
                                                {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; $i++;?></td>
                                                    <td><?php echo $value['TRADING_CLIENT_ID']??$value['TRADING CLIENT ID'];?></td>
                                                    <td><?php echo $value['FIRST_HOLD_NAME']??$value['BO NAME'];?></td>
                                                    <td><?php echo $value['ITPA_NO']??$value['BO PAN NO'];?></td>
                                                </tr>
                                        <?php }}?>
                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- end card body -->
                        </div><!-- end card -->
                    <!-- </a> -->
                </div>
            </div>
        </div>
    </div>
</div>