<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18"></h4>
                  <!-- <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">APBackOffice</a></li>
                        <li class="breadcrumb-item active">HelpDesk</li>
                     </ol>
                  </div> -->
               </div>
            </div>
         </div>
         <!-- end page title -->
         <?php include("alert.php"); ?> 
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;">CDSL Client Detail</h6>
                        </div>
                  <div class="card-header align-items-center d-flex">
                     <!-- Start Form -->
                     <form method="post" action="<?php echo base_url();?>KYC/cdsl_client_detail">
                        <div class="row card-title mb-0 flex-grow-1">
             
                           <div class="col-md-4">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-fromdate-input">From Date:</label>
                                 <input class="form-control" type="date" value="2021-04-01" id="from_date" name="from_date">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="mb-2">
                                 <label class="form-label" for="formrow-todate-input">To Date:</label>
                                 <input class="form-control" type="date" value="<?php echo date('Y-m-d')?>" id="to_date" name="to_date">
                              </div>
                           </div> 
                          <!--  <div class="col-md-4">
                              <div class="mb-2">
                                    <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                    <div class="mb-3">
                                       <input type="text" class="form-control" name="client_code">
                                    </div>
                              </div>
                           </div> -->
                           
                           <div class="col-md-1">
                              <div class="mb-2" style="padding-top: 30px;">
                                 <button type="submit" name="btn_submit" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                              </div>
                           </div>
                        </div>
                     </form>
                     <!-- End Form -->
                  </div>
                  <!-- Start DataTable -->
                  <!-- <div class="card-body">
                     <table id="datatable1" class="table table-bordered dt-responsive w-100">
                        <thead>
                           <tr>
                              <th>COMPANY CODE</th>
                              <th>NET BRK</th>
                              <th>BRANCH CODE NAME</th>
                              <th>CLIENT ID</th>
                              <th>CLIENT NAME</th>
                              <th>CLIENT BROKERAGE</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($back_data)){
                               foreach ($back_data as $data_row) {

                              ?>

                           <tr>
                              <td><?php echo $data_row[0];?></td>
                              <td><?php echo $data_row[5];?></td>
                              <td><?php echo $data_row[11];?></td>
                              <td><?php echo $data_row[24];?></td>
                              <td><?php echo $data_row[25];?></td>
                              <td><?php echo $data_row[27];?></td>
                           </tr>
                        <?php } } ?>

                        </tbody>
                     </table>
                  </div> -->
                  <!-- End DataTable -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <script type="text/javascript">
   $(document).ready( function () {
      $('#datatable1').DataTable( {
      responsive: true
      
      } );
} );
</script> -->