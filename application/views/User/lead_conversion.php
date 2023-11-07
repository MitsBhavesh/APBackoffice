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
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content">
                             <!-- <h4 class="mb-sm-0 font-size-18">Account Opening Process</h4> -->
                        </div>
                    </div>
                </div>
                <div class="container-inner">
                    <!-- card -->
                    <div class="row align-items-center">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book-open me-3"
                        style="color: #ffff;"></i>Account Opening Process</h6>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#login" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                             <?php 
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                                                $ap_code=$_SESSION['APBackOffice_user_code'];
                                                $sql_login = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Login'";
                                                ?>
                                            <span class="d-none d-sm-block">Login (<?php echo $KYC_db_odbc->query($sql_login)->num_rows();?>)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pending" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                             <?php 
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                                                $ap_code=$_SESSION['APBackOffice_user_code'];
                                                $sql_pending = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Pending'";
                                                ?>
                                            <span class="d-none d-sm-block">Pending (<?php echo $KYC_db_odbc->query($sql_pending)->num_rows();?>)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#authorise" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <?php 
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                                                $ap_code=$_SESSION['APBackOffice_user_code'];
                                                $sql_authorize = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Authorize'";
                                                
                                               
                                            ?>
                                            <span class="d-none d-sm-block">Authorize (<?php echo $KYC_db_odbc->query($sql_authorize)->num_rows();?>)</span>
                                        </a>
                                    </li>
                                   
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#rejection" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <?php 
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                                                $ap_code=$_SESSION['APBackOffice_user_code'];
                                                $sql_rejection = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Rejection'";
                                                
                                               
                                            ?>
                                            <span class="d-none d-sm-block">Rejection (<?php echo $KYC_db_odbc->query($sql_rejection)->num_rows();?>)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#finished" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                             <?php 
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
                                                $ap_code=$_SESSION['APBackOffice_user_code'];
                                                $sql_finished = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='TechFinished'";
                                                
                                               
                                            ?>
                                            <span class="d-none d-sm-block">Finished (<?php echo $KYC_db_odbc->query($sql_finished)->num_rows();?>)</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    
                                    <div class="tab-pane active" id="login" role="tabpanel">
                                        <table id="datatable"
                                            class="table table-bordered dt-responsive dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>CreateDate</th>
                                                    <th>ELastLogoin</th>
                                                    <th>UserName</th>
                                                    <th>PAN</th>
                                                    <th>MobileNo</th>
                                                    <th>EmailID</th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                                 <?php
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);

                                                $sql_login = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Login'";

                                                    // echo $sql_login;
                                                    // exit();

                                                $result_login = $KYC_db_odbc->query($sql_login)->result_array();

                                                 $i = 1;
                                                foreach ($result_login as $value)
                                                {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; $i++; ?></td>
                                                    <td><?php 
                                                    $date=date_create($value['EntryDate']);
                                                    echo date_format($date,"d M Y H:i:s");
                                                    ?></td>
                                                    <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                    <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                    <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                    
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="pending" role="tabpanel">
                                        <table id="datatable1"
                                            class="table table-bordered dt-responsive dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th>CreateDate</th>
                                                    <th>UserName</th>
                                                    <th>PAN</th>
                                                    <th>MobileNo</th>
                                                    <th>EmailID</th>
                                                    <th>IntroducerCode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);

                                                $sql_pending = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Pending'";

                                                    // echo $sql_login;
                                                    // exit();

                                                $result_pending = $KYC_db_odbc->query($sql_pending)->result_array();

                                                 $i = 1;
                                                foreach ($result_pending as $value)
                                                {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; $i++; ?></td>
                                                    <td><?php echo $value['FirstName']." ".$value['MiddleName']." ".$value['LastName'] ; ?></td>
                                                    <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                    <td><?php echo $value['MobileNo']; ?></td>
                                                    <td><?php echo $value['EmailID'];?></td>
                                                    <td><?php echo $value['IntroducerCode']; ?></td>
                                                </tr>
                                                <?php 
                                                    } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="authorise" role="tabpanel">
                                        <table id="datatable2"
                                            class="table table-bordered dt-responsive dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px;">No.</th>
                                                    <th>CreateDate</th>
                                                    <th>UserName</th>
                                                    <th>PAN</th>
                                                    <th>MobileNo</th>
                                                    <th>EmailID</th>
                                                    <th>IntroducerCode</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);

                                                $sql_authorize = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Authorize'";
                                                $result_authorize = $KYC_db_odbc->query($sql_authorize)->result_array();
                                                
                                                $i = 1;
                                                foreach ($result_authorize as $value)
                                                {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; $i++; ?></td>
                                                <td><?php 
                                                    $date=date_create($value['EntryDate']);
                                                    echo date_format($date,"d M Y H:i:s");
                                                    ?></td>
                                                <td><?php echo $value['FirstName']." ".$value['MiddleName']." ".$value['LastName'] ; ?></td>
                                                <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                <td><?php echo $value['MobileNo']; ?></td>
                                                <td><?php echo $value['EmailID'];?></td>
                                                
                                                <td><?php echo $value['IntroducerCode']; ?></td>
                                            </tr>
                                            <?php 
                                            } 
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="rejection" role="tabpanel">
                                        <table id="datatable3"
                                            class="table table-bordered dt-responsive dataTable"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>CreateDate</th>
                                                    <th>UserName</th>
                                                    <th>PAN</th>
                                                    <th>KRA</th>
                                                    <th>MobileNo</th>
                                                    <th>Rejection Query</th>
                                                    <th>EmailID</th>
                                                    <th>Rejection Date</th>
                                                    <th>IntroducerCode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);

                                                $sql_rejection = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Rejection'";
                                                $result_rejection = $KYC_db_odbc->query($sql_rejection)->result_array();
                                                    
                                                $i = 1;
                                                foreach ($result_rejection as $value)
                                                {

                                            ?>
                                            <tr>
                                                <td><?php echo $i; $i++; ?></td>
                                                <td><?php 
                                                    $date=date_create($value['EntryDate']);
                                                    echo date_format($date,"d M Y H:i:s");
                                                    ?></td>
                                                <td><?php echo $value['FirstName']." ".$value['MiddleName']." ".$value['LastName'] ; ?></td>
                                                <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                <td><?php echo $value['KRA']; ?></td>
                                                <td><?php echo $value['MobileNo']; ?></td>
                                                <td><?php echo $value['Rejection']; ?></td>
                                                <td><?php echo $value['EmailID'];?></td>
                                                <td><?php echo $value['RejectionDate']; ?></td>
                                                <td><?php echo $value['IntroducerCode']; ?></td>
                                            </tr>
                                            <?php 
                                            } 
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="finished" role="tabpanel">
                                        <table id="datatable4" class="table table-bordered dt-responsive dataTable" style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
                                            <thead>
                                                <tr>
                                                    <th> Sr No </th>
                                                    <th>CreateDate</th>
                                                    <th>Finished Date</th>
                                                    <th>UserName</th>
                                                    <th>PAN</th>
                                                    <th>MobileNo</th>
                                                    <th>EmailID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);

                                                $sql_finished = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='TechFinished'";
                                                $result_finished = $KYC_db_odbc->query($sql_finished)->result_array();
                                                    
                                                $i = 1;
                                               
                                                foreach ($result_finished as $value)
                                                {

                                            ?>
                                            <tr>
                                                <td><?php echo $i; $i++; ?></td>
                                                
                                                <td><?php 
                                                    $date=date_create($value['EntryDate']);
                                                    echo date_format($date,"d M Y H:i:s");
                                                    ?></td>
                                                <td><?php 
                                                $date=date_create($value['TechDate']);
                                                echo date_format($date,"d M Y H:i:s");
                                                ?></td>
                                                <td><?php echo $value['FirstName']." ".$value['MiddleName']." ".$value['LastName'] ; ?></td>
                                                <td><?php echo strtoupper($value['PANCard']); ?></td>
                                                <td><?php echo $value['MobileNo']; ?></td>
                                                <td><?php echo $value['EmailID'];?></td>
                                                
                                            <?php 
                                            } 
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- end col -->
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable({
        responsive: true

    });
});
</script>
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
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable4').DataTable({
        responsive: true

    });
});
</script>