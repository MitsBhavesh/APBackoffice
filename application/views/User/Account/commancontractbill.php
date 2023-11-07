<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-billboard me-3"
                        style="color: #ffff;"></i>Comman Contrat Bill</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Get_CommonContractBill">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="mb-2">
                                                <label class="form-label" for="exchange_code">Exchange Code:</label>
                                                <select name="exchange_code" id="exchange_code" class="form-select">
                                                    <option value="" selected="">All</option>
                                                    <option value="BSE_CASH,NSE_CASH">Equity</option>
                                                    <option value="NSE_FNO">Derivatives</option>
                                                    <option value="CD_NSE">Currancy</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-2">
                                                <label class="form-label" for="client_code">Client Code:</label>
                                                <input class="form-control" id="client_code" type="text"
                                                    name="client_code"
                                                    value="<?php if(isset($_SESSION['ApBackOffice_commancontractbill_client_code'])){echo $_SESSION['ApBackOffice_commancontractbill_client_code'];}?>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-2">
                                                <label class="form-label" for="from_date">From Date</label>
                                                <input class="form-control" type="date"
                                                    value="<?php if(isset($_SESSION['ApBackOffice_commancontractbill_from_date'])){echo $_SESSION['ApBackOffice_commancontractbill_from_date'];}else{$year=date('Y');echo ($year-1).'-'.'04-01';}?>"
                                                    id="from_date" name="from_date">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-2">
                                                <label class="form-label" for="to_date">To Date</label>
                                                <input class="form-control" type="date"
                                                    value="<?php if(isset($_SESSION['ApBackOffice_commancontractbill_to_date'])){echo $_SESSION['ApBackOffice_commancontractbill_to_date'];}else{echo date('Y-m-d');}?>"
                                                    id="to_date" name="to_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="margin-top: auto;">
                                            <div class="mb-2">
                                                <label class="form-label"
                                                    for="formrow-todate-input">&nbsp;&nbsp;&nbsp;</label>
                                                <button type="submit" name="btn_submit" class="btn btn-primary w-md"
                                                    style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <small style="color: red;"><b>Note:</b> PDF in by default password is your pan
                                        number as capital letter.</small>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>

                        <!-- Start DataTable -->
                        <style>
                        .table td,
                        .table th {
                            font-size: 11px;
                            /*font-family:    Arial, Verdana, sans-serif;*/
                        }
                        </style>
                        <div class="card-body">
                            <div class="row">
                                <!-- <h6>Comman Contract Bill</h6> -->
                                <div class="col-12">
                                    <div class="">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-bordered dt-responsive w-100">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;"  id="vouchardateclick">Date</th>
                                                        <th>Client Code</th>
                                                        <th>Client Name</th>
                                                        <th>File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                              if(isset($back_data))
                              {
                                 $i = 0;
                                 foreach ($back_data as $value) 
                                 {
                           ?>
                                                    <tr>
                                                        <td><?php $date = $value[7]; $date = str_replace('/', '-', $date);
                                                        echo date('Y-m-d', strtotime($date));?></td>
                                                        <td><?php echo $value[11]; ?></td>
                                                        <td><?php echo $value[12]; ?></td>
                                                        <?php 
                                  $pdf_file_path = $back_data[$i][6]; //file path URL [6]
                              ?>
                                                        <td>
                                                            <form
                                                                action="<?php echo base_url(); ?>Accounts/CommanContractBill_Download"
                                                                method="post">
                                                                <input type="hidden" name="bill_url"
                                                                    value="<?php echo $pdf_file_path; ?>">
                                                                <input type="hidden" name="client_code"
                                                                    value="<?php echo $value[11]; ?>">
                                                                <input type="hidden" name="file"
                                                                    value="<?php echo $value[13]; ?>">

                                                                <button class="btn" type="submit"
                                                                    style="display: contents; color: blue;" value=""><i
                                                                        class="fa fa-file-pdf-o" aria-hidden="true"
                                                                        style=""></i> &nbsp;
                                                                    <?php echo $back_data[$i][13] ?></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php      
                                 }

                              }
                           ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End DataTable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>