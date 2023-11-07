<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IPO extends CI_Controller{

    public function index()
    {
    	if(!isset($_SESSION['APBackOffice_user_code']))
		{

			redirect(base_url('APBackOffice'));

		}
		else
		{

		$this->load->view('User/header.php');
		$this->load->view('User/IPO/online_ipo.php');
		$this->load->view('User/footer.php');
		}
    }
    public function online()
    {
    	if(!isset($_SESSION['APBackOffice_user_code']))
		{

			redirect(base_url('APBackOffice'));

		}
		else
		{
			$KYC_db = $this->load->database('AP_No_Of_Client', TRUE);
            unset($_SESSION['AP_Online_ipo_list_api']);
            // echo $_SESSION['APBackOffice_IPO_TOKEN'];
            // exit();
                // {
            clearstatcache();
            //******************************* start Get Login Token in UAT Platform *******************************//

            if(!isset($_SESSION['AP_Online_ipo_list_api']))
            {
                if(!isset($_SESSION['APBackOffice_IPO_TOKEN']))
                {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/login',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => 'gzip',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS =>'{
                            "member": "14275",
                            "loginId": "AIPO",
                            "password": "Arham@123456"
                        }',
                          CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json'),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                        $response = curl_exec($curl);

                    $res = json_decode($response);
                    // if(isset($res->token))
                    // {
                    //     echo $res->token;
                    //     exit();
                    // }
                    // exit();
                    
                    
                    $branch_code=$_SESSION['APBackOffice_user_code'];

                    date_default_timezone_set('Asia/Kolkata');
                    $myfile2 = fopen("accessTokenIPO.txt", "a") or die("Unable to open file!");
                    $txt2 = "\n".$branch_code."\n".$response."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
                    fwrite($myfile2, $txt2);
                    if(isset($res->token))
                    {
                        $this->session->set_userdata('APBackOffice_IPO_TOKEN',rtrim($res->token)); 
                    }
                    else
                    {
                        unset($_SESSION['APBackOffice_IPO_TOKEN']);  
                    }
                }
                else
                {
                     // echo "dgd";
                     //    exit();
                }
              
                if(isset($_SESSION['APBackOffice_IPO_TOKEN']))
                {
                    // echo $_SESSION['APBackOffice_IPO_TOKEN'];
                    $token = $_SESSION['APBackOffice_IPO_TOKEN'];
                    // print_r($token);exit();
                    //******************************* End Get Login Token in UAT Platform *******************************//

                    //******************************* Start Get IPO Master *******************************//
                    // 'https://www.eipouat.com/eipo/v1/ipomaster';
                    $header_data = array('Content-Type: application/json','Access-Token: '.$token);
                    // print_r($header_data);
                    // exit();
                    // $curl = curl_init();
                    // curl_setopt_array($curl, array(
                    //    CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/ipomaster',
                    //    CURLOPT_RETURNTRANSFER => true,
                    //    CURLOPT_TIMEOUT => 0,
                    //    CURLOPT_CUSTOMREQUEST => 'GET',
                    //    CURLOPT_HTTPHEADER => $header_data,
                    // ));


                    // $response = curl_exec($curl);

                    // curl_close($curl);

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/ipomaster',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                      CURLOPT_HTTPHEADER => $header_data,
                    ));
                    // echo "<pre>";
                    // print_r($curl);
                    // exit();

                    $response = curl_exec($curl);

                    curl_close($curl);

                    

                    $res_ipo_list = json_decode($response,true);

                    if(empty($res_ipo_list))
                    {
                        unset($_SESSION['APBackOffice_IPO_TOKEN']);  
                    }

                   
                    // exit();
                    $branch_code=$_SESSION['APBackOffice_user_code'];
                    date_default_timezone_set('Asia/Kolkata');
                    $myfile2 = fopen("accessTokenIPO_LIST.txt", "a") or die("Unable to open file!");
                    $txt2 = "\n".$branch_code."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
                    fwrite($myfile2, $txt2);
                }
                else
                {
                  $res_ipo_list = array();                
                }
              // echo "<pre>";
               // print_r($res_ipo_list);exit();
                //******************************* End Get IPO Master *******************************//

               $_SESSION['AP_Online_ipo_list_api'] = $res_ipo_list;
            }
            else
            {
               $res_ipo_list = $_SESSION['AP_Online_ipo_list_api'];
            }
        

               // IPO
               $sql = "Exec Proc_IPO_SearchIPO";
               $result = $KYC_db->query($sql);
               $ipo_data = $result->result_array();

			$this->load->view('User/header.php');
			$this->load->view('User/IPO/online_ipo.php',["ipo_data"=>$ipo_data,"res_ipo_list"=>$res_ipo_list]);
			$this->load->view('User/footer.php');
		}
    }
    public function Physical()
    {
    	if(!isset($_SESSION['APBackOffice_user_code']))
		{

			redirect(base_url('APBackOffice'));

		}
		else
		{
            //  ****************************************** IPO DATA ********************************************//
                    $KYC_db = $this->load->database('AP_No_Of_Client', TRUE);
                    unset($_SESSION['AP_Physical_ipo_list_api']);
                    clearstatcache();
                    //******************************* start Get Login Token in UAT Platform *******************************//
                    if(!isset($_SESSION['AP_Physical_ipo_list_api']))
                    {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/login',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => 'gzip',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS =>'{
                            "member": "14275",
                            "loginId": "AIPO",
                            "password": "Arham@123456"
                        }',
                          CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json'),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                        $response = curl_exec($curl);

                    $res = json_decode($response);
                    // print_r($res);
                    // exit();
                    // if(isset($res->token))
                    // {
                    //     echo $res->token;
                    //     exit();
                    // }
                    // exit();
                    
                    
                    $branch_code=$_SESSION['APBackOffice_user_code'];
                    date_default_timezone_set('Asia/Kolkata');
                    $myfile2 = fopen("accessTokenIPO_p.txt", "a") or die("Unable to open file!");
                    $txt2 = "\n".$branch_code."\n".$response."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
                    fwrite($myfile2, $txt2);
                    // exit();

                    if(isset($res->token))
                    {
                        $this->session->set_userdata('APBackOffice_IPO_TOKEN',rtrim($res->token)); 
                    }
                    else
                    {
                        unset($_SESSION['APBackOffice_IPO_TOKEN']);  
                    }

                       // $payload = '{
                       //         "member": "14275",
                       //         "loginId": "AIPO",
                       //         "password": "Arham@123456"
                       //     }';
                       // $header_data = array('Content-Type: application/json');

                       // // IPO Authentication
                       // $curl = curl_init();
                       // curl_setopt_array($curl, array(
                       //   CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/login',
                       //   CURLOPT_RETURNTRANSFER => true,
                       //   CURLOPT_TIMEOUT => 0,
                       //   CURLOPT_CUSTOMREQUEST => 'POST',
                       //   CURLOPT_POSTFIELDS =>$payload,
                       //   CURLOPT_HTTPHEADER => $header_data,
                       // ));
                       //  $response = curl_exec($curl);

                       // curl_close($curl);
                    //     $curl = curl_init();

                    // curl_setopt_array($curl, array(
                    //   CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/login',
                    //   CURLOPT_RETURNTRANSFER => true,
                    //   CURLOPT_ENCODING => '',
                    //   CURLOPT_MAXREDIRS => 10,
                    //   CURLOPT_TIMEOUT => 0,
                    //   CURLOPT_FOLLOWLOCATION => true,
                    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //   CURLOPT_CUSTOMREQUEST => 'POST',
                    //   CURLOPT_POSTFIELDS =>'{
                    //     "member": "14275",
                    //     "loginId": "AIPO",
                    //     "password": "Arham@123456"
                    // }',
                    //   CURLOPT_HTTPHEADER => array(
                    //     'Content-Type: application/json',
                    // ),
                    // ));

                    // $response = curl_exec($curl);
                    //    $res = json_decode($response);
                        // print_r($_SESSION['APBackOffice_IPO_TOKEN']);exit();
                       if(isset($_SESSION['APBackOffice_IPO_TOKEN']))
                       {
                            $token = $_SESSION['APBackOffice_IPO_TOKEN'];
                           // print_r($token);exit();
                           //******************************* End Get Login Token in UAT Platform *******************************//


                           //******************************* Start Get IPO Master *******************************//
                              // 'https://www.eipouat.com/eipo/v1/ipomaster';
                        $header_data = array('Content-Type: application/json','Access-Token: '.$token);

                        $curl = curl_init();
                       curl_setopt_array($curl, array(
                         CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/ipomaster',
                         CURLOPT_RETURNTRANSFER => true,
                         CURLOPT_TIMEOUT => 3,
                         CURLOPT_CUSTOMREQUEST => 'GET',
                         CURLOPT_HTTPHEADER => $header_data,
                       ));


                       $response = curl_exec($curl);

                       curl_close($curl);
                       $res_ipo_list = json_decode($response,true);

                   }
                   else
                   {
                    $res_ipo_list = array();
                   }
                       // print_r($res_ipo_list);exit();
                    //******************************* End Get IPO Master *******************************//

                       $_SESSION['AP_Physical_ipo_list_api'] = $res_ipo_list;
                    }
                    else
                    {
                       $res_ipo_list = $_SESSION['AP_Physical_ipo_list_api'];
                    }

    		$this->load->view('User/header.php');
    		$this->load->view('User/IPO/physical_ipo.php',["res_ipo_list"=>$res_ipo_list]);
    		$this->load->view('User/footer.php');
		}
    }
    public function Read_Data()
    {       
        if(isset($_FILES) && isset($_POST))
        {

            if(!empty($_POST['online_sub_category']))
            {

                $sub_category = $_POST['online_sub_category'];
                $this->load->view('User/PDF/Create_IPO_PDF.php',["sub_category"=>$sub_category]);
            }
            else
            {
                echo "choose category";
            }
            // $this->load->view('PDF/Create_IPO_PDF.php');
        }
        else
        {
            $this->session->set_userdata('APBackOffice_danger_alert',"File not Uploaded.");
            redirect(base_url('IPO'));
        }
    }
    public function Get_data_From_code()
    {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
            // print_r($_POST);
            // exit();
            if(isset($_POST['client_code']))
            {
                $ses_client_code = strtoupper($_POST['client_code']);

                if($ses_client_code=='A2196')
                { 
                    $ses_client_code_new="A2196";
                }
                elseif($ses_client_code=='A1770')
                { 
                    $ses_client_code_new="A1770";
                }
                else
                {
                    $trading_user=$_SESSION['No_of_client_list'];
                    $ses_client_code_new=0;
                    foreach ($trading_user as $codes) 
                    {

                        if (in_array($ses_client_code, $codes, TRUE)){

                            $ses_client_code_new=$codes['TRADING_CLIENT_ID'];
                        }
                    }
                    if($ses_client_code_new=="0"){
                        echo "0";
                    }
                }

                $api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientList/ClientList?&CLIENT_ID=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=2022";
                // echo $api_url;
                // exit();
                $model = $this->load->model("Api_model");
                $result = $this->Api_model->api_data_get($api_url);
                $arr=json_decode($result);

                if(!empty($arr))
                {
                    $Client_master_data = $arr[0];
                    $i = 0;
                    $status = 'N0';

                    foreach ($Client_master_data as $key => $value) 
                    {
                        $farray[$i] = $value;
                        $i++;
                    }
                    if(empty($farray[1])){

                        echo "0";

                    }else{
                        $Boid=$farray[1][0][583];
                        $PAN=$farray[1][0][189];
                        $CLIENT_NAME=$farray[1][0][206];
                        $mobile=$farray[1][0][200];
                        $email=$farray[1][0][178];


                        $data='{"Boid":"'.$Boid.'","PAN":"'.$PAN.'","CLIENT_NAME":"'.$CLIENT_NAME.'","mobile":"'.$mobile.'","email":"'.$email.'"}';
                        echo json_encode(json_decode($data, true));
                    }
                }
            }
    
        }

    }

        //Online IPO
   public function online_ipo()
   {
        // https://eipo.nseindia.com/eipo/v1/logout live credential
   	// echo "We are Working Now!!Thank You..";
   	// exit();
   	if(isset($_SESSION['APBackOffice_user_code']))
	{
        $token=$_SESSION['APBackOffice_IPO_TOKEN'];
        date_default_timezone_set("Asia/Kolkata"); 
        // echo date('d-m-Y H:i:s');
        // exit();
        // print_r($_POST);
        // exit();
        //   // $payload = '{
          //              "member": "14275",
          //              "loginId": "AIPO",
          //              "password": "Arham@123456"
          //             }';
          //  $header_data = array('Content-Type: application/json');

          // // IPO Authentication
          // $curl = curl_init();
          // curl_setopt_array($curl, array(
          //   CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/login',
          //   CURLOPT_RETURNTRANSFER => true,
          //   CURLOPT_TIMEOUT => 0,
          //   CURLOPT_CUSTOMREQUEST => 'POST',
          //   CURLOPT_POSTFIELDS =>$payload,
          //   CURLOPT_HTTPHEADER => $header_data,
          // ));
          //  $response = curl_exec($curl);

          // curl_close($curl);
          // $res = json_decode($response);
        // $curl = curl_init();

        //             curl_setopt_array($curl, array(
        //               CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/login',
        //               CURLOPT_RETURNTRANSFER => true,
        //               CURLOPT_ENCODING => '',
        //               CURLOPT_MAXREDIRS => 10,
        //               CURLOPT_TIMEOUT => 0,
        //               CURLOPT_FOLLOWLOCATION => true,
        //               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //               CURLOPT_CUSTOMREQUEST => 'POST',
        //               CURLOPT_POSTFIELDS =>'{
        //                 "member": "14275",
        //                 "loginId": "AIPO",
        //                 "password": "Arham@123456"
        //             }',
        //               CURLOPT_HTTPHEADER => array(
        //                 'Content-Type: application/json'),
        //             ));

        //             $response = curl_exec($curl);
        //             $res = json_decode($response);
        //             $token = $res->token;

        //             $branch_code=$_SESSION['APBackOffice_user_code'];
        //             date_default_timezone_set('Asia/Kolkata');
        //             $myfile2 = fopen("accessTokenIPO_BIDDING_LIST.txt", "a") or die("Unable to open file!");
        //             $txt2 = "\n".$branch_code."\n".$token."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
        //             fwrite($myfile2, $txt2);
          // print_r($token);exit();

        // ******************************* End Get Login Token in UAT Platform *******************************//
         
        //  ******************************* start Transaction API under UAT *******************************//
        if(isset($_POST['edit_btn']))
        {

          //Database Connection to get Application Number

           $KYC_db = $this->load->database('AP_No_Of_Client', TRUE);
          $apllication_no = $_POST['online_ipo'];
          $sql = "exec Proc_IPO_NSEApplicationnumber '$apllication_no'";

         $applicationno_result = $KYC_db->query($sql)->result_array();
         $application_no = str_replace("'", "", $applicationno_result[0]['AppNo']); 

         // Policy Holder 
         if($_POST['online_sub_category'] == 'POL')
          {
               $sql_pol = "exec Proc_IPO_NSEApplicationnumber_Policy '$apllication_no'";
               $applicationno_result = $KYC_db->query($sql_pol)->result_array();
               $application_no = str_replace("'", "", $applicationno_result[0]['AppNo']); 
               // print_r($application_no);
               // exit;
          }
          
        //  print_r($application_no);
        // die();
         
          $date_t = date('d-m-Y H:i:s');
          // print_r($date_t);exit();
          $ipo_symbol = $_POST['online_ipo'];
          $clientName = $_POST['online_name'];
          $clientBenId = $_POST['online_cdsl_Amount'];
          $pan_no = $_POST['online_pan'];
          $bank_upi = $_POST['online_bnk_upi'];
          $quantity = $_POST['online_qty'];
          $price = $_POST['online_price'];
          $amount = $_POST['online_Amount'];
          $email = $_POST['online_email'];
          $mobile_no = $_POST['online_mob_no'];
          $sub_category = $_POST['online_sub_category'];
          $ref_no=rand();
//         $json ='{
//     "symbol": "EMSLIMITED",
//     "applicationNumber": "72223009",
//     "clientName": "AXAY SUMANBHAI PATEL",
//     "upiPaymentStatusFlag": 31,
//     "chequeNumber": "",
//     "referenceNumber": "1643562895",
//     "dpVerStatusFlag": "S",
//     "subBrokerCode": "",
//     "depository": "CDSL",
//     "pan": "ELVPP7214K",
//     "ifsc": "01",
//     "timestamp": "11-09-2023 13:24:53",
//     "bankAccount": "",
//     "bankCode": "",
//     "dpVerReason": "",
//     "dpId": "",
//     "upi": "ap44556677-2@oksbi",
//     "upiAmtBlocked": null,
//     "bids": [
//         {
//             "atCutOff": false,
//             "amount": 14770.0,
//             "quantity": 70,
//             "bidReferenceNumber": 2023091100230802,
//             "series": "",
//             "price": 211.0,
//             "remark": "",
//             "activityType": "new",
//             "status": "success"
//         },
//         {
//             "atCutOff": false,
//             "amount": 14770.0,
//             "quantity": 70,
//             "bidReferenceNumber": 2023091100207658,
//             "series": "",
//             "price": 211.0,
//             "remark": "",
//             "activityType": "new",
//             "status": "success"
//         },
//         {
//             "atCutOff": false,
//             "amount": 14770.0,
//             "quantity": 70,
//             "bidReferenceNumber": 2023091100226250,
//             "series": "",
//             "price": 211.0,
//             "remark": "",
//             "activityType": "new",
//             "status": "success"
//         }
//     ],
//     "allotmentMode": "demat",
//     "dpVerFailCode": "",
//     "nonASBA": false,
//     "upiFlag": "Y",
//     "category": "IND",
//     "locationCode": "",
//     "clientBenId": "1207170000213372",
//     "status": "success"
// }';
// $raa=json_decode($json);
// print_r($raa->applicationNumber);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/transactions/add',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "symbol": "'.$ipo_symbol.'",
    "applicationNumber": "'.$application_no.'",
    "category": "'.$sub_category.'",
    "clientName": "'.$clientName.'",
    "depository": "CDSL",
    "dpId": "",
    "clientBenId": "'.$clientBenId.'",
    "nonASBA": "false",
    "pan": "'.$pan_no.'",
    "referenceNumber": "'.$ref_no.'",
    "allotmentMode": "demat",
    "upiFlag": "Y",
    "upi": "'.$bank_upi.'",
    "bankCode": "null",
    "locationCode": "null",
    "timestamp": "'.$date_t.'",
    "bids": [
        {
            "activityType": "new",
            "quantity": "'.$quantity.'",
            "atCutOff": "false",
            "price": "'.str_replace(".00", "",str_replace(",", "", $price)).'",
            "amount": "'.str_replace(".00", "",str_replace(",", "", $amount)).'"
        }
    ]
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Access-Token: '.$token.''),
));

$response = curl_exec($curl);

curl_close($curl);



//               $curl = curl_init();

//               curl_setopt_array($curl, array(
//                 CURLOPT_URL => 'https://eipo.nseindia.com/eipo/v1/transactions/add',
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => 'gzip',
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => 'POST',
//                 CURLOPT_POSTFIELDS =>'{
//                                   "symbol": "'.$ipo_symbol.'",
//                                   "applicationNumber": "'.$application_no.'",
//                                   "category": "'.$sub_category.'",
//                                   "clientName": "'.$clientName.'",
//                                   "depository": "CDSL",
//                                   "dpId":"",
//                                   "clientBenId": "'.$clientBenId.'",
//                                   "nonASBA": "false",
//                                   "pan": "'.$pan_no.'",
//                                   "referenceNumber": "'.$ref_no.'",
//                                   "allotmentMode": "demat",
//                                   "upiFlag": "Y",
//                                   "upi": "'.$bank_upi.'",
//                                   "bankCode": "null",
//                                   "locationCode" : "null",
//                                   "timestamp" : "'.$date_t.'",
//                                   "bids": [
//                                               {
//                                                   "activityType" : "new",
//                                                   "quantity": "'.$quantity.'",
//                                                   "atCutOff": "false",
//                                                   "price": "'.str_replace(".00", "",str_replace(",", "", $price)).'",
//                                                   "amount": "'.str_replace(".00", "",str_replace(",", "", $amount)).'"
//                                               }
//                                           ]

//                               }
//               ',
//                 CURLOPT_HTTPHEADER => array(
//                   'Content-Type: application/json',
//                   'Access-Token: '.$token.''),
//               ));
//               // $i++;
//               $response = curl_exec($curl);

//               curl_close($curl);
              // echo $response;
              // exit();
              // echo "<br>";
              // print_r($rec_no);
              // exit();

          $dec_response = json_decode($response,true);
          // echo "<pre>";
          // print_r($dec_response);exit();
          // echo "<br>";
          if(!isset($dec_response['applicationNumber']))
          {
            $this->session->set_userdata('Arham_danger_alert',"Application Number not found !");
            redirect(base_url('IPO/online'));
          } 

          $application_no = $dec_response['applicationNumber'];
          // print_r($application_no);
          // echo "<br>";        
          $bidref_no = $dec_response['bids'][0]['bidReferenceNumber'];
          // print_r($bidref_no);
          
          //Insert Record in database
          $scrip_symbol = $dec_response['symbol'];
          $application_no = $dec_response['applicationNumber'];
          $client_name = $dec_response['clientName'];
          $cheque_no = $dec_response['chequeNumber'];
          $referenceno = $dec_response['referenceNumber'];
          $dpverstatusflag = $dec_response['dpVerStatusFlag'];
          $subbrokercode = $dec_response['subBrokerCode'];
          $depository = $dec_response['depository'];
          $panno = $dec_response['pan'];
          $ifsccode = $dec_response['ifsc'];
          $timestamp = $dec_response['timestamp'];
          $bank_account = $dec_response['bankAccount'];
          $bank_code = $dec_response['bankCode'];
          $dpver_reason = $dec_response['dpVerReason'];
          $dpid = $dec_response['dpId'];
          $upiid = $dec_response['upi'];
          $upi_amount_blocked = $dec_response['upiAmtBlocked'];
          $bid_atcuttoff = $dec_response['bids'][0]['atCutOff'];
          $bid_amount = $dec_response['bids'][0]['amount'];
          $bid_quantity = $dec_response['bids'][0]['quantity'];
          $bid_ref_no = $dec_response['bids'][0]['bidReferenceNumber'];
          $bid_series = $dec_response['bids'][0]['series'];
          $bid_price = $dec_response['bids'][0]['price'];
          $bid_activity_type = $dec_response['bids'][0]['activityType'];
          $bid_status = $dec_response['bids'][0]['status'];
          $allotment_mode = $dec_response['allotmentMode'];
          $dp_verfailcode = $dec_response['dpVerFailCode'];
          $nonASBA  = $dec_response['nonASBA'];
          $upi_flag  = $dec_response['upiFlag'];
          $category = $dec_response['category'];
          $location_code = $dec_response['locationCode'];
          $clientbenid = $dec_response['clientBenId'];
          $status = $dec_response['status']; 
          $client_ip_address =$this->input->ip_address(); 

          $KYC_db = $this->load->database('AP_No_Of_Client', TRUE);
  
        $ipo_sql = "Exec Proc_IPO_NSEOrderInsert '$scrip_symbol','".str_replace("'", "", $application_no)."','$client_name','$cheque_no','$referenceno','$dpverstatusflag','$subbrokercode','$depository','$panno','$ifsccode','$timestamp','$bank_account','$bank_code','$dpver_reason','$dpid','$upiid','$upi_amount_blocked','$bid_atcuttoff','$bid_amount','$bid_quantity','$bid_ref_no','$bid_series','$bid_price','$bid_activity_type','$bid_status','$allotment_mode','$dp_verfailcode','$nonASBA','$upi_flag','$category','$location_code','$clientbenid','$status','$client_ip_address','$email','$mobile_no'";
        // print_r($dec_response);exit();
        $ipo_result = $KYC_db->query($ipo_sql)->result_array();
        $ipo_bid_response = $response."\n";
          $ipo_bid_response_file_path = "E:/AP_IPO_Master_Data/".date('d-m-Y').".txt";
          file_put_contents($ipo_bid_response_file_path, $ipo_bid_response.PHP_EOL , FILE_APPEND | LOCK_EX);
        // print_r($ipo_result);
        // die();
           // exit();

// $dec_response="work";
//           $this->load->view('User/IPO/ipo_response.php',['dec_response'=>$dec_response]);
          $this->load->view('User/IPO/ipo_response.php',['dec_response'=>$dec_response,'application_no'=>$application_no,'bidref_no'=>$bidref_no]);
          
          

        }
    }//******************************* End Transaction API under UAT *******************************// 
   }
    // Get Ipo Data Online

      public function get_ipo_list_quantity()
      {
         if(isset($_SESSION['APBackOffice_user_code']))
         {
           
            $symbol = $_POST['symbol'];
            $res_ipo_list = $_SESSION['AP_Online_ipo_list_api'];
            $res_ipo_list = $res_ipo_list['data'];
            
            $i = 0;
            foreach ($res_ipo_list as $ipo_list) 
            {
               // echo "<pre>";
               // print_r($ipo_list->minBidQuantity);
               // echo "<br>";
               // foreach ($ipo_list as $value) {
                  if($ipo_list['symbol'] == $symbol)
                  {
                     $quantity = $ipo_list['minBidQuantity']; 
                     $price_ipo = $ipo_list['maxPrice'] * $quantity;
                     $qty = 0;
                     $p_i = 0;
                     // $price_t = $price_ipo;
                // print_r($price_ipo);
                     while ($price_ipo < 200000) {
                        
                        if ($price_ipo < 200000) {
                           $qty = $qty + $ipo_list['minBidQuantity']; 
                           $p_i = $ipo_list['maxPrice'] * $quantity;
                           print_r("<option>".$qty."</option>");
                        }
                        $quantity = $quantity + $ipo_list['minBidQuantity']; 
                        $price_ipo = $ipo_list['maxPrice'] * $quantity;
                        // $price_t += $price_ipo; 
                     }
                     // print_r($p_i);
                  }
               // }
            }
         }
      }
      public function Ipo_Qty()
    {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
            $symbol = $_POST['off_ipo'];
            // $symbol = 'EUROBOND';
            $res_ipo_list = $_SESSION['AP_Physical_ipo_list_api'];
            $res_ipo_list = $res_ipo_list['data'];
            $i = 0;
            foreach ($res_ipo_list as $ipo_list) {
                if($ipo_list['symbol'] == $symbol)
                {
                    $quantity = $ipo_list['minBidQuantity']; 
                    $price_ipo = $ipo_list['maxPrice'] * $quantity;
                    $qty = 0;
                    $p_i = 0;
                     // $price_t = $price_ipo;
                    // print_r($price_ipo);
                    while ($price_ipo < 200000)
                    {
                        if ($price_ipo < 200000)
                        {
                           $qty = $qty + $ipo_list['minBidQuantity']; 
                           $p_i = $ipo_list['maxPrice'] * $quantity;
                           print_r("<option>".$qty."</option>");
                        }
                        $quantity = $quantity + $ipo_list['minBidQuantity']; 
                        $price_ipo = $ipo_list['maxPrice'] * $quantity;
                        // $price_t += $price_ipo; 
                    }
                }
            }
        }
        else
        {
            redirect(base_url('IPO'));
        }
    }
      // Offline Ipo_Price
    public function Ipo_Price()
    {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
            $symbol = $_POST['off_ipo'];
            $res_ipo_list = $_SESSION['AP_Physical_ipo_list_api'];
            $res_ipo_list = $res_ipo_list['data'];
            $i = 0;
            foreach ($res_ipo_list as $ipo_list) 
            {
               // echo "<pre>";
               // print_r($ipo_list->minBidQuantity);
               // echo "<br>";
               // foreach ($ipo_list as $value) {
                  if($ipo_list['symbol'] == $symbol)
                  {
                     print_r(str_replace(",", "",number_format($ipo_list['maxPrice'],2))); 
                     // print_r($p_i);
                  }
            }
        }
        else
        {
            redirect(base_url('IPO'));
        }
    }

      // Get Ipo Data Online

      public function get_ipo_list_bidprice()
      {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
            // print_r("asd");
            // exit();
            $symbol = $_POST['symbol'];
            $res_ipo_list = $_SESSION['AP_Online_ipo_list_api'];
            $res_ipo_list = $res_ipo_list['data'];
            
            $i = 0;
            foreach ($res_ipo_list as $ipo_list)
            {
               // echo "<pre>";
               // print_r($ipo_list->minBidQuantity);
               
                  if($ipo_list['symbol'] == $symbol)
                  {
                     $cutOffPrice = number_format($ipo_list['cutOffPrice'],2); 
                     $minPrice = number_format($ipo_list['minPrice'],2); 
                     $maxPrice = number_format($ipo_list['maxPrice'],2); 

                     $jsondata = '{"cutOffPrice":'.str_replace(",", "", $cutOffPrice).',"minPrice":'.str_replace(",", "", $minPrice).',"maxPrice":'.str_replace(",", "", $maxPrice).'}';
                     print_r($jsondata);
                  }
            }

        }
        else
        {
            redirect(base_url('IPO'));
        }

      }
      public function abc_test()
    {
        echo "<script>alert('Invalid Client List Data not Found OR CSV File Invalid!.');</script>";
        echo "<script>window.location = '".base_url('IPO/Physical')."'</script>";
    }
    public function Tracking()
    {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
            if (isset($_POST['btn_submit'])) 
            {
                $client_code=strtoupper($_POST['client_code']);

                 $api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=2022"; 

                    $model = $this->load->model("Api_model");
                    $result_client_master= $this->Api_model->api_data_get($api_url_client_master);

                    $arr_client_master = json_decode($result_client_master);
                    if(!empty($arr_client_master))
                    {
                        $Client_master_data_api = $arr_client_master[0];
                        $j = 0;
            
                        foreach ($Client_master_data_api as $key => $value_master) 
                        {
                            $farray_master[$j] = $value_master;
                            $j++;
                        }
                    }
                    else
                    {
                        $this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
                        unset($_SESSION['APBackOffice_Ipo_application_number']);
                        unset($_SESSION['APBackOffice_Ipo_client_name']);
                        unset($_SESSION['APBackOffice_Ipo_boid']);
                        unset($_SESSION['APBackOffice_Ipo_symbol']);
                        unset($_SESSION['APBackOffice_Ipo_BID_STATUS']);
                        redirect(base_url('IPO/Tracking'));
                    }
                    // echo "<pre>";
                    // print_r($farray_master);
                    // exit();
                    $master_back_data=$farray_master[1];
                    $boid=$master_back_data[0][4];
                    $client_code=$master_back_data[0][9];
                    $client_name=$master_back_data[0][10];


                    $application_no="12345678";
                    
                    if(empty($master_back_data))
                    {
                        $this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
                        unset($_SESSION['APBackOffice_Ipo_application_number']);
                        unset($_SESSION['APBackOffice_Ipo_client_name']);
                        unset($_SESSION['APBackOffice_Ipo_boid']);
                        unset($_SESSION['APBackOffice_Ipo_symbol']);
                        unset($_SESSION['APBackOffice_Ipo_BID_STATUS']);
                        redirect(base_url('IPO/Tracking'));
                    }
                    else
                    { 
                        $AP_No_Of_Client = $this->load->database('AP_No_Of_Client',TRUE);
                        $sql_tracking="exec PROC_NSEIPO_Tracking '$boid'";
                        $result_tracking = $AP_No_Of_Client->query($sql_tracking)->result_array();
                        // echo "<pre>";
                        // print_r($result_tracking);
                        // exit();

                        if(empty($result_tracking))
                        {
                            $this->session->set_userdata('APBackOffice_danger_alert',"Not Found!");
                            redirect(base_url('IPO/Tracking'));
                        }
                        else
                        {

                            $this->load->view('User/header.php');
                            $this->load->view('User/IPO/ipo_tracking.php',['result_tracking'=>$result_tracking]);
                            $this->load->view('User/footer.php');
                        }
                    }
            }
            else
            {
                unset($_SESSION['APBackOffice_Ipo_application_number']);
                unset($_SESSION['APBackOffice_Ipo_client_name']);
                unset($_SESSION['APBackOffice_Ipo_boid']);
                unset($_SESSION['APBackOffice_Ipo_symbol']);
                unset($_SESSION['APBackOffice_Ipo_BID_STATUS']);
                $this->load->view('User/header.php');
                $this->load->view('User/IPO/ipo_tracking.php');
                $this->load->view('User/footer.php');
            }
        }
        else
        {
            redirect(base_url('IPO'));
        }  
    }
    // HNI_QTY_SERIES
    public function HNI_QTY_SERIES()
    {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
            if(isset($_POST['sub_cat']) && isset($_POST['off_ipo']))
            {
                $symbol_ipo = $_POST['off_ipo'];
                $path = '//192.168.102.100\e\usermanagement\IPO_PDF\HNI_SERIES/'.$symbol_ipo.'_IPO_SERIES.txt';

                if(!file_exists($path))
                {
                    echo "Invalid";
                    exit;
                    // $this->session->set_userdata('Arham_user_danger_alert',"Upload HNI Series.");
                    // redirect(base_url('HelpDesk/IPOBulk_PDF'));
                }

                $get_txt_data = file_get_contents($path); 

                $hni_data = explode(',',$get_txt_data);
                if(!empty($hni_data))
                {
                    foreach ($hni_data as $value)
                    {
                        // print_r($get_txt_data);
                        print_r("<option>".$value."</option>");
                    }
                }
            }
            else
            {
                echo "Invalid";
                exit;
                // $this->session->set_userdata('Arham_user_danger_alert',"Choose IPO OR HNI Category.");
                // redirect(base_url('HelpDesk/IPOBulk_PDF'));
            }
        }
        else
        {
            echo "Invalid";
            exit;
            // redirect(base_url('HelpDesk/IPOBulk_PDF'));
        }
    }
}
