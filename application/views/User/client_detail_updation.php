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
                    <!-- card -->

                    <div class="row align-items-center">
                            <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book me-3"
                        style="color: #ffff;"></i>Modification Online Process</h6>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#leads" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Upation</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#rejected" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Rejected (3)</span>   
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#pending" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                    <span class="d-none d-sm-block">Pending (10)</span>    
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#finished" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Finished (50)</span> 
                                                </a>
                                            </li> -->



                                </ul>
                                <?php
                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                                $ap_code=$_SESSION['APBackOffice_user_code'];
                                $sql="Select * from EKYC_ClientMaster where IntroducerCode='$ap_code'";
                                $result = $KYC_db_odbc->query($sql)->result_array();
                                ?>
                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="leads" role="tabpanel">
                                        <table id="datatable"
                                            class="table table-bordered dt-responsive nowrap dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th> Request Date </th>
                                                    <th> Status </th>
                                                    <th> Mode </th>
                                                    <th> Trading Code </th>
                                                    <th> ClientName </th>
                                                    <th> Modification Type </th>
                                                    <th> Rejection Type </th>
                                                    <th> Rejection Date </th>
                                                    <th> Accept Date </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($result as $key => $value) {
                                                    $mobile=$value['MobileNo'];
                                                    //Bank
                                                    $sql_bank="select * from APIKYC_BankUpdateMaster where Old_Mobile='$mobile'";
                                                    $result_bank = $KYC_db_odbc->query($sql_bank)->result_array(); 
                                                    //Profile
                                                    $sql_profile="select * from APIKYC_UpdateMaster where Old_Mobile_No='$mobile'";
                                                    $result_profile = $KYC_db_odbc->query($sql_profile)->result_array();
                                                    foreach ($result_bank as $value_bnk) {

                                                    // foreach ($result_profile as $value_profile) {
                                                   
                                                ?>
                                                <tr>
                                                    <td><?php echo $value_bnk['UpdateDate'];?></td>
                                                    <td><?php echo $value_bnk['KYC_Status'];?></td>
                                                    <td>Online</td>
                                                    <td><?php echo $value_bnk['Client_ID'];?></td>
                                                    <td><?php echo $value_bnk['Bank_ClientName'];?></td>
                                                    <td><?php if(!empty($value_bnk)){echo "Bank Change";}if(!empty($value_profile)){echo "Profile Change";}?></td>
                                                    <td><?php echo $value_bnk['Rejection_Other'];?></td>
                                                    <td><?php echo $value_bnk['Rejection_Date'];?></td>
                                                    <td><?php echo $value_bnk['Accept_Date'];?></td>
                                                    
                                                </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="rejected" role="tabpanel">
                                        <table id="datatable1"
                                            class="table table-bordered dt-responsive nowrap dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> CreateDate </th>
                                                    <th> Mode Of KYC </th>
                                                    <th> Trading Code </th>
                                                    <th> Bo ID </th>
                                                    <th> Client Name </th>
                                                    <th> Modification Type </th>
                                                    <th> Rejection Type</th>
                                                    <th> Entry Type </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <!-- no -->
                                                    <td>1</td>
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <td>Online</td>
                                                    <!-- client code -->
                                                    <td>A0555</td>
                                                    <td>1207170000008358</td>
                                                    <td>Rakesh Patel</td>
                                                    <!-- client name -->
                                                    <td>Bank Change</td>
                                                    <td>Not Valid IFSC</td>
                                                    <!-- branch -->
                                                    <td>NPM</td>

                                                </tr>
                                                <tr>
                                                    <td>2</td>

                                                    <!-- no -->
                                                    <td>21 Apr 2022 11:26:04</td>
                                                    <td>Physical</td>
                                                    <!-- client code -->
                                                    <td>A0555</td>
                                                    <td>1207170000008358</td>
                                                    <td>Rakesh Patel</td>
                                                    <!-- client name -->
                                                    <td>Mobile Change</td>
                                                    <td>Signature Differ</td>
                                                    <!-- branch -->
                                                    <td>NPM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="pending" role="tabpanel">
                                        <table id="datatable2"
                                            class="table table-bordered dt-responsive nowrap dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> CreateDate </th>
                                                    <th> Mode Of KYC </th>
                                                    <th> Receiver Date </th>
                                                    <th> Trading Code </th>
                                                    <th> Bo ID </th>
                                                    <th> Client Name </th>
                                                    <th> Modification Type </th>
                                                    <th> Entry Type </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <!-- no -->
                                                    <td>1</td>
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <td>Online</td>
                                                    <!-- client code -->
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <td>A0555</td>
                                                    <td>1207170000008358</td>
                                                    <td>Rakesh Patel</td>
                                                    <!-- client name -->
                                                    <td>Bank Change</td>
                                                    <!-- branch -->
                                                    <td>NPM</td>

                                                </tr>
                                                <tr>
                                                    <td>2</td>

                                                    <!-- no -->
                                                    <td>21 Apr 2022 11:26:04</td>
                                                    <td>Physical</td>
                                                    <!-- client code -->
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <td>A0555</td>
                                                    <td>1207170000008358</td>
                                                    <td>Rakesh Patel</td>
                                                    <!-- client name -->
                                                    <td>Mobile Change</td>
                                                    <!-- branch -->
                                                    <td>NPM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="finished" role="tabpanel">
                                        <table id="datatable3"
                                            class="table table-bordered dt-responsive nowrap dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> CreateDate </th>
                                                    <th> Mode Of KYC </th>
                                                    <th> Trading Code </th>
                                                    <th> Bo ID </th>
                                                    <th> Client Name </th>
                                                    <th> Modification Type </th>
                                                    <th> Finished Date</th>
                                                    <th> Entry Type </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <!-- no -->
                                                    <td>1</td>
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <td>Online</td>
                                                    <!-- client code -->
                                                    <td>A0555</td>
                                                    <td>1207170000008358</td>
                                                    <td>Rakesh Patel</td>
                                                    <!-- client name -->
                                                    <td>Bank Change</td>
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <!-- branch -->
                                                    <td>NPM</td>

                                                </tr>
                                                <tr>
                                                    <td>2</td>

                                                    <!-- no -->
                                                    <td>21 Apr 2022 11:26:04</td>
                                                    <td>Physical</td>
                                                    <!-- client code -->
                                                    <td>A0555</td>
                                                    <td>1207170000008358</td>
                                                    <td>Rakesh Patel</td>
                                                    <!-- client name -->
                                                    <td>Mobile Change</td>
                                                    <td>22 Apr 2022 11:26:04</td>
                                                    <!-- branch -->
                                                    <td>NPM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div><!-- end col -->
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
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
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable2').DataTable({
        responsive: true

    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable3').DataTable({
        responsive: true

    });
});
</script>