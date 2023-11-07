<?php
if(isset($_SESSION['APBackOffice_client_Trading_data']))
{
   $columns=$_SESSION['APBackOffice_client_Trading_data'][0];
   $back_data=$_SESSION['APBackOffice_client_Trading_data'][1];
   // echo "<pre>";
   // print_r($_SESSION['APBackOffice_client_Trading_data']);exit();
}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<table id="client_trading" class="table table-bordered dt-responsive  nowrap w-100" style="display:none;">
  <thead>
     <tr>
        <th>Company Code</th>
        <th>Remeshire Group</th>
        <th>Remeshire Name</th>
        <th>Client Id</th>
        <th>Client Name</th>
        <th>DP Id</th>
        <th>Client DP Code</th>
        <th>DP Name</th>
        <th>Mobile No</th>
        <th>Email Id</th>
        <th>Resi Address 1</th>
        <th>Resi Address 2</th>
        <th>Resi Address 3</th>
        <th>Bank Name</th>
        <th>Bank Account No</th>
        <th>Micr Code</th>
     </tr>
  </thead>

  <tbody>
     <?php
        $i = 0;
        if(!empty($back_data))
        {//if start
           foreach($back_data as $key => $value)
           {//foreach start
              // echo "<pre>";
              // print_r($back_data[$i][4]);exit();

     ?>
        <tr>
           <td><?php echo $back_data[$i][0]; ?></td>
           <td><?php echo $back_data[$i][7]; ?></td>
           <td><?php echo $back_data[$i][8]; ?></td>
           <td><?php echo $back_data[$i][9]; ?></td>
           <td><?php echo $back_data[$i][10]; ?></td>
           <td><?php echo $back_data[$i][5]; ?></td>
           <td><?php echo "'".$back_data[$i][4]; ?></td>
           <td><?php echo $back_data[$i][6]; ?></td>
           <td><?php echo $back_data[$i][14]; ?></td>
           <td><?php echo $back_data[$i][15]; ?></td>
           <td><?php echo $back_data[$i][11]; ?></td>
           <td><?php echo $back_data[$i][12]; ?></td>
           <td><?php echo $back_data[$i][13]; ?></td>
           <td><?php echo $back_data[$i][3]; ?></td>
           <td><?php echo $back_data[$i][2]; ?></td>
           <td><?php echo $back_data[$i][1]; ?></td>
        </tr>
     <?php
           $i++;
        }//end foreach end
     }//if end

     ?>
  </tbody>
</table>
<script type="text/javascript">
  $(document).ready(function(){
  
    $("#client_trading").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "client_Trading_Details",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>KYC/trading_detail";
  
});
</script>