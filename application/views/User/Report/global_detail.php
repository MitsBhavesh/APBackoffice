<?php
// echo "<pre>";
// print_r($back_data);
if(isset($_SESSION['APBackOffice_MoreReport_GlobalDetaildata']))
{
    // print_r($_SESSION['APBackOffice_MoreReport_Ledgerdata']);
    // exit();
   $columns=$_SESSION['APBackOffice_MoreReport_GlobalDetaildata'][0];
   $back_data=$_SESSION['APBackOffice_MoreReport_GlobalDetaildata'][1];
   // echo "<pre>";
   // print_r($back_data);exit();
}  
$group = array();
foreach ($back_data as $value ) {
    $group[$value[30]][] = $value;
}
?> 
<style>
   .table td, .table th {
   font-size: 11px;
   padding: 0.35rem 0.35rem;
   /*font-family:    Arial, Verdana, sans-serif;*/
   }
</style>

<div class="card-body">
	 <div class="row">
        <div class="col-2" style="text-align: center;">
          Code :<span
              style="padding:20px;color:blue;"><b><?php echo $back_data[0][11];?></b></span>
        </div>
        <div class="col-5">
          Name :<span
              style="padding:20px;color:blue;"><b><?php echo $back_data[0][12];?></b></span>
        </div>       
 </div>
  <br>
   <div class="row">
      <div class="col-12">
         <div class="">
            <div class="card-body">	
            	 <div style="text-align-last: end;">
                     <a href="<?php echo base_url('Reports/report_globaldetails_excel_download'); ?>"><img src="<?php echo base_url(); ?>assets/xls-icon-3397.png" width="25" height="25"></a>
                     <a href="<?php echo base_url('Reports/report_global_detail_pdf_download'); ?>"><img
                                            src="<?php echo base_url(); ?>assets/pdf.png" width="25"
                                            height="25"></a>
                  </div>
	            <table id="datatable" class="table table-bordered dt-responsive w-100" style="border-collapse: collapse; border-spacing: 0; width: 100%; height: 200px;">
	                <thead>
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
	                    <?php

	                    	// Grand Total
	                        $_SESSION['totalofbuyqty'] = $bqty;
	                        $_SESSION['totalofsaleqty'] = $sqty;
	                        $_SESSION['totalofnetqty'] = $nqty;
	                        $_SESSION['totalofnetamount'] = $namount;
                        ?>
	                </tr>                                 
	               </tfoot>
	            </table>
            </div>
         </div>
      </div>
   </div>
</div>