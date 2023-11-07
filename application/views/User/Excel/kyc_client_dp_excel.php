<?php
if(isset($_SESSION['APBackOffice_client_dp_data']))
{
    $result= $_SESSION['APBackOffice_client_dp_data'];

                // echo "<pre>";
                // $value = $result[0];
                // print_r($r);
                // exit();
}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jquery.table2excel.min.js"></script>

<table id="client_dp" class="table table-bordered dt-responsive  nowrap w-100" style="display:none">
<!-- <table id="client_dp" class="table table-bordered width=device-width, initial-scale=1"> -->
   <thead>
      <tr>
         <th>Branch Code</th>
         <th>Trading Client ID</th>
         <th>Boid</th>
         <th>BO Name</th>
         <th>BO Pan No</th>
         <th>BO Account Status</th>
         <th>Bo Sub Status</th>
         <th>Module DESC</th>
         <th>Account Open Date</th>
         <th>Bo-Closour Date</th>
         <th>BO D.O.B</th>
         <th>Bo Add1</th>
         <th>Bo Add2</th>
         <th>Bo Add3</th>
         <th>Bo Add city</th>
         <th>Bo Add State</th>
         <th>Bo Add Country</th>
         <th>Bo Add Pin</th>
         <th>Mobile No</th>
         <th>Emailid</th>
         <th>Bank name</th>
         <th>Bank Acc No</th>
         <th>IFSC</th>
         <th>Micr code</th>
         <th>Second Holder name</th>
         <th>Second Holder Pan</th>
         <th>Third Holder name</th>
         <th>Third Holder Pan</th>
         <th>Poa Name</th>
         <th>Poa Enable</th>
         <th>Nominee Name</th>
         <th>Risk Category</th>
         <th>Guardian Pan No </th>
         <th>Income Range</th>
         
      </tr>
   </thead>
   <tbody>
      <?php
         // $value = $result[0];
         $i = 0;
         if(!empty($result))
         {      
             foreach($result as $key => $value)
             {
         
         
         ?>
      <tr>
         <td><?php echo $result[$i]['BRANCH_CODE']; //BRANCH CODE ?></td>
         <td><?php echo $result[$i]['TRADING_CLIENT_ID']; //TRADING_COCD name ?></td>
         <td><?php echo "'".$result[$i]['BO_ID']; //boid ?></td>
         <td><?php echo $result[$i]['FIRST_HOLD_NAME']; //boname ?></td>
         <td><?php echo $result[$i]['ITPA_NO']; //bo pan no ?></td>
         <td><?php echo $result[$i]['STATUS']; //bo STATUS ?></td>
         <td><?php echo $result[$i]['BO_SUB_STAT']; //BO SUB STAT ?></td>
         <td><?php  //Module Desc ?></td>
         <td><?php  echo $result[$i]['ACC_OPEN_DAT'];//Account Opening Date?></td>
         <td><?php  echo $result[$i]['ACC_CLOSE_DAT'];//Bo Clouser Date?></td>
         <td><?php echo $result[$i]['BO_DOB']; //BO DOB ?></td>
         <td><?php echo $result[$i]['BO_ADD1']; //BO ADD1 ?></td>
         <td><?php echo $result[$i]['BO_ADD2']; //BO ADD2 ?></td>
         <td><?php echo $result[$i]['BO_ADD3']; //BO ADD3 ?></td>
         <td><?php echo $result[$i]['BO_ADD_CITY']; //BO ADD CITY ?></td>
         <td><?php echo $result[$i]['BO_ADD_STATE']; //BO ADD STATE ?></td>
         <td><?php echo $result[$i]['BO_ADD_COUNTRY']; //BO ADD COUNTRY ?></td>
         <td><?php echo $result[$i]['BO_ADD_PIN']; //BO ADD PIN ?></td>
         <td><?php echo $result[$i]['MOBILE_NO']; //MOBILE NO ?></td>
         <td><?php echo $result[$i]['EMAIL_ID']; //EMAIL ID ?></td>
         <td><?php echo $result[$i]['BANK_NAM']; //BANK NAME ?></td>
         <td><?php echo $result[$i]['BANK_ACC_NO']; //BANK ACC NO ?></td>
         <td><?php echo $result[$i]['BEN_BANK_COD']; //BEN_BANK_COD ifsc ?></td>
         <td><?php echo $result[$i]['MICR_CODE']; //MICR CODE ?></td>
         <td><?php echo $result[$i]['SECOND_HOLD_NAM']; //SECOND HOLD NAME ?></td>
         <td><?php echo $result[$i]['PAN_NO_2'];//SECOND HOLD PAN ?></td>
         <td><?php echo $result[$i]['THIRD_HOLD_NAM']; //THIRD HOLD NAM ?></td>
         <td><?php echo $result[$i]['PAN_NO_3'];//THIRD HOLD PAN ?></td>
         <td><?php echo $result[$i]['POA_NAME']; //POA NAME ?></td>
         <td><?php echo $result[$i]['POA_ENABLED']; //POA ENABLED ?></td>
         <td><?php echo $result[$i]['NOMIN_NAM']; //Nominee name ?></td>
         <td><?php echo $result[$i]['Risk_catg']; //Risk catg ?></td>
         <td><?php echo $result[$i]['Guardian_PANNO']; //GUARDIAN PAN NO ?></td>
         <!-- <td><?php echo $result[$i]['INCOM_COD']; //INCOM COD ?></td> -->
         <td>
            <!-- <?php echo $result[$i]['INCOM_COD']; //INCOM COD ?> -->
         <?php
            if(str_replace(" ", "", $result[$i]['INCOM_COD']) == "1")
            {
             
              echo "UPTO RS 1 LAKH";
             
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "2")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "1 LAKHS TO 2 LAKHS";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "3")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "2 LAKHS TO 5 LAKHS";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "4")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "5 LAKHS AND ABOVE";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "5")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "NOT AVAILABLE";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "6")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "1,00,001 TO 5,00,000";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "7")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "5,00,001 TO 10,00,000";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "8")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "10,00,001 TO 25,00,000  ";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "9")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "MORE THEN 25,00,000";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "10")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "25,00,001 TO 1,00,00,000";
            }
            elseif(str_replace(" ", "", $result[$i]['INCOM_COD']) == "10")
            {
                 // $s1=str_replace("J","JV",$data_row[6]);
                 // echo $s1;
              echo "25,00,001 TO 1,00,00,000";
            }
            else
            {
                echo "MORE THAN 1,00,00,000";
            }
        ?> 
        </td>
        
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
  
    $("#client_dp").table2excel({      
      exclude: ".noExl",
      name: "Developer data",
      filename: "client_dp_Details",
      fileext: ".xls",    
      exclude_img: true,
      exclude_links: true,
      exclude_inputs: true      
    }); 
    window.location = "<?= base_url() ?>KYC/dp_detail";
  
});
</script>