<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Plain Papar Bill [Pending]</h4>
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
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Get_PlainPaperBill">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="mb-2">
                                                <label class="form-label" for="formrow-todate-input">Client
                                                    Code:</label>
                                                <div class="mb-3">
                                                    <select class="form-select" name="client_code" required>
                                                        <option disabled="disabled" selected="selected">Select</option>
                                                        <?php foreach ($client_code as $value) {
                                          echo '<option value='.$value.'>'.$value.'</option>';
                                       }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="mb-2">
                                                <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                                <input class="form-control" type="date" value="2021-04-01"
                                                    id="from_date" name="from_date">
                                                <input class="form-control" type="hidden" value="common_contract_bill"
                                                    name="report_type">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="mb-2">
                                                <label class="form-label" for="formrow-todate-input">To Date</label>
                                                <input class="form-control" type="date"
                                                    value="<?php echo date('Y-m-d')?>" id="to_date" name="to_date">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="mb-2">
                                                <label class="form-label"
                                                    for="formrow-todate-input">&nbsp;&nbsp;&nbsp;</label>
                                                <button type="submit" class="btn btn-primary w-md"
                                                    style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                            </div>
                                        </div>
                                        <!--   <div class="col-sm">
                              One of three columns
                            </div> -->
                                    </div>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                        <!-- Start DataTable -->
                        <!-- Start DataTable -->
                        <?php if(isset($filename))
                  {
                     include("AccountReport/".$filename);
                  }
                  ?>
                        <!-- End DataTable -->
                        <!-- End DataTable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>