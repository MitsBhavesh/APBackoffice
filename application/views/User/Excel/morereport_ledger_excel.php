<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<?php
// echo "gdjg";exit();
if(isset($_SESSION['APBackOffice_MoreReport_Ledgerdata']))
{
    // echo "hi";exit();
   $columns=$_SESSION['APBackOffice_MoreReport_Ledgerdata'][0];
   $back_data=$_SESSION['APBackOffice_MoreReport_Ledgerdata'][1];
   // echo "<pre>";print_r($_SESSION['APBackOffice_client_code']]);exit();
}
 include("check_number_convert.php");
?>


<table id="datatable_more_report_ledger" class="table table-bordered dt-responsive w-100" style="display:none;">
<thead>
<tr>
    <th style="color:blue;"><b>Code: <?php echo $back_data[0][26];?></b></th>
</tr>
<tr>
    <th style="color:blue;"><b>Name: <?php echo $back_data[0][33];?></b></th>  
</tr>
<tr>
    <th style="width: 50px;">Trading Date</th>
    <th id="vouchardateclick">Voucher Date</th>
    <th>Voucher No</th>
    <th>Segment</th>
    <th>Particulars</th>
    <th>Chq No</th>
    <th>Debit</th>
    <th>Credit</th>
    <th>Balance</th>
</tr>
</thead>
<tbody>
    <?php 
    $debit = 0;
    $credit = 0;
    $total_balance = 0;
    if(!empty($back_data))
    {
    $i = 0;
    $yestarday_balance = 0;
    foreach ($back_data as $key_index => $data_row) {
                    
                    // $balance = $balance + $back_data[$i][6];
    if($back_data[$i][1] != "" || $back_data[$i][2] != "")
    {
        $debit = $debit + floatval($back_data[$i][1]);
        $credit = $credit + floatval($back_data[$i][2]);
    ?>
    <tr>
                    <td>
                        <span style="display: none;">
                            <?php
                            // if($back_data[$i][9] != "OPENING BALANCE")
                            // {
                             echo ($back_data[$i][19] != " " && $back_data[$i][19] != "")?date_format(date_create(str_replace(",", "", $back_data[$i][19])),"Y/m/d"):""; 
                            // }
                            ?>
                            </span>

                            <?php 
                            // if($back_data[$i][9] != "OPENING BALANCE")
                            // {
                                echo ($back_data[$i][19] != " " && $back_data[$i][19] != "")?date_format(date_create(str_replace(",", "", $back_data[$i][19])),"d-m-Y"):""; 
                            // }
                            ?>
                    </td>

                    <td>
                        <span style="display: none;">
                            <?php 
                            if($back_data[$i][3] != "" && $back_data[$i][3]!=" ")
                            {
                                echo ($back_data[$i][3] != " ")?date_format(date_create(str_replace(",", "", $back_data[$i][3])),"Y/m/d"):""; 
                            }
                            ?>
                            </span>
                            <?php 
                            if($back_data[$i][3] != "" && $back_data[$i][3]!=" ")
                            {
                                echo ($back_data[$i][3] != " ")?date_format(date_create(str_replace(",", "", $back_data[$i][3])),"d-m-Y"):""; 
                            }
                            ?>
                    </td>
                    <td><?php echo $back_data[$i][8]; ?></td>
                    <td><?php echo $back_data[$i][0]; ?></td>
                    <td><?php echo $back_data[$i][9]; ?></td>
                    <td><?php echo $back_data[$i][12]; ?></td>
                    <td class="t1 arh_rgt"><?php echo $back_data[$i][1]; ?></td>
                    <td class="t2 arh_rgt"><?php echo $back_data[$i][2]; ?></td>
                    <td class="t3 arh_rgt" value="">

                        <?php 
                        // echo "##".$back_data[$i][1]."##";
                        if($back_data[$i][1] == 0 || $back_data[$i][1] == "")
                        {

                            $yestarday_balance -= $back_data[$i][2];
                            // $total_balance += $back_data[$i][2];
                            echo Ledger_balance($yestarday_balance);
                            ?>
                            <input type="hidden" class="t3t" value="<?php echo $yestarday_balance; ?>">
                            <?php
                        }
                        else
                        {
                            $yestarday_balance += $back_data[$i][1];
                            // $total_balance += $back_data[$i][1];
                            echo Ledger_balance($yestarday_balance);
                            ?>
                            <input type="hidden" class="t3t" value="<?php echo $yestarday_balance; ?>">
                            <?php
                        }
                        $total_balance += $yestarday_balance;
                        ?>
                    </td>
                </tr>
    <?php  
        }

    $i++;
    }
    }
    else
    {?>
        <tr>No Data Found</tr>
    <?php
    }
    // echo "just<br>";
    // print_r($total_balance);
    ?>
    </tbody>
       <!-- <tr>
            <td style="font-weight: bold;"><?php echo "Total"; ?></td>
            <td><?php echo ""; ?></td>
            <td><?php echo ""; ?></td>
            <td><?php echo ""; ?></td>
            <td><?php echo ""; ?></td>
            <td><?php echo ""; ?></td>
            <td class="ft1 arh_rgt"></td>
            <td class="ft2 arh_rgt"></td>
            <td class="ft3 arh_rgt"></td>
        </tr> -->
    <tr>
        <td style="font-weight: bold;"><?php echo "Ledger Balance"; ?></td>
        <td><?php echo ""; ?></td>
        <td><?php echo ""; ?></td>
        <td><?php echo ""; ?></td>
        <td><?php echo ""; ?></td>
        <td><?php echo ""; ?></td>
        <td class="arh_rgt" style="font-weight: bold;"><?php 
        // echo $debit; 
        ?></td>
        <td class="arh_rgt" style="font-weight: bold;"><?php 
        // echo $credit; 
        ?></td>
        <td class="arh_rgt" style="font-weight: bold;"><?php
        if(isset($yestarday_balance))
        { 
            $yestarday_balance = $yestarday_balance <= 0 ? abs($yestarday_balance) : -$yestarday_balance ;
            echo Ledger_balance($yestarday_balance);
        }
        else
        {
            echo 0;
        }
        ?></td>
    </tr>
</table>
<!-- <script type="text/javascript">
  $(document).ready(function(){
  
    $("#datatable_more_report_ledger").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "MoreReport_Ledger",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>Reports/GenerateReport";
  
});
</script> -->
<script type="text/javascript">
    window.exportToExcel('datatable_more_report_ledger');
    function exportToExcel(tableId){
        let tableData = document.getElementById(tableId).outerHTML;
        //tableData = tableData.replace(/<img[^>]*>/gi,""); //enable thsi if u dont want images in your table
        tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params
        //click a hidden link to which will prompt for download.
        let a = document.createElement('a')
        let dataType = 'data:application/vnd.ms-excel';
        a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
        a.download = 'Ledger' + rand() + '.xls'
        a.click()
        window.location.href = '<?php echo base_url('Reports/GenerateReport');?>';
    }
    function rand() {
        let rand = Math.floor((Math.random().toFixed(2)*100))
        let dateObj = new Date()
        let dateTime = `${dateObj.getHours()}${dateObj.getMinutes()}${dateObj.getSeconds()}`
        return `${dateTime}${rand}`
    }
</script>