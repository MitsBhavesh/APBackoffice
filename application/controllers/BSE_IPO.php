<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BSE_IPO extends CI_Controller{

	  public function index()
	  {
	  	// print_r($_SESSION['APBackOffice_user_code']); exit;
	    	if(!isset($_SESSION['APBackOffice_user_code']))
			{
				redirect(base_url('APBackOffice'));
			}
			else
			{

				if(!isset($_SESSION['AP_BSE_ipo_api']))
		        {
			        // Login
			       	
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => 'https://ibbs.bseindia.com/ibbsmsgapi/iBBSWebBroadcastApi.svc/v1/login',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>'{
				    	"membercode":"6405",
				    	"loginid":"ARHIPO",
				    	"password":"Ishita@78910",
				    	"ibbsid":"BWX8RMTKP9"
					}',
					  CURLOPT_HTTPHEADER => array(
					    'Content-Type: application/json'
					  ),
					));

					$response = curl_exec($curl);

					curl_close($curl);

					$result = json_decode($response);
					clearstatcache();
					// print_r($result);exit();
					// Script Name 
					// Token get or not && message getor not && message  is valid or not
					// $result->token = 110627410341900;
					// $result->message ='Valid Login';
					if(isset($result->token) && isset($result->message) && $result->message =='Valid Login')
					{
					  $token = $result->token;

						// IPO name and qty and price
					  	$curl = curl_init();
					  	curl_setopt_array($curl, array(
					    CURLOPT_URL => 'https://ibbs.bseindia.com/ibbsmsgapi/iBBSWebBroadcastApi.svc/v1/openissue',
					    CURLOPT_RETURNTRANSFER => true,
					    CURLOPT_ENCODING => '',
					    CURLOPT_MAXREDIRS => 10,
					    CURLOPT_TIMEOUT => 0,
					    CURLOPT_FOLLOWLOCATION => true,
					    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					    CURLOPT_CUSTOMREQUEST => 'GET',
					    CURLOPT_HTTPHEADER => array(
					      'Membercode: 6405',
					      'Login: ARHIPO',
					      'token: '.$token
					    ),
					  ));

					  $response = curl_exec($curl);

					  	curl_close($curl);
					  	
					  	$ipo_detail = json_decode($response);
						// $cat[] = $ipo_data->category;  //object to array
						foreach ($ipo_detail as $ipo_data)
						{
							// asbanonasba (1 = Regular & 2 = SME)
							// && $element->asbanonasba == "1"
						 	if($ipo_data->symbol && $ipo_data->category == "IND" && $ipo_data->issuetype == "BB") 
						 	{
					  			// echo "<pre>";
						 		// print_r($ipo_data);
						 		// $_SESSION['AP_BSE_ipo_api'] = $ipo_data; //Create Session 
						 		if(!isset($_SESSION['AP_BSE_ipo_api']) || !is_array($_SESSION['AP_BSE_ipo_api'])) {
						 			$_SESSION['AP_BSE_ipo_api'] = array();
						 		}
						 		array_push($_SESSION['AP_BSE_ipo_api'], $ipo_data);
						 	}
					    }
					    // print_r($_SESSION['AP_BSE_ipo_api']);
					    // exit();
					}
					else
			        {

			        	// $this->session->set_userdata('Arham_danger_alert',$result->message);
			        	// unset($_SESSION['AP_BSE_ipo_api']);
			        	$ipo_data = array();                
			        }
				}
				else
		        {
		           $ipo_data = $_SESSION['AP_BSE_ipo_api'];
		        }

		        $menu_title_active = "AP_bseipo";

				$this->load->view('User/header.php' ,["menu_title_active"=>$menu_title_active]);
				$this->load->view('User/IPO/bse_ipo.php',["ipo_data"=>$ipo_data]);
				$this->load->view('User/footer.php');
			}
	  }

	  public function BSC_online()
      {
      		if(!isset($_SESSION['APBackOffice_user_code']))
    		{

    			redirect(base_url('APBackOffice'));

    		}
    		else
    		{    			
    			$this->load->view('User/header.php');
				$this->load->view('User/IPO/bse_ipo.php');
				$this->load->view('User/footer.php');
    		}
      }

      public function BSC_online_ipo()
      {

      }

    public function Bse_qty()
    {	
    	// echo "string";
    	if(isset($_SESSION['AP_BSE_ipo_api']))
        {	

        	$json_data = $_SESSION['AP_BSE_ipo_api'];
        	// print_r($json_data);
        	// $json_data = json_decode($_SESSION['AP_BSE_ipo_api']);
        	$IPO_name = $_POST['IPO_name'];
        	$IPO_type = $_POST['IPO_type'];  //asba-nonasba (1 || 2)

        	$i = 0;
            foreach ($json_data as $ipo_list) 
            {            	
                if($ipo_list->symbol == $IPO_name &&  $ipo_list->asbanonasba == $IPO_type)  // asbanonasba (1)
                {
                     $quantity = $ipo_list->minbidqty; 
                     $price_ipo = $ipo_list->cuttoff * $quantity;
                     $qty = 0;
                     $p_i = 0;
                     // echo "<pre>";
               			
                    while ($price_ipo < 500000) 
                    {
                        
                        if($price_ipo < 500000) 
                        {
                           $qty = $qty + $ipo_list->minbidqty; 
                           $p_i = $ipo_list->cuttoff * $quantity;
                           print_r("<option>".$qty."</option>");
                        }
                        $quantity = $quantity + $ipo_list->minbidqty; 
                        $price_ipo = $ipo_list->cuttoff * $quantity;
                        // print_r($quantity); exit;	
                        // $price_t += $price_ipo; 
                    }
                     // print_r($price_ipo);
                }
                // asbanonasba = 2
            }
        }
    }

    public function Bse_price()
    {
    	if(isset($_SESSION['AP_BSE_ipo_api']))
    	{
    		$IPO_name = $_POST['IPO_name'];
    		$json_data = $_SESSION['AP_BSE_ipo_api'];
    		// $json_data = json_decode($_SESSION['AP_BSE_ipo_api']);
                    // print_r($json_data);
    		foreach ($json_data as $ipo_list) 
    		{  
                if($ipo_list->symbol == $IPO_name)
                {
                    $cuttoff = number_format($ipo_list->cuttoff,2); 
                    $floorprice = number_format($ipo_list->floorprice,2); 
                    $ceilingprice = number_format($ipo_list->ceilingprice,2); 

                    // $jsondata ='{"cuttoff":'.str_replace(",", "", $cuttoff).',"floorprice":'.str_replace(",", "", $floorprice).',"ceilingprice":'.str_replace(",", "", $ceilingprice).'}';
                    $myObj = new stdClass();
					$myObj->cuttoff = str_replace(",", "",$cuttoff);
					$myObj->floorprice = str_replace(",", "",$floorprice); //min
					$myObj->ceilingprice = str_replace(",", "",$ceilingprice); //max
					echo json_encode($myObj);
					exit();

                    // echo json_encode($jsondata);
                }
            }
    	}
    }

   	public function BidData()
   	{
   		// print_r($_POST);exit;
   		// print_r($_POST['online_ipo_bse']);exit;
   		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['online_ipo']) && !empty($_POST['online_ipo']))
			{

				$ipo_name = $_POST['online_ipo'];
				$ipo_qty = $_POST['online_qty'];
				$ipo_price = $_POST['online_price'];
				$ipo_amt = $_POST['online_Amount'];
				$cdsl_num = $_POST['online_cdsl_Amount'];
				$ipo_category = $_POST['online_sub_category'];  //category
				$ipo_type = $_POST['ipotype_bse'];  //sme or regular
				$pancard = $_POST['online_pan'];
				$client_name = $_POST['online_name'];
				$client_mob = $_POST['online_mob_no'];
				$client_email = $_POST['online_email'];
				$client_UPI = $_POST['online_bnk_upi'];
				// print_r($client_UPI); exit();

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'https://ibbs.bseindia.com/ibbsmsgapi/iBBSWebBroadcastApi.svc/v1/login',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS =>'{
				    "membercode":"6405",
				    "loginid":"ARHIPO",
				    "password":"Ishita@78910",
				    "ibbsid":"BWX8RMTKP9"
				}',
				  CURLOPT_HTTPHEADER => array(
				    'Content-Type: application/json'
				  ),
				));

				$response_login = curl_exec($curl);
				curl_close($curl);

				$res_login = json_decode($response_login);
				// print_r($res_login); exit;

				if(isset($res_login->token) && isset($res_login->message) && $res_login->message =='Valid Login')
				{
				  	$bidtokn = $res_login->token;
				  	// BID IPO 
				  	$KYC_db = $this->load->database('KYC_db', TRUE);

					$ipo_symbol = $_POST['online_ipo'];  //online bse ipo name
					// print_r($ipo_symbol); exit;
					$sql = "exec Proc_IPO_BSEApplicationnumber '$ipo_symbol'";
					// IPO_AppilicationNo  (TABLE NAME)

					$applicationno_result = $KYC_db->query($sql)->result_array();
					$application_no = str_replace("'", "", $applicationno_result[0]['AppNo']);
					// print_r($application_no); exit();

					// $app_no = rand(100000,999999);
					$ref_no = rand(100000,999999);
					$order_no = rand(100000,999999);
					// print_r($order_no); exit;

					$payload = '{
					  "scripid": "'.$ipo_name.'",
					  "applicationno": "'.$application_no.'",
					  "category": "IND",
					  "applicantname": "'.$client_name.'",
					  "depository": "CDSL",
					  "dpid": "0",
					  "clientbenfid": "'.$cdsl_num.'",
					  "chequereceivedflag": "Y",
					  "chequeamount": "'.$ipo_amt.'",
					  "panno": "'.$pancard.'",
					  "bankname": "8888",
					  "location": "UPIIDL",
					  "accountnumber_upiid": "'.$client_UPI.'",
					  "ifsccode": "",
					  "referenceno": "'.$ref_no.'",
					  "asba_upiid": "1",
					  "bids": [
					    {
					      "bidid": "",
					      "quantity": "'.$ipo_qty.'",
					      "rate": "'.$ipo_price.'",
					      "cuttoffflag": "0",
					      "orderno": "'.$order_no.'",
					      "actioncode": "N"
					    }
					  ]
					}';

					// print_r($payload); exit;
					// exit;

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => 'https://ibbs.bseindia.com/ibbsapi/iBBSAPIService.svc/v1/Ipoorder',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>$payload,
					  CURLOPT_HTTPHEADER => array(
					    'Membercode: 6405',
					    'Login: ARHIPO',
					    'Token:'.$bidtokn,
					    'Content-Type: application/json'
					  ),
					));

					$response = curl_exec($curl);

					// curl_close($curl);

					$this->session->set_userdata('arhamshare_bseipo_response',$response);
					// if(isset($_SESSION['arhamshare_bseipo_response']))
					// {
					// 	file_put_contents('E:/ArhamBackOffice_PDF/BSEIPO_Logs/'.$_SESSION['Arham_User_Session_Data'][9].'_BSEIPO.txt', $_SESSION['arhamshare_bseipo_response'].PHP_EOL , FILE_APPEND | LOCK_EX);
					// }
					
					$bse_response = json_decode($response);
					// echo "<pre>";
					// print_r($bse_response); exit;
					//Insert database
					$scripid = $bse_response->scripid;
					$applicationno = $bse_response->applicationno;
					$category = $bse_response->category;
					$applicantname = $bse_response->applicantname;
					$depository = $bse_response->depository;
					$dpid = $bse_response->dpid;
					$clientbenfid = $bse_response->clientbenfid;
					$chequereceivedflag = $bse_response->chequereceivedflag;
					$chequeamount = $bse_response->chequeamount;
					$panno = $bse_response->panno;
					$bankname = $bse_response->bankname;
					$location = $bse_response->location;
					$accountnumber_upiid = $bse_response->accountnumber_upiid;
					$ifsccode = $bse_response->ifsccode;
					$referenceno = $bse_response->referenceno;
					$asba_upiid = $bse_response->asba_upiid;
					$statuscode = $bse_response->statuscode;
					$statusmessage = $bse_response->statusmessage;

					$bids = $bse_response->bids[0];
					$bidid = $bids->bidid;
					$quantity = $bids->quantity;
					$rate = $bids->rate;
					$cuttoffflag = $bids->cuttoffflag;
					$orderno = $bids->orderno;
					$actioncode = $bids->actioncode;
					$errorcode = $bids->errorcode;
					$message = $bids->message."#".$_SESSION['APBackOffice_user_code'];
					$email = $_POST['online_email'];
					// print_r($email); exit;
					// $email = $_SESSION['APBackOffice_user_code'][15];

					$KYC_db = $this->load->database('KYC_db', TRUE);
					// // IPO_OrderMaster (Table name)

			        $bseipo_sql = "Exec Proc_IPO_OrderInsert '$scripid','$applicationno','$category','$applicantname','$depository','$dpid','$clientbenfid','$chequereceivedflag','$chequeamount','$panno','$bankname','$location','$accountnumber_upiid','$ifsccode','$referenceno','$asba_upiid','$statuscode','$statusmessage' ,'$bidid','$quantity','$rate','$cuttoffflag','$orderno','$actioncode','$errorcode','$message','$email'";
			        $ipo_db_res = $KYC_db->query($bseipo_sql);
			       // print_r($ipo_db_res);
			       //  exit();
			        
			        $ipo_bid_response = $response."\n";
					$ipo_bid_response_file_path = '//192.168.102.100\e\IPO_Master_Data\BSEIPO\AP/'.date('d-m-Y').'.txt';
					 // $path = '//192.168.102.100\e\usermanagement\IPO_PDF\HNI_SERIES/'.$symbol_ipo.'_IPO_SERIES.txt';

					// $ipo_bid_response_file_path = "C:/BSE_IPO/IPO_Master/".date('d-m-Y').".txt";
					file_put_contents($ipo_bid_response_file_path, $ipo_bid_response.PHP_EOL , FILE_APPEND | LOCK_EX);

		        	$this->load->view('User/IPO/bse_ipo_response.php',['bse_response'=>$bse_response,'bidid'=>$bidid,'orderno'=>$orderno]);
				}
				else
				{
					print_r($result->message);exit();
				}
			}
		}
		else
		{
			// echo "byeee";
			redirect(base_url('APBackOffice'));
		}
   	}

   	// public function IPOResp()
   	// {
   	// 	$this->load->view('User/IPO/bse_ipo_response.php');
   	// }

}