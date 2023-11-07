<?php
function calculateFiscalYearForDate($month)
{
    if($month > 4)
    {
       $y = date('Y');
       $pt = date('Y', strtotime('+1 year'));
       $fy = $y."-04-01".",".$pt."-03-31";
    }
    else
    {
       $y = date('Y', strtotime('-1 year'));
       $pt = date('Y');
       $fy = $y."-04-01".",".$pt."-03-31";
    }
    return $fy;
} 
$curr_date_month = date('m');
$calculate_fiscal_year_for_date = calculateFiscalYearForDate($curr_date_month);
$calculate_fiscal_year_for_date=explode(",", $calculate_fiscal_year_for_date);
$from_date=$calculate_fiscal_year_for_date[0];
$todate=$calculate_fiscal_year_for_date[1];
if(isset($_SESSION['finacial_year_apbackoffice']))
{
    $year=$_SESSION['finacial_year_apbackoffice'];
    $todate=$year."-03-31";
    $newYear=$year-1;
    $from_date=$newYear."-04-01";
}
else
{
    $year=date("Y");
    $todate=$year."-03-31";
    $newYear=$year-1;
    $from_date=$newYear."-04-01";
}
   ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                            <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-book-account-outline me-2" style="color:#fff;"></i>Account Reports</h6>
                        </div>
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <form method="post" action="<?php echo base_url();?>Reports/GenerateReport">
                                <div class="row card-title mb-0 flex-grow-1">
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                            <div class="mb-3">
                                                <input class="form-control" type="text" name="client_code" value="<?php if(isset($_SESSION['APBackOffice_client_code_report'])){echo $_SESSION['APBackOffice_client_code_report'];}?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-fromdate-input">From Date</label>
                                            <input class="form-control" type="date" value="<?php echo $from_date;?>" id="from_date"
                                                name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">To Date</label>
                                            <input class="form-control" type="date" value="<?php echo $todate;?>"
                                                id="to_date" name="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label" for="formrow-todate-input">Report</label>
                                            <div class="mb-3">
                                                <select class="form-select" name="report">
                                                    <option disabled="disabled" selected="selected">Select</option>
                                                    <option value="ledger">Ledger</option>
                                                    <option value="holding">Holding</option>
                                                    <option value="kyc">KYC</option>
                                                    <option value="globalsummary">Global Summary</option>
                                                    <option value="globaldetail">Global Detail</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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
                        <?php if(isset($filename))
                  {
                     include("Report/".$filename);
                  }
                  ?>
                        <!-- End DataTable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>