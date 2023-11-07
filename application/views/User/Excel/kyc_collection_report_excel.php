<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<?php
    if(isset($_SESSION['APBackOffice_collection_data']))
    {
      
      $columns=$_SESSION['APBackOffice_collection_data'][0];
      $back_data=$_SESSION['APBackOffice_collection_data'][1];
      //  echo "<pre>";
      // print_r($_SESSION['APBackOffice_collection_data'][0]);
      // exit();
    }
?>

  <table id="collection_tbl" class="table table-bordered dt-responsive w-100" style="display: none;">
     <thead>
        <tr>
           <th>BRANCH_CODE</th>
           <th>ACCOUNTCODE</th>
           <th>ACCOUNTNAME</th>
           <th>BRANCH_NAME</th>
           <th>MOBILENO</th>
           <th>LASTRDATE</th>
        </tr>
     </thead>
     <tbody>
     
            <?php if(!empty($back_data)){
         foreach ($back_data as $data_row) {
         
         ?>
            <tr>
     
               <td><?php echo $data_row[0];?></td>
               <td><?php echo $data_row[1];?></td>
               <td><?php echo $data_row[2];?></td>
               <td><?php echo $data_row[3];?></td>
               <td><?php echo $data_row[60];?></td>
               <td><?php echo $data_row[65];?></td>
            </tr>
      <?php 
         }
        } 
         ?>
      
     </tbody>
  </table>


<script type="text/javascript">
  $(document).ready(function(){

    $("#collection_tbl").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "collection_report_excel",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
  window.location = "<?= base_url() ?>KYC/Collection_report";

  });
</script>