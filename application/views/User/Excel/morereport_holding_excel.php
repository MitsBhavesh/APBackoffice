<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<?php
// echo "gdjg";exit();
if(isset($_SESSION['APBackOffice_MoreReport_Holdingdata']))
{
    // echo "hi";exit();
   $columns=$_SESSION['APBackOffice_MoreReport_Holdingdata'][0];
   $holdint_data=$_SESSION['APBackOffice_MoreReport_Holdingdata'][1];
   // echo "<pre>";print_r($holdint_data);exit();
}
include("check_number_convert.php");
// include("datatlb_header.php");
?>


<table id="datatable_more_report_holding" class="table table-bordered dt-responsive w-100" style="display:none;">
 <thead>
    <tr>
<th style="color:blue;"><b>Code: <?php echo $holdint_data[0][0];?></b></th>
</tr>
<tr>
<th style="color:blue;"><b>Name: <?php echo $holdint_data[0][12];?></b></th>  
</tr>
        <tr>
            <th>Script Name</th>
            <th>ISIN</th>
            <th>POA</th>
            <th>NONPOA</th>
            <th>Colletral</th>
            <th>In Short</th>
            <th>Out Short</th>
            <th>Net</th>
            <th>Closing Price</th>
            <th>Amount</th>
        </tr>
    </thead>

    <tbody>
        <?php 
            $i = 0;
            $colqty = 0;
            $inshort = 0;
            $outshort = 0;
            $net = 0;
            $scriptvalue = 0;
            $amount = 0;
            $nonpoa = 0;
            $poa = 0;
            if(!empty($holdint_data))
            {
            foreach ($holdint_data as $key_index => $data_row) {
                
            $colqty = $colqty + $holdint_data[$i][29];
            $inshort = $inshort + $holdint_data[$i][5];
            $outshort = $outshort + $holdint_data[$i][6];
            $net = $net + $holdint_data[$i][38];
            $scriptvalue = $scriptvalue + $holdint_data[$i][30];
            $amount = $amount + $holdint_data[$i][2];
            $nonpoa = $nonpoa + $holdint_data[$i][36];
            $poa = $poa + $holdint_data[$i][32];
        ?>   
        <tr>
            <td><?php echo $holdint_data[$i][26]; ?></td>
            <td><?php echo $holdint_data[$i][9]; ?></td>
            <td class="t9 arh_rgt"><?php echo $holdint_data[$i][32]; ?></td>
            <td class="t8 arh_rgt"><?php echo $holdint_data[$i][36]; ?></td> <!-- none poa -->
            <td class="t1 arh_rgt"><?php echo $holdint_data[$i][29]; ?></td>
            <td class="t2 arh_rgt"><?php echo $holdint_data[$i][5]; ?></td>
            <td class="t3 arh_rgt"><?php echo $holdint_data[$i][6]; ?></td>
            <td class="t4 arh_rgt"><?php echo $holdint_data[$i][38]; ?></td>
            <td class="t5 arh_rgt"><?php echo $holdint_data[$i][30]; ?></td>
            <td class="t6 arh_rgt"><?php echo $holdint_data[$i][2]; ?></td>
        </tr>
        <?php  
           $i++;
           }
           }
        else
           {?>

           
           <?php
           }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td style="font-weight: bold;"><?php echo "Total"; ?></td>
            <td><?php echo ""; ?></td>
            <td class="ft9 arh_rgt_bold"></td>
            <td class="ft8 arh_rgt_bold"></td>
            <td class="ft1 arh_rgt_bold"></td>
            <td class="ft2 arh_rgt_bold"></td>
            <td class="ft3 arh_rgt_bold"></td>
            <td class="ft4 arh_rgt_bold"></td>
            <td class="ft5 arh_rgt_bold"></td>
            <td class="ft6 arh_rgt_bold"></td>
        </tr>
        <tr>
            <td style="font-weight: bold;"><?php echo "Grand Total"; ?></td>
            <td><?php echo ""; ?></td>
            <td class="arh_rgt_bold"><?php echo $poa; ?></td>
            <td class="arh_rgt_bold"><?php echo $nonpoa; ?></td>
            <td class="arh_rgt_bold"><?php echo $colqty; ?></td>
            <td class="arh_rgt_bold"><?php echo $inshort; ?></td>
            <td class="arh_rgt_bold"><?php echo $outshort; ?></td>
            <td class="arh_rgt_bold"><?php echo $net; ?></td>
            <td class="arh_rgt_bold"><?php echo $scriptvalue; ?></td>
            <td class="arh_rgt_bold"><?php echo $amount; ?></td>
        </tr>
    </tfoot>
                 
</table>
<!-- <script type="text/javascript">
  $(document).ready(function(){
  
    $("#datatable_more_report_holding").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "MoreReport_Holding",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>Reports/GenerateReport";
  
});
</script> -->
<script type="text/javascript">
    window.exportToExcel('datatable_more_report_holding');
    function exportToExcel(tableId){
        let tableData = document.getElementById(tableId).outerHTML;
        //tableData = tableData.replace(/<img[^>]*>/gi,""); //enable thsi if u dont want images in your table
        tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params
        //click a hidden link to which will prompt for download.
        let a = document.createElement('a')
        let dataType = 'data:application/vnd.ms-excel';
        a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
        a.download = 'MoreReport_Holding' + rand() + '.xls'
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