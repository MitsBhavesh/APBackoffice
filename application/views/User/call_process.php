<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-6">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  
               </div>
            </div>
            <div class="col-6">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  
               </div>
            </div>
         </div>
         <!-- end page title -->
         <div class="row">

            <div class="col-lg-6">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-folder-zip me-2" style="color:#fff;"></i>Upload file(.ZIP)</h6>
                        </div>

                  <div class="card-body">
                     <p class="card-title-desc" style="color:red;">Note: Supported File Format .Zip | Max file size 500MB!</p>
                     <?php include("alert.php"); ?>
                     <form method="POST" action="<?php echo base_url();?>Call_process/Upload_file" enctype="multipart/form-data">
                        <div class="row mb-4">
                           <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Upload File:</label>
                           <div class="col-sm-6">
                              <input class="form-control" name="zip_file" type="file" id="formFile">
                           </div>
                        </div>
                        <div class="row justify-content-end">
                           <div class="col-sm-9">
                              <div>
                                 <button type="submit" class="btn btn-primary w-md">Upload</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- end row -->
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-zip-box-outline me-2" style="color:#fff;"></i>File Uploaded List</h6>
                        </div>
                  <div class="card-body">
                     <p class="card-title-desc" style="color:red;">Note: By Default Today Uploaded File Shown.</p>
                     <form method="POST" action="<?php echo base_url();?>Call_process/List_File" enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="card-body">
                                 <fieldset>
                                    <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                    <input class="" type="date" value="<?php if(isset($_SESSION['Arham_recording_from_date'])){echo $_SESSION['Arham_recording_from_date'];}else{echo date('Y-m-d',strtotime('-1 days'));}?>" id="from_date" name="from_date">
                                 </fieldset>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="card-body">
                                 <fieldset>
                                    <label class="form-label" for="formrow-fromdate-input">To Date</label>
                                    <input class="" type="date" value="<?php if(isset($_SESSION['Arham_recording_to_date'])){echo $_SESSION['Arham_recording_to_date'];}else{echo date('Y-m-d');}?>" id="to_date" max="<?= date('Y-m-d'); ?>" name="to_date">
                                 </fieldset>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="card-body">
                                 <fieldset>
                                    <div class="col-md-2">
                                       <div class="mb-2" style="padding-top: 30px;">
                                          <button type="submit" class="btn btn-primary w-md">Submit</button>
                                       </div>
                                    </div>
                                 </fieldset>
                              </div>
                           </div>
                        </div>
                     </form>
                     <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead class="table-light">
                           <tr>
                              <th scope="col" style="width: 70px;">#</th>
                              <th scope="col" style="width: 270px;">File Name</th>
                              <th scope="col" style="width: 270px;">Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($result)){
                              foreach ($result as $value) {?>
                           <tr>
                              <td><?php echo $value['Row_ID']?></td>
                              <td><?php echo $value['File_name']?></td>
                              <td>
                              <?php 
                                 if($value['Entry_Status']=="Verified")
                                 {
                                    echo $value['Entry_Status'].'<img src="assets/images/verified.png" height="20" width="20">';
                                 }
                                 else
                                 {
                                    echo $value['Entry_Status'];
                                 }
                              ?>
                                       
                              </td>
                           </tr>
                           <?php }} ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end row -->
   </div>
   <!-- container-fluid -->
</div>
<!-- End Page-content -->