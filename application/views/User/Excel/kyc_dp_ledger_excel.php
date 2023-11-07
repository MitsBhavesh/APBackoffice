<?php
// if(isset($_SESSION['APBackOffice_DP_Ledger_data']))
// {
//    $columns=$_SESSION['APBackOffice_DP_Ledger_data'][0];
//    $back_data=$_SESSION['APBackOffice_DP_Ledger_data'][1];
//    // echo "<pre>";
//    // print_r($_SESSION['APBackOffice_client_Trading_data']);exit();

// }

include("check_number_convert_kyc.php");
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>
<table id="datatable_dpledger" class="table table-bordered width=device-width, initial-scale=1" style="display: none;">
 <thead>
      <tr>
       <th><b>Code: <?php if(isset($_SESSION['ApbackOffice_client_code_dpledger_detail'])){echo $_SESSION['ApbackOffice_client_code_dpledger_detail'];}?></b></th>
     </tr>
     <tr>
       <th><b>Name: <?php if(isset($_SESSION['ApbackOffice_client_name_dpledger_detail'])){echo $_SESSION['ApbackOffice_client_name_dpledger_detail'];}?></b></th>  
     </tr>
      <tr>
       <th><b>Statement For Ledger From  <?php echo $excel_dpledger_fromdate." To ".$excel_dpledger_todate;?></b></th>  
      </tr>
      <tr>
         <th>Sr no</th>
         <th>Date</th>
         <th >Voucher</th>
         <th>CDSL No</th>
         <th>Code</th>
         <th>Narration</th>
         <th>Check No</th>
         <th>Receive Date</th>
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
         $i=0;
         $j=1;
         $yestarday_balance = 0;
         foreach ($back_data as $data_row) 
         {
             if($back_data[$i][10] != "" || $back_data[$i][11] != "")
               {
                      $debit = $debit + floatval($back_data[$i][10]);
                      // print_r($debit);
                      // echo "<br>";
                      $credit = $credit + floatval($back_data[$i][11]);
                      // print_r($credit);
         ?> 

      <tr>
         <td><?php echo $j;?></td>
         <td>
            <!-- <?php echo $data_row[5]; //Date?> -->
          <!--   <span style="display: none;">
             <?php
                                  
               if($data_row[12] != "" && $data_row[12]!=" ")
               {
                   echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"Y/m/d"):""; 
               }
               ?>
               </span> -->
               <?php 
               if($data_row[12] != "" && $data_row[12]!=" ")
               {
                   echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"d-m-Y"):""; 
               }
                                    
             ?>
            
         </td>
         <td>
            <!-- <?php echo $data_row[6]; // Voucher?> -->
             <?php 
             if(str_replace(" ", "", $data_row[6]) == "SJ")
             {
              
               echo "Bill";
              
             }
             elseif(str_replace(" ", "", $data_row[6]) == "OP")
             {
                  // $s1=str_replace("J","JV",$data_row[6]);
                  // echo $s1;
               echo "OP";
             }
             else
             {
               echo "JV";
             }
            // Voucher
             ?>
               
         </td>
         <td>
            <!-- <?php echo $data_row[14];//CDSL No?> -->
               <?php
                 $cdsl_no=$data_row[14];
                 $newstring = substr($cdsl_no, 2);
                 echo $newstring;
               ?> 
         </td>
         <td>
            <!-- <?php echo $data_row[6];//Code?> -->
             <?php
             if(str_replace(" ", "", $data_row[6]) == "SJ")
               {
                 
                  echo " ";
                 
               }
               elseif(str_replace(" ", "", $data_row[6]) == "OP")
               {
                     // $s1=str_replace("J","JV",$data_row[6]);
                     // echo $s1;
                  echo "OP";
               }
               else
               {
                  echo "JV";
               }
            ?>  
         </td>
         <td><?php echo $data_row[1];//Narration?></td>
         <td><?php echo $data_row[2]; //Check No?></td>
         <td>
            <!-- <?php echo $data_row[12]; //Receive Date?> -->
            <!--  <span style="display: none;">
             <?php
                                  
               if($data_row[12] != "" && $data_row[12]!=" ")
               {
                   echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"Y/m/d"):""; 
               }
               ?>
               </span> -->
               <?php 
               if($data_row[12] != "" && $data_row[12]!=" ")
               {
                   echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"d-m-Y"):""; 
               }
                                    
             ?>
            
               
         </td>
         <td class="t1 arh_rgt"><?php echo $data_row[10];//Debit?></td>
         <td class="t2 arh_rgt"><?php echo $data_row[11]; //Credit?></td>
         <td class="t3 arh_rgt" value="">
         <?php 

            // print_r($back_data[$i][10]);
            if($back_data[$i][10] == 0 || $back_data[$i][10] == "")
            {
                $yestarday_balance += $back_data[$i][11];
                // $total_balance += $back_data[$i][1];
                echo Ledger_balance($yestarday_balance);
                ?>
                       <!--  <input type="hidden" class="t3t"
                            value="<?php echo $yestarday_balance; ?>"> -->
                        <?php
            // echo Ledger_balance($yestarday_balance);
            }
            else
            {
            
            $yestarday_balance -= $back_data[$i][10];
            // $total_balance += $back_data[$i][2];
            echo Ledger_balance($yestarday_balance);
            ?>
                        <!-- <input type="hidden" class="t3t"
                            value="<?php echo $yestarday_balance; ?>"> -->
                        <?php
            // echo Ledger_balance($yestarday_balance);
            }
            $total_balance += $yestarday_balance;
         ?>
         </td>
         <!-- <td><?php  //Balance?></td> -->
      </tr>
     <?php 
            }//if end
         $i++;
         $j++;
         }//foreech end 
      }//first if end 
      else
      {?>
               <tr>No Data Found</tr>
      <?php
      }
      // echo "just<br>";
      // print_r($total_balance);
      ?>
   </tbody>
      <tr>
         <td style="font-weight: bold;"><?php echo "Ledger Balance"; ?></td>
         <td><?php echo ""; ?></td>
         <td><?php echo ""; ?></td>
         <td><?php echo ""; ?></td>
         <td><?php echo ""; ?></td>
         <td><?php echo ""; ?></td>
         <td><?php echo ""; ?></td>
         <td><?php echo ""; ?></td>
         <td class="arh_rgt" style="font-weight: bold;">
            <?php 
               echo $debit; 
            ?>
         </td>
         <td class="arh_rgt" style="font-weight: bold;">
            <?php 
               echo $credit; 
            ?>
         </td>
         <td class="arh_rgt" style="font-weight: bold;">
            <?php
            if(isset($yestarday_balance))
            { 
                $yestarday_balance = $yestarday_balance <= 0 ? abs($yestarday_balance) : -$yestarday_balance ;
                echo $yestarday_balance;

                // if($yestarday_balance > 0)
                // {
                //   echo "hi";
                // }
                // elseif($yestarday_balance < 0)
                // {
                //    echo "no";
                // }
                // else
                // {
                //    echo "0";
                // }
            }
            else
            {
                echo 0;
            }
            ?>
         </td>
      </tr>
</table>


<!-- <script type="text/javascript">
    window.exportToExcel('datatable_dpledger');
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
        window.location.href = '<?php echo base_url('KYC/dp_ledger');?>';
    }
    function rand() {
        let rand = Math.floor((Math.random().toFixed(2)*100))
        let dateObj = new Date()
        let dateTime = `${dateObj.getHours()}${dateObj.getMinutes()}${dateObj.getSeconds()}`
        return `${dateTime}${rand}`
    }
</script> -->

<script type="text/javascript">
  $(document).ready(function(){
  
    $("#datatable_dpledger").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "cdsl_ledger",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>KYC/dp_ledger";
  
});
</script>