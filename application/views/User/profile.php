?>
<style>
.table td,
.table th {
    font-size: 11px !important;
    padding: 0.35rem 0.35rem;
    /*font-family:    Arial, Verdana, sans-serif;*/
}

</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;">Partner Profile</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img src="<?php echo base_url();?>assets/images/favicon.png" alt=""
                                                    class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1"><?php if(!empty($result1[0])){echo $result1[0]['REMESHIRE_NAME'];}else{echo "<span style='color:red;'>Profile Data Not Available Please Contact to Administrator! Thank You!</span>";}?></h5>
                                                <p class="text-muted font-size-13"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Arhamshare Private Limited</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview"
                                        role="tab">Personal Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab">Finacial
                                        Info</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel">
                            <div class="card">

                                <div class="card-body">
                                    <div>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <div>
                                                        <h5 class="font-size-15">Name :</h5>
                                                    </div>
                                                </div>
                                                <div class="col-xl">
                                                    <div class="text-muted">
                                                        <p class="mb-2"><?php  if(!empty($result1[0])){echo $result1[0]['REMESHIRE_NAME'];}?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <div>
                                                        <h5 class="font-size-15">Mobile No :</h5>
                                                    </div>
                                                </div>
                                                <div class="col-xl">
                                                    <div class="text-muted">
                                                        <p class="mb-2"><?php  if(!empty($result1[0])){ echo $result1[0]['MobileNo'];}?></p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <div>
                                                        <h5 class="font-size-15">Email ID :</h5>
                                                    </div>
                                                </div>
                                                <div class="col-xl">
                                                    <div class="text-muted">
                                                        <p class="mb-0"><?php  if(!empty($result1[0])){ echo strtoupper($result1[0]['EMAIL_ID']);}?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="row">
                                                <div class="col-xl-2">
                                                    <div>
                                                        <h5 class="font-size-15">Address :</h5>
                                                    </div>
                                                </div>
                                                <div class="col-xl">
                                                    <div class="text-muted">

                                                        <p><?php  if(!empty($result1[0])){ echo $result1[0]['Address']." ".$result1[0]['address2']." ".$result1[0]['address3']." ".$result1[0]['Permanent_City']." ".$result1[0]['Permanent_State'];}?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-xl-2">
                                                <div>
                                                    <h5 class="font-size-15">Pan No:</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="text-muted">

                                                    <p><?php  if(!empty($result1[0])){ echo $result1[0]['PAN_NO'];}?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="">
                                        <div class="row">
                                            <div class="col-xl-2">
                                                <div>
                                                    <h5 class="font-size-15">Partner Code :</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl">
                                                <div class="text-muted">

                                                    <p><b style="color:#2ab57d;"><?php  if(!empty($result1[0])){ echo strtoupper($result1[0]['REMESHIRE_CODE']);}else{echo strtoupper($_SESSION['APBackOffice_user_code']);}?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->


                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane" id="about" role="tabpanel">
                            <div class="card">

                                <div class="card-body">
                                    <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>Bank Name</th>
                                                <th>Account No</th>
                                                <th>IFSC Code</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <td><?php if(!empty($result1[0])){ echo $result1[0]['REM_BANK_NAME'];}?></td>
                                                <td><?php  if(!empty($result1[0])){ echo $result1[0]['RemBankAcBNo'];}?></td>
                                                <td><?php if(!empty($result1[0])){ echo $result1[0]['REM_IFSC_CODE'];}?></td>
                                                
                                            </tr>
                                      

                                        </tbody>
                                    </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </div>
                <!-- end col -->

                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;">Active Segment</h6>
                        </div>
                        <div class="card-body">

                            <div class="d-flex flex-wrap gap-2 font-size-16">
                                <?php  if(!empty($result1[0])){ foreach ($result1 as $key => $value){?>
                        
                                <a href="#" class="badge badge-soft-primary"><?php echo $value['COMPANY_CODE'];?></a>
                            <?php }}?>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                     <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;">Brokerage Sharing</h6>
                        </div>
                                    <div class="card-body">

                                        <div>
                                            <ul class="list-unstyled mb-0">
                                               <b>OneSidePer : </b> <?php  if(!empty($result1[0])){ echo $result1[1]['OneSidePer'];}?></br>
                                               <b>OtherSidePer :</b> <?php  if(!empty($result1[0])){ echo $result1[1]['OtherSidePer'];}?></br>
                                               <b>DeliverySidePer :</b> <?php  if(!empty($result1[0])){ echo $result1[1]['DeliverySidePer'];}?>
                                               
                                            </ul>
                                        </div>
                                    </div>
                    <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <!--  <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Similar Profiles</h5>

                                        <div class="list-group list-group-flush">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">James Nix</h5>
                                                            <p class="font-size-13 text-muted mb-0">Full Stack Developer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="img-thumbnail rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">Darlene Smith</h5>
                                                            <p class="font-size-13 text-muted mb-0">UI/UX Designer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm flex-shrink-0 me-3">
                                                        <div class="avatar-title bg-soft-light text-light rounded-circle font-size-22">
                                                            <i class="bx bxs-user-circle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="font-size-14 mb-1">William Swift</h5>
                                                            <p class="font-size-13 text-muted mb-0">Backend Developer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div> -->
                    <!-- end card body -->
                    <!-- </div> -->
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable1').DataTable({
            responsive: true

        });
    });
    </script>