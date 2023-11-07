?>
<style>
.table td,
.table th {
    font-size: 11px !important;
    padding: 0.35rem 0.35rem;
    /*font-family:    Arial, Verdana, sans-serif;*/
}
.center1
{
    margin-left: 250px!important;
}
@media only screen and (max-width: 768px)
{
    .center1
    {
        margin-left: 0px!important;
    }
}

</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
             <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-xl-6 center1">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;">Change Password</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-grow-1">
                                            <form id="myformlogin" method="post"
                                                action="<?php echo base_url('APBackOffice/Change_Password'); ?>">
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">Old Password</label>
                                                        </div>
                      
                                                    </div>
                                                    
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control" id="old_password"
                                                            name="old_password" placeholder="Enter Old Password" required>
                                                        <button class="btn btn-light shadow-none ms-0" type="button"
                                                            id="password-addon1"><i
                                                                class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                    <small class="text-muted form-text fw-semibold" id="error_old_password"
                                                        style="color: red !important;"></small>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">New Password</label>
                                                        </div>
                      
                                                    </div>
                                                    
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control" id="new_password"
                                                            name="new_password" placeholder="Enter New Password" required>
                                                        <button class="btn btn-light shadow-none ms-0" type="button"
                                                            id="password-addon2"><i
                                                                class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                    <small class="text-muted form-text fw-semibold" id="error_new_password"
                                                        style="color: red !important;"></small>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">Re-type Password</label>
                                                        </div>
                      
                                                    </div>
                                                    
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control" id="re_password"
                                                            name="re_password" placeholder="Enter Re-type Password" onChange="checkPasswordMatch();" required>
                                                        <button class="btn btn-light shadow-none ms-0" type="button"
                                                            id="password-addon3"><i
                                                                class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                    <small class="text-muted form-text fw-semibold" id="error_re_password"
                                                        style="color: red !important;"></small>
                                                </div>
                                                <div style="color:red;" id="divCheckPasswordMatch"></div>
                                                
                                                <div class="mb-3">
                                                    <input type="submit"
                                                        class="btn btn-primary w-100 waves-effect waves-light"
                                                        value="Submit" id="btn_submit" 
                                                        style="background-color: #0b5639;border-color: #acc840;">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    </div>
                    
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
    <script type="text/javascript">
        $("#btn_submit").prop("disabled",true);
            function checkPasswordMatch() {
                var password = $("#new_password").val();
                var confirmPassword = $("#re_password").val();

                if (password != confirmPassword)
                {
                    $("#btn_submit").prop("disabled",true);
                    $("#divCheckPasswordMatch").html("Passwords do not match!");
                }
                else
                {
                    $("#btn_submit").prop("disabled",false);
                    $("#divCheckPasswordMatch").html("");
                }
            }

            $(document).ready(function () {
               $("#txtConfirmPassword").keyup(checkPasswordMatch);
            });
        </script>
        <script src="<?php echo base_url();?>assets/js/pages/pass-addon1.init.js"></script>