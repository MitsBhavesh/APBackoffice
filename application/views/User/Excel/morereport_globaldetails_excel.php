
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<?php
// echo "gdjg";exit();
if(isset($_SESSION['APBackOffice_MoreReport_GlobalDetaildata']))
{
    // echo "hi";exit();
   $columns=$_SESSION['APBackOffice_MoreReport_GlobalDetaildata'][0];
   $back_data=$_SESSION['APBackOffice_MoreReport_GlobalDetaildata'][1];
   // echo "<pre>";print_r($holdint_data);exit();
}
$group = array();
foreach ($back_data as $value ) {
    $group[$value[30]][] = $value;
}
?>

<table id="datatable_more_report_globaldetail" class="table table-bordered dt-responsive w-100" style="display:none;">
 <thead>
			 		<tr>
			            <th style="color:blue;"><b>Code: <?php echo $back_data[0][11];?></b></th>
			        </tr>
			        <tr>
			            <th style="color:blue;"><b>Name: <?php echo $back_data[0][12];?></b></th>  
			        </tr>
	                <tr>
	                    <th>Company</th>
	                    <th>Date</th>
	                    <th>Narration</th>
	                    <th>BQty</th>
	                    <th>BRate</th>
	                    <th>SQty</th>
	                    <th>SRate</th>
	                    <th>NetQty</th>
	                    <th>NRate</th>
	                    <th>NetAmt</th>
	                    
	                </tr>
	                </thead>

	                <tbody>
	                <?php 

	                $bqty = 0;
	                $sqty = 0;
	                $nqty = 0;
	                $namount = 0;

	                if(!empty($back_data))
	                {
	                    $i = 0;
	                    foreach ($group as $key_index => $data_row) { 

	                    $bqty_sub = 0;
	                    $sqty_sub = 0;
	                    $nqty_sub = 0;
	                    $namount_sub = 0;
	                   
	                 ?>
	                    <tr>
	                        <td style="background-color: #e6e6e6;" colspan="10"><?php echo $key_index; ?></td>
	                   
	                    </tr>
	                <?php
	                    foreach ($data_row as $key_index2 => $data_row2) 
	                    {
	                    
	                    $bqty = $bqty + $back_data[$i][34];
	                    $sqty = $sqty + $back_data[$i][3];
	                    $nqty = $nqty + $back_data[$i][6];
	                    $namount = $namount + $back_data[$i][9];

	                    $bqty_sub = $bqty_sub + $back_data[$i][34];
	                    $sqty_sub = $sqty_sub + $back_data[$i][3];
	                    $nqty_sub = $nqty_sub + $back_data[$i][6];
	                    $namount_sub = $namount_sub + $back_data[$i][9];
	                ?>
	                
	                    <tr>
	                    <td><?php echo $back_data[$i][0]; ?></td>  <!-- company name -->

	                    <td>
	                        <span style="display: none;">
	                        <?php echo ($back_data[$i][32] != " ")?date_format(date_create(str_replace("/", "-", $back_data[$i][32])),"Y/m/d"):""; ?>
	                        </span>
	                        <?php echo ($back_data[$i][32] != " ")?date_format(date_create(str_replace("/", "-", $back_data[$i][32])),"d-m-Y"):""; ?>
	                            
	                    </td>                                     
	                    
	                    <td><?php echo $back_data[$i][26]; ?></td> <!-- Narration -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][34]; ?></td>  <!-- buy quantity -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][1]; ?></td>    <!-- buy rate -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][3]; ?></td>    <!-- sale qty -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][4]; ?></td>    <!-- sale rate -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][6]; ?></td>    <!-- net qty -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][7]; ?></td>   <!--  net rate -->

	                    <td class="arh_rgt"><?php echo $back_data[$i][9]; ?></td>    <!-- net amount -->
	                </tr>
	               <?php  
	                    $i++;
	                    } ?> 
	                    <tr>
	                     
	                        <td></td>
	                        <td></td>
	                        <td style="font-weight: bold;">Total</td>
	                        <td class="arh_rgt_bold"><?php echo $bqty_sub; ?></td>
	                        <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                        <td class="arh_rgt_bold"><?php echo $sqty_sub; ?></td>
	                        <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                        <td class="arh_rgt_bold"><?php echo $nqty_sub; ?></td>
	                        <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                        <td class="arh_rgt_bold"><?php echo $namount_sub; ?></td>
	                    </tr>
	                    <?php
	                }
	                }
	                else
	                {?>
	                    <!-- <tr>No Data Found</tr> -->
	                <?php
	                }
	                ?>                 
	                </tbody>
	                <tfoot>
	                  <tr>
	                    <td style="font-weight: bold;"><?php echo "Grand Total"; ?></td>
	                    <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                    <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                    <td class="arh_rgt_bold"><?php echo $bqty; ?></td>
	                    <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                    <td class="arh_rgt_bold"><?php echo $sqty ?></td>
	                    <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                    <td class="arh_rgt_bold"><?php echo $nqty ?></td>
	                    <td class="arh_rgt_bold"><?php echo ""; ?></td>
	                    <td class="arh_rgt_bold"><?php echo $namount; ?></td>
	                    
	                </tr>                                 
	               </tfoot>              
</table>
<!-- <script type="text/javascript">
  $(document).ready(function(){
  
    $("#datatable_more_report_globaldetail").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "MoreReport_GlobalDetails",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>Reports/GenerateReport";
  
});
</script> -->
<script type="text/javascript">
    window.exportToExcel('datatable_more_report_globaldetail');
    function exportToExcel(tableId){
        let tableData = document.getElementById(tableId).outerHTML;
        //tableData = tableData.replace(/<img[^>]*>/gi,""); //enable thsi if u dont want images in your table
        tableData = tableData.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tableData = tableData.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params
        //click a hidden link to which will prompt for download.
        let a = document.createElement('a')
        let dataType = 'data:application/vnd.ms-excel';
        a.href = `data:application/vnd.ms-excel, ${encodeURIComponent(tableData)}`
        a.download = 'MoreReport_GlobalDetails' + rand() + '.xls'
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
