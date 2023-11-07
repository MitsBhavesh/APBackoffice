<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KYC extends CI_Controller {

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('APBackOffice'));
		}
		else
		{
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/cdsl_client_detail.php');
			$this->load->view('User/footer.php');
		}
	}
	public function nominee_link_generator()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/nominee_link_generator.php');
			$this->load->view('User/footer.php');
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	public function createlink_pnl()
	{	
		if(isset($_SESSION['APBackOffice_user_code']))
		{		
			if (isset($_POST['Client_code'])) 
			{	
				$ses_client_code_new_text = $_POST['Client_code'];

				///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0")
					{
						echo "00";
						return;
					}
					///////////////////////////Check Code

				$Client_code = bin2hex(base64_encode($ses_client_code_new));

				// $link =  "https://connect.arhamshare.com/Arham_PNL/?client_code=".$Client_code;
				$link =  "https://connect.arhamshare.com/NomineeAddition/?client_code=".$Client_code;

				date_default_timezone_set('Asia/Kolkata');
				$myfile2 = fopen("Nominee_LINK.txt", "a") or die("Unable to open file!");
				$txt2 = "\n".$_SESSION['APBackOffice_user_code']."\n".$ses_client_code_new."\n".$link."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
				fwrite($myfile2, $txt2);

				echo $link;
			}
			else
			{	
				redirect(base_url('Home'));
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function createlink_trading_pref()
	{	
		if(isset($_SESSION['APBackOffice_user_code']))
		{		
			if (isset($_POST['Client_code'])) 
			{	
				$ses_client_code_new_text = $_POST['Client_code'];

				///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0")
					{
						echo "00";
						return;
					}
					///////////////////////////Check Code

				$Client_code = bin2hex(base64_encode($ses_client_code_new));

				// $link =  "https://connect.arhamshare.com/Arham_PNL/?client_code=".$Client_code;
				$link =  "https://connect.arhamshare.com/SegmentVerification";

				date_default_timezone_set('Asia/Kolkata');
				$myfile2 = fopen("Trading_Pref_LINK.txt", "a") or die("Unable to open file!");
				$txt2 = "\n".$_SESSION['APBackOffice_user_code']."\n".$ses_client_code_new."\n".$link."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
				fwrite($myfile2, $txt2);

				echo $link;
			}
			else
			{	
				redirect(base_url('Home'));
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	public function trading_preference()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/trading_preference.php');
			$this->load->view('User/footer.php');
		}
		else
		{	
			redirect(base_url('Home'));
		}
	}
	public function send_mail()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$client_code=strtoupper($_POST['client_code']);
			$link=$_POST['link'];
			$api_url='192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?null=null&ClientCode='.$client_code.'&UrlUserName=techapi&UrlPassword=techapi%40123&UrlDatabase=capsfo&UrlDataYear=2023';

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Cookie: cfid=cc29c2a5-0668-4606-be5b-28e5f21ad197; cftoken=0'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			// echo $response;
			$arr=json_decode($response,true);
			$Email_ID=$arr[0]['DATA'][0][15];


			########################
			$config = Array(
			  	'protocol' => 'smtp',
			  	'smtp_host' => 'us2.smtp.mailhostbox.com',
			  	'smtp_port' => 587,
			  	'smtp_user' => 'donotreply@arhamshare.com', // change it to yours
			  	'smtp_pass' => 'H$#WTyZ0', // change it to yours
			  	'mailtype' => 'html',
			  	'charset' => 'iso-8859-1',
			  	'wordwrap' => TRUE
				);
			$message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'\application\views\template\arh_nominee_mail.php');
			$message = str_replace('{{client_code}}', $client_code, $message);
			$message = str_replace('{{link}}', $link, $message);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('donotreply@arhamshare.com'); // change it to yours
			$this->email->to($Email_ID);// change it to yours
			$this->email->subject('Urgent Action Required: Update "Choice of Nomination" for your Trading and Demat Account');
			$this->email->message($message);
			if($this->email->send())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
			########################
	}
	public function send_mail_trading_pref()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$client_code=strtoupper($_POST['client_code']);
			$link=$_POST['link'];
			$api_url='192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?null=null&ClientCode='.$client_code.'&UrlUserName=techapi&UrlPassword=techapi%40123&UrlDatabase=capsfo&UrlDataYear=2023';

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Cookie: cfid=cc29c2a5-0668-4606-be5b-28e5f21ad197; cftoken=0'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			// echo $response;
			$arr=json_decode($response,true);
			$Email_ID=$arr[0]['DATA'][0][15];


			########################
			$config = Array(
			  	'protocol' => 'smtp',
			  	'smtp_host' => 'us2.smtp.mailhostbox.com',
			  	'smtp_port' => 587,
			  	'smtp_user' => 'donotreply@arhamshare.com', // change it to yours
			  	'smtp_pass' => 'H$#WTyZ0', // change it to yours
			  	'mailtype' => 'html',
			  	'charset' => 'iso-8859-1',
			  	'wordwrap' => TRUE
				);
			$message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'\application\views\template\arh_trading_mail.php');
			$message = str_replace('{{client_code}}', $client_code, $message);
			$message = str_replace('{{link}}', $link, $message);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('donotreply@arhamshare.com'); // change it to yours
			$this->email->to($Email_ID);// change it to yours
			// $this->email->to("ap44556677@gmail.com");// change it to yours
			$this->email->subject('Urgent Action Required: Update Trading Preference');
			$this->email->message($message);
			// print_r($message);exit();
			if($this->email->send())
			{
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
			########################
	}
	public function cdsl_client_detail()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{

			if(isset($_POST['btn_submit'])){

				$f="Client_Master103914.xls";   
		 	
		       	$file = ("D:/$f");
		       	// print_r($file);return;
		       	if(file_exists($file))
		       	{
			        $filetype=filetype($file);

			        $filename=basename($file);

			        header ("Content-Type: ".$filetype);

			        header ("Content-Length: ".filesize($file));

			        // header ("Content-Disposition: attachment; filename=".$filename);
			        header("Content-disposition: attachment; filename=\"".$filename."\""); 

			        readfile($file);
			    }
			}

			$this->load->view('User/header.php');
			$this->load->view('User/KYC/cdsl_client_detail.php');
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	// start code cdsl client holding data
	public function cdsl_client_holding()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['btn_submit']))
			{
				$ses_client_code=strtoupper($_POST["client_code"]);

				// print_r($ses_client_code);exit();

				if(isset($_SESSION['APBackOffice_client_code']))
				{
					unset($_SESSION['APBackOffice_client_code']);
				}
				if(isset($_SESSION['APBackOffice_client_name']))
				{
					unset($_SESSION['APBackOffice_client_name']);
				}
				///////////////////////////Check Code
					// $trading_user=$_SESSION['No_of_client_list'];
					// $ses_client_code_new=0;
					// foreach ($trading_user as $people) {

					// 	if (in_array($ses_client_code, $people, TRUE)){

					// 		$ses_client_code_new=$people['TRADING_CLIENT_ID'];
					// 	}
					// }
					// if($ses_client_code_new=="0"){
					// 	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					// 	unset($_SESSION['APBackOffice_client_Holding_data']);
					// 	redirect(base_url('KYC/cdsl_client_holding'));
					// }
					///////////////////////////Check Code

				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range_ledger($year);
				    $year=$finacial_years['year'];
				    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
				}
				else
				{
				    $year=date("Y");
				    $finacial_years=$this->get_finacial_year_range_ledger($year);
				    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
				}
				//////////////////////////////////// Start get client name /////////////////////////////////// 
				$t_date = date("d/m/Y");
				$api_url_client = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code."&To_date=".$t_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
				// echo $api_url;

	    		$model = $this->load->model("Api_model");
				$result_client = $this->Api_model->api_data_get($api_url_client);

	    		$arr_client = json_decode($result_client);
	    		// echo "<pre>";
				// print_r($arr_client);exit();

				if(!empty($arr_client))
			    {
			    	$Client_master_data = $arr_client[0];
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
					// echo "<pre>";
					// print_r($farray[1][0][10]);
					// EXIT();
					$client_name=$farray[1][0][10];
					$this->session->set_userdata('APBackOffice_client_name',$client_name);
			    }
			    else
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    	redirect(base_url('KYC/cdsl_client_holding'));
			    }
			    // print_r($ses_client_code);
				// exit();
			    //////////////////////////////////// end get client name /////////////////////////////////// 
				
				//////////////////////////////////// Start client holding /////////////////////////////////// 
				$api_url="192.168.102.101:8080/techexcelapi/index.cfm/soh/soh?&Client_id=".$ses_client_code."&Branch_code=&ISIN=&Inputdate=&Bo_id=&Dp_id=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				// echo $api_url;
				// exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

			    $arr = json_decode($result);
			    // echo "<pre>";
			    // print_r($arr);
			    // exit();
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
					$this->session->set_userdata('APBackOffice_client_Holding_data',$farray);
					$this->session->set_userdata('APBackOffice_client_code',$ses_client_code);
			    }
			    else
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    	redirect(base_url('KYC/cdsl_client_holding'));
			    }

			    if(empty($farray[1]))
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
			    	redirect(base_url('KYC/cdsl_client_holding'));
			    }
			    //////////////////////////////////// end client holding ///////////////////////////////////

			}
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/cdsl_client_holding.php');
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	public function cdsl_holding_excel_download()
	{
		// echo "hi";exit();
		if(isset($_SESSION['APBackOffice_client_Holding_data']))
		{
			$this->load->view('User/Excel/kyc_cdsl_holding_excel.php');
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client Code!");
			redirect(base_url('KYC/cdsl_client_holding'));
		}
	}
	// end code cdsl client holding data
	// Start cdsl holding PDF download Code
	public function holding_pdf_download()
	{
		// echo "<pre>";
		// print_r($_SESSION['APBackOffice_client_Holding_data']);exit();
		// exit();
		
		if(isset($_SESSION['APBackOffice_client_Holding_data']))
		{
			$client_code=$_SESSION['APBackOffice_client_code'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range_ledger($year);
			    $year=$finacial_years['year'];
			    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
			    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
			}
			else
			{
			    $year=date("Y");
			    $finacial_years=$this->get_finacial_year_range_ledger($year);
			    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
			    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
			}
			// ######################## Start holding api ###################################
				$kyc_holding_api_url="192.168.102.101:8080/techexcelapi/index.cfm/soh/soh?&Client_id=".$client_code."&Branch_code=&ISIN=&Inputdate=&Bo_id=&Dp_id=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				// echo $api_url;
				// exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($kyc_holding_api_url);

			    $arr = json_decode($result);
			    // echo "<pre>";
			    // print_r($arr);
			    // exit();

			    if(!empty($arr))
				{
				    $Client_master_data = $arr[0];
				    $i = 0;
					
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	
				    	$farray[$i] = $value;
						$i++;
					}
				}
				$Holding_PNL=$farray[1];
				// echo "<pre>";
				// print_r($Holding_PNL);
				// exit();
			// ######################## End holding api #####################################
			// ######################## start get client detail api  ########################
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
			// echo $api_url_client_master;
			// exit();
			$model = $this->load->model("Api_model");
			$result_client_master= $this->Api_model->api_data_get($api_url_client_master);

			$arr_client_master = json_decode($result_client_master);

			// echo "<pre>";
			// print_r($arr_client_master);
			// exit();
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
				// unset($_SESSION['ApbackOffice_client_name_profit_and_loss']);
				// unset($_SESSION['ApbackOffice_client_code_profit_and_loss']);
				// unset($_SESSION['ApbackOffice_client_pan_profit_and_loss']);
			}
			$master_back_data=$farray_master[1];

			$pan=$master_back_data[0][16];
			$client_code=$master_back_data[0][9];
			$client_name=$master_back_data[0][10];
			$data=array($client_code,$client_name,$pan);

			// print_r($data);
			// exit();
			// ######################## start get client detail api ##############################
			$this->load->view('User/PDF/kyc_cdsl_holding_pdf.php',["data"=>$data,'Holding_PNL'=>$Holding_PNL]);
			// $this->load->view('User/PDF/kyc_dp_ledger_pdf.php',["data"=>$data,"kyc_dpledger_fromdate"=>$kyc_dpledger_fromdate,"kyc_dpledger_todate"=>$kyc_dpledger_todate,"DPledger_PNL"=>$DPledger_PNL]);
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client Code!");
			redirect(base_url('KYC/cdsl_client_holding'));
		}
	}
	// End cdsl holding PDF download Code
	// start code cdsl client dp detail
	public function dp_detail()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			
			$recipt_ID= $_SESSION['APBackOffice_user_code'];

			$patment = $this->load->database('AP_No_Of_Client_local',TRUE);		
			$proc="exec Proc_API_APCLIENTGET '$recipt_ID'";
			$result=$patment->query($proc)->result_array();
			if(!empty($result))
			{
				$this->session->set_userdata('APBackOffice_client_dp_data',$result);
			}
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/client_dp_detail.php');
			$this->load->view('User/footer.php');
		}

	}

	public function dp_excel_download()
	{
		$this->load->view('User/Excel/kyc_client_dp_excel.php');
	}


	// end code cdsl client dp detail
	// start code cdsl client trading detail
	public function trading_detail()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['btn_trading']))
			{
				
				$ses_client_code=strtoupper($_POST["client_code"]);
				if(isset($_SESSION['APBackOffice_client_code']))
				{
					unset($_SESSION['APBackOffice_client_code']);
				}
				if(isset($_SESSION['APBackOffice_client_name']))
				{
					unset($_SESSION['APBackOffice_client_name']);
				}

				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range_ledger($year);
				    $year=$finacial_years['year'];
				    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
				}
				else
				{
				    $year=date("Y");
				    $finacial_years=$this->get_finacial_year_range_ledger($year);
				    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
				}
				///////////////////////////Check Code
				$trading_user=$_SESSION['No_of_client_list'];
				$ses_client_code_new=0;
				foreach ($trading_user as $people) {

					if (in_array($ses_client_code, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID'];
					}
				}
				if($ses_client_code_new=="0"){
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					unset($_SESSION['APBackOffice_client_Trading_data']);
					redirect(base_url('KYC/trading_detail'));
				}
				///////////////////////////Check Code
				// Start get client name 
				$t_date = date("d/m/Y");
				$api_url_client = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&To_date=".$t_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
				// echo $api_url;

	    		$model = $this->load->model("Api_model");
				$result_client = $this->Api_model->api_data_get($api_url_client);

	    		$arr_client = json_decode($result_client);
	    		//echo "<pre>";
				// print_r($arr_client[0]);

				if(!empty($arr_client))
			    {
			    	$Client_master_data = $arr_client[0];
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
					// echo "<pre>";
					// print_r($farray[1][0][10]);
					// EXIT();
					$client_name=$farray[1][0][10];
					$this->session->set_userdata('APBackOffice_client_name',$client_name);
			    }
			    else
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    	redirect(base_url('KYC/cdsl_client_holding'));
			    }
			    // end get client name
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
				// echo $api_url;
				// exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

			    $arr = json_decode($result);
			    // echo "<pre>";
			    // print_r($arr);
			    // exit();
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
					$this->session->set_userdata('APBackOffice_client_Trading_data',$farray);
					$this->session->set_userdata('APBackOffice_client_code',$ses_client_code);
			    }
			    else
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    	redirect(base_url('KYC/trading_detail'));
			    }

			    if(empty($farray[1]))
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
			    	redirect(base_url('KYC/trading_detail'));
			    }

			}
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/client_trading_detail.php');
			$this->load->view('User/footer.php');
		}
	}

	public function trading_excel_download()
	{
		// echo "hi";exit();
		$this->load->view('User/Excel/kyc_client_trading_excel.php');
	}
	// end code cdsl client trading detail

	// start collection report view
	public function collection_report()
	{
        if(isset($_SESSION['APBackOffice_user_code']))
        {
			if(!isset($_POST['btn_submit']))
			{	
			    $this->load->view('User/header.php');
				$this->load->view('User/KYC/collection_report_view.php');
				$this->load->view('User/footer.php');
			}
			else
			{
					// print_r($_POST);
					// print_r($_SESSION['APBackOffice_user_code']);
	                // exit();
					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
					    $year=$_SESSION['finacial_year_apbackoffice'];
					    $finacial_years=$this->get_finacial_year_range_ledger($year);
					    $year=$finacial_years['year'];
					    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
					    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
					}
					else
					{
					    $year=date("Y");
					    $finacial_years=$this->get_finacial_year_range_ledger($year);
					    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
					    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
					}
					$arr="";
					$to_date=date_create($_POST['to_date']);
				    $to_date=date_format($to_date,"d/m/Y");
				    // print_r($to_date);exit();
					$Group   =$_POST['exchange_code'];
					$client_code = $_POST['client_code'];

                    $api_url ="192.168.102.101:8080/techexcelapi/index.cfm/Collection_View/Collection_View1?&TO_DATE=".$to_date."&COMPANY_CODE=".$Group."&CLIENT_ID=".$client_code."&BRANCH=".$_SESSION['APBackOffice_user_code']."&STOCK=&WITH_HAIRCUT=&CLIENT_TYPE=&PERIOD=&VIEW_SHORTMARGIN=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
                    // echo "<pre>";
                    // print_r($api_url);
                    // exit();
					$model = $this->load->model("Api_model");

					$data = $this->Api_model->api_data_get($api_url);

					$arr = json_decode($data);
					// echo "<pre>";
				 //    print_r($arr);
					// exit();
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
					}      
							             
				  	if(empty($farray))
				    {

						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						unset($_SESSION['APBackOffice_collection_data']);
						redirect(base_url('KYC/collection_report'));
					}
					else
					{
							
						$this->session->set_userdata('APBackOffice_collection_data',$farray);
						$this->session->set_userdata('APBackOffice_collection_data_to_date',$_POST['to_date']);
						$this->session->set_userdata('ApbackOffice_client_Group',$Group);
						$this->session->set_userdata('ApbackOffice_client_client_code',$client_code);

						$this->load->view('User/header.php');
						$this->load->view('User/KYC/collection_report_view.php');
						$this->load->view('User/footer.php');
				    }

				    if(empty($farray[1]))
				    {
				    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
				    	redirect(base_url('KYC/collection_report'));
				    }
			}					
	
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function collection_report_excel_download()
	{
         
		$this->load->view('User/Excel/kyc_collection_report_excel.php');
	}
	// end collection report view
	// Start Margin Pledge Code
	public function margin_pledge()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			// print_r($_SESSION['APBackOffice_user_code']);exit();
			if(isset($_POST['btn_margin']))
			{
				$D_date = date("d/m/Y");
				$ses_client_code = strtoupper($_POST['client_code']);

				if(isset($_SESSION['APBackOffice_client_code']))
				{
					unset($_SESSION['APBackOffice_client_code']);
				}
				if(isset($_SESSION['APBackOffice_client_name']))
				{
					unset($_SESSION['APBackOffice_client_name']);
				}

				///////////////////////////Check Code
				$trading_user=$_SESSION['No_of_client_list'];
				$ses_client_code_new=0;
				foreach ($trading_user as $people) {

					if (in_array($ses_client_code, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID'];
					}
				}
				if($ses_client_code_new=="0"){
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					unset($_SESSION['APBackOffice_client_holding_data']);
					redirect(base_url('KYC/margin_pledge'));
				}
				///////////////////////////Check Code

				///////////////////////// Start get client name 
				if(isset($_SESSION['finacial_year_apbackoffice']))
					{
					    $year=$_SESSION['finacial_year_apbackoffice'];
					    $finacial_years=$this->get_finacial_year_range_ledger($year);
					    $year=$finacial_years['year'];
					    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
					    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
					}
					else
					{
					    $year=date("Y");
					    $finacial_years=$this->get_finacial_year_range_ledger($year);
					    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
					    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
					}
				$t_date = date("d/m/Y");
				$api_url_client = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code."&To_date=".$t_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
				// echo $api_url;

	    		$model = $this->load->model("Api_model");
				$result_client = $this->Api_model->api_data_get($api_url_client);

	    		$arr_client = json_decode($result_client);
	    		//echo "<pre>";
				// print_r($arr_client[0]);

				if(!empty($arr_client))
			    {
			    	$Client_master_data = $arr_client[0];
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
					// echo "<pre>";
					// print_r($farray[1][0][10]);
					// EXIT();
					$client_name=$farray[1][0][10];
					$this->session->set_userdata('APBackOffice_client_name',$client_name);
			    }
			    else
			    {
			    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    	redirect(base_url('KYC/cdsl_client_holding'));
			    }
			    ////////////////////////// end get client name

				// print_r($ses_client_code);exit();
				// Api to get holding Data as Session
				unset($_SESSION['APBackOffice_client_holding_data']);
				if(!isset($_SESSION['APBackOffice_client_holding_data']))
				{
					$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$ses_client_code_new."&To_date=".$D_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

					$model = $this->load->model("Api_model");

					$result = $this->Api_model->api_data_get($api_url);

				    $arr = json_decode($result);
				    // echo "<pre>";
				    // print_r($arr);
				    // exit();
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
						$this->session->set_userdata('APBackOffice_client_holding_data',$farray);
						$this->session->set_userdata('APBackOffice_client_code',$ses_client_code);
						
				    }
				    else
				    {
				    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    		redirect(base_url('KYC/margin_pledge'));
				    }

				    if(empty($farray[1]))
				    {
				    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
				    	redirect(base_url('KYC/margin_pledge'));
				    }
				    
				}


				// APBackOffice_client_client_master_data
				unset($_SESSION['APBackOffice_client_client_master_data']);
				if(!isset($_SESSION['APBackOffice_client_client_master_data']))
				{
						
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientList/ClientList?&CLIENT_ID=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
						
					    
					$model = $this->load->model("Api_model");
					$result = $this->Api_model->api_data_get($api_url);

					$arr = json_decode($result);
					// echo "<pre>";
					// print_r($arr);
					// echo "</pre>";
					// exit();
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
						$this->session->set_userdata('APBackOffice_client_client_master_data',$farray);

					}
					else
					{
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
			    		redirect(base_url('KYC/margin_pledge'));	
					}
					if(empty($farray[1]))
				    {
				    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
				    	redirect(base_url('KYC/margin_pledge'));
				    }


				}

				// Api to get global summary data
				unset($_SESSION['APBackOffice_client_global_summary_data']);
				if(!isset($_SESSION['APBackOffice_client_global_summary_data']))
				{
					$exchange_code = "BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE";
					$opening_balance = "Y";
					$to_date =  date("d/m/Y");
					$year = date("Y");

					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=".$exchange_code."&Client_Code=".$ses_client_code_new."&Finstyr=".$year."&To_date=".$to_date."&WITHOpening=".$opening_balance."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
					
				    // echo $api_url;
				    // exit();
				    
				    $model = $this->load->model("Api_model");
					$result = $this->Api_model->api_data_get($api_url);

				    $arr = json_decode($result);
				    // echo "<pre>";
				    // print_r($arr);
				    // echo "</pre>";
				    // exit();
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
						$this->session->set_userdata('APBackOffice_client_global_summary_data',$farray);
					}
					else
					{
						$farray[0] = "";
						$farray[1] = "";
						$this->session->set_userdata('APBackOffice_client_global_summary_data',$farray);	
					}

					if(empty($farray[1]))
				    {
				    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
				    	redirect(base_url('KYC/margin_pledge'));
				    }
					// print_r($api_url);
					// print_r($farray);
					// exit();
				}


			}

			if(isset($_POST['client_code']))
			{
				$ClientCode=$_POST['client_code'];
			}
			else
			{
				$ClientCode="";	
			}
			// unset($_SESSION['APBackOffice_User_Session_Data']);
			if(!empty($ClientCode))
			{
				$this->session->set_userdata('APBackOffice_User_Session_Data',$ClientCode);
			}
			// unset($_SESSION['APBackOffice_User_Session_Data']);
			// echo "jhfghk";
			// print_r($_SESSION['APBackOffice_User_Session_Data']);exit();
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/margin_pledge.php');
			$this->load->view('User/footer.php');
		}
	}
	
	public function MarginPledge_Request()
	{
		// print_r($_POST);
		// return;
		// echo "<pre>";
		// print_r($_POST);
		// return;
		//check only data entry into database
		// $KYC_db = $this->load->database('KYC_db', TRUE); 
		// $sql = "select * from tbl_MarginPledgeData where ISIN_REQUEST_ID = '270356978'";
		// $result = $KYC_db->query($sql)->result_array();
		// echo "<pre>";
		// print_r($result);
		// exit();
		$this->load->view("User/KYC/MarginPledgeFormPass.php");
	}
	public function MarginPledge_Response()
	{
		// print_r($_POST['pledgeresdtls']);
		// exit;
		// print_r($this->decrypt('bscaiudb6mfrr6ymfd5mz88olxgw67ug',$_POST['pledgeresdtls']));return;
		// print_r($_GET['clientDetail']);
		// exit;
		// echo "hi";
		// exit();
		if (isset($_GET['clientDetail'])) 
		{
			$clientDetail = base64_decode($_GET['clientDetail']);
			$ClientCode = $clientDetail;
			if(isset($_SESSION['finacial_year_apbackoffice']))
					{
					    $year=$_SESSION['finacial_year_apbackoffice'];
					    $finacial_years=$this->get_finacial_year_range_ledger($year);
					    $year=$finacial_years['year'];
					    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
					    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
					}
					else
					{
					    $year=date("Y");
					    $finacial_years=$this->get_finacial_year_range_ledger($year);
					    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
					    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
					}

			if(!isset($_SESSION['APBackOffice_User_Session_Data']))
			{
				$t_date = date("d/m/Y");
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ClientCode."&To_date=".$t_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

	    		$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

	    		$arr = json_decode($result);

	    		$_SESSION['APBackOffice_User_Session_Data'] = $arr[0]->DATA[0];
	    		// echo "<pre>";
	    		// print_r($arr[0]->DATA[0]);
	    		// exit;
			}
		}

		$response=$this->decrypt_plg('bscaiudb6mfrr6ymfd5mz88olxgw67ug',$_POST['pledgeresdtls']);
		// print_r($response);
		// exit;
		$margin_pledge_Response_file_path = "E:/PLEDGE/Pledge_AP/MarginPledge_ResponseData/".date('d-m-Y').".txt";
		file_put_contents($margin_pledge_Response_file_path, $response.PHP_EOL , FILE_APPEND | LOCK_EX);

		$arrResponse=json_decode($response,true);
		// echo "<pre>";
		// print_r($arrResponse['pledgeresdtls']);return;

		// loop make code +++++++++++++++++++++++++++
		$i=0;
		foreach ($arrResponse['pledgeresdtls']['isinresdtls'] as $key => $value) 
		{
			// print_r($value);
			// continue;
			// return;

			$KYC_db = $this->load->database('AP_No_Of_Client', TRUE); 
			$sql = "select * from tbl_MarginPledgeData where ISIN_REQUEST_ID = '".$value['isinreqid']."'";
			$result = $KYC_db->query($sql)->result_array();
			// echo "<pre>";
			// print_r($result);
			// print_r($result[0]['PLEDGE_VALUE']);
			$Holding_Quantity=explode("||",$result[0]['ISIN_NAME']);
			// echo "<br>";
			if(isset($Holding_Quantity[2]))
			{
				$Holding_Quantity=$Holding_Quantity[2];
			}	
			$current_poa_qty=explode("||",$result[0]['ISIN_NAME']);
			$Margin_Quantity=explode("||",$result[0]['ISIN_NAME']);
			if(isset($Margin_Quantity[3]))
			{
				// print_r($Holding_Quantity[3]);
				$Margin_Quantity=$Margin_Quantity[3];
			}
			$Net_Rate=explode("||",$result[0]['ISIN_NAME']);
			if(isset($Net_Rate[4]))
			{
				// print_r($Holding_Quantity[3]);
				$Net_Rate=$Net_Rate[4];
			}
			// print_r($Net_Rate);
			// return;
			// print_r($current_poa_qty[1]);
			// exit();
			// print_r($value['isin']);return;
			$REQUEST_ID=$arrResponse['pledgeresdtls']['reqid'];
			$I_REQUEST_ID=$value['isinreqid'];
			$RESPONSE_ID=$arrResponse['pledgeresdtls']['resid'];
			$RESPONSE_TIME=$arrResponse['pledgeresdtls']['restime'];
			$RESPONSE_STATUS=$arrResponse['pledgeresdtls']['resstatus'];
			$ISIN_RESPONSE_ID =$value['isinresid'];
			$ISIN_STATUS=$value['status'];
			$PledgeQty=$value['quantity'];
			$isin_p=$value['isin'];
			// print_r($isin_p);return;

			$new_poa_qty=$current_poa_qty[1] - $PledgeQty;
			// print_r($new_poa_qty);return;


			// print_r($current_poa_qty[1]);
			// exit();
			// print_r($value['isin']);return;
			// +++++++++++++++++++++++++++
			// $REQUEST_ID=$arrResponse['pledgeresdtls']['reqid'];
			// $I_REQUEST_ID=$arrResponse['pledgeresdtls']['isinresdtls'][0]['isinreqid'];
			// $RESPONSE_ID=$arrResponse['pledgeresdtls']['resid'];
			// $RESPONSE_TIME=$arrResponse['pledgeresdtls']['restime'];
			// $RESPONSE_STATUS=$arrResponse['pledgeresdtls']['resstatus'];
			// $ISIN_RESPONSE_ID =$arrResponse['pledgeresdtls']['isinresdtls'][0]['isinresid'];
			// $ISIN_STATUS  =$arrResponse['pledgeresdtls']['isinresdtls'][0]['status'];
			// $PledgeQty  =$arrResponse['pledgeresdtls']['isinresdtls'][0]['quantity'];
			// $isin_p  =$arrResponse['pledgeresdtls']['isinresdtls'][0]['isin'];
			// $current_poa_qty  =$arrResponse['pledgeresdtls']['remarks'];
			// $new_poa_qty=$current_poa_qty - $PledgeQty;
			// print_r($new_poa_qty);return;
			// print_r($arrResponse['pledgeresdtls']['isinresdtls'][0]['status']);
			// exit;
			// ++++++++++++++++++++++++++
			// $arrResponse['pledgeresdtls']['isinresdtls'][0]['status']==0 && $arrResponse['pledgeresdtls']['resstatus']==0
			$client_ip_address =$this->input->ip_address(); 
			if($value['status']==0 && $arrResponse['pledgeresdtls']['resstatus']==0)
			{
				// echo "Success";
				$KYC_db = $this->load->database('AP_No_Of_Client', TRUE); 

				$margin_pledge_res_sql = "Exec Proc_MarginPledgeDataInsert '','','','','','','','','$I_REQUEST_ID','','','','','$REQUEST_ID','$RESPONSE_ID','$RESPONSE_TIME','$RESPONSE_STATUS','$ISIN_RESPONSE_ID','$ISIN_STATUS','$client_ip_address'";
				// print_r($margin_pledge_res_sql);return;
				$margin_pledge_res_result = $KYC_db->query($margin_pledge_res_sql);


				// DataPayload
				$DataPayload['client_code'] = $ClientCode;
				$DataPayload['ISIN'] = $isin_p;
				$DataPayload['Holding_Quantity']=$Holding_Quantity;//Net value
				// $DataPayload['Haircut']="";//From excel File haircut value
				// collateral qty value addition with margin (pledgeqty + margin)
				$DataPayload['CollateralQuantity']=$PledgeQty + $Margin_Quantity;
				// Buy avarage Price
				// BuyAvgPrice
				$DataPayload['BuyAvgPrice']=$Net_Rate;
				// print_r($DataPayload);return;
				// Call Model to set data
				$XtsHoldings_API = $this->load->model('XTS_Model');
				$ResXtsHoldings = $this->XTS_Model->XTS_APIDataget($DataPayload);
				// return;
				// $margin_pledge_xtspayload_file_path ="E:/PLEDGE/Pledge_AP/MarginPledge_XTSPayloadResponse/".$ClientCode."_".$isin_p."_LastXTSResponse_".date('Ymdhis').".txt";
				$margin_pledge_xtspayload_file_path ="E:/PLEDGE/Pledge_AP/MarginPledge_XTSPayloadResponse/".$ClientCode."_".$isin_p."_LastXTSResponse.txt";
				date_default_timezone_set("Asia/Kolkata");
				$xtsdatetime=date('d-m-Y H:i:s');
				file_put_contents($margin_pledge_xtspayload_file_path, $xtsdatetime.$ResXtsHoldings.PHP_EOL , FILE_APPEND | LOCK_EX);
				// print_r($ResXtsHoldings);
				// return;
				// print_r($margin_pledge_res_result);return;
				// date_default_timezone_get("Asia/Kolkata");
				date_default_timezone_set("Asia/Kolkata"); 

				$PathLastHold = "E:/PLEDGE/Pledge_AP/MarginPledge_QtyEffect/".$ClientCode."_".$isin_p."_LastHold.txt";
				if(file_exists($PathLastHold))
				{
					$dataAsLast = file_get_contents($PathLastHold);
					if(!empty($dataAsLast))
					{
						// OLD DATA AS ARRAY
						$dataAsLast = explode(",", $dataAsLast);
						if(isset($dataAsLast[0]) && isset($dataAsLast[2]))
						{
							$var_data_from_pledge = explode(",", file_get_contents($PathLastHold));
							$prev_poa_qty = $var_data_from_pledge[1];
							$new_poa_qty=$prev_poa_qty - $PledgeQty;
							$LastHoldData = $ClientCode.",".$new_poa_qty.",".$isin_p.",".date('Y-m-d h:i:s');
						}
						else
						{
							// As selexted value
							$LastHoldData = $ClientCode.",".$new_poa_qty.",".$isin_p.",".date('Y-m-d h:i:s');
						}
					}
					else
					{
						// As selexted value
						$LastHoldData = $ClientCode.",".$new_poa_qty.",".$isin_p.",".date('Y-m-d h:i:s');
					}
				}
				else
				{
					$LastHoldData = $ClientCode.",".$new_poa_qty.",".$isin_p.",".date('Y-m-d h:i:s');
				}


				file_put_contents($PathLastHold, $LastHoldData);

				// exit;

				$success_marginpledge_data_session =$arrResponse['pledgeresdtls']['reqid'] ;
				$_SESSION['APBackOffice_Success_MarginPledge']=$success_marginpledge_data_session;
				// print_r($success_marginpledge_data_session);return;
				// $this->session->set_userdata('TradeCircle_Success_MarginPledge',$success_marginpledge_data_session);
				unset($_SESSION['APBackOffice_client_holding_data']);
				// redirect(base_url('Holdings'));
			}
			else
			{
				$KYC_db = $this->load->database('AP_No_Of_Client', TRUE); 

				$margin_pledge_res_sql = "Exec Proc_MarginPledgeDataInsert '','','','','','','','','$I_REQUEST_ID','','','','','$REQUEST_ID','$RESPONSE_ID','$RESPONSE_TIME','$RESPONSE_STATUS','$ISIN_RESPONSE_ID','$ISIN_STATUS','$client_ip_address'";

				$margin_pledge_res_result = $KYC_db->query($margin_pledge_res_sql);

				// print_r($margin_pledge_res_result);return;

				$success_marginpledge_data_session =$arrResponse['pledgeresdtls']['reserrmsg'];
				$_SESSION['APBackOffice_Danger_MarginPledge']=$success_marginpledge_data_session;
				// print_r($success_marginpledge_data_session);return;
				// $_SESSION['TradeCircle_Danger_MarginPledge'] = $success_marginpledge_data_session;
				// print_r($_SESSION['TradeCircle_Danger_MarginPledge']);
				// redirect(base_url('Holdings'));
			}
			$i++;
		}
		redirect(base_url('KYC'));
		// exit;
		//loop end ++++++++++++++++++++++++++++++
	}

	public function decrypt_plg($aesKey, $dataTodecrypt) 
	{
	    $output = false;
	    $iv = '';
	    $dataTodecrypt = base64_decode ($dataTodecrypt);
	    $dataTodecrypt = $output = openssl_decrypt($dataTodecrypt, 'AES-256-CBC',
	    $aesKey, OPENSSL_RAW_DATA, $iv);
	    return $output;
	}
	public function Get_Valid_PledgeQTY()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$data=$_SESSION['APBackOffice_client_holding_data'][1];
			// echo $data;
			// echo str_replace("],[", "},{", str_replace("]]", "}]", str_replace("[[", "[{", json_encode($data))));
			// $str = '{"name":"John", "age":30}';
			$str = "{";
			$i = 1;
			foreach ($data as $key => $value) 
			{
				if($str == "{")
				{
					// $str .= "".'"a'.$i.'":"'.$value[9].'"';
					$str .= '"a'.$i.'":"'.$value[9].','.$value[32].','.$value[30].','.$value[26].','.$value[38].'"';
				}
				else
				{
					$str .= ',"a'.$i.'":"'.$value[9].','.$value[32].','.$value[30].','.$value[26].','.$value[38].'"';
				}
				$i++;
			}
			$str .= "}";
			print_r($str);
			// print_r($data);
			// exit;

		}
	}
	// end Margin Pledge Code
	// Start DP Ledger
	// public function dp_ledger()
	// {
	// 	if(isset($_SESSION['APBackOffice_user_code']))
	// 	{
	// 		// print_r($_POST);
	// 		// exit();
	// 		if(isset($_POST['btn_submit']))
	// 		{
	// 			// print_r($_POST);
	// 			// exit();

	// 			if(isset($_SESSION['finacial_year_apbackoffice']))
	// 			{
	// 				$year=$_SESSION['finacial_year_apbackoffice'];
	// 			}
	// 			else
	// 			{
	// 				$year=date("Y");
	// 			}
	// 			// print_r($year);exit();

	// 			$ses_client_code=strtoupper($_POST['client_code']);
	// 			if(isset($_SESSION['APBackOffice_client_code']))
	// 			{
	// 				unset($_SESSION['APBackOffice_client_code']);
	// 			}
	// 			if(isset($_SESSION['APBackOffice_client_name']))
	// 			{
	// 				unset($_SESSION['APBackOffice_client_name']);
	// 			}

	// 			///////////////////////////Start Check Code
	// 			$trading_user=$_SESSION['No_of_client_list'];
	// 			// print_r($trading_user);exit();
	// 			$ses_client_code_new=0;
	// 			foreach ($trading_user as $people) {

	// 				if (in_array($ses_client_code, $people, TRUE)){

	// 					$ses_client_code_new=$people['TRADING_CLIENT_ID'];
	// 				}
	// 			}
	// 			if($ses_client_code_new=="0"){
	// 				// echo "hi";exit();
	// 				$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
	// 				redirect(base_url('KYC/dp_ledger'));
	// 			}
	// 			///////////////////////////End Check Code

	// 			///////////////////////// Start get client name 
	// 			$t_date = date("d/m/Y");
	// 			$api_url_client = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code."&To_date=".$t_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=2022"; 


	//     		$model = $this->load->model("Api_model");
	// 			$result_client = $this->Api_model->api_data_get($api_url_client);

	//     		$arr_client = json_decode($result_client);
	//    //  		echo "<pre>";
	// 			// print_r($arr_client);exit();

	// 			if(!empty($arr_client))
	// 		    {
	// 		    	$Client_master_data = $arr_client[0];
	// 			    $i = 0;
	// 			    $status = 'N0';
	// 			    foreach ($Client_master_data as $key => $value) 
	// 			    {
	// 			    	$farray[$i] = $value;
	// 					$i++;
	// 				}
	// 				// echo "<pre>";
	// 				// print_r($farray[1][0][10]);
	// 				// EXIT();
	// 				$client_name=$farray[1][0][10];
	// 				$this->session->set_userdata('APBackOffice_client_name',$client_name);
	// 		    }
	// 		    else
	// 		    {
	// 		    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
	// 		    	redirect(base_url('KYC/dp_ledger'));
	// 		    }
	// 		    ////////////////////////// end get client name

	// 			$from_date=date_create($_POST['from_date']);
	// 			$from_date=date_format($from_date,"d/m/Y");
					
	// 			$to_date=date_create($_POST['to_date']);
	// 			$to_date=date_format($to_date,"d/m/Y");

	// 			$api_url="192.168.102.101:8080/techexcelapi/index.cfm/DepositoryLedger/ledger2?&Cocd=&FromDate=".$from_date."&ToDate=".$to_date."&Client_Id=".$ses_client_code."&DatabaseName=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=DEPOSITORY&UrlDataYear=".$year."";
	// 			// 	echo $api_url;
	// 			// exit();
	// 			$model = $this->load->model("Api_model");
	// 			$result = $this->Api_model->api_data_get($api_url);

	// 			$arr = json_decode($result);
	// 		    // echo "<pre>";
	// 		    // print_r($arr);
	// 		    // exit();
	// 		    if(!empty($arr))
	// 		    {
	// 		    	$Client_master_data = $arr[0];
	// 			    $i = 0;
	// 			    $status = 'N0';
	// 			    foreach ($Client_master_data as $key => $value) 
	// 			    {
	// 			    	$farray[$i] = $value;
	// 					$i++;
	// 				}
	// 				$this->session->set_userdata('APBackOffice_DP_Ledger_data',$farray);
	// 				$this->session->set_userdata('APBackOffice_client_code',$ses_client_code);
	// 				$this->session->set_userdata('ApbackOffice_client_f_date_kycdpledger_detail',$from_date);
	// 				$this->session->set_userdata('ApbackOffice_client_t_date_kycdpledger_detail',$to_date);
	// 		    }
	// 		    else
	// 		    {
	// 		    	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client Code!");
	// 		    	redirect(base_url('KYC/dp_ledger'));
	// 		    }

	// 		    if(empty($farray[1]))
	// 		    {
	// 		    	$this->session->set_userdata('APBackOffice_danger_alert',"Data is not available!");
	// 		    	redirect(base_url('KYC/dp_ledger'));
	// 		    }

	// 		}
			
	// 		$this->load->view('User/header.php');
	// 		$this->load->view('User/KYC/client_dp_ledger.php');
	// 		$this->load->view('User/footer.php');

	// 	}
	// 	else
	// 	{
	// 		redirect(base_url('Dashboard'));
	// 	}
	// }

	public function dp_ledger()
	{
		if(isset($_SESSION['APBackOffice_user_code'])){

				if(isset($_POST['client_code']))
				{
					$ses_client_code_new_text=strtoupper($_POST['client_code']);
					// print_r($ses_client_code_new_text);
					// exit();
					$from_date=date_create($_POST['from_date']);
				    $from_date=date_format($from_date,"d/m/Y");

				    $to_date=date_create($_POST['to_date']);
				    $to_date=date_format($to_date,"d/m/Y");

					///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('KYC/dp_ledger'));
					}
					///////////////////////////Check Code
					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
						
    					$year=$_SESSION['finacial_year_apbackoffice'];
    					// print_r($year);
    					// exit();
    					$finacial_years=$this->get_finacial_year_range($year);
    					// print_r($finacial_years);
    					// exit();
    					$year=$finacial_years['year'];
    					$p_year=$finacial_years['p_year'];
    					$final_convert_date_new_fromdate=$finacial_years['start_date'];
    					$final_convert_date_new_todate_eq=$finacial_years['end_date'];
					}
					else
					{
    					$year=date("Y");
    					$finacial_years=$this->get_finacial_year_range($year);
    					$final_convert_date_new_fromdate=$finacial_years['start_date'];
						$final_convert_date_new_todate_eq=$finacial_years['end_date'];
					}
					// $api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date."&ToDate=".$to_date."&Client_code=".$ses_client_code_new."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year.""; 

					$api_url="http://192.168.102.101:8080/techexcelapi/index.cfm/DepositoryLedger/ledger2?&Cocd=&FromDate=".$from_date."&ToDate=".$to_date."&Client_Id=".$ses_client_code_new_text."&DatabaseName=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year."";
					// DEPOSITORY
					// echo $api_url;
					// exit();
					$model = $this->load->model("Api_model");
					$result = $this->Api_model->api_data_get($api_url);

					$arr = json_decode($result);
					// echo "<pre>";
					// print_r($arr);
					// echo "</pre>";
					// exit();
					if(!empty($arr))
					{
					    $Client_master_data = $arr[0];
					    $i = 0;
						
					    foreach ($Client_master_data as $key => $value) 
					    {
					    	$farray[$i] = $value;
							$i++;
						}
					}
					$back_data = $farray[1];
					// print_r($farray);
					// exit();
					// echo "<pre>";
					// print_r($back_data);exit();

					if(empty($back_data)){

						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						unset($_SESSION['ApbackOffice_client_name_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_code_dpledger_detail']);
						unset($_SESSION['ApbackOffice_client_f_date_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_t_date_ledger_detail']);
						unset($_SESSION['ApbackOffice_DP_Ledger_BackData']);
						
						redirect(base_url('KYC/dp_ledger'));
					}
					else
					{
						// $this->session->set_userdata('ApbackOffice_client_name_ledger_detail',$back_data[0][33]);
						// $this->session->set_userdata('APBackOffice_DP_Ledger_data',$farray);
						$this->session->set_userdata('ApbackOffice_client_code_dpledger_detail',$ses_client_code_new);
						$this->session->set_userdata('ApbackOffice_client_f_date_ledger_detail',$_POST['from_date']);
						$this->session->set_userdata('ApbackOffice_client_t_date_ledger_detail',$_POST['to_date']);
						$this->session->set_userdata('ApbackOffice_client_name_dpledger_detail',$back_data[0][7]);
						$this->session->set_userdata('ApbackOffice_DP_Ledger_BackData',$back_data);
						
						$this->load->view('User/header.php');
						$this->load->view('User/KYC/client_dp_ledger.php',['back_data'=>$back_data]);
						$this->load->view('User/footer.php');
					}
				}
				else
				{
					
					unset($_SESSION['ApbackOffice_client_code_dpledger_detail']);
					unset($_SESSION['ApbackOffice_client_f_date_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_t_date_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_name_dpledger_detail']);
					unset($_SESSION['ApbackOffice_DP_Ledger_BackData']);
					$this->load->view('User/header.php');
					$this->load->view('User/KYC/client_dp_ledger.php');
					$this->load->view('User/footer.php');
				}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	// End DP Ledger
	// Start DP Ldeger Excel
	public function dp_ledger_excel_download()
	{
		if(isset($_SESSION['ApbackOffice_DP_Ledger_BackData']))
		{
			// echo "<pre>";
			// print_r($_SESSION['ApbackOffice_DP_Ledger_BackData']);
			// exit();
			$back_data=$_SESSION['ApbackOffice_DP_Ledger_BackData'];
			// $excel_dpledger_fromdate=$_SESSION['ApbackOffice_client_f_date_ledger_detail'];
			// $excel_dpledger_fromdate=date_format($date,"d/m/Y");
			$excel_dpledger_fromdate=date_create($_SESSION['ApbackOffice_client_f_date_ledger_detail']);
			$excel_dpledger_fromdate=date_format($excel_dpledger_fromdate,"d/m/Y");
			// print_r($excel_dpledger_fromdate);
			// echo$excel_dpledger_fromdate; 
			// exit();
			// $excel_dpledger_todate=$_SESSION['ApbackOffice_client_t_date_ledger_detail'];
			$excel_dpledger_todate=date_create($_SESSION['ApbackOffice_client_t_date_ledger_detail']);
			$excel_dpledger_todate=date_format($excel_dpledger_todate,"d/m/Y");

			$this->load->view('User/Excel/kyc_dp_ledger_excel.php',["excel_dpledger_fromdate"=>$excel_dpledger_fromdate,"excel_dpledger_todate"=>$excel_dpledger_todate,"back_data"=>$back_data]);
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client Code!");
			redirect(base_url('KYC/dp_ledger'));
		}
	}
	// End DP Ledger Excel

	// Start DP Ldeger PDF
	// public function dp_ledger_pdf_download()
	// {
	// 	// echo ob_start('ob_gzhandler');
	// 	// echo $_SESSION['finacial_year_apbackoffice'];
	// 	// exit();
	// 	// echo $_SESSION['ApbackOffice_client_f_date_kycdpledger_detail'];
	// 	// echo $_SESSION['ApbackOffice_client_t_date_kycdpledger_detail'];
	// 	// exit();
	// 	if(isset($_SESSION['APBackOffice_DP_Ledger_data']))
	// 	{
	// 		ob_start('ob_gzhandler');


	// 		// echo "<pre>";
	// 		// print_r($_SESSION['APBackOffice_DP_Ledger_data']);
	// 		// exit();
	// 		if(isset($_SESSION['APBackOffice_client_code']))
	// 		{
	// 			$client_code=$_SESSION['APBackOffice_client_code'];


			
	// 			if(isset($_SESSION['finacial_year_apbackoffice']))
	// 			{
	// 			    $year=$_SESSION['finacial_year_apbackoffice'];
	// 			    $finacial_years=$this->get_finacial_year_range_ledger($year);
	// 			    $year=$finacial_years['year'];
	// 			    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
	// 			    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
	// 			}
	// 			else
	// 			{
	// 			    $year=date("Y");
	// 			    $finacial_years=$this->get_finacial_year_range_ledger($year);
	// 			    // $final_convert_date_new_fromdate=$finacial_years['start_date'];
	// 			    // $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
	// 			}


	// 			// ########################  start DP Leader api code  ########################
	// 			$kyc_dpledger_fromdate=$_SESSION['ApbackOffice_client_f_date_kycdpledger_detail'];
	// 			$kyc_dpledger_todate=$_SESSION['ApbackOffice_client_t_date_kycdpledger_detail'];

	// 			$kyc_dpledger_api_url="192.168.102.101:8080/techexcelapi/index.cfm/DepositoryLedger/ledger2?&Cocd=&FromDate=".$kyc_dpledger_fromdate."&ToDate=".$kyc_dpledger_todate."&Client_Id=".$client_code."&DatabaseName=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

	// 			$kyc_dpledger_api_url="192.168.102.101:8080/techexcelapi/index.cfm/DepositoryLedger/ledger2?&Cocd=&FromDate=".$kyc_dpledger_fromdate."&ToDate=".$kyc_dpledger_todate."&Client_Id=".$client_code."&DatabaseName=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
					
	// 			$model = $this->load->model("Api_model");
	// 			$result = $this->Api_model->api_data_get($kyc_dpledger_api_url);

	// 			$arr = json_decode($result);
	// 			// echo "<pre>";
	// 			// print_r($arr);
	// 			// exit();
	// 			if(!empty($arr))
	// 			{
	// 			    $Client_master_data = $arr[0];
	// 			    $i = 0;
					
	// 			    foreach ($Client_master_data as $key => $value) 
	// 			    {
				    	
	// 			    	$farray[$i] = $value;
	// 					$i++;
	// 				}
	// 			}
	// 			$DPledger_PNL=$farray[1];
	// 			// echo "<pre>";
	// 			// print_r($DPledger_PNL);
	// 			// exit();
	// 			//  ######################## end DP Leader api code ###########################
				
	// 			// ######################## start get client detail api  ########################
	// 			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
				
	// 			$model = $this->load->model("Api_model");
	// 			$result_client_master= $this->Api_model->api_data_get($api_url_client_master);

	// 			$arr_client_master = json_decode($result_client_master);

	// 			// echo "<pre>";
	// 			// print_r($arr_client_master);
	// 			// exit();
	// 			if(!empty($arr_client_master))
	// 			{
	// 			    $Client_master_data_api = $arr_client_master[0];
	// 			    $j = 0;
				
	// 			    foreach ($Client_master_data_api as $key => $value_master) 
	// 			    {
	// 			    	$farray_master[$j] = $value_master;
	// 					$j++;
	// 				}
	// 			}
	// 			else
	// 			{
	// 				$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
	// 				// unset($_SESSION['ApbackOffice_client_name_profit_and_loss']);
	// 				// unset($_SESSION['ApbackOffice_client_code_profit_and_loss']);
	// 				// unset($_SESSION['ApbackOffice_client_pan_profit_and_loss']);
	// 			}
	// 			$master_back_data=$farray_master[1];

	// 			$pan=$master_back_data[0][16];
	// 			$client_code=$master_back_data[0][9];
	// 			$client_name=$master_back_data[0][10];
	// 			$data=array($client_code,$client_name,$pan);
				
	// 			// ######################## start get client detail api ##############################
	// 			// echo "<pre>";
	// 			// print_r($data);
	// 			// exit();
	// 			$this->load->view('User/PDF/kyc_dp_ledger_pdf.php',["data"=>$data,"kyc_dpledger_fromdate"=>$kyc_dpledger_fromdate,"kyc_dpledger_todate"=>$kyc_dpledger_todate,"DPledger_PNL"=>$DPledger_PNL]);
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client Code!");
	// 		redirect(base_url('KYC/dp_ledger'));
	// 	}
	// 	// End DP Ldeger PDF

	// }
	public function dp_ledger_pdf_download()
	{
		if(isset($_SESSION['ApbackOffice_DP_Ledger_BackData']))
		{
			ob_start('ob_gzhandler');
			if(isset($_SESSION['ApbackOffice_client_code_dpledger_detail']))
			{
				$client_code=$_SESSION['ApbackOffice_client_code_dpledger_detail'];
				$DPledger_PNL=$_SESSION['ApbackOffice_DP_Ledger_BackData'];
				// ######################## start get client detail api  ########################
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					
					$year=$_SESSION['finacial_year_apbackoffice'];
					// print_r($year);
					// exit();
					$finacial_years=$this->get_finacial_year_range($year);
					// print_r($finacial_years);
					// exit();
					$year=$finacial_years['year'];
					$p_year=$finacial_years['p_year'];
					$final_convert_date_new_fromdate=$finacial_years['start_date'];
					$final_convert_date_new_todate_eq=$finacial_years['end_date'];
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
					$final_convert_date_new_fromdate=$finacial_years['start_date'];
					$final_convert_date_new_todate_eq=$finacial_years['end_date'];
				}
				// print_r($p_year);
				// exit();
				$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year.""; 
				// echo $api_url_client_master;
				// exit();
				$model = $this->load->model("Api_model");
				$result_client_master= $this->Api_model->api_data_get($api_url_client_master);

				$arr_client_master = json_decode($result_client_master);

				// echo "<pre>";
				// print_r($arr_client_master);
				// exit();
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
				}
				$master_back_data=$farray_master[1];

				$pan=$master_back_data[0][16];
				$client_code=$master_back_data[0][9];
				$client_name=$master_back_data[0][10];
				$data=array($client_code,$client_name,$pan);
				
				// ######################## start get client detail api ##############################
				// echo "<pre>";
				// print_r($data);
				// exit();
				
				$kyc_dpledger_fromdate=date_create($_SESSION['ApbackOffice_client_f_date_ledger_detail']);
				$kyc_dpledger_fromdate=date_format($kyc_dpledger_fromdate,"d/m/Y");

				
				$kyc_dpledger_todate=date_create($_SESSION['ApbackOffice_client_t_date_ledger_detail']);
				$kyc_dpledger_todate=date_format($kyc_dpledger_todate,"d/m/Y");
				
				$this->load->view('User/PDF/kyc_dp_ledger_pdf.php',["data"=>$data,"kyc_dpledger_fromdate"=>$kyc_dpledger_fromdate,"kyc_dpledger_todate"=>$kyc_dpledger_todate,"DPledger_PNL"=>$DPledger_PNL]);
			}
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client Code!");
			redirect(base_url('KYC/dp_ledger'));
		}
		// End DP Ldeger PDF

	}
	function get_finacial_year_range_ledger($year)
	{
		$month = date('m');
		$year_r = date('Y');
		if($month<4){
		    $year = $year-1;
		}
		// 2022 get if condition
		if($year_r==$year){
		    $year = $year-1;
		}

		// echo $year;
		// exit();
		$start_date = date('d/m/Y',strtotime(($year).'-04-01'));
		$end_date = date('d/m/Y',strtotime(($year+1).'-03-31'));
		$response = array('start_date' => $start_date, 'end_date' => $end_date,'year'=>$year);
		// print_r($response);
		// exit();
		return $response;
	}
	function get_finacial_year_range($year)
	{
		// echo $year;
		// exit();
		$month = date('m');
		$year_r = date('Y');
		if($month<4){
		    $year = $year-1;
		}
		// if($year_r<$year){
		//     $year = $year-1;
		// }
		
		$start_date = date('d/m/Y',strtotime(($year-1).'-03-30'));
		$end_date = date('d/m/Y',strtotime(($year).'-03-30'));
		$response = array('start_date' => $start_date, 'end_date' => $end_date,'year'=>$year,'p_year'=>$year-1);
		// print_r($response);
		// exit();
		return $response;
	}
	public function PhysicalKYC()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('APBackOffice'));
		}
		else
		{
			$this->load->view('User/header.php');
			$this->load->view('User/KYC/physical_kyc.php');
			$this->load->view('User/footer.php');

			// print_r($_SESSION['APBackOffice_user_code']); exit();
			if(isset($_POST) && !empty($_POST))
			{
				$ip_address = $this->input->ip_address();
				$kyc_mob_no = $_POST['kyc_mob_no'];
				$kyc_email = $_POST['kyc_email'];
				$kyc_type = 'physical_acc_opening';
				$branch_code = $_SESSION['APBackOffice_user_code'];

				//Insert in Database
				$DB_KYC = $this->load->Database('KYC_db',TRUE);
				$signup_sql = "Exec Proc_EKYC_Ph_Signup_ARHAM '".$kyc_mob_no."','".$kyc_email."',1,'".$ip_address."','654321','654321'";

		        $signup_db = $DB_KYC->query($signup_sql);

		        // print_r($signup_db); exit();
		        if(!is_object($signup_db))
		        {
		        	if(strpos($signup_db,"Mobile And Email Already Singup"))
		        	{
		        		// echo "used"; exit();
		        		$this->session->set_userdata('APBackOffice_danger_alert','Mobile and Email already exists!');
		        		redirect(base_url('KYC/PhysicalKYC'));
		        	}
		        	else
		        	{
		        		// echo "not used"; exit();
		        		$this->session->set_userdata('APBackOffice_danger_alert',$signup_db);
		        		redirect(base_url('KYC/PhysicalKYC'));	
		        	}
		        }
				// $url = 'http://192.168.102.203:81';
				$url = 'http://192.168.102.203:81/eKYC_P/eKYC_Process';

				// $url = 'https://ekyc.arhamshare.com/eKYC_P/eKYC_Process';  //Production

				// $url = "http://192.168.106.20/eKYC_A/eKYC_P/eKYC_Process"; // UAT
				// $url = "http://localhost/eKYC_A/eKYC_P/eKYC_Process"; // UAT

				redirect($url."?kyc_mob=".$kyc_mob_no."&kyc_email=".$kyc_email."&Branchuser=".$branch_code."&kyc_type=".$kyc_type);

			}
		}
	}
}
