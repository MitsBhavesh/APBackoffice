<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script><table id="datatable1" class="table table-bordered dt-responsive w-100" style="display: none;">
     <thead>
        <tr>
           <th>Exchange Code</th>
           <th>Client Code</th>
           <th>Amount</th>
           <th>PAY</th>
        </tr>
     </thead>
     <tbody>
     
            <?php if(!empty($data_table)){
              // print_r($data_table);exit();        
         ?>
            <tr>
               <td><?php echo $data_table[0];?></td>
               <td><?php echo $data_table[1];?></td>
               <td><?php echo $data_table[2];?></td>
               <td><?php echo $data_table[3];?></td>
             
            </tr>
              <?php if(!empty($data_table[5])){?>
                <tr>
                <td><?php echo $data_table[4];?></td>
               <td><?php echo $data_table[5];?></td>
               <td><?php echo $data_table[6];?></td>
               <td><?php echo $data_table[7];?></td>
              
              </tr>
              <?php
               }
              ?>
               <?php if(!empty($data_table[9])){?>
                <tr>
                <td><?php echo $data_table[8];?></td>
               <td><?php echo $data_table[9];?></td>
               <td><?php echo $data_table[10];?></td>
               <td><?php echo $data_table[11];?></td>
               <td><?php echo $data_table[12];?></td>
               </tr>
               <?php
               }
              ?>

      <?php 
         
        } 
         ?>
      
     </tbody>
  </table>


<script type="text/javascript">
  $(document).ready(function(){

    $("#datatable1").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "payment_export",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
  window.location = "<?= base_url() ?>Accounts/payment_request_wallet";

  });
</script>
