<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
.card_hov:hover {
    background-color: #d8e1b5;
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
    
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <!-- Start Check List  -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card border-primary">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-clipboard"
                                    style="color: #ffff;"></i> KYC Check List</h6>
                            <!-- <p class="card-title-desc">Add <code>.btn-lg</code> or <code>.btn-sm</code> for additional sizes.</p> -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($pdffiles as $value): ?>
                                <div class="col-xl-3">
                                    <a class="ex"
                                        href="<?php echo base_url('Check_List/Check_List_doc_download?file_name='.$value); ?>">
                                        <div class="card text-center card_hov border-primary zoom">
                                            <div class="card-content">
                                                <div class="card-body ">
                                                    <div
                                                        class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                        <i class="fa fa-download" style="color: #a4b542;"></i>
                                                    </div>
                                                    <h6 class="mb-0">
                                                        <?php
                                             if($value=="Online_Ekyc_Check_List.pdf"){
                                                echo "DOCUMENT CHECKLIST FOR EKYC";

                                             }if($value=="Proof_For_Corporate_Account_Form.pdf"){

                                                echo "DOCUMENT CHECKLIST FOR CORPORATE ACCOUNT";

                                             }if($value=="Proof_For_Partnership_Account_Form.pdf"){

                                                echo "DOCUMENT CHECKLIST FOR PARTNERSHIP ACCOUNT";

                                             }if($value=="Required_for_opening_Individual_account.pdf"){

                                                echo "DOCUMENT CHECKLIST FOR NRI ACCOUNT";

                                             }if($value=="Required_for_opening_Minor_account.pdf"){

                                                echo "DOCUMENT CHECKLIST FOR INDIVIDUAL ACCOUNT";

                                             }if($value=="Required_For_Opening_NRI_Account_Check_List.pdf"){

                                                echo "DOCUMENT CHECKLIST FOR MINOR ACCOUNT";
                                             }





                                          ?></h6>
                                                    <!-- <p class="text-muted mb-0 line-ellipsis">pdf</p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Check List -->