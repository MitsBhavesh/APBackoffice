<?php
// echo "<pre>";
// print_r($_SESSION['APBackOffice_client_client_master_data'][1][0][583]);
// print_r($_SESSION['APBackOffice_client_client_master_data'][1][0][4]);
// $_SESSION['APBackOffice_client_client_master_data'][0][583];
// print_r($_POST);
// return;

function encrypt($aesKey, $dataToEncrypt) {
    $output = false;
    $IVbytes = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $output = openssl_encrypt($dataToEncrypt, 'AES-256-CBC', $aesKey,
    OPENSSL_RAW_DATA, $IVbytes);
    $output = base64_encode($output);
    return $output;
}

function decrypt($aesKey, $dataTodecrypt) {
    $output = false;
    $iv = '';
    $dataTodecrypt = base64_decode ($dataTodecrypt);
    $dataTodecrypt = $output = openssl_decrypt($dataTodecrypt, 'AES-256-CBC',
    $aesKey, OPENSSL_RAW_DATA, $iv);
    return $output;
}
date_default_timezone_set("Asia/Kolkata"); 

$date_t=date('dmYHis');//req time

$executiondate=date('dmY');
$Next_year=date('Y', strtotime('+1 year'));//2023
$expirydate="2001".$Next_year;
// echo $expirydate;exit();

$ses_client_code = $_SESSION['APBackOffice_client_client_master_data'][1][0][4];
// $ses_client_code = $_SESSION['Arham_User_Session_Data'][9];
// $pledgorboid=$_SESSION['Arham_User_Session_Data'][4];
$pledgorboid=$_SESSION['APBackOffice_client_client_master_data'][1][0][583];
$prfnumber=rand(10,1000000000);
$pledgorintref =rand(10,1000000000);
$isinreqid = rand(10,1000000000);
$pledgeeboid="1207170000193834";
$clientDetail = $ses_client_code;
$clientDetail = base64_encode($clientDetail);
$created_date=date('d-m-Y H:i:s');
$poa_plgqty=$_POST['avaible_qty'];
$net_qty=$_POST['netqty'];
$margin_qty=$_POST['margin_qty'];
$net_rate=$_POST['net_rate'];
$pledge_reason=$_POST['pledge_reason'];
$client_ip_address =$this->input->ip_address(); 
// print_r($net_rate);return;
// echo "<pre>";
// print_r($poa_plgqty);return;
// $poa_plgqty="";
// $poa_plgqty=implode(" ",$poa_plgqty);
// print_r($poa_plgqty);
// foreach($_POST['avaible_qty'] as $poa_plgqty)
// {
//     print_r($_POST['avaible_qty']);
// }
// exit();



$data = '{"pledgeidentifier": "MP","reqtime": "'.$date_t.'","pledgorboid": "'.$pledgorboid.'","pledgeeboid": "'.$pledgeeboid.'","executiondate": "'.$executiondate.'","expirydate": "'.$expirydate.'","uccid": "'.$ses_client_code.'",    "exid": "12","entityidentifier": "TM","tmid": "14275","remarks": "API CALL","returnurl": "'.base_url().'KYC/MarginPledge_Response?clientDetail='.$clientDetail.'","isindtls": [';



// print_r($data);
// return;

//Insert Request into database
$KYC_db = $this->load->database('AP_No_Of_Client', TRUE);  

//strreplace str_replace(",","","12,345");
if(isset($_POST['isin']))
{
    $cindex = 0;
    foreach($_POST['isin'] as $val_isin)
    {
        

        $data .= (($cindex != 0)?',':'').'{"prfnumber": "'.$prfnumber.'","pledgorintref": "'.$pledgorintref.'","isinreqid": "'.$isinreqid.'","isin": "'.$val_isin.'","quantity": "'.$_POST['select_plgqty'][$cindex].'","value": "'.str_replace(',', '',number_format($_POST['total_pledge_value'][$cindex],2)).'","segmentid": "AL","cmid": "6405","reasoncode": "'.$pledge_reason.'"}';

        // $margin_pledge_sql = "Exec Proc_MarginPledgeDataInsert '$ses_client_code','$created_date','$date_t','$pledgorboid','$pledgeeboid','$executiondate','$prfnumber','$pledgorintref','$isinreqid','$val_isin','".$_POST['isin_name'][$cindex].'||'.$poa_plgqty[$cindex]."','".$_POST['select_plgqty'][$cindex]."','".str_replace(',', '',number_format($_POST['total_pledge_value'][$cindex],2))."','','','','','',''";
        $margin_pledge_sql = "Exec Proc_MarginPledgeDataInsert '$ses_client_code','$created_date','$date_t','$pledgorboid','$pledgeeboid','$executiondate','$prfnumber','$pledgorintref','$isinreqid','$val_isin','".$_POST['isin_name'][$cindex].'||'.$poa_plgqty[$cindex].'||'.$net_qty[$cindex].'||'.$margin_qty[$cindex].'||'.$net_rate[$cindex].'||'.$pledge_reason."','".$_POST['select_plgqty'][$cindex]."','".str_replace(',', '',number_format($_POST['total_pledge_value'][$cindex],2))."','','','','','','','$client_ip_address'";

        // print_r($margin_pledge_sql);return;

        $margin_pledge_result = $KYC_db->query($margin_pledge_sql);
        // print_r($margin_pledge_result);return;
        
        $cindex++;
        $isinreqid++;
        $pledgorintref++;
        $prfnumber++;
        // break;
    }
}

$data .= ']}';


// $data2 = '{"pledgeidentifier": "MP","reqtime": "'.$date_t.'","pledgorboid": "'.$pledgorboid.'","pledgeeboid": "'.$pledgeeboid.'","executiondate": "'.$executiondate.'","expirydate": "'.$expirydate.'","uccid": "'.$ses_client_code.'",    "exid": "12","entityidentifier": "TM","tmid": "14275","remarks": "'.$poa_plgqty.'","returnurl": "'.base_url().'Holdings/MarginPledge_Response?clientDetail='.$clientDetail.'","isindtls": [{"prfnumber": "'.$prfnumber.'","pledgorintref": "'.$pledgorintref.'","isinreqid": "'.$isinreqid.'","isin": "IN0020200427","quantity": "1","value": "4203.13","segmentid": "AL","cmid": "6405"}]}';

// print_r($data);
// echo "<br>";
// echo "<br>";
// print_r($data);
// exit;

$margin_pledge_file_path = "E:/PLEDGE/Pledge_AP/MarginPledge_RequestData/".date('d-m-Y').".txt";
file_put_contents($margin_pledge_file_path, $data.PHP_EOL , FILE_APPEND | LOCK_EX);
// return;
$pledgedtls = encrypt("bscaiudb6mfrr6ymfd5mz88olxgw67ug", $data);
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
     <script>
         function call() {
            //alert("Page is loaded");
                //debugger
                document.getElementById("frmpledge").submit();
                sessionStorage.clear();
                // window.open(url, "_blank");
            } 
    </script>   
    <style type="text/css">
        #pledgedtls {
            width: 148px;
        }
    </style>
</head>
<body onload="call()">
    <form id="frmpledge" runat="server" name="frmpledge" action="https://api.cdslindia.com/APIServices/pledgeapi/pledgesetup" method="post">
    <input type="hidden" id="dpid" name="dpid" value="71700" />
    <input type="hidden" id="reqid" name="reqid" value="<?php echo rand(); ?>" />
    <input type="hidden" id="version" name="version" value="1.0" />
    <input type="hidden" id="pledgedtls" name="pledgedtls" value="<?php echo $pledgedtls; ?>" />
    <!-- <input type="submit" value="Post Request"/> -->
    </form>
</body>
</html>

<!-- 71700 -->