<?php
if(isset($_SESSION['APBackOffice_client_Holding_data']))
{
   $columns=$_SESSION['APBackOffice_client_Holding_data'][0];
   $back_data=$_SESSION['APBackOffice_client_Holding_data'][1];
   // echo "<pre>";
   // print_r($_SESSION['APBackOffice_client_Holding_data']);exit();
    $previouse_year=date('Y')-1;
   $start_date="01/04/".$previouse_year;

    // start new code previouse year 01-04-2022 to 31032023 ###################### 2022 to 2023 selected
    $current_year=date('Y');
    $to_date="31/03/".$current_year;
    // end new code previouse year 01-04-2022 to 31032023 ###################### 2022 to 2023 selected
}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<table id="datatable_cdsl_holding" class="table table-bordered dt-responsive  nowrap w-100" style="display:none;">
                        <thead>
                          <tr>
                            <th><b>Code: <?php if(isset($_SESSION['APBackOffice_client_code'])){echo $_SESSION['APBackOffice_client_code'];}?></b></th>
                          </tr>
                           <tr>
                             <th><b>Name: <?php if(isset($_SESSION['APBackOffice_client_name'])){echo $_SESSION['APBackOffice_client_name'];}?></b></th>  
                           </tr>
                            <tr>
                             <!-- <th><b>Statement For Holding From  <?php $t_date=date('d/m/Y'); echo $start_date." To ".$t_date;?></b></th>  2023 to 2024 year -->

                             <th><b>Statement For Holding From  <?php echo $start_date." To ".$to_date;?></b></th>
                             <!-- 2022 to 2023 year -->
                           </tr>
                           <tr>
                              <th>Scrip Name</th>
                              <th>ISIN</th>
                              <th>free Balance</th>
                              <th>Pledge Balance</th>
                              <th>Pending Dmt</th>
                              <th>Lock In</th>
                              <th>Pending Remat</th>
                              <th>Total</th>
                              <th>Price</th>
                              <th>Value</th>
                              <th>Ear Mark</th>
                           </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($back_data)){
                                  foreach ($back_data as $data_row) {
                                    $total_sum=array((int)$data_row[5],(int)$data_row[8],(int)$data_row[4],(int)$data_row[6]);
                                    $sum_totalvalue=array_sum($total_sum);
                                    // $value_multiply = (int)$sum_totalvalue * (int)$data_row[16];
                                    $value_multiply = (float)$sum_totalvalue * (float)$data_row[16];
                                    if($sum_totalvalue!=0)
                                    {//start if
                                 ?> 

                              <tr>
                                 <td><?php echo $data_row[14]; //scrip name?></td>
                                 <td><?php echo $data_row[13]; // ISIN?></td>
                                 <td><?php echo $data_row[5];//free Balance?></td>
                                 <td><?php echo $data_row[8];//Pledge Balance?></td>
                                 <td><?php echo $data_row[4]; //Pending Dmt?></td>
                                 <td><?php echo $data_row[6]; //Lock In?></td>
                                 <td><?php //Pending Remat?></td>
                                 <!-- <td><?php echo $data_row[15]; //Total?></td> -->
                                 <td><?php echo $sum_totalvalue; //Total?></td>
                                 <td><?php echo $data_row[16]; //Price?></td>
                                 <!-- <td><?php echo $data_row[7];//Value?></td> -->
                                 <td><?php echo $value_multiply;//Value?></td>
                                 <td><?php //Ear Mark?></td>
                              </tr>
                         <?php
                            }//if end
                          } } ?> 

                        </tbody>
                     </table>
<script type="text/javascript">
  $(document).ready(function(){
  
    $("#datatable_cdsl_holding").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "cdsl_holding",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>KYC/cdsl_client_holding";
  
});
</script>