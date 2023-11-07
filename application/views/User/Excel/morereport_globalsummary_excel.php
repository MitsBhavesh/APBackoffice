
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<?php
// echo "gdjg";exit();
if(isset($_SESSION['APBackOffice_MoreReport_GlobalSummarydata']))
{
    // echo "hi";exit();
   $columns=$_SESSION['APBackOffice_MoreReport_GlobalSummarydata'][0];
   $back_data=$_SESSION['APBackOffice_MoreReport_GlobalSummarydata'][1];
   // echo "<pre>";print_r($holdint_data);exit();
}

?>

<table id="datatable_more_report_globalsummary" class="table table-bordered dt-responsive w-100" style="display:none;">
<thead>
		<tr>
            <th style="color:blue;"><b>Code: <?php echo $back_data[0][36];?></b></th>
        </tr>
        <tr>
            <th style="color:blue;"><b>Name: <?php echo $back_data[0][37];?></b></th>  
        </tr>
        <tr>
            <th>Script</th>
            <th>Open Qty</th>
            <th>Open rate</th>
            <th>Buy Qty</th>
            <th>Buy Rate</th>
            <th>Sale Qty</th>
            <th>Sale Rate</th>
            <th>Net Qty</th>
            <th>Net Rate</th>
            <th>Net Amount</th>
            <th>Closing Price</th>
            <th>Not Profit</th>
        </tr>
        </thead>

        <tbody>
           <?php 
        $opqty = 0;
        $buyqty = 0;
        $buyamount = 0;
        $saleqty = 0;
        $saleamount = 0;
        $netqty = 0;
        $netamount = 0;
        $netprofit = 0;
        if(!empty($back_data))
        {
            $i = 0;

            foreach ($back_data as $key_index => $data_row) 
            {
                $opqty += $back_data[$i][39];
                $buyqty += $back_data[$i][2];
                $buyamount += $back_data[$i][4];
                $saleqty += $back_data[$i][5];
                $saleamount += $back_data[$i][7];
                $netqty += $back_data[$i][8];
                $netamount += $back_data[$i][10];
                $netprofit += $back_data[$i][14];

                if($back_data[$i][28] != "IGST" && $back_data[$i][28] != "STAMP DUTY" && $back_data[$i][28] != "OTHER EXP" && $back_data[$i][28] != "STT" && $back_data[$i][28] != "CGST" && $back_data[$i][28] != "SGST" && $back_data[$i][28] != "TURN OVER CHARGE")
                {
                ?>
                    <tr>
                        <td><?php echo $back_data[$i][38]; ?></td>
                        <!-- <td><?php echo $back_data[$i][28]; ?></td> -->
                        <td class="t1 arh_rgt"><?php echo $back_data[$i][39]; ?></td>
                        <td class="arh_rgt"><?php echo $back_data[$i][1]; ?></td>
                        <td class="t2 arh_rgt"><?php echo $back_data[$i][2]; ?></td>
                        <td class="arh_rgt"><?php echo $back_data[$i][3]; ?></td>
                        <td class="t4 arh_rgt"><?php echo $back_data[$i][5]; ?></td>
                        <td class="arh_rgt"><?php echo $back_data[$i][6]; ?></td>
                        <td class="t6 arh_rgt"><?php echo $back_data[$i][8]; ?></td>
                        <td class="arh_rgt"><?php echo $back_data[$i][9]; ?></td>
                        <td class="t7 arh_rgt"><?php echo $back_data[$i][10]; ?></td>
                        <td class="arh_rgt"><?php echo $back_data[$i][13]; ?></td>
                        <td class="t8 arh_rgt"><?php echo $back_data[$i][14]; ?></td>
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
        ?>                                  
        </tbody>
        <tfoot>
        <?php
        $i = 0;
        if(!empty($back_data))
        {
        foreach ($back_data as $key_index => $data_row) 
        {
            if($back_data[$i][28] == "IGST" or $back_data[$i][28] == "STAMP DUTY" or $back_data[$i][28] == "OTHER EXP" or $back_data[$i][28] == "STT" or $back_data[$i][28] == "CGST" or $back_data[$i][28] == "SGST" or $back_data[$i][28] == "TURN OVER CHARGE")
            {
        ?>
                <tr class="expense_tr">
                    <td><?php echo $back_data[$i][38]; ?></td>
                    <!-- <td><?php echo $back_data[$i][28]; ?></td> -->
                    <td class="t1 arh_rgt"><?php echo $back_data[$i][39]; ?></td>
                    <td class="arh_rgt"><?php echo $back_data[$i][1]; ?></td>
                    <td class="t2 arh_rgt"><?php echo $back_data[$i][2]; ?></td>
                    <td class="arh_rgt"><?php echo $back_data[$i][3]; ?></td>
                    <td class="t4 arh_rgt"><?php echo $back_data[$i][5]; ?></td>
                    <td class="arh_rgt"><?php echo $back_data[$i][6]; ?></td>
                    <td class="t6 arh_rgt"><?php echo $back_data[$i][8]; ?></td>
                    <td class="arh_rgt"><?php echo $back_data[$i][9]; ?></td>
                    <td class="t7 arh_rgt"><?php echo $back_data[$i][10]; ?></td>
                    <td class="arh_rgt"><?php echo $back_data[$i][13]; ?></td>
                    <td class="t8 arh_rgt"><?php echo $back_data[$i][14]; ?></td>
                </tr>
        <?PHP
            }
            $i++;

        }
        }
        ?>
        <tr>
            <td style="font-weight: bold;"><?php echo "Total"; ?></td>
            <td class="ft1 arh_rgt_bold"></td>
            <td class="arh_rgt_bold"></td>
            <td class="ft2 arh_rgt_bold"></td>
            <td class="arh_rgt_bold"></td>
            <td class="ft4 arh_rgt_bold"></td>
            <td class="arh_rgt_bold"></td>
            <td class="ft6 arh_rgt_bold"></td>
            <td class="arh_rgt_bold"></td>
            <td class="ft7 arh_rgt_bold"></td>
            <td class="arh_rgt_bold"></td>
            <td class="ft8 arh_rgt_bold"></td>
        </tr>
        <tr>
            <td style="font-weight: bold;"><?php echo "Grand Total"; ?></td>
            <td class="arh_rgt_bold"><?php echo $opqty; ?></td>
            <td></td>
            <td class="arh_rgt_bold"><?php echo $buyqty; ?></td>
            <td></td>                                       
            <td class="arh_rgt_bold"><?php echo $saleqty; ?></td>
            <td></td>
            <td class="arh_rgt_bold"><?php echo $netqty; ?></td>
            <td></td>
            <td class="arh_rgt_bold"><?php echo $netamount; ?></td>
            <td></td>
            <td class="arh_rgt_bold"><?php echo $netprofit; ?></td>
        </tr>
    </tfoot>
                  
</table>
<!-- <script type="text/javascript">
  $(document).ready(function(){
  
    $("#datatable_more_report_globalsummary").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "MoreReport_GlobalSummary",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>Reports/GenerateReport";
  
});
</script> -->
<script type="text/javascript">
    window.exportToExcel('datatable_more_report_globalsummary');
    function exportToExcel(tableId){
        let tableData = document.getElementById(tableId).outerHTML;
        //tableData = tableData.replace(/<img[^>]*>/gi,""); //enable thsi if u dont want images in your table
        tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params
        //click a hidden link to which will prompt for download.
        let a = document.createElement('a')
        let dataType = 'data:application/vnd.ms-excel';
        a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
        a.download = 'MoreReport_GlobalSummary' + rand() + '.xls'
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
