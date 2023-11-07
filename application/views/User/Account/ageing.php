<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-book-reader me-3"
                        style="color: #ffff;"></i>Ageing</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Accounts/Ageing_form" enctype="multipart/form-data">
                                <div class="row card-title mb-0 flex-grow-1">

                                    <input type="hidden" value="<?php echo $_SESSION['APBackOffice_user_code']; ?>"
                                        name="branch_code">

                                    <?php $years = range(2010, strftime("%Y", time())); ?>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Start Year</label>
                                            <select name="start_year" class="form-select" id="start_year">
                                                <option>Select Year</option>
                                                <?php foreach($years as $year) : ?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date:</label>
                                            <input class="form-control" type="date" value="<?php echo date('Y-m-d')?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2"> <label class="form-label" for="formrow-todate-input">Company
                                                code:</label>
                                            <div class="mb-3">
                                                <select name="company_code" class="form-select" id="company_code">
                                                    <option value="BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MF_BSE">Group 1
                                                    </option>
                                                    <option value="MCX,ICEX">Group 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="client_code"
                                                    value="<?php if(isset($_SESSION['Collection_client_code'])){echo $_SESSION['Collection_client_code'];}?>"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Day 1</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="day1"
                                                    placeholder="Enter day1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Day 2</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="day2"
                                                    placeholder="Enter day2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Day 3</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="day3"
                                                    placeholder="Enter day3">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Day 4</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="day4"
                                                    placeholder="Enter day4">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Day 5</label>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="day5"
                                                    placeholder="Enter day5">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="mb-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary w-md"
                                                style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                        <!-- Start DataTable -->
                        <div class="card-body">
                            <div class="row">
                                <div style="text-align-last: end;">
                                    <a href="<?php echo base_url('Accounts/ageing_excel'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25"
                                            height="25"></a>
                                </div>
                            </div>
                            <table id="datatable1" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <?php

                              if (!empty($ageing_data) && isset($ageing_data[0])) 
                              {

                           ?>
                                    <tr>
                                        <th>COMPANY CODE</th>
                                        <th>CLIENTNAME </th>
                                        <th>CLIENT_ID </th>
                                        <th>TOTAL AMOUNT </th>
                                        <th><?php print_r($ageing_data[0][9]); ?></th>
                                        <th><?php print_r($ageing_data[0][10]); ?></th>
                                        <th><?php print_r($ageing_data[0][12]); ?></th>
                                        <th><?php print_r($ageing_data[0][13]); ?></th>
                                        <th><?php print_r($ageing_data[0][14]); ?></th>
                                        <th><?php print_r($ageing_data[0][15]); ?></th>
                                    </tr>
                                    <?php
                              }
                           ?>
                                </thead>
                                <tbody>

                                    <?php

                              if (!empty($ageing_data)) 
                              {
                                 $i = 0;
                                 foreach ($ageing_data as $value)
                                 {
                           ?>
                                    <tr>
                                        <td><?php print_r($value[0]); ?></td>
                                        <td><?php print_r($value[22]); ?></td>
                                        <td><?php print_r($value[11]); ?></td>
                                        <td><?php print_r($value[2]); ?></td>
                                        <td><?php print_r($value[3]); ?></td>
                                        <td><?php print_r($value[4]); ?></td>
                                        <td><?php print_r($value[5]); ?></td>
                                        <td><?php print_r($value[6]); ?></td>
                                        <td><?php print_r($value[7]); ?></td>
                                        <td><?php print_r($value[8]); ?></td>

                                    </tr>
                                    <?php
                                 } 
                              }
                           ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- End DataTable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable1').DataTable({
        processing: true,
        deferRender: true,
        // dom: 'Bfrtip',
        // buttons: [
        //     'csv', 'pdf'
        // ],
    });
});
</script>