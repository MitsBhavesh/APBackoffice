<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">

                            <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-users"
                                    style="color: #ffff;"></i> KYC Form & Formats</h6>
                        </div>
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>Form Name</th>
                                        <th>Download</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($pdffiles as $value) {
                                                ?>
                                    <tr>
                                        <td><?php echo str_replace(".pdf", "", $value);?></td>
                                        <td>
                                            <?php 
                                                $file_name =str_replace(array(' ', '&' ), '_', $value);

                                                ?>
                                            <a href="<?php echo base_url().'F_formats/KYC_doc_download?file_name='.$file_name;?>"
                                                type="button" download>
                                                <i style="font-size:24px" class="far fa-file-pdf"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>