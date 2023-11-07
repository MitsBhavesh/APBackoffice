<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct()
    {

        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        clearstatcache();
    }

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('APBackOffice'));
		}
		else
		{
			$this->load->view('User/header.php');
			$this->load->view('User/Account/accounts.php');
			$this->load->view('User/footer.php');
		}
	}

	public function GenerateReport()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if($_POST['report_type']=="risk_common_report"){

				$filename="risk_common_report.php";
				$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved risk common report!");
				$this->load->view('User/header.php');
				$this->load->view('User/Account/risk_common_report.php',["filename"=>$filename]);
				$this->load->view('User/footer.php');
			}
			if($_POST['report_type']=="collect_view"){

				$filename="collect_view.php";
				$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved collect view!");
				$this->load->view('User/header.php');
				$this->load->view('User/Account/collect_view.php',["filename"=>$filename]);
				$this->load->view('User/footer.php');
			}
		}
		else
			{
				redirect(base_url('Dashboard'));
			}
	
	}
	public function CommanContractBill()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('Dashboard'));
		}
		else
		{

			if(isset($_SESSION['ApBackOffice_commancontractbill_client_code'])) 
			{
				unset($_SESSION['ApBackOffice_commancontractbill_client_code']);
			}
			if(isset($_SESSION['ApBackOffice_commancontractbill_to_date'])) 
			{
				unset($_SESSION['ApBackOffice_commancontractbill_to_date']);
			}
			if(isset($_SESSION['ApBackOffice_commancontractbill_from_date'])) 
			{
				unset($_SESSION['ApBackOffice_commancontractbill_from_date']);
			}
			$this->load->view('User/header.php');
			$this->load->view('User/Account/commancontractbill.php');
			$this->load->view('User/footer.php');
		}
	
	}

	public function Get_CommonContractBill()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{	
			// print_r($_POST);exit();
			if(isset($_POST['client_code']))
			{
			
				$ses_client_code_new_text = strtoupper($_POST['client_code']);

				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
		    		$year=$_SESSION['finacial_year_apbackoffice'];
		    		$finacial_years=$this->get_finacial_year_range($year);
		    		$year=$finacial_years['year'];
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

				$trading_user=$_SESSION['No_of_client_list'];

				$ses_client_code_new=0;

				foreach ($trading_user as $people) {

					if (in_array($ses_client_code_new_text, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
					}
				}
				
				if($ses_client_code_new=="0"){

					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					redirect(base_url('Accounts/CommanContractBill'));
				}
				// echo $ses_client_code_new;exit();
				$exchange_code = $_POST['exchange_code'];

				$from_date=date_create($_POST['from_date']);
			    $from_date=date_format($from_date,"d/m/Y");

			    $to_date=date_create($_POST['to_date']);
			    $to_date=date_format($to_date,"d/m/Y");

				if(2022>=$_SESSION['finacial_year_apbackoffice'])
				{
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ViewDigitalDocuments/ViewDigitalDocuments1?&FROMDATE=".$from_date."&TODATE=".$to_date."&Client_Id=".$ses_client_code_new."&COCD=".$exchange_code."&DCTYPE=CN&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				}
				else
				{
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ViewDigitalDocuments/ViewDigitalDocuments1?&FROMDATE=".$from_date."&TODATE=".$to_date."&Client_Id=".$ses_client_code_new."&COCD=".$exchange_code."&DCTYPE=CN&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
				}


			    $model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result);
					// print_r($arr);exit();
			    if(!empty($arr))
				{
				    $Client_master_data = $arr[0];	//saprate data column and row wise
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
				}
				else
				{
					if(isset($_SESSION['ApBackOffice_commancontractbill_client_code'])) 
					{
					unset($_SESSION['ApBackOffice_commancontractbill_client_code']);
					}
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					redirect(base_url('Accounts/CommanContractBill'));

				}

				$back_data = $farray[1];


				//Create Form Submit Session
				$this->session->set_userdata('ApBackOffice_commancontractbill_from_date',$_POST['from_date']);
				$this->session->set_userdata('ApBackOffice_commancontractbill_to_date',$_POST['to_date']);
				$this->session->set_userdata('ApBackOffice_commancontractbill_client_code',$ses_client_code_new);

				//End Form Submit Session

				$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Comman Contrat Bill!");
				$this->load->view('User/header.php');
				$this->load->view('User/Account/commancontractbill.php',["back_data"=>$back_data]);
				$this->load->view('User/footer.php');

			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	public function CommanContractBill_Download()
	{
		
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$filename=$_POST['bill_url'];
			$client_code=$_POST['client_code'];

			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename="Bill'.$client_code.'.pdf"');
			header('Content-Transfer-Encoding: binary');
			header("Content-Type: application/download");
			header('Accept-Ranges: bytes');
			@ readfile($filename);
		}
		else
		{
			redirect(base_url('Dashboard'));}

	}

	// Start code PlainPaperBill
	public function PlainPaperBill()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('Dashboard'));
		}
		else
		{
			// echo "hi";return;
			$client_code=array("A0342","A0501","A0502","A0520","A0772","A0868","A0915","A1201","A1202","A1446","A1080");
			$this->load->view('User/header.php');
			$this->load->view('User/Account/plainpaperbill.php',['client_code'=>$client_code]);
			$this->load->view('User/footer.php');
		}
	
	}

	public function Get_PlainPaperBill()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if($this->input->post())
			{
				$client_code=array("A0342","A0501","A0502","A0520","A0772","A0868","A0915","A1201","A1202","A1446","A1080");
				
				$filename="report_plainpaperbill.php";
				$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Plain Papar Bill!");
				$this->load->view('User/header.php');
				$this->load->view('User/Account/plainpaperbill.php',["filename"=>$filename,'client_code'=>$client_code]);
				$this->load->view('User/footer.php');

			}
		}
	}

	
	public function payment_request()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{

			$api_url="192.168.102.101:8080/techexcelapi/index.cfm/PAYMENTREQUESTTYPE/PAYMENTREQUESTTYPE1?&Client_code=A0342&Balance_date=22/06/2022&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

			$model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);
			$arr = json_decode($result);
			// echo "<pre>";
			// print_r($arr);
			// echo "</pre>";
			exit();
			if(!empty($arr))
			{
				$Client_master_data = $arr[0];										//saprate data column and row wise
				$i = 0;
				foreach ($Client_master_data as $key => $value) 
				{
					$farray[$i] = $value;
					$i++;
				}
			}
			$back_data = $farray[1];
			$this->load->view('User/header.php');
			$this->load->view('User/Account/payment_request.php',['back_data'=>$back_data]);
			$this->load->view('User/footer.php');
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	
	public function payment_request_wallet()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{
			

			 if($data=$this->input->post())
			  {   
				// print_r($_POST); die();
				$client_code=$_POST['client_code'];
				$grp_wise=$_POST['grp_wise'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
					{
						$year=$_SESSION['finacial_year_apbackoffice'];
					}
					else
					{
						$year=date("Y");
					}
				// $voucher_date=date_create($_POST['voucher_date']);
				// $voucher_date=date_format($voucher_date,"d/m/Y");

				$voucher_date =date("d/m/Y", strtotime('+5 days'));

				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/LedgerSummary/LedgerSummary?&ClientId=".$client_code."&VOUCHERDATE=".$voucher_date."&GRPWISE=".$grp_wise."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

				$arr = json_decode($result);

				if(!empty($arr))
				{
					$Client_master_data = $arr[0];
					$i = 0;

					foreach ($Client_master_data as $key => $value) 
					{
						$farray[$i] = $value;
						$i++;
					}
					$data = json_encode($farray[1]);
				}

				$data = json_encode($farray[1]);
				$data_payment = json_decode($data);

				if ($grp_wise == "y")
				    {
					$Grp1 = $data_payment[0];
					}
					else
					{
						$Grp1 = $data_payment;
					}

					$this->load->view('User/header.php');
					$this->load->view('User/Account/payment_request.php',['Grp1'=>$data_payment,'grp_wise'=>$grp_wise]);
					$this->load->view('User/footer.php');
			}else{
				$this->load->view('User/header.php');
			    $this->load->view('User/Account/payment_request.php');
			    $this->load->view('User/footer.php');
			}
		}
	}
	
	public function payment_export()
	{
	     
        $payment_data=$_POST['Payment_data'];
		$data=explode("#", $payment_data);
		$data_table = $data;
		$this->load->view('Excel/payment_export.php',['data_table'=>$data_table]);
	}
	
	public function receipt_request()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{

			$patment=$this->load->database('KYC_db_local',TRUE);
			$proc="EXEC Proc_AP_ReceiptGet";
			$result=$patment->query($proc)->result_array();

			$this->load->view('User/header.php');
			$this->load->view('User/Account/receipt_request.php',['result'=>$result]);
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function receipt_request_from()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['btn_receipt']))
			{	
				
				// print_r($_SESSION['APBackOffice_user_code']);exit();
				date_default_timezone_set("Asia/Kolkata");
				$client_code=$_POST['client_code'];
				$current_date = date("dmYhis");
				$new_name = $client_code."_".$current_date."_ReceiptProof"; 
				// print_r($new_name);exit();
				if(!empty($_FILES['ChequeImg']['name']))
				{
					
					$file_info=$_FILES['ChequeImg']['name'];
					// print_r($file_info);exit();
					$proof_type= pathinfo($file_info,PATHINFO_EXTENSION);
					$config['upload_path']='E:/APBackOffice_Document/APBackOffice_Proof/';
					$config['allowed_types']='jpg|jpeg|png';
					$config['file_name'] = $new_name;

					$this->load->library('upload',$config);
					$result=$this->upload->data('file_name');
					// print_r($result);exit();
					if($proof_type == "png")
					{
						$proof_path = "E:/APBackOffice_Document/APBackOffice_Proof/".$new_name.".png";
					}
					else if($proof_type == "jpeg")
					{
						$proof_path = "E:/APBackOffice_Document/APBackOffice_Proof/".$new_name.".jpeg";
					}
					else
					{
						$proof_path = "E:/APBackOffice_Document/APBackOffice_Proof/".$new_name.".jpg";
					}


					if($this->upload->do_upload('ChequeImg'))
					{
							// echo "done";
							// return;
					}
					else
					{
						$this->session->set_userdata('APBackOffice_danger_alert',"Please Select only jpg or jpeg or png as Receipt Proof !");
						redirect(base_url('Accounts/receipt_request'));
					}


					// print_r($result);
					// exit();
				}
				// exit();
				$created_at=$_POST['date'];
				// print_r($date);exit();
				$final_date=date('d/m/Y',strtotime($created_at));
				// print_r($final_date);exit();
				$exchange_code=$_POST['exchange_code_ins']; 
			    $client_name=$_POST['client_name']; 
			    $closing_price=$_POST['closing_price']; 
			    $date=$final_date; 
			    $bank_code=$_POST['bank_code_ins']; 
			    $mode_entry=$_POST['mode_entry']; 
			    $Cr_Amt=$_POST['Cr_Amt'];
			    $Cheque_No=$_POST['Cheque_No']; 
			    $Client_bank=$_POST['Client_bank'];
			    // $ChequeImg=$new_name;//file upload cheque prooff
			    $ChequeImg=$proof_path;
			    // print_r($proof_path);
			    // exit();
			    $Narration=$_POST['Narration'];
			    $Refe_No=$_POST['Refe_No']; 
			    $ip_address= $this->input->ip_address();
			    $entry_user=$_SESSION['APBackOffice_user_code'];

				$KYC_db_local = $this->load->database('KYC_db_local',TRUE);

				$sql_receipt="EXEC Proc_AP_ReceiptInsert '$exchange_code','$client_code','$client_name','$closing_price','$date','$bank_code','$mode_entry','$Cr_Amt','$Cheque_No','$Client_bank','$ChequeImg','','$Refe_No','$Narration','$ip_address','$entry_user'";
				// print_r($sql_receipt);exit();
				$result_receipt = $KYC_db_local->query($sql_receipt);
				// print_r($result_receipt);exit();
				$this->session->set_userdata('APBackOffice_success',"Successfully Added Request.!");
				redirect(base_url('Accounts/receipt_request'));

				// $exchange_code=$_POST['exchange_code']; 
			 //    $client_code=$_POST['client_code']; 
			 //    $client_name=$_POST['client_name']; 
			 //    $closing_price=$_POST['closing_price']; 
			 //    $date=$_POST['date']; 
			 //    $bank_code=$_POST['bank_code']; 
			 //    $mode_entry=$_POST['mode_entry']; 
			 //    $Cr_Amt=$_POST['Cr_Amt'];
			 //    $Cheque_No=$_POST['Cheque_No']; 
			 //    $Client_bank=$_POST['Client_bank'];
			 //    $ChequeImg=$_POST['ChequeImg'];//file upload cheque prooff
			 //    $Narration=$_POST['Narration'];
			 //    $Refe_No=$_POST['Refe_No']; 
			 //    $ip_address= $this->input->ip_address();
			 //    $entry_user=$_SESSION['APBackOffice_user_code'];

				// $KYC_db_local = $this->load->database('KYC_db_local',TRUE);

				// $sql_receipt="EXEC Proc_AP_ReceiptInsert '$exchange_code','$client_code','$client_name','$closing_price','$date','$bank_code','$mode_entry','$Cr_Amt','$Cheque_No','$Client_bank','$ChequeImg','','$Refe_No','$Narration','$ip_address','$entry_user'";

				// $result_receipt = $KYC_db_local->query($sql_receipt);
				// $this->session->set_userdata('APBackOffice_success',"Successfully Added Request.!");
				// redirect(base_url('Accounts/receipt_request'));

			}
		}
	}
	public function receipt_request_update()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['btn_edit_receipt']))
			{	
				// print_r($_POST);exit();
				date_default_timezone_set("Asia/Kolkata");
				$client_code=$_POST['client_code'];
				$current_date = date("dmYhis");
				$new_name = $client_code."_".$current_date."_ReceiptProofUpdate"; 
				// print_r($new_name);exit();

				if(!empty($_FILES['ChequeImg']['name']))
				{
					
					$file_info=$_FILES['ChequeImg']['name'];
					$proof_type= pathinfo($file_info,PATHINFO_EXTENSION);
					$config['upload_path']='E:/APBackOffice_Document/APBackOffice_Proof/';
					$config['allowed_types']='jpg|jpeg|png';
					$config['file_name'] = $new_name;

					$this->load->library('upload',$config);
					$result=$this->upload->data('file_name');

					if($proof_type == "png")
					{
						$proof_path = "E:/APBackOffice_Document/APBackOffice_Proof/".$new_name.".png";
					}
					else if($proof_type == "jpeg")
					{
						$proof_path = "E:/APBackOffice_Document/APBackOffice_Proof/".$new_name.".jpeg";
					}
					else
					{
						$proof_path = "E:/APBackOffice_Document/APBackOffice_Proof/".$new_name.".jpg";
					}


					if($this->upload->do_upload('ChequeImg'))
					{
							// echo "done";
							// return;
					}
					else
					{
						$this->session->set_userdata('APBackOffice_danger_alert',"Please Select only jpg or jpeg or png as Receipt Proof !");
						redirect(base_url('Accounts/receipt_request'));
					}


					// print_r($result);
					// exit();
				}
				// exit();
				$created_at=$_POST['date'];
				$final_date=date('d/m/Y',strtotime($created_at));
				// print_r($final_date);
				// exit();
				$receipt_id=$_POST['receipt_id']; 
				$exchange_code=$_POST['exchange_code']; 
			    $client_code=$_POST['client_code']; 
			    $client_name=$_POST['client_name']; 
			    $closing_price=$_POST['closing_price']; 
			    $date=$final_date; 
			    // print_r($date);exit();
			    $bank_code=$_POST['bank_code']; 
			    $mode_entry=$_POST['mode_entry']; 
			    $Cr_Amt=$_POST['Cr_Amt'];
			    $Cheque_No=$_POST['Cheque_No']; 
			    $Client_bank=$_POST['Client_bank'];
			    $ChequeImg=$proof_path;//file upload cheque prooff
			    // print_r($ChequeImg);exit();
			    $Narration=$_POST['Narration'];
			    $Refe_No=$_POST['Refe_No']; 
			    $ip_address= $this->input->ip_address();
			    $entry_user=$_SESSION['APBackOffice_user_code'];

				$KYC_db_local = $this->load->database('KYC_db_local',TRUE);

				$sql_receipt="EXEC Proc_AP_ReceiptUpdate '$receipt_id','$exchange_code','$client_code','$client_name','$closing_price','$date','$bank_code','$mode_entry','$Cr_Amt','$Cheque_No','$Client_bank','$ChequeImg','$Refe_No','$Narration','$ip_address','$entry_user'";
				// print_r($sql_receipt);exit();
				$result_receipt = $KYC_db_local->query($sql_receipt);
				$this->session->set_userdata('APBackOffice_success',"Successfully Updated Request.!");
				redirect(base_url('Accounts/receipt_request'));

			}
		}
	}

	public function Receipt_Report_Accept()
	{
		// echo "hi";
		// exit();
		if(isset($_POST['btn_accept']))
		{
			if(isset($_POST['chk_report'] )) 
			{

				$Receipt_ID=$_POST['chk_report'];
				$KYC_db_local = $this->load->database('KYC_db_local',TRUE);

				$select_query="SELECT * FROM AP_Receipt_Request WHERE Receipt_ID='$Receipt_ID'";
				$results = $KYC_db_local->query($select_query)->result_array();
				// echo "<pre>";
				// print_r($results);
				// exit();
				$Voucher_Date=$results[0]['Date'];
				$Client_Code=$results[0]['Client_Code'];
				$Company_Code=$results[0]['Exchange_Code'];
				$Credit_Amount=$results[0]['Credit_Amount'];
				$PostingBankAccount=$results[0]['Bank_Code'];
				$BankAccountNumber=$results[0]['Client_Bank_Account'];
				$Cheque_No=$results[0]['Cheque_No'];
				// print_r($Cheque_No);
				if($Cheque_No=='0')
				{
					$CHEQUE_CAN='';
				}
				else
				{
					$CHEQUE_CAN='c';
					// print_r($CHEQUE_CAN);
				}
				$Upload_Path=$results[0]['Upload_Path'];
				// print_r($Upload_Path);
				// echo "<br>";
				$Cheque_Image=base64_encode($Upload_Path);
				// print_r($Cheque_Image);
				$Mode=$results[0]['Mode_of_Entry'];
				// exit();
				///////////////////////////Check Code
				$trading_user=$_SESSION['No_of_client_list'];
				$ses_client_code_new=0;
				foreach ($trading_user as $people) {

					if (in_array($ses_client_code_new_text, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
					}
				}
				if($ses_client_code_new=="0"){
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					redirect(base_url('Accounts/receipt_request'));
				}
				///////////////////////////Check Code
				$api_url="192.168.102.101:8080/techexcelapi/index.cfm/ReceiptNormal/ReceiptNormal?&VoucherDate=".$Voucher_Date."&AccountCode=".$ses_client_code_new."&COMPANYCODE=".$Company_Code."&PAYMENTREFERENCENUMBER=PG&Amount=".$Credit_Amount."&PostingBankAccount=".$PostingBankAccount."&BankAccountNumber=".$BankAccountNumber."&NARRATION=being amount received from client&ENTRYTYPE=PG&LiveExport=&RecoDate=&CHEQUE_CAN=".$CHEQUE_CAN."&Cheque_Image=".$Cheque_Image."=&Unautho_Flag=1&Mode=".$Mode."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
				// print_r($api_url);
				// exit();

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
				    'Cookie: cfid=905300e0-46f5-4fdf-91d5-568ead63ceaa; cftoken=0'
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				echo $response;
				// exit();
			
			   
			    

				$this->session->set_userdata('APBackOffice_success',"Successfully Added Receipt.!");
				redirect(base_url('Accounts/receipt_request'));
			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Please Select One Record");
				redirect(base_url('Accounts/receipt_request'));
			}
		}

		if(isset($_POST['btn_reject']))
		{
			if(isset($_POST['chk_report'] )) 
			{
				// echo "hgfhfh";exit();
				$selec_val =$_POST['checkedValue'];
				// $KYC_db_local = $this->load->database('KYC_db_local',TRUE);
				// $select_query="SELECT * FROM AP_Receipt_Request WHERE Receipt_ID='$selec_val'";
				// $results = $KYC_db_local->query($select_query)->result_array();
				// echo "<pre>";
				// print_r($results[0]['Status']);
				// $receipt_status=$results[0]['Status'];
				$KYC_db_local = $this->load->database('KYC_db_local',TRUE);
				$reject_query="EXEC Proc_AP_ReceiptRejection '$selec_val'";

				$update_status = $KYC_db_local->query($reject_query);

				// print_r($update_status);
				// exit();
			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Please Select One Record");
				redirect(base_url('Accounts/receipt_request'));
			}
		}

	}

	public function Receipt_Report_Reject()
	{
		$selec_val =$_POST['checkedValue'];
		// $KYC_db_local = $this->load->database('KYC_db_local',TRUE);
		// $select_query="SELECT * FROM AP_Receipt_Request WHERE Receipt_ID='$selec_val'";
		// $results = $KYC_db_local->query($select_query)->result_array();
		// echo "<pre>";
		// print_r($results[0]['Status']);
		// $receipt_status=$results[0]['Status'];
		$KYC_db_local = $this->load->database('KYC_db_local',TRUE);
		$reject_query="EXEC Proc_AP_ReceiptRejection '$selec_val'";

		$update_status = $KYC_db_local->query($reject_query);

	}
	public function ledger_detail_pdf()
	{
		if(isset($_SESSION['ApbackOffice_client_code_ledger_detail']))
		{
			ob_start('ob_gzhandler');

			$client_code=$_SESSION['ApbackOffice_client_code_ledger_detail'];
			$exchange_code=$_SESSION['ApbackOffice_client_exchange_code_ledger_detail'];
			$exp=$_SESSION['ApbackOffice_client_margin_code_ledger_detail'];

			$from_date_ledger_pdf=$_SESSION['ApbackOffice_client_f_date_ledger_detail'];
			$to_date_ledger_pdf=$_SESSION['ApbackOffice_client_t_date_ledger_detail'];

			$from_date_ledger_pdf=date_create($from_date_ledger_pdf);
			$from_date_ledger_pdf=date_format($from_date_ledger_pdf,"d/m/Y");

			$to_date_ledger_pdf=date_create($to_date_ledger_pdf);
			$to_date_ledger_pdf=date_format($to_date_ledger_pdf,"d/m/Y");

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

			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date_ledger_pdf."&ToDate=".$to_date_ledger_pdf."&Client_code=".$client_code."&COCDLIST=".$exchange_code."&ShowMargin=".$exp."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
			// echo $api_url;
			// exit();
			$model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);

			$arr = json_decode($result);

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

			$ledger_PNL=$farray[1];
			$ledger_PNL_ALL=$farray;

			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

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
				unset($_SESSION['ApbackOffice_client_name_profit_and_loss']);
				unset($_SESSION['ApbackOffice_client_code_profit_and_loss']);
				unset($_SESSION['ApbackOffice_client_pan_profit_and_loss']);
			}
			$master_back_data=$farray_master[1];

			$pan=$master_back_data[0][16];
			$client_code=$master_back_data[0][9];
			$client_name=$master_back_data[0][10];
			$data=array($client_code,$client_name,$pan);

			$this->load->view('User/PDF/ledger_pdf.php',["data"=>$data,'final_convert_date_new_todate_ledger'=>$to_date_ledger_pdf,'final_convert_date_new_fromdate'=>$from_date_ledger_pdf,"ledger_PNL"=>$ledger_PNL,'ledger_PNL_ALL'=>$ledger_PNL_ALL]);

		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	// function get_finacial_year_range_ledger($year)
	// {
	// 	$month = date('m');
	// 	$year_r = date('Y');
	// 	if($month<4){
	// 	    $year = $year-1;
	// 	}
	// 	if($year_r==$year){
	// 	    $year = $year-1;
	// 	}
	// 	// echo $year;
	// 	// exit();
	// 	$start_date = date('d/m/Y',strtotime(($year).'-04-01'));
	// 	$end_date = date('d/m/Y',strtotime(($year+1).'-03-31'));
	// 	$response = array('start_date' => $start_date, 'end_date' => $end_date,'year'=>$year);
	// 	// print_r($response);
	// 	// exit();
	// 	return $response;
	// }
	//PROFIT AND LOSS 84 REPORTS START
	public function profit_and_loss()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['client_code']))
			{
		        $ses_client_code_new_text=strtoupper($_POST['client_code']);
				$exp=$_POST['exp'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
				}
				else
				{
					$year=date("Y");
				}

				///////////////////////////Check Code
				$trading_user=$_SESSION['No_of_client_list'];
				$ses_client_code_new=0;
				foreach ($trading_user as $people) {

					if (in_array($ses_client_code_new_text, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
					}
				}
				if($ses_client_code_new=="0"){
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Code!");
					redirect(base_url('Accounts/profit_and_loss'));
				}
				///////////////////////////Check Code
				if(2022>=$year)
				{
					$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				}
				else
				{
					$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
				} 
		         
				// echo $api_url_client_master;
			    // exit();
			    
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
						unset($_SESSION['ApbackOffice_client_name_profit_and_loss']);
						unset($_SESSION['ApbackOffice_client_code_profit_and_loss']);
						unset($_SESSION['ApbackOffice_client_pan_profit_and_loss']);
						// redirect(base_url('Accounts/profit_and_loss'));
					}
					$master_back_data=$farray_master[1];
					$BSE_CASH="0";
					$CD_NSE="0";
					$MF_BSE="0";
					$NSE_CASH="0";
					$NSE_FNO="0";
					$NSE_SLBM="0";
					$MCX="0";
					// echo "<pre>";
					foreach ($master_back_data as $key => $value) {
						// echo $value[0]."<br>";
						if($value[0]=="BSE_CASH")
						{
							$BSE_CASH="1";
						}
						if($value[0]=="NSE_CASH")
						{
							$NSE_CASH="1";
						}
						if($value[0]=="CD_NSE")
						{
							$CD_NSE="1";
						}
						if($value[0]=="NSE_FNO")
						{
							$NSE_FNO="1";
						}
						if($value[0]=="MCX")
						{
							$MCX="1";
						}
					}
					$pan=$master_back_data[0][16];
					$client_code=$master_back_data[0][9];
					$client_name=$master_back_data[0][10];
					
					if(empty($master_back_data))
					{
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						unset($_SESSION['ApbackOffice_client_name_profit_and_loss']);
						unset($_SESSION['ApbackOffice_client_code_profit_and_loss']);
						unset($_SESSION['ApbackOffice_client_pan_profit_and_loss']);
						redirect(base_url('Accounts/profit_and_loss'));
					}
					else
					{	
						$filename='report_profitandloss.php';
						$this->session->set_userdata('ApbackOffice_client_code_profit_and_loss',$client_code);
						$this->session->set_userdata('ApbackOffice_client_name_profit_and_loss',$client_name);
						$this->session->set_userdata('ApbackOffice_client_pan_profit_and_loss',$pan);

						$this->session->set_userdata('ApbackOffice_client_exp_profit_and_loss',$exp);
						$this->load->view('User/header.php');
						$this->load->view('User/Account/profitandloss.php',['BSE_CASH'=>$BSE_CASH,'NSE_CASH'=>$NSE_CASH,'CD_NSE'=>$CD_NSE,'NSE_FNO'=>$NSE_FNO,'MCX'=>$MCX]);
						$this->load->view('User/footer.php');
					}
			}
			else
			{
				$BSE_CASH="0";
					$CD_NSE="0";
					$MF_BSE="0";
					$NSE_CASH="0";
					$NSE_FNO="0";
					$NSE_SLBM="0";
					$MCX="0";
				if(isset($_SESSION['ApbackOffice_client_name_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_name_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_code_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_pan_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_pan_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_todate_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_todate_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_todate_form_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_todate_form_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_exp_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_exp_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_shortterm_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_shortterm_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_longterm_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_longterm_profit_and_loss']);
				}
				if(isset($_SESSION['ApbackOffice_client_Broekrage_profit_and_loss']))
				{
					unset($_SESSION['ApbackOffice_client_Broekrage_profit_and_loss']);
				}

				$this->load->view('User/header.php');
				$this->load->view('User/Account/profitandloss.php',['BSE_CASH'=>$BSE_CASH,'NSE_CASH'=>$NSE_CASH,'CD_NSE'=>$CD_NSE,'NSE_FNO'=>$NSE_FNO,'MCX'=>$MCX]);
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		} 
	}
	public function Account_Summary()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['client_code']))
			{
				// print_r($_POST);exit;
				$ses_client_code_new_text=strtoupper($_POST['client_code']);

				$from_date=date_create($_POST['from_date']);
			    $from_date=date_format($from_date,"d/m/Y");

			    $to_date=date_create($_POST['to_date']);
			    $to_date=date_format($to_date,"d/m/Y");

				$company_code=$_POST['company_code'];
				
				$Trance_Type=$_POST['Trance_Type'];

				///////////////////////////Check Code
				$trading_user=$_SESSION['No_of_client_list'];
				$ses_client_code_new=0;
				foreach ($trading_user as $people) {

					if (in_array($ses_client_code_new_text, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
					}
				}
				if($ses_client_code_new=="0"){
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					redirect(base_url('Accounts/Account_Summary'));
				}
				///////////////////////////Check Code
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					$finacial_years=$this->get_finacial_year_range($year);
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

				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=".$company_code."&TRANS_TYPE=".$Trance_Type."&FROM_DATE=".$from_date."&TO_DATE=".$to_date."&CLIENT_CODE=".$ses_client_code_new."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year.""; 
				// echo $api_url;
				// exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

				// print_r($result);
				// exit();
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
				// print_r($back_data);
				// exit();

				
				// sort($back_data);
				if(empty($back_data))
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Not Found Data!");
					unset($_SESSION['ApbackOffice_client_name_account_summary']);
					unset($_SESSION['ApbackOffice_client_code_account_summary']);
					unset($_SESSION['ApbackOffice_client_f_date_account_summary']);
					unset($_SESSION['ApbackOffice_client_t_date_account_summary']);
					unset($_SESSION['ApbackOffice_client_company_code_account_summary']);
					unset($_SESSION['ApbackOffice_trance_type_account_summary']);
					unset($_SESSION['ApbackOffice_ledger_detail_excel']);
					redirect(base_url('Accounts/Account_Summary'));
				}
				else
				{
					foreach ($back_data as $key => $row) {
				 	$sort[$key] = strtotime(date_format(date_create(str_replace(",", "", $row[7])),"Y/m/d"));
					}
					array_multisort($sort, SORT_ASC, $back_data);
					$this->session->set_userdata('ApbackOffice_client_name_account_summary',$back_data[0][6]);
					$this->session->set_userdata('ApbackOffice_client_code_account_summary',$ses_client_code_new);
					$this->session->set_userdata('ApbackOffice_client_f_date_account_summary',$_POST['from_date']);
					$this->session->set_userdata('ApbackOffice_client_t_date_account_summary',$_POST['to_date']);
					$this->session->set_userdata('ApbackOffice_client_company_code_account_summary',$company_code);
					$this->session->set_userdata('ApbackOffice_trance_type_account_summary1',$Trance_Type);
					$this->session->set_userdata('ApbackOffice_ledger_detail_excel',$back_data);
					$this->session->set_userdata('ApbackOffice_Account_Summary_excel',$back_data);
					$this->session->set_userdata('ApbackOffice_Account_Summary_pdf',$back_data);
					$this->load->view('User/header.php');
					$this->load->view('User/Account/Account_Summary.php',['back_data'=>$back_data]);
					$this->load->view('User/footer.php');
				}
			}
			else
			{
				unset($_SESSION['ApbackOffice_client_name_account_summary']);
				unset($_SESSION['ApbackOffice_client_code_account_summary']);
				unset($_SESSION['ApbackOffice_client_f_date_account_summary']);
				unset($_SESSION['ApbackOffice_client_t_date_account_summary']);
				unset($_SESSION['ApbackOffice_client_company_code_account_summary']);
				// unset($_SESSION['ApbackOffice_trance_type_account_summary']);
				unset($_SESSION['ApbackOffice_ledger_detail_excel']);
				$this->load->view('User/header.php');
				$this->load->view('User/Account/Account_Summary.php');
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Account_Summary_excel()
	{	

		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['ApbackOffice_Account_Summary_excel']))
		{
			$client_code=$_SESSION['ApbackOffice_client_code_account_summary'];
			$client_name=$_SESSION['ApbackOffice_client_name_account_summary'];
			$company_code=$_SESSION['ApbackOffice_client_company_code_account_summary'];
			$trance_type=$_SESSION['ApbackOffice_trance_type_account_summary'];

			$from_date_Account_Summary=$_SESSION['ApbackOffice_client_f_date_account_summary'];
			$to_date_Account_Summary=$_SESSION['ApbackOffice_client_t_date_account_summary'];

			$from_date_Account_Summary=date_create($from_date_Account_Summary);
			$from_date_Account_Summary=date_format($from_date_Account_Summary,"d/m/Y");

			$to_date_Account_Summary=date_create($to_date_Account_Summary);
			$to_date_Account_Summary=date_format($to_date_Account_Summary,"d/m/Y");

			$back_data=$_SESSION['ApbackOffice_Account_Summary_excel'];
			// print_r($back_data);
			// exit();
			// $this->load->view('User/header.php');
			$this->load->view('User/Excel/Account_Summary_excel.php',["back_data"=>$back_data]);
			// $this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Account_Summary_pdf()
	{
		if(isset($_SESSION['ApbackOffice_client_code_account_summary']) && isset($_SESSION['ApbackOffice_Account_Summary_pdf']))
		{
			ob_start('ob_gzhandler');

			$client_code=$_SESSION['ApbackOffice_client_code_account_summary'];
			$client_name=$_SESSION['ApbackOffice_client_name_account_summary'];
			$company_code=$_SESSION['ApbackOffice_client_company_code_account_summary'];
			$trance_type=$_SESSION['ApbackOffice_trance_type_account_summary'];

			$from_date_Account_Summary=$_SESSION['ApbackOffice_client_f_date_account_summary'];
			$to_date_Account_Summary=$_SESSION['ApbackOffice_client_t_date_account_summary'];

			$from_date_Account_Summary=date_create($from_date_Account_Summary);
			$from_date_Account_Summary=date_format($from_date_Account_Summary,"d/m/Y");

			$to_date_Account_Summary=date_create($to_date_Account_Summary);
			$to_date_Account_Summary=date_format($to_date_Account_Summary,"d/m/Y");

			$back_data=$_SESSION['ApbackOffice_Account_Summary_pdf'];

			// print_r($back_data);
			// // $final_convert_date_new_todate
			// exit();
			$this->load->view('User/PDF/Account_Summary_pdf.php',["back_data"=>$back_data,'final_convert_date_new_todate'=>$to_date_Account_Summary,'final_convert_date_new_fromdate'=>$from_date_Account_Summary,'client_code'=>$client_code,'client_name'=>$client_name]);

		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	function get_finacial_year_range_charges($year)
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
		
		$start_date = date('d/m/Y',strtotime(($year-1).'-04-01'));
		$end_date = date('d/m/Y',strtotime(($year).'-03-31'));
		$response = array('start_date' => $start_date, 'end_date' => $end_date,'year'=>$year,'p_year'=>$year-1);
		// print_r($response);
		// exit();
		return $response;
	}
	public function pnlSummary()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
			{
				$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
				$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];
				########## Equity
				if(isset($_SESSION['finacial_year_apbackoffice']))
					{
					    $year=$_SESSION['finacial_year_apbackoffice'];
					    $finacial_years=$this->get_finacial_year_range($year);
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
					

					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Reports2/R892?&Client_code=".$client_code."&ToDate=".$final_convert_date_new_todate_eq."&WithExp=".$exp."&COCD=BSE_CASH,NSE_CASH&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year."";

					// echo $api_url;
					// exit();
					$model = $this->load->model("Api_model");
					$result = $this->Api_model->api_data_get($api_url);

					$arr = json_decode($result);

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

					$equity_pnl_GlobalDetail=$farray[1];
					$equity_pnl_all_GlobalDetail=$farray;

					if(empty($equity_pnl_GlobalDetail))
					{
						$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
						redirect(base_url('Accounts/profit_and_loss'));
					}
					else
					{
						$intraday_total=0;
						$longterm_total=0;
						$LIABILITIES_total=0;
						$shortterm_total=0;
						$holdings=0;

						$SHORTTERM="1";
						$ASSETS="1";
						$TRADING="1";
						$LONGTERM="1";
						$LIABILITIES="1";

						foreach ($equity_pnl_GlobalDetail as $key => $value) 
						{
							if($value[14]=="OP_SHORTTERM" || $value[14]=="SHORTTERM")
							{
					            $pnl=$value[10];
					            $shortterm_total+=number_format((float)$pnl, 2, '.', '');
								$SHORTTERM="0";
							}
							if($value[14]=="OP_ASSETS" || $value[14]=="ASSETS")
							{
								if($value[0]!="MF_BSE")
            					{
								    $realized_pl=(int)$value[21]*$value[24]-$value[10];
								    $realized_pl=number_format((float)$realized_pl, 2, '.', '');
								    $holdings+=(int)$realized_pl;
								    $ASSETS="0";
								}
							}
							if($value[14]=="TRADING")
							{
								$intraday_total+=(int)$value[10];
								$TRADING="0";
							}
							if($value[14]=="LONGTERM")
							{
								$longterm_total+=(int)$value[10];
								$LONGTERM="0";
							}
							if($value[14]=="LIABILITIES")
							{
								$realized_pl=$value[21]*$value[24]-$value[10];
            					$realized_pl=number_format((float)$realized_pl, 2, '.', '');
								$LIABILITIES_total+=(int)$realized_pl;
								$LIABILITIES="0";
							}
						}
					}
				########## Equity
				########## FO
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $year=$finacial_years['year'];
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_fo=$finacial_years['end_date'];
				}
				else
				{
				    $year=date("Y");
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_fo=$finacial_years['end_date'];
				}


				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=NSE_FNO&Client_Code=".$client_code."&Finstyr=".$year."&To_date=".$final_convert_date_new_todate_fo."&WITHOpening=Y&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				// echo $api_url;exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result);

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
				$fo_pnl=[];
				$fo_pnl_all=[];

				if (isset($farray)) {

					$fo_pnl=$farray[1];
					$fo_pnl_all=$farray;
				}
				// echo "<pre>";
				// print_r($fo_pnl);
				// exit();
				if(empty($fo_pnl))
				{
					// $this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
					// redirect(base_url('Accounts/profit_and_loss'));
					$future_total=0;
					$options_total=0;

					$fo_future_data="0";
					$fo_option_data="0";
				}
				else
				{
					$future_total=0;
					$options_total=0;

					$fo_future_data="0";
					$fo_option_data="0";

					foreach ($fo_pnl as $key => $value)
					{
					   if(!preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="NSE_FNO" && $value[22]=="FO")
					   		{
					   			$fo_future_data="1";
					   			$future_total+=$value[10];
					   		}
					   	}
					   	if(preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="NSE_FNO" && $value[22]=="FO")
					   		{
					   			$fo_option_data="1";
					   			$options_total+=$value[10];
					   		}
					   	}
					}
				}
				########## FO
				########## CDS
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $year=$finacial_years['year'];
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_cd=$finacial_years['end_date'];
				}
				else
				{
				    $year=date("Y");
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_cd=$finacial_years['end_date'];
				}

				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=CD_NSE&Client_Code=".$client_code."&Finstyr=".$year."&To_date=".$final_convert_date_new_todate_cd."&WITHOpening=".$exp."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				// echo $api_url;
				// exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

				$arr = json_decode($result);
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
					$cds_pnl=$farray[1];
					$cds_pnl_all=$farray;

					// echo "<pre>";
					// print_r($cds_pnl);
					// exit();
					if(empty($cds_pnl))
					{
						// $this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
						// redirect(base_url('Accounts/profit_and_loss'));
						$cd_future_total=0;
						$cd_options_total=0;

						$cds_future_data="0";
						$cds_option_data="0";
						$yestarday_balance_2_charges="0";
						$yestarday_balance_2_charges_P="0";
						$yestarday_balance_2_charges_R="0";
						$actual_jv="";
						$actual_P="";
						$actual_R="";
					}
					else
					{
						$cd_future_total=0;
						$cd_options_total=0;

						$cds_future_data="0";
						$cds_option_data="0";

						foreach ($cds_pnl as $key => $value) 
						{

						   if(!preg_match("/\b(CE|PE)\b/", $value[31]))
						   	{
						   		if($value[27]=="CD_NSE" && $value[22]=="FO")
						   		{
						   			$cds_future_data="1";
						   			$cd_future_total+=$value[10];
						   		}
						   	}
						   	if(preg_match("/\b(CE|PE)\b/", $value[31]))
						   	{
						   		if($value[27]=="CD_NSE" && $value[22]=="FO")
						   		{
						   			$cds_option_data="1";
						   			$cd_options_total+=$value[10];
						   		}
						   	}
						}
					}
				########## CDS
				########## Other Taxes
				#########################API FA DAY
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year_charges=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year_charges);
				    $year_charges=$finacial_years_charges['year'];
				    $p_year_charges=$finacial_years_charges['p_year'];
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				else
				{
				    $year_charges=date("Y");
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year);
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				################################# JV Start######################
				$yestarday_balance_2_charges="0";
				$yestarday_balance_2_charges_P="0";
				$yestarday_balance_2_charges_R="0";
				$api_url_jv = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE&TRANS_TYPE=J&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_jv;
				// exit();
				$model = $this->load->model("Api_model");
				$result_jv = $this->Api_model->api_data_get($api_url_jv);

			    $array_jv = json_decode($result_jv);

			    if(!empty($array_jv))
				{
				    $Client_jv = $array_jv[0];
				    $jv = 0;
			
				    foreach ($Client_jv as $value_jv) 
				    {
				    	$farray_jv[$jv] = $value_jv;
						$jv++;
					}
				}
				if(empty($farray_jv[1]))
				{
					$actual_jv="";
					$act_jv=[];
				}
				else
				{
					$act_jv=$farray_jv[1];
					$act_jv_all=$farray_jv;
					// $actual_jv=$act_jv[0][3];
					foreach ($act_jv as $key => $row) {
				 	$sort[$key] = strtotime(date_format(date_create(str_replace(",", "", $row[7])),"Y/m/d"));
					}
					array_multisort($sort, SORT_ASC, $act_jv);

					$iv = 0;
	                $yestarday_balance_charges = 0;
	                $yestarday_balance_2_charges = 0;
	                foreach ($act_jv as $key_index => $data_row) 
	                {
		                if (str_contains($act_jv[$iv][13], 'FUND TRANSFER') || str_contains($act_jv[$iv][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_jv[$iv][12] != "" || $act_jv[$iv][11] != "")
                            {
                                if($act_jv[$iv][12] == 0)
                                {
                                    $yestarday_balance_charges -= $act_jv[$iv][11];
                                    $yestarday_balance_2_charges += $act_jv[$iv][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges += $act_jv[$iv][12];
                                    $yestarday_balance_2_charges -= $act_jv[$iv][12];
                                }
                            }
		                }
		                $iv++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges))
                    { 
                        $yestarday_balance_2_charges = $yestarday_balance_2_charges <= 0 ? abs($yestarday_balance_2_charges) : -$yestarday_balance_2_charges ;
                        // echo ($yestarday_balance_2_charges);
                    }
                    else
                    {
                        $yestarday_balance_2_charges="0";
                    }
				}
				################################# JV End######################
				################################# Payment Start######################
				$api_url_P = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE&TRANS_TYPE=P&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_P;
				// exit();
				$model = $this->load->model("Api_model");
				$result_P = $this->Api_model->api_data_get($api_url_P);

			    $array_P = json_decode($result_P);

			    if(!empty($array_P))
				{
				    $Client_P = $array_P[0];
				    $_P = 0;
			
				    foreach ($Client_P as $value_P) 
				    {
				    	$farray_P[$_P] = $value_P;
						$_P++;
					}
				}
				if(empty($farray_P[1]))
				{
					$actual_P="";
					$act_P=[];
				}
				else
				{
					$act_P=$farray_P[1];
					$act_P_all=$farray_P;
					// $actual_P=$act_P[0][3];
					foreach ($act_P as $key_P => $row_P) {
				 	$sort_P[$key_P] = strtotime(date_format(date_create(str_replace(",", "", $row_P[7])),"Y/m/d"));
					}
					array_multisort($sort_P, SORT_ASC, $act_P);

					$i_P = 0;
	                $yestarday_balance_charges_P = 0;
	                $yestarday_balance_2_charges_P = 0;
	                foreach ($act_P as $key_index_P => $data_row) 
	                {
		                if (str_contains($act_P[$i_P][13], 'FUND TRANSFER') || str_contains($act_P[$i_P][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_P[$i_P][12] != "" || $act_P[$i_P][11] != "")
                            {
                                if($act_P[$i_P][12] == 0)
                                {
                                    $yestarday_balance_charges_P -= $act_P[$i_P][11];
                                    $yestarday_balance_2_charges_P += $act_P[$i_P][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_P += $act_P[$i_P][12];
                                    $yestarday_balance_2_charges_P -= $act_P[$i_P][12];
                                }
                            }
		                }
		                $i_P++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_P))
                    { 
                        $yestarday_balance_2_charges_P = $yestarday_balance_2_charges_P <= 0 ? abs($yestarday_balance_2_charges_P) : -$yestarday_balance_2_charges_P ;
                        // echo ($yestarday_balance_2_charges_P);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_P="0";
                    }
				}
				################################# Payment End ######################
				################################# Receipt Start ######################
				$api_url_R = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE&TRANS_TYPE=R&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_R;
				// exit();
				$model = $this->load->model("Api_model");
				$result_R = $this->Api_model->api_data_get($api_url_R);

			    $array_R = json_decode($result_R);

			    if(!empty($array_R))
				{
				    $Client_R = $array_R[0];
				    $_R = 0;
			
				    foreach ($Client_R as $value_R) 
				    {
				    	$farray_R[$_R] = $value_R;
						$_R++;
					}
				}
				if(empty($farray_R[1]))
				{
					$actual_R="";
					$act_R=[];
				}
				else
				{
					$act_R=$farray_R[1];
					$act_R_all=$farray_R;
					// $actual_R=$act_R[0][3];
					foreach ($act_R as $key_R => $row_R) {
				 	$sort_R[$key_R] = strtotime(date_format(date_create(str_replace(",", "", $row_R[7])),"Y/m/d"));
					}
					array_multisort($sort_R, SORT_ASC, $act_R);

					$i_R = 0;
	                $yestarday_balance_charges_R = 0;
	                $yestarday_balance_2_charges_R = 0;
	                foreach ($act_R as $key_index_R => $data_row) 
	                {
		                if (str_contains($act_R[$i_R][13], 'FUND TRANSFER') || str_contains($act_R[$i_R][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_R[$i_R][12] != "" || $act_R[$i_R][11] != "")
                            {
                                if($act_R[$i_R][12] == 0)
                                {
                                    $yestarday_balance_charges_R -= $act_R[$i_R][11];
                                    $yestarday_balance_2_charges_R += $act_R[$i_R][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_R += $act_R[$i_R][12];
                                    $yestarday_balance_2_charges_R -= $act_R[$i_R][12];
                                }
                            }
		                }
		                $i_R++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_R))
                    { 
                        $yestarday_balance_2_charges_R = $yestarday_balance_2_charges_R <= 0 ? abs($yestarday_balance_2_charges_R) : -$yestarday_balance_2_charges_R ;
                        // echo ($yestarday_balance_2_charges_R);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_R="0";
                    }
				}
				################################# Receipt End ######################
				#########################API FA DAY

				########## Other Taxes 





				$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
				$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
				$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];

				$data=array($client_code,$client_name,$pan);
				$this->load->view('User/PDF/pnl_summary.php',["data"=>$data,'final_convert_date_new_todate_eq'=>$final_convert_date_new_todate_eq,'final_convert_date_new_fromdate'=>$final_convert_date_new_fromdate,"LONGTERM"=>$LONGTERM,"TRADING"=>$TRADING,"ASSETS"=>$ASSETS,"SHORTTERM"=>$SHORTTERM,"LIABILITIES"=>$LIABILITIES,"intraday_total"=>$intraday_total,"longterm_total"=>$longterm_total,"LIABILITIES_total"=>$LIABILITIES_total,"shortterm_total"=>$shortterm_total,"holdings"=>$holdings,"future_total"=>$future_total,"options_total"=>$options_total,"cd_future_total"=>$cd_future_total,"cd_options_total"=>$cd_options_total,"yestarday_balance_2_charges"=>$yestarday_balance_2_charges,"yestarday_balance_2_charges_P"=>$yestarday_balance_2_charges_P,"yestarday_balance_2_charges_R"=>$yestarday_balance_2_charges_R,"act_jv"=>$act_jv,"act_P"=>$act_P,"act_R"=>$act_R]);

			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
				$this->load->view('User/header.php');
				$this->load->view('User/Account/profitandloss.php');
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	public function pnl_link_generator()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$this->load->view('User/header.php');
			$this->load->view('User/Account/pnl_link_generator.php');
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

				$link =  "https://connect.arhamshare.com/Arham_PNL/?client_code=".$Client_code;

				date_default_timezone_set('Asia/Kolkata');
				$myfile2 = fopen("PNL_LINK.txt", "a") or die("Unable to open file!");
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
			$message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'\application\views\template\arh_pnl_mail.php');
			$message = str_replace('{{client_code}}', $client_code, $message);
			$message = str_replace('{{link}}', $link, $message);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('donotreply@arhamshare.com'); // change it to yours
			$this->email->to($Email_ID);// change it to yours
			$this->email->subject('Profit and Loss Statement & Ledger for the Financial Year of 2022-23');
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
	
	public function EQ_PNL()
	{
		if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
		{
			ob_start('ob_gzhandler');

			$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];

			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
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
			

			// $api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Reports2/R892?&Client_code=".$client_code."&ToDate=".$final_convert_date_new_todate_eq."&WithExp=".$exp."&COCD=BSE_CASH,NSE_CASH&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year."";
			if(2023>=$_SESSION['finacial_year_apbackoffice'])
				{
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Reports2/R892?&Client_code=".$client_code."&ToDate=".$final_convert_date_new_todate_eq."&WithExp=".$exp."&COCD=BSE_CASH,NSE_CASH&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year."";
				}
				else
				{
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Reports2/R892?&Client_code=".$client_code."&ToDate=".$final_convert_date_new_todate_eq."&WithExp=".$exp."&COCD=BSE_CASH,NSE_CASH&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$p_year."";
				}

			// echo $api_url;
			// exit();
			$model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);

			$arr = json_decode($result);

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

			$equity_pnl_GlobalDetail=$farray[1];
			$equity_pnl_all_GlobalDetail=$farray;

			//Start ACTUAL Brokerage API
			$api_url_actbrk = "192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$final_convert_date_new_fromdate."&TO_DATE=".$final_convert_date_new_todate_eq."&COMPANY_CODE=bse_cash,nse_cash&CLIENT_ID=".$client_code."&BRANCH=&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
			// echo $api_url_actbrk;
				$model = $this->load->model("Api_model");
				$result_actbrk = $this->Api_model->api_data_get($api_url_actbrk);

			    $array = json_decode($result_actbrk);

			    if(!empty($array))
				{
				    $Client_actbrk = $array[0];
				    $j = 0;
			
				    foreach ($Client_actbrk as $value_brk) 
				    {
				    	$farray_actbrk[$j] = $value_brk;
						$j++;
					}
				}
				if(empty($farray_actbrk[1]))
				{
					$actual_brokerage="";
				}
				else
				{
					$actbrk=$farray_actbrk[1];
					$actbrk_all=$farray_actbrk;
					$actual_brokerage=$actbrk[0][3];
				}
			//End Actual Brokerage Api
			if(empty($equity_pnl_GlobalDetail))
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
				redirect(base_url('Accounts/profit_and_loss'));
			}
			else
			{
				$shortterm_total=0;
				$intraday_total=0;
				$longterm_total=0;
				$LIABILITIES_total=0;

				$holdings=0;
				$realized_non_zero=0;
				$SHORTTERM="1";
				$ASSETS="1";
				$TRADING="1";
				$LONGTERM="1";
				$LIABILITIES="1";

				foreach ($equity_pnl_GlobalDetail as $key => $value) 
				{
					if($value[14]=="OP_SHORTTERM" || $value[14]=="SHORTTERM")
					{
			            $pnl=$value[10];
			            $realized_non_zero+=number_format((float)$pnl, 2, '.', '');
						$SHORTTERM="0";
					}
					if($value[14]=="OP_ASSETS" || $value[14]=="ASSETS")
					{
					    $realized_pl=$value[10];
			     		$holdings+=number_format((float)$realized_pl, 2, '.', '');
						$ASSETS="0";
					}
					if($value[14]=="TRADING")
					{
						$intraday_total+=(int)$value[10];
						$TRADING="0";
					}
					if($value[14]=="LONGTERM")
					{
						$longterm_total+=(int)$value[10];
						$LONGTERM="0";
					}
					if($value[14]=="LIABILITIES")
					{
						// $LIABILITIES_total+=(int)$value[10];
						$LIABILITIES="0";
					}
				}
				// echo "<pre>";
				// print_r($equity_pnl_GlobalDetail);
				// exit();
				if(isset($_SESSION['APBackOffice_CGST_EQ']))
				{
					unset($_SESSION['APBackOffice_CGST_EQ']);
					$this->session->set_userdata('APBackOffice_CGST_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_SGST_EQ']))
				{
					unset($_SESSION['APBackOffice_SGST_EQ']);
					$this->session->set_userdata('APBackOffice_SGST_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_STAMP_DUTY_EQ']))
				{
					unset($_SESSION['APBackOffice_STAMP_DUTY_EQ']);
					$this->session->set_userdata('APBackOffice_STAMP_DUTY_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_STT_EQ']))
				{
					unset($_SESSION['APBackOffice_STT_EQ']);
					$this->session->set_userdata('APBackOffice_STT_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_SEBI_FEES_EQ']))
				{
					unset($_SESSION['APBackOffice_SEBI_FEES_EQ']);
					$this->session->set_userdata('APBackOffice_SEBI_FEES_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_TOC_BSE_EQ']))
				{
					unset($_SESSION['APBackOffice_TOC_BSE_EQ']);
					$this->session->set_userdata('APBackOffice_TOC_BSE_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_TOC_NSE_EQ']))
				{
					unset($_SESSION['APBackOffice_TOC_NSE_EQ']);
					$this->session->set_userdata('APBackOffice_TOC_NSE_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_ROUNDING_EQ']))
				{
					unset($_SESSION['APBackOffice_ROUNDING_EQ']);
					$this->session->set_userdata('APBackOffice_ROUNDING_EQ','0');
				}
				if(isset($_SESSION['APBackOffice_BSE_CLEARING_CHGS_EQ']))
				{
					unset($_SESSION['APBackOffice_BSE_CLEARING_CHGS_EQ']);
					$this->session->set_userdata('APBackOffice_BSE_CLEARING_CHGS_EQ','0');
				}

				foreach ($equity_pnl_GlobalDetail as $key => $charges)
				{
					if($charges[2]=="EXPENSES")
   					{  
					    if($charges[0]=="CGST")
					    {
					        $this->session->set_userdata('APBackOffice_CGST_EQ',$charges[25]);
					    }
					    if($charges[0]=="SGST")
		 				{
		 				    $this->session->set_userdata('APBackOffice_SGST_EQ',$charges[25]);
		 				}
		 				if($charges[0]=="ROUNDING")
		 				{
		 				    $this->session->set_userdata('APBackOffice_ROUNDING_EQ',$charges[25]);
		 				}
		 				if($charges[0]=="BSE CLEARING CHGS")
		 				{
		 				    $this->session->set_userdata('APBackOffice_BSE_CLEARING_CHGS_EQ',$charges[25]);
		 				}
		 				if($charges[0]=="STAMP DUTY")
	    				{
	     					$this->session->set_userdata('APBackOffice_STAMP_DUTY_EQ',$charges[25]);
	    				}
	    				if($charges[0]=="STT")
	    				{
	     					$this->session->set_userdata('APBackOffice_STT_EQ',$charges[25]);
	    				}
	    				if($charges[0]=="SEBI FEES")
	    				{
	     					$this->session->set_userdata('APBackOffice_SEBI_FEES_EQ',$charges[25]);
	    				}
	    				if($charges[0]=="TOC BSE Exchange")
	    				{
	     					$this->session->set_userdata('APBackOffice_TOC_BSE_EQ',$charges[25]);
	    				}
	    				if($charges[0]=="TOC NSE Exchange")
	    				{
	     					$this->session->set_userdata('APBackOffice_TOC_NSE_EQ',$charges[25]);
	    				}
	    			}
				}
				if(!isset($_SESSION['APBackOffice_CGST_EQ']))
				{
					$this->session->set_userdata('APBackOffice_CGST_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_SGST_EQ']))
				{
					$this->session->set_userdata('APBackOffice_SGST_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_STAMP_DUTY_EQ']))
				{
					$this->session->set_userdata('APBackOffice_STAMP_DUTY_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_STT_EQ']))
				{
					$this->session->set_userdata('APBackOffice_STT_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_SEBI_FEES_EQ']))
				{
					$this->session->set_userdata('APBackOffice_SEBI_FEES_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_TOC_BSE_EQ']))
				{
					$this->session->set_userdata('APBackOffice_TOC_BSE_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_TOC_NSE_EQ']))
				{
					$this->session->set_userdata('APBackOffice_TOC_NSE_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_ROUNDING_EQ']))
				{
					$this->session->set_userdata('APBackOffice_ROUNDING_EQ','0');
				}
				if(!isset($_SESSION['APBackOffice_BSE_CLEARING_CHGS_EQ']))
				{
					$this->session->set_userdata('APBackOffice_BSE_CLEARING_CHGS_EQ','0');
				}
				// echo "<pre>";
				// print_r($equity_pnl_all_GlobalDetail);
				// exit();

				#########################API FA DAY
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year_charges=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year_charges);
				    $year_charges=$finacial_years_charges['year'];
				    $p_year_charges=$finacial_years_charges['p_year'];
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				else
				{
				    $year_charges=date("Y");
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year);
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				################################# JV Start######################
				$yestarday_balance_2_charges="0";
				$yestarday_balance_2_charges_P="0";
				$yestarday_balance_2_charges_R="0";
				$api_url_jv = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=BSE_CASH,NSE_CASH&TRANS_TYPE=J&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_jv;
				// exit();
				$model = $this->load->model("Api_model");
				$result_jv = $this->Api_model->api_data_get($api_url_jv);

			    $array_jv = json_decode($result_jv);

			    if(!empty($array_jv))
				{
				    $Client_jv = $array_jv[0];
				    $jv = 0;
			
				    foreach ($Client_jv as $value_jv) 
				    {
				    	$farray_jv[$jv] = $value_jv;
						$jv++;
					}
				}
				if(empty($farray_jv[1]))
				{
					$actual_jv="";
				}
				else
				{
					$act_jv=$farray_jv[1];
					$act_jv_all=$farray_jv;
					// $actual_jv=$act_jv[0][3];
					foreach ($act_jv as $key => $row) {
				 	$sort[$key] = strtotime(date_format(date_create(str_replace(",", "", $row[7])),"Y/m/d"));
					}
					array_multisort($sort, SORT_ASC, $act_jv);

					$iv = 0;
	                $yestarday_balance_charges = 0;
	                $yestarday_balance_2_charges = 0;
	                foreach ($act_jv as $key_index => $data_row) 
	                {
		                if (str_contains($act_jv[$iv][13], 'FUND TRANSFER') || str_contains($act_jv[$iv][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_jv[$iv][12] != "" || $act_jv[$iv][11] != "")
                            {
                                if($act_jv[$iv][12] == 0)
                                {
                                    $yestarday_balance_charges -= $act_jv[$iv][11];
                                    $yestarday_balance_2_charges += $act_jv[$iv][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges += $act_jv[$iv][12];
                                    $yestarday_balance_2_charges -= $act_jv[$iv][12];
                                }
                            }
		                }
		                $iv++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges))
                    { 
                        $yestarday_balance_2_charges = $yestarday_balance_2_charges <= 0 ? abs($yestarday_balance_2_charges) : -$yestarday_balance_2_charges ;
                        // echo ($yestarday_balance_2_charges);
                    }
                    else
                    {
                        $yestarday_balance_2_charges="0";
                    }
				}
				################################# JV End######################
				################################# Payment Start######################
				$api_url_P = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=BSE_CASH,NSE_CASH&TRANS_TYPE=P&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_P;
				// exit();
				$model = $this->load->model("Api_model");
				$result_P = $this->Api_model->api_data_get($api_url_P);

			    $array_P = json_decode($result_P);

			    if(!empty($array_P))
				{
				    $Client_P = $array_P[0];
				    $_P = 0;
			
				    foreach ($Client_P as $value_P) 
				    {
				    	$farray_P[$_P] = $value_P;
						$_P++;
					}
				}
				if(empty($farray_P[1]))
				{
					$actual_P="";
				}
				else
				{
					$act_P=$farray_P[1];
					$act_P_all=$farray_P;
					// $actual_P=$act_P[0][3];
					foreach ($act_P as $key_P => $row_P) {
				 	$sort_P[$key_P] = strtotime(date_format(date_create(str_replace(",", "", $row_P[7])),"Y/m/d"));
					}
					array_multisort($sort_P, SORT_ASC, $act_P);

					$i_P = 0;
	                $yestarday_balance_charges_P = 0;
	                $yestarday_balance_2_charges_P = 0;
	                foreach ($act_P as $key_index_P => $data_row) 
	                {
		                if (str_contains($act_P[$i_P][13], 'FUND TRANSFER') || str_contains($act_P[$i_P][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_P[$i_P][12] != "" || $act_P[$i_P][11] != "")
                            {
                                if($act_P[$i_P][12] == 0)
                                {
                                    $yestarday_balance_charges_P -= $act_P[$i_P][11];
                                    $yestarday_balance_2_charges_P += $act_P[$i_P][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_P += $act_P[$i_P][12];
                                    $yestarday_balance_2_charges_P -= $act_P[$i_P][12];
                                }
                            }
		                }
		                $i_P++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_P))
                    { 
                        $yestarday_balance_2_charges_P = $yestarday_balance_2_charges_P <= 0 ? abs($yestarday_balance_2_charges_P) : -$yestarday_balance_2_charges_P ;
                        // echo ($yestarday_balance_2_charges_P);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_P="0";
                    }
				}
				################################# Payment End ######################
				################################# Receipt Start ######################
				$api_url_R = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=BSE_CASH,NSE_CASH&TRANS_TYPE=R&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_R;
				// exit();
				$model = $this->load->model("Api_model");
				$result_R = $this->Api_model->api_data_get($api_url_R);

			    $array_R = json_decode($result_R);

			    if(!empty($array_R))
				{
				    $Client_R = $array_R[0];
				    $_R = 0;
			
				    foreach ($Client_R as $value_R) 
				    {
				    	$farray_R[$_R] = $value_R;
						$_R++;
					}
				}
				if(empty($farray_R[1]))
				{
					$actual_R="";
				}
				else
				{
					$act_R=$farray_R[1];
					$act_R_all=$farray_R;
					// $actual_R=$act_R[0][3];
					foreach ($act_R as $key_R => $row_R) {
				 	$sort_R[$key_R] = strtotime(date_format(date_create(str_replace(",", "", $row_R[7])),"Y/m/d"));
					}
					array_multisort($sort_R, SORT_ASC, $act_R);

					$i_R = 0;
	                $yestarday_balance_charges_R = 0;
	                $yestarday_balance_2_charges_R = 0;
	                foreach ($act_R as $key_index_R => $data_row) 
	                {
		                if (str_contains($act_R[$i_R][13], 'FUND TRANSFER') || str_contains($act_R[$i_R][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_R[$i_R][12] != "" || $act_R[$i_R][11] != "")
                            {
                                if($act_R[$i_R][12] == 0)
                                {
                                    $yestarday_balance_charges_R -= $act_R[$i_R][11];
                                    $yestarday_balance_2_charges_R += $act_R[$i_R][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_R += $act_R[$i_R][12];
                                    $yestarday_balance_2_charges_R -= $act_R[$i_R][12];
                                }
                            }
		                }
		                $i_R++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_R))
                    { 
                        $yestarday_balance_2_charges_R = $yestarday_balance_2_charges_R <= 0 ? abs($yestarday_balance_2_charges_R) : -$yestarday_balance_2_charges_R ;
                        // echo ($yestarday_balance_2_charges_R);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_R="0";
                    }
				}
				################################# Receipt End ######################
				#########################API FA DAY
				$this->session->set_userdata('ApbackOffice_client_hold_profit_and_loss',$holdings);
				$this->session->set_userdata('ApbackOffice_client_shortterm_profit_and_loss',$realized_non_zero);
				$this->session->set_userdata('ApbackOffice_client_intraday_profit_and_loss',$intraday_total);
				$this->session->set_userdata('ApbackOffice_client_longterm_profit_and_loss',$longterm_total);
				$this->session->set_userdata('ApbackOffice_client_Broekrage_profit_and_loss',$actual_brokerage);
				$this->session->set_userdata('ApbackOffice_client_JV_charges_profit_and_loss',$yestarday_balance_2_charges);
				$this->session->set_userdata('ApbackOffice_client_P_charges_profit_and_loss',$yestarday_balance_2_charges_P);
				$this->session->set_userdata('ApbackOffice_client_R_charges_profit_and_loss',$yestarday_balance_2_charges_R);

				$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
				$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
				$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];
				$data=array($client_code,$client_name,$pan);

			$this->load->view('User/PDF/equity_pnl.php',["data"=>$data,'final_convert_date_new_todate_eq'=>$final_convert_date_new_todate_eq,'final_convert_date_new_fromdate'=>$final_convert_date_new_fromdate,"equity_pnl_GlobalDetail"=>$equity_pnl_GlobalDetail,'equity_pnl_all_GlobalDetail'=>$equity_pnl_all_GlobalDetail,"LONGTERM"=>$LONGTERM,"TRADING"=>$TRADING,"ASSETS"=>$ASSETS,"SHORTTERM"=>$SHORTTERM,"LIABILITIES"=>$LIABILITIES]);
			}
				
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
			$this->load->view('User/header.php');
			$this->load->view('User/Account/profitandloss.php');
			$this->load->view('User/footer.php');
		}
	}
	//PROFIT AND LOSS 84 REPORTS END
	public function client_master()
	{
		if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
		{
			$ses_client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
				$year=$_SESSION['finacial_year_apbackoffice'];
			}
			else
			{
				$year=date("Y");
			}
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientList/ClientList?&CLIENT_ID=".$ses_client_code."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

				$arr = json_decode($result);
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
					$this->session->set_userdata('ApbackOffice_client_client_master_data',$farray);
				}
			$this->load->view('User/PDF/client_master.php');
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
			$this->load->view('User/header.php');
			$this->load->view('User/Account/profitandloss.php');
			$this->load->view('User/footer.php');
		}

	}



	public function CDS_PNL()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
		if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
		{

			$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];

			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range_fo($year);
			    $year=$finacial_years['year'];
			    $final_convert_date_new_fromdate=$finacial_years['start_date'];
			    $final_convert_date_new_todate_cd=$finacial_years['end_date'];
			}
			else
			{
			    $year=date("Y");
			    $finacial_years=$this->get_finacial_year_range_fo($year);
			    $final_convert_date_new_fromdate=$finacial_years['start_date'];
			    $final_convert_date_new_todate_cd=$finacial_years['end_date'];
			}

			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=CD_NSE&Client_Code=".$client_code."&Finstyr=".$year."&To_date=".$final_convert_date_new_todate_cd."&WITHOpening=".$exp."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
			// echo $api_url;
			// exit();
			$model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);

			$arr = json_decode($result);
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
				$cds_pnl=$farray[1];
				$cds_pnl_all=$farray;

				// echo "<pre>";
				// print_r($cds_pnl);
				// exit();
				if(empty($cds_pnl))
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
					redirect(base_url('Accounts/profit_and_loss'));
				}
				else
				{
					$cd_future_total=0;
					$cd_future_turnover=0;
					$cd_options_total=0;
					$cd_options_turnover=0;
					$total_buy_value_future=0;
					$total_sell_value_future=0;
					$total_buy_value_options=0;
					$total_sell_value_options=0;
					$cds_future_data="0";
					$cds_option_data="0";

					foreach ($cds_pnl as $key => $value) 
					{

					   if(!preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="CD_NSE" && $value[22]=="FO")
					   		{
					   			$cds_future_data="1";
					   			$cd_future_total+=$value[10];
					   			$cd_future_turnover+=$value[4];

					   			$total_buy_value_future+=$value[4];
            					$total_sell_value_future+=$value[7];
					   		}
					   	}
					   	if(preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="CD_NSE" && $value[22]=="FO")
					   		{
					   			$cds_option_data="1";
					   			$cd_options_total+=$value[10];
					   			// $cd_options_turnover+=$value[4];

					   			$total_buy_value_options+=$value[4];
            					$total_sell_value_options+=$value[7];
					   		}
					   	}
					}
					// $cd_future_turnover=$
					// $cd_options_turnover=$
					$cd_future_turnover=$total_buy_value_future+$total_sell_value_future;
					$cd_options_turnover=$total_buy_value_options+$total_sell_value_options;
				}
					// exit();
				// echo "<pre>";
				// print_r($api_url);
				// exit();
				//Start ACTUAL Brokerage API
					$api_url_actbrk = "192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$final_convert_date_new_fromdate."&TO_DATE=".$final_convert_date_new_todate_cd."&COMPANY_CODE=CD_NSE&CLIENT_ID=".$client_code."&BRANCH=&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

					$model = $this->load->model("Api_model");
					$result_actbrk = $this->Api_model->api_data_get($api_url_actbrk);

					 $array = json_decode($result_actbrk);

					 if(!empty($array))
					{
					    $Client_actbrk = $array[0];
					    $j = 0;
					
					    foreach ($Client_actbrk as $value_brk) 
					    {
					    	$farray_actbrk[$j] = $value_brk;
							$j++;
						}
					}
					if(empty($farray_actbrk[1]))
					{
						$actual_brokerage="";
					}
					else
					{
						$actbrk=$farray_actbrk[1];
						$actbrk_all=$farray_actbrk;
						$actual_brokerage=$actbrk[0][3];
					}

					foreach ($cds_pnl as $key => $charges)
					{
						if($charges[35]=="EXPENSES")
	   					{  
						    if($charges[32]=="CGST")
						    {
						        $this->session->set_userdata('APBackOffice_CGST_CD',$charges[4]);
						    }
						    if($charges[32]=="SGST")
			 				{
			 				    $this->session->set_userdata('APBackOffice_SGST_CD',$charges[4]);
			 				}
				 				if($charges[32]=="STAMP DUTY")
			    				{
			     					$this->session->set_userdata('APBackOffice_STAMP_DUTY_CD',$charges[4]);
			    				}
			    				
		    				if($charges[32]=="SEBI FEES")
		    				{
		     					$this->session->set_userdata('APBackOffice_SEBI_FEES_CD',$charges[4]);
		    				}
		    	
		    				if($charges[32]=="TOC NSE Exchange")
		    				{
		     					$this->session->set_userdata('APBackOffice_TOC_NSE_CD',$charges[4]);
		    				}
		    			}
					}
					#########################API FA DAY
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year_charges=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year_charges);
				    $year_charges=$finacial_years_charges['year'];
				    $p_year_charges=$finacial_years_charges['p_year'];
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				else
				{
				    $year_charges=date("Y");
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year);
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				################################# JV Start######################
				$yestarday_balance_2_charges="0";
				$yestarday_balance_2_charges_P="0";
				$yestarday_balance_2_charges_R="0";
				$api_url_jv = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=CD_NSE&TRANS_TYPE=J&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_jv;
				// exit();
				$model = $this->load->model("Api_model");
				$result_jv = $this->Api_model->api_data_get($api_url_jv);

			    $array_jv = json_decode($result_jv);

			    if(!empty($array_jv))
				{
				    $Client_jv = $array_jv[0];
				    $jv = 0;
			
				    foreach ($Client_jv as $value_jv) 
				    {
				    	$farray_jv[$jv] = $value_jv;
						$jv++;
					}
				}
				if(empty($farray_jv[1]))
				{
					$actual_jv="";
				}
				else
				{
					$act_jv=$farray_jv[1];
					$act_jv_all=$farray_jv;
					// $actual_jv=$act_jv[0][3];
					foreach ($act_jv as $key => $row) {
				 	$sort[$key] = strtotime(date_format(date_create(str_replace(",", "", $row[7])),"Y/m/d"));
					}
					array_multisort($sort, SORT_ASC, $act_jv);

					$iv = 0;
	                $yestarday_balance_charges = 0;
	                $yestarday_balance_2_charges = 0;
	                foreach ($act_jv as $key_index => $data_row) 
	                {
		                if (str_contains($act_jv[$iv][13], 'FUND TRANSFER') || str_contains($act_jv[$iv][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_jv[$iv][12] != "" || $act_jv[$iv][11] != "")
                            {
                                if($act_jv[$iv][12] == 0)
                                {
                                    $yestarday_balance_charges -= $act_jv[$iv][11];
                                    $yestarday_balance_2_charges += $act_jv[$iv][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges += $act_jv[$iv][12];
                                    $yestarday_balance_2_charges -= $act_jv[$iv][12];
                                }
                            }
		                }
		                $iv++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges))
                    { 
                        $yestarday_balance_2_charges = $yestarday_balance_2_charges <= 0 ? abs($yestarday_balance_2_charges) : -$yestarday_balance_2_charges ;
                        // echo ($yestarday_balance_2_charges);
                    }
                    else
                    {
                        $yestarday_balance_2_charges="0";
                    }
				}
				################################# JV End######################
				################################# Payment Start######################
				$api_url_P = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=CD_NSE&TRANS_TYPE=P&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_P;
				// exit();
				$model = $this->load->model("Api_model");
				$result_P = $this->Api_model->api_data_get($api_url_P);

			    $array_P = json_decode($result_P);

			    if(!empty($array_P))
				{
				    $Client_P = $array_P[0];
				    $_P = 0;
			
				    foreach ($Client_P as $value_P) 
				    {
				    	$farray_P[$_P] = $value_P;
						$_P++;
					}
				}
				if(empty($farray_P[1]))
				{
					$actual_P="";
				}
				else
				{
					$act_P=$farray_P[1];
					$act_P_all=$farray_P;
					// $actual_P=$act_P[0][3];
					foreach ($act_P as $key_P => $row_P) {
				 	$sort_P[$key_P] = strtotime(date_format(date_create(str_replace(",", "", $row_P[7])),"Y/m/d"));
					}
					array_multisort($sort_P, SORT_ASC, $act_P);

					$i_P = 0;
	                $yestarday_balance_charges_P = 0;
	                $yestarday_balance_2_charges_P = 0;
	                foreach ($act_P as $key_index_P => $data_row) 
	                {
		                if (str_contains($act_P[$i_P][13], 'FUND TRANSFER') || str_contains($act_P[$i_P][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_P[$i_P][12] != "" || $act_P[$i_P][11] != "")
                            {
                                if($act_P[$i_P][12] == 0)
                                {
                                    $yestarday_balance_charges_P -= $act_P[$i_P][11];
                                    $yestarday_balance_2_charges_P += $act_P[$i_P][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_P += $act_P[$i_P][12];
                                    $yestarday_balance_2_charges_P -= $act_P[$i_P][12];
                                }
                            }
		                }
		                $i_P++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_P))
                    { 
                        $yestarday_balance_2_charges_P = $yestarday_balance_2_charges_P <= 0 ? abs($yestarday_balance_2_charges_P) : -$yestarday_balance_2_charges_P ;
                        // echo ($yestarday_balance_2_charges_P);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_P="0";
                    }
				}
				################################# Payment End ######################
				################################# Receipt Start ######################
				$api_url_R = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=CD_NSE&TRANS_TYPE=R&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_R;
				// exit();
				$model = $this->load->model("Api_model");
				$result_R = $this->Api_model->api_data_get($api_url_R);

			    $array_R = json_decode($result_R);

			    if(!empty($array_R))
				{
				    $Client_R = $array_R[0];
				    $_R = 0;
			
				    foreach ($Client_R as $value_R) 
				    {
				    	$farray_R[$_R] = $value_R;
						$_R++;
					}
				}
				if(empty($farray_R[1]))
				{
					$actual_R="";
				}
				else
				{
					$act_R=$farray_R[1];
					$act_R_all=$farray_R;
					// $actual_R=$act_R[0][3];
					foreach ($act_R as $key_R => $row_R) {
				 	$sort_R[$key_R] = strtotime(date_format(date_create(str_replace(",", "", $row_R[7])),"Y/m/d"));
					}
					array_multisort($sort_R, SORT_ASC, $act_R);

					$i_R = 0;
	                $yestarday_balance_charges_R = 0;
	                $yestarday_balance_2_charges_R = 0;
	                foreach ($act_R as $key_index_R => $data_row) 
	                {
		                if (str_contains($act_R[$i_R][13], 'FUND TRANSFER') || str_contains($act_R[$i_R][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_R[$i_R][12] != "" || $act_R[$i_R][11] != "")
                            {
                                if($act_R[$i_R][12] == 0)
                                {
                                    $yestarday_balance_charges_R -= $act_R[$i_R][11];
                                    $yestarday_balance_2_charges_R += $act_R[$i_R][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_R += $act_R[$i_R][12];
                                    $yestarday_balance_2_charges_R -= $act_R[$i_R][12];
                                }
                            }
		                }
		                $i_R++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_R))
                    { 
                        $yestarday_balance_2_charges_R = $yestarday_balance_2_charges_R <= 0 ? abs($yestarday_balance_2_charges_R) : -$yestarday_balance_2_charges_R ;
                        // echo ($yestarday_balance_2_charges_R);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_R="0";
                    }
				}
				################################# Receipt End ######################
				#########################API FA DAY

					$this->session->set_userdata('ApbackOffice_client_cd_future_total_profit_and_loss',$cd_future_total);
					$this->session->set_userdata('ApbackOffice_client_cd_options_total_profit_and_loss',$cd_options_total);
					$this->session->set_userdata('ApbackOffice_client_cd_future_turnover_turnover_profit_and_loss',$cd_future_turnover);
					$this->session->set_userdata('ApbackOffice_client_cd_options_turnover_profit_and_loss',$cd_options_turnover);
					$this->session->set_userdata('ApbackOffice_client_cd_Broekrage_profit_and_loss',$actual_brokerage);
					$this->session->set_userdata('ApbackOffice_client_JV_charges_CDS_profit_and_loss',$yestarday_balance_2_charges);
					$this->session->set_userdata('ApbackOffice_client_P_charges_CDS_profit_and_loss',$yestarday_balance_2_charges_P);
					$this->session->set_userdata('ApbackOffice_client_R_charges_CDS_profit_and_loss',$yestarday_balance_2_charges_R);

					$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
					$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
					$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];
					$data=array($client_code,$client_name,$pan);
					$this->load->view('User/PDF/cds_pnl.php',["data"=>$data,"final_convert_date_new_fromdate"=>$final_convert_date_new_fromdate,"final_convert_date_new_todate_cd"=>$final_convert_date_new_todate_cd,"cds_pnl"=>$cds_pnl,"cds_pnl_all"=>$cds_pnl_all,'cds_option_data'=>$cds_option_data,'cds_future_data'=>$cds_future_data]);
			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
				$this->load->view('User/header.php');
				$this->load->view('User/Account/profitandloss.php');
				$this->load->view('User/footer.php');
			}
	}
	else
	{
		redirect(base_url('Dashboard'));
	}
	}
	public function ledger_PNL()
	{
		if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
		{
			ob_start('ob_gzhandler');

			$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			$exchange_code = "BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF";
			$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];

			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range_ledger($year);
			    $year=$finacial_years['year'];
			    $final_convert_date_new_fromdate=$finacial_years['start_date'];
			    $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
			}
			else
			{
			    $year=date("Y");
			    $finacial_years=$this->get_finacial_year_range_ledger($year);
			    $final_convert_date_new_fromdate=$finacial_years['start_date'];
			    $final_convert_date_new_todate_ledger=$finacial_years['end_date'];
			}
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$final_convert_date_new_fromdate."&ToDate=".$final_convert_date_new_todate_ledger."&Client_code=".$client_code."&COCDLIST=".$exchange_code."&ShowMargin=".$exp."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
			// echo $api_url;
			// exit();
				$model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);

			$arr = json_decode($result);

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

			$ledger_PNL=$farray[1];
			$ledger_PNL_ALL=$farray;

			$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
			$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];
			$data=array($client_code,$client_name,$pan);

			$this->load->view('User/PDF/ledger_pnl.php',["data"=>$data,'final_convert_date_new_todate_ledger'=>$final_convert_date_new_todate_ledger,'final_convert_date_new_fromdate'=>$final_convert_date_new_fromdate,"ledger_PNL"=>$ledger_PNL,'ledger_PNL_ALL'=>$ledger_PNL_ALL]);
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
		
	}
	function get_finacial_year_range_ledger($year)
	{
		$month = date('m');
		$year_r = date('Y');
		if($month<4){
		    $year = $year-1;
		}
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
	function get_finacial_year_range_fo($year)
	{
		$month = date('m');
		$year_r = date('Y');
		if($month<4){
		    $year = $year-1;
		}
		if($year_r==$year){
		    $year = $year-1;
		}
		// echo $year;
		// exit();
		$start_date = date('d/m/Y',strtotime(($year).'-03-31'));
		$end_date = date('d/m/Y',strtotime(($year+1).'-04-01'));
		$response = array('start_date' => $start_date, 'end_date' => $end_date,'year'=>$year);
		// print_r($response);
		// exit();
		return $response;
	}
	public function FO_PNL()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
			{
				$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
				$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];

				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $year=$finacial_years['year'];
				    $p_year=$year-1;
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_fo=$finacial_years['end_date'];
				}
				else
				{
				    $year=date("Y");
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_fo=$finacial_years['end_date'];
				}

				// if(2022>=$_SESSION['finacial_year_apbackoffice'])
				// {
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=NSE_FNO&Client_Code=".$client_code."&Finstyr=".$p_year."&To_date=".$final_convert_date_new_todate_fo."&WITHOpening=Y&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year."";
				// echo $api_url;exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result);

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
				$fo_pnl=[];
				$fo_pnl_all=[];

				if (isset($farray)) {

					$fo_pnl=$farray[1];
					$fo_pnl_all=$farray;
				}
				// echo "<pre>";
				// print_r($fo_pnl);
				// exit();
				if(empty($fo_pnl))
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
					redirect(base_url('Accounts/profit_and_loss'));
				}
				else
				{
					$future_total=0;
					$future_turnover=0;
					$options_total=0;
					$options_turnover=0;
					$future_unrealized=0;
					$options_unrealized=0;

					$total_buy_value_future=0;
					$total_sell_value_future=0;
					$total_buy_value_options=0;
					$total_sell_value_options=0;
					$fo_future_data="0";
					$fo_option_data="0";
					$Notional_future=0;
					$Notional_options=0;

					foreach ($fo_pnl as $key => $value)
					{
					   if(!preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="NSE_FNO" && $value[22]=="FO")
					   		{
					   			$fo_future_data="1";
					   			$future_total+=$value[10];
					   			$future_turnover+=$value[4];
					   			$future_unrealized+=$value[8];
					   			$total_buy_value_future+=$value[4];
            					$total_sell_value_future+=$value[7];
            					$Notional_future+=abs($value[14]);
					   		}
					   	}
					   	if(preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="NSE_FNO" && $value[22]=="FO")
					   		{
					   			$fo_option_data="1";
					   			$options_total+=$value[10];
					   			$options_turnover+=$value[4];
					   			$options_unrealized+=$value[8];
					   			$total_buy_value_options+=$value[4];
            					$total_sell_value_options+=$value[7];
            					$Notional_options+=abs($value[14]);
					   		}
					   	}
					}
					$total_future_turnover=$Notional_future;
					$total_options_turnover=$Notional_options;

					if(isset($_SESSION['APBackOffice_TURN_OVER_CHARGE']))
					{
						unset($_SESSION['APBackOffice_TURN_OVER_CHARGE']);
						$this->session->set_userdata('APBackOffice_TURN_OVER_CHARGE','0');
					}
					if(isset($_SESSION['APBackOffice_STT']))
					{
						unset($_SESSION['APBackOffice_STT']);
						$this->session->set_userdata('APBackOffice_STT','0');
					}
					if(isset($_SESSION['APBackOffice_CGST']))
					{
						unset($_SESSION['APBackOffice_CGST']);
						$this->session->set_userdata('APBackOffice_CGST','0');
					}
					if(isset($_SESSION['APBackOffice_IGST']))
					{
						unset($_SESSION['APBackOffice_IGST']);
						$this->session->set_userdata('APBackOffice_IGST','0');
					}
					if(isset($_SESSION['APBackOffice_SGST']))
					{
						unset($_SESSION['APBackOffice_SGST']);
						$this->session->set_userdata('APBackOffice_SGST','0');
					}
					if(isset($_SESSION['APBackOffice_STAMP_DUTY']))
					{
						unset($_SESSION['APBackOffice_STAMP_DUTY']);
						$this->session->set_userdata('APBackOffice_STAMP_DUTY','0');
					}
					if(isset($_SESSION['APBackOffice_SEBI_FEES']))
					{
						unset($_SESSION['APBackOffice_SEBI_FEES']);
						$this->session->set_userdata('APBackOffice_SEBI_FEES','0');
					}
					if(isset($_SESSION['APBackOffice_CLEARING_CHARGES']))
					{
						unset($_SESSION['APBackOffice_CLEARING_CHARGES']);
						$this->session->set_userdata('APBackOffice_CLEARING_CHARGES','0');
					}

					foreach ($fo_pnl as $key => $value)
					{
					    if($value[32]=="TURN OVER CHARGE")
					    {
					        $this->session->set_userdata('APBackOffice_TURN_OVER_CHARGE',$value[4]);
					    }
					    if($value[32]=="STT")
	    				{
	    				    $this->session->set_userdata('APBackOffice_STT',$value[4]);
	    				}
	    				if($value[32]=="CGST")
    					{
        					$this->session->set_userdata('APBackOffice_CGST',$value[4]);
    					}
    					if($value[32]=="IGST")
    					{
        					$this->session->set_userdata('APBackOffice_IGST',$value[4]);
    					}
    					if($value[32]=="SGST")
    					{
        					$this->session->set_userdata('APBackOffice_SGST',$value[4]);
    					}
    					if($value[32]=="STAMP DUTY")
    					{
        					$this->session->set_userdata('APBackOffice_STAMP_DUTY',$value[4]);
    					}
    					if($value[32]=="SEBI FEES")
    					{
        					$this->session->set_userdata('APBackOffice_SEBI_FEES',$value[4]);
    					}
    					if($value[32]=="CLEARING CHARGES")
    					{
        					$this->session->set_userdata('APBackOffice_CLEARING_CHARGES',$value[4]);
    					}
					}
					if(!isset($_SESSION['APBackOffice_TURN_OVER_CHARGE']))
					{
						$this->session->set_userdata('APBackOffice_TURN_OVER_CHARGE','0');
					}
					if(!isset($_SESSION['APBackOffice_STT']))
					{
						$this->session->set_userdata('APBackOffice_STT','0');
					}
					if(!isset($_SESSION['APBackOffice_CGST']))
					{
						$this->session->set_userdata('APBackOffice_CGST','0');
					}
					if(!isset($_SESSION['APBackOffice_IGST']))
					{
						$this->session->set_userdata('APBackOffice_IGST','0');
					}
					if(!isset($_SESSION['APBackOffice_SGST']))
					{
						$this->session->set_userdata('APBackOffice_SGST','0');
					}
					if(!isset($_SESSION['APBackOffice_STAMP_DUTY']))
					{
						$this->session->set_userdata('APBackOffice_STAMP_DUTY','0');
					}
					if(!isset($_SESSION['APBackOffice_SEBI_FEES']))
					{
						$this->session->set_userdata('APBackOffice_SEBI_FEES','0');
					}
					if(!isset($_SESSION['APBackOffice_CLEARING_CHARGES']))
					{
						$this->session->set_userdata('APBackOffice_CLEARING_CHARGES','0');
					}
					//Start ACTUAL Brokerage API
					$api_url_actbrk = "192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$final_convert_date_new_fromdate."&TO_DATE=".$final_convert_date_new_todate_fo."&COMPANY_CODE=NSE_FNO&CLIENT_ID=".$client_code."&BRANCH=&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

					$model = $this->load->model("Api_model");
					$result_actbrk = $this->Api_model->api_data_get($api_url_actbrk);

					 $array = json_decode($result_actbrk);

					 if(!empty($array))
					{
					    $Client_actbrk = $array[0];
					    $j = 0;
					
					    foreach ($Client_actbrk as $value_brk) 
					    {
					    	$farray_actbrk[$j] = $value_brk;
							$j++;
						}
					}
					if(empty($farray_actbrk[1]))
					{
						$actual_brokerage="";
					}
					else
					{
						$actbrk=$farray_actbrk[1];
						$actbrk_all=$farray_actbrk;
						$actual_brokerage=$actbrk[0][3];
					}
					// echo $actual_brokerage;exit();
					//End Actual Brokerage Api

					#########################API FA DAY
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year_charges=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year_charges);
				    $year_charges=$finacial_years_charges['year'];
				    $p_year_charges=$finacial_years_charges['p_year'];
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				else
				{
				    $year_charges=date("Y");
				    $finacial_years_charges=$this->get_finacial_year_range_charges($year);
				    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
				    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
				}
				################################# JV Start######################
				$api_url_jv = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=NSE_FNO&TRANS_TYPE=J&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_jv;
				// exit();
				$model = $this->load->model("Api_model");
				$result_jv = $this->Api_model->api_data_get($api_url_jv);

			    $array_jv = json_decode($result_jv);

			    if(!empty($array_jv))
				{
				    $Client_jv = $array_jv[0];
				    $jv = 0;
			
				    foreach ($Client_jv as $value_jv) 
				    {
				    	$farray_jv[$jv] = $value_jv;
						$jv++;
					}
				}
				if(empty($farray_jv[1]))
				{
					$actual_jv="";
					$yestarday_balance_charges = 0;
	                $yestarday_balance_2_charges = 0;
				}
				else
				{
					$act_jv=$farray_jv[1];
					$act_jv_all=$farray_jv;
					// $actual_jv=$act_jv[0][3];
					foreach ($act_jv as $key => $row) {
				 	$sort[$key] = strtotime(date_format(date_create(str_replace(",", "", $row[7])),"Y/m/d"));
					}
					array_multisort($sort, SORT_ASC, $act_jv);

					$iv = 0;
	                $yestarday_balance_charges = 0;
	                $yestarday_balance_2_charges = 0;
	                foreach ($act_jv as $key_index => $data_row) 
	                {
		                if (str_contains($act_jv[$iv][13], 'FUND TRANSFER') || str_contains($act_jv[$iv][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_jv[$iv][12] != "" || $act_jv[$iv][11] != "")
                            {
                                if($act_jv[$iv][12] == 0)
                                {
                                    $yestarday_balance_charges -= $act_jv[$iv][11];
                                    $yestarday_balance_2_charges += $act_jv[$iv][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges += $act_jv[$iv][12];
                                    $yestarday_balance_2_charges -= $act_jv[$iv][12];
                                }
                            }
		                }
		                $iv++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges))
                    { 
                        $yestarday_balance_2_charges = $yestarday_balance_2_charges <= 0 ? abs($yestarday_balance_2_charges) : -$yestarday_balance_2_charges ;
                        // echo ($yestarday_balance_2_charges);
                    }
                    else
                    {
                        $yestarday_balance_2_charges="0";
                    }
				}
				################################# JV End######################
				################################# Payment Start######################
				$api_url_P = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=NSE_FNO&TRANS_TYPE=P&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_P;
				// exit();
				$model = $this->load->model("Api_model");
				$result_P = $this->Api_model->api_data_get($api_url_P);

			    $array_P = json_decode($result_P);

			    if(!empty($array_P))
				{
				    $Client_P = $array_P[0];
				    $_P = 0;
			
				    foreach ($Client_P as $value_P) 
				    {
				    	$farray_P[$_P] = $value_P;
						$_P++;
					}
				}
				if(empty($farray_P[1]))
				{
					$actual_P="";
					$yestarday_balance_charges_P = 0;
	                $yestarday_balance_2_charges_P = 0;
				}
				else
				{
					$act_P=$farray_P[1];
					$act_P_all=$farray_P;
					// $actual_P=$act_P[0][3];
					foreach ($act_P as $key_P => $row_P) {
				 	$sort_P[$key_P] = strtotime(date_format(date_create(str_replace(",", "", $row_P[7])),"Y/m/d"));
					}
					array_multisort($sort_P, SORT_ASC, $act_P);

					$i_P = 0;
	                $yestarday_balance_charges_P = 0;
	                $yestarday_balance_2_charges_P = 0;
	                foreach ($act_P as $key_index_P => $data_row) 
	                {
		                if (str_contains($act_P[$i_P][13], 'FUND TRANSFER') || str_contains($act_P[$i_P][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_P[$i_P][12] != "" || $act_P[$i_P][11] != "")
                            {
                                if($act_P[$i_P][12] == 0)
                                {
                                    $yestarday_balance_charges_P -= $act_P[$i_P][11];
                                    $yestarday_balance_2_charges_P += $act_P[$i_P][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_P += $act_P[$i_P][12];
                                    $yestarday_balance_2_charges_P -= $act_P[$i_P][12];
                                }
                            }
		                }
		                $i_P++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_P))
                    { 
                        $yestarday_balance_2_charges_P = $yestarday_balance_2_charges_P <= 0 ? abs($yestarday_balance_2_charges_P) : -$yestarday_balance_2_charges_P ;
                        // echo ($yestarday_balance_2_charges_P);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_P="0";
                    }
				}
				################################# Payment End ######################
				################################# Receipt Start ######################
				$api_url_R = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=NSE_FNO&TRANS_TYPE=R&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
				// echo $api_url_R;
				// exit();
				$model = $this->load->model("Api_model");
				$result_R = $this->Api_model->api_data_get($api_url_R);

			    $array_R = json_decode($result_R);

			    if(!empty($array_R))
				{
				    $Client_R = $array_R[0];
				    $_R = 0;
			
				    foreach ($Client_R as $value_R) 
				    {
				    	$farray_R[$_R] = $value_R;
						$_R++;
					}
				}
				if(empty($farray_R[1]))
				{
					$actual_R="";
					$yestarday_balance_charges_R = 0;
	                $yestarday_balance_2_charges_R = 0;
				}
				else
				{
					$act_R=$farray_R[1];
					$act_R_all=$farray_R;
					// $actual_R=$act_R[0][3];
					foreach ($act_R as $key_R => $row_R) {
				 	$sort_R[$key_R] = strtotime(date_format(date_create(str_replace(",", "", $row_R[7])),"Y/m/d"));
					}
					array_multisort($sort_R, SORT_ASC, $act_R);

					$i_R = 0;
	                $yestarday_balance_charges_R = 0;
	                $yestarday_balance_2_charges_R = 0;
	                foreach ($act_R as $key_index_R => $data_row) 
	                {
		                if (str_contains($act_R[$i_R][13], 'FUND TRANSFER') || str_contains($act_R[$i_R][13], 'Inter Exchange')) {
		                }
		                else
		                {  
		                	if($act_R[$i_R][12] != "" || $act_R[$i_R][11] != "")
                            {
                                if($act_R[$i_R][12] == 0)
                                {
                                    $yestarday_balance_charges_R -= $act_R[$i_R][11];
                                    $yestarday_balance_2_charges_R += $act_R[$i_R][11];
                                }
                                else
                                {
                                	$yestarday_balance_charges_R += $act_R[$i_R][12];
                                    $yestarday_balance_2_charges_R -= $act_R[$i_R][12];
                                }
                            }
		                }
		                $i_R++;
	            	}
	            	// echo $yestarday_balance_charges;
	            	// exit();
	            	if(isset($yestarday_balance_2_charges_R))
                    { 
                        $yestarday_balance_2_charges_R = $yestarday_balance_2_charges_R <= 0 ? abs($yestarday_balance_2_charges_R) : -$yestarday_balance_2_charges_R ;
                        // echo ($yestarday_balance_2_charges_R);
                    }
                    else
                    {
                        $yestarday_balance_2_charges_R="0";
                    }
				}
				################################# Receipt End ######################
				#########################API FA DAY
					$this->session->set_userdata('ApbackOffice_client_future_profit_and_loss',$future_total);
					$this->session->set_userdata('ApbackOffice_client_future_turnover_profit_and_loss',$total_future_turnover);
					$this->session->set_userdata('ApbackOffice_client_future_unrealized_profit_and_loss',$future_unrealized);
					$this->session->set_userdata('ApbackOffice_client_options_profit_and_loss',$options_total);
					$this->session->set_userdata('ApbackOffice_client_options_turnover_profit_and_loss',$total_options_turnover);
					$this->session->set_userdata('ApbackOffice_client_options_unrealized_profit_and_loss',$options_unrealized);
					$this->session->set_userdata('ApbackOffice_client_fo_Broekrage_profit_and_loss',$actual_brokerage);
					$this->session->set_userdata('ApbackOffice_client_JV_charges_FO_profit_and_loss',$yestarday_balance_2_charges);
					$this->session->set_userdata('ApbackOffice_client_P_charges_FO_profit_and_loss',$yestarday_balance_2_charges_P);
					$this->session->set_userdata('ApbackOffice_client_R_charges_FO_profit_and_loss',$yestarday_balance_2_charges_R);
				}

					$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
					$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
					$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];
					// exit();
					$data=array($client_code,$client_name,$pan);
					$this->load->view('User/PDF/fo_pnl.php',["data"=>$data,'final_convert_date_new_todate_fo'=>$final_convert_date_new_todate_fo,'final_convert_date_new_fromdate'=>$final_convert_date_new_fromdate,"fo_pnl"=>$fo_pnl,"fo_pnl_all"=>$fo_pnl_all,"fo_future_data"=>$fo_future_data,"fo_option_data"=>$fo_option_data]);
				}
				else
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
					$this->load->view('User/header.php');
					$this->load->view('User/Account/profitandloss.php');
					$this->load->view('User/footer.php');
				}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function MUTUAL_FUNDS()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
		if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
		{

			$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			$from_date=$_SESSION['ApbackOffice_client_todate_profit_and_loss'];
			$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
				$year=$_SESSION['finacial_year_apbackoffice'];
			}
			else
			{
				$year=date("Y");
			}

			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ANNUAL_PNL_SUMMARY/ANNUAL_PNL_SUMMARY1?&Client_code=".$client_code."&ToDate=31/03/".$year."&WithExp=".$exp."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

			    $model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

			    $arr = json_decode($result);

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

				$mf_pnl=$farray[1];
				$mf_pnl_all=$farray;

				if(empty($mf_pnl))
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
					redirect(base_url('Accounts/profit_and_loss'));
				}
				else
				{
					// $shortterm_total=0;
					// $intraday_total=0;
					// $longterm_total=0;
					foreach ($mf_pnl as $key => $value) {
						
						// if($value[0]=="MF_BSE")
						// {
							echo "<pre>";
							print_r($mf_pnl_all);
						// }
					}
				}

				$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
				$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
				$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];
				$to_date=$_SESSION['ApbackOffice_client_todate_profit_and_loss'];
				$data=array($client_code,$client_name,$pan,$to_date);
				$this->load->view('User/PDF/mutual_funds.php',["data"=>$data]);
				
				
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
			$this->load->view('User/header.php');
			$this->load->view('User/Account/profitandloss.php');
			$this->load->view('User/footer.php');
		}
	}

	}
	public function Other_charges()
	{
		if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
		{

			$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
			$to_date=$_SESSION['ApbackOffice_client_todate_profit_and_loss'];
			$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
				$year=$_SESSION['finacial_year_apbackoffice'];
			}
			else
			{
				$year=date("Y");
			}
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ANNUAL_PNL_SUMMARY/ANNUAL_PNL_SUMMARY1?&Client_code=".$client_code."&ToDate=31/03/".$year."&WithExp=".$exp."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

			    $model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

			    $arr = json_decode($result);

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
				$charges_all=$farray;
				$charges_data=$farray[1];

				if(empty($charges_data))
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
					redirect(base_url('Accounts/profit_and_loss'));
				}
				else
				{
					foreach ($charges_data as $key => $value) {
						

					}
					// exit();
				}
			
			$this->load->view('User/PDF/Other_charges.php');	
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
			$this->load->view('User/header.php');
			$this->load->view('User/Account/profitandloss.php');
			$this->load->view('User/footer.php');
		}
	}
	public function COMMODITY_PNL()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_SESSION['ApbackOffice_client_code_profit_and_loss']))
			{
				$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
				$exp=$_SESSION['ApbackOffice_client_exp_profit_and_loss'];

				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $year=$finacial_years['year'];
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_fo=$finacial_years['end_date'];
				}
				else
				{
				    $year=date("Y");
				    $finacial_years=$this->get_finacial_year_range_fo($year);
				    $final_convert_date_new_fromdate=$finacial_years['start_date'];
				    $final_convert_date_new_todate_fo=$finacial_years['end_date'];
				}


				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=MCX&Client_Code=".$client_code."&Finstyr=".$year."&To_date=".$final_convert_date_new_todate_fo."&WITHOpening=Y&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
				// echo $api_url;exit();
				$model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result);

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
				$commodity_pnl=[];
				$commodity_pnl_all=[];

				if (isset($farray)) {

					$commodity_pnl=$farray[1];
					$commodity_pnl_all=$farray;
				}
				// echo "<pre>";
				// print_r($commodity_pnl);
				// exit();
				if(empty($commodity_pnl))
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Data Not Available.!!");
					redirect(base_url('Accounts/profit_and_loss'));
				}
				else
				{
					$future_total=0;
					$future_turnover=0;
					$options_total=0;
					$options_turnover=0;
					$future_unrealized=0;
					$options_unrealized=0;

					$total_buy_value_future=0;
					$total_sell_value_future=0;
					$total_buy_value_options=0;
					$total_sell_value_options=0;
					$commodity_future_data="0";
					$commodity_option_data="0";


					foreach ($commodity_pnl as $key => $value)
					{
					   if(!preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="MCX" && $value[22]=="FO")
					   		{
					   			$commodity_future_data="1";
					   			$future_total+=$value[10];
					   			$future_turnover+=$value[4];
					   			$future_unrealized+=$value[8];
					   			$total_buy_value_future+=$value[4];
            					$total_sell_value_future+=$value[7];
					   		}
					   	}
					   	if(preg_match("/\b(CE|PE)\b/", $value[31]))
					   	{
					   		if($value[27]=="MCX" && $value[22]=="FO")
					   		{
					   			$commodity_option_data="1";
					   			$options_total+=$value[10];
					   			$options_turnover+=$value[4];
					   			$options_unrealized+=$value[8];
					   			$total_buy_value_options+=$value[4];
            					$total_sell_value_options+=$value[7];
					   		}
					   	}
					}

					$total_future_turnover=$total_buy_value_future+$total_sell_value_future;
					$total_options_turnover=$total_buy_value_options+$total_sell_value_options;

					foreach ($commodity_pnl as $key => $value)
					{
					    if($value[32]=="TURN OVER CHARGE")
					    {
					        $this->session->set_userdata('APBackOffice_TURN_OVER_CHARGE',$value[4]);
					    }
					    if($value[32]=="CTT")
	    				{
	    				    $this->session->set_userdata('APBackOffice_CTT',$value[4]);
	    				}
	    				if($value[32]=="CGST")
    					{
        					$this->session->set_userdata('APBackOffice_CGST',$value[4]);
    					}
    					if($value[32]=="SGST")
    					{
        					$this->session->set_userdata('APBackOffice_SGST',$value[4]);
    					}
    					if($value[32]=="STAMP DUTY")
    					{
        					$this->session->set_userdata('APBackOffice_STAMP_DUTY',$value[4]);
    					}
    					if($value[32]=="SEBI FEES")
    					{
        					$this->session->set_userdata('APBackOffice_SEBI_FEES',$value[4]);
    					}
    					if($value[32]=="CLEARING CHARGES")
    					{
        					$this->session->set_userdata('APBackOffice_CLEARING_CHARGES',$value[4]);
    					}
					   
					}
					//Start ACTUAL Brokerage API
					$api_url_actbrk = "192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$final_convert_date_new_fromdate."&TO_DATE=".$final_convert_date_new_todate_fo."&COMPANY_CODE=MCX&CLIENT_ID=".$client_code."&BRANCH=&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

					$model = $this->load->model("Api_model");
					$result_actbrk = $this->Api_model->api_data_get($api_url_actbrk);

					 $array = json_decode($result_actbrk);

					 if(!empty($array))
					{
					    $Client_actbrk = $array[0];
					    $j = 0;
					
					    foreach ($Client_actbrk as $value_brk) 
					    {
					    	$farray_actbrk[$j] = $value_brk;
							$j++;
						}
					}
					if(empty($farray_actbrk[1]))
					{
						$actual_brokerage="";
					}
					else
					{
						$actbrk=$farray_actbrk[1];
						$actbrk_all=$farray_actbrk;
						$actual_brokerage=$actbrk[0][3];
					}
					// echo $actual_brokerage;exit();
					//End Actual Brokerage Api

					#########################API FA DAY
					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
					    $year_charges=$_SESSION['finacial_year_apbackoffice'];
					    $finacial_years_charges=$this->get_finacial_year_range_charges($year_charges);
					    $year_charges=$finacial_years_charges['year'];
					    $p_year_charges=$finacial_years_charges['p_year'];
					    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
					    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
					}
					else
					{
					    $year_charges=date("Y");
					    $finacial_years_charges=$this->get_finacial_year_range_charges($year);
					    $final_convert_date_new_fromdate_charges=$finacial_years_charges['start_date'];
					    $final_convert_date_new_todate_eq_charges=$finacial_years_charges['end_date'];
					}
					################################# JV Start######################
					$api_url_jv = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=MCX&TRANS_TYPE=J&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
					// echo $api_url_jv;
					// exit();
					$model = $this->load->model("Api_model");
					$result_jv = $this->Api_model->api_data_get($api_url_jv);

				    $array_jv = json_decode($result_jv);

				    if(!empty($array_jv))
					{
					    $Client_jv = $array_jv[0];
					    $jv = 0;
				
					    foreach ($Client_jv as $value_jv) 
					    {
					    	$farray_jv[$jv] = $value_jv;
							$jv++;
						}
					}
					if(empty($farray_jv[1]))
					{
						// echo "tet";
						$actual_jv="";
						$yestarday_balance_charges = 0;
		                $yestarday_balance_2_charges = 0;
					}
					else
					{
						echo "testst";
						$act_jv=$farray_jv[1];
						$act_jv_all=$farray_jv;
						// $actual_jv=$act_jv[0][3];
						foreach ($act_jv as $key => $row) {
					 	$sort[$key] = strtotime(date_format(date_create(str_replace(",", "", $row[7])),"Y/m/d"));
						}
						array_multisort($sort, SORT_ASC, $act_jv);

						$iv = 0;
		                $yestarday_balance_charges = 0;
		                $yestarday_balance_2_charges = 0;
		                foreach ($act_jv as $key_index => $data_row) 
		                {
			                if (str_contains($act_jv[$iv][13], 'FUND TRANSFER') || str_contains($act_jv[$iv][13], 'Inter Exchange')) {
			                }
			                else
			                {  
			                	if($act_jv[$iv][12] != "" || $act_jv[$iv][11] != "")
	                            {
	                                if($act_jv[$iv][12] == 0)
	                                {
	                                    $yestarday_balance_charges -= $act_jv[$iv][11];
	                                    $yestarday_balance_2_charges += $act_jv[$iv][11];
	                                }
	                                else
	                                {
	                                	$yestarday_balance_charges += $act_jv[$iv][12];
	                                    $yestarday_balance_2_charges -= $act_jv[$iv][12];
	                                }
	                            }
			                }
			                $iv++;
		            	}
		            	// echo $yestarday_balance_charges;
		            	// exit();
		            	if(isset($yestarday_balance_2_charges))
	                    { 
	                        $yestarday_balance_2_charges = $yestarday_balance_2_charges <= 0 ? abs($yestarday_balance_2_charges) : -$yestarday_balance_2_charges ;
	                        // echo ($yestarday_balance_2_charges);
	                    }
	                    else
	                    {
	                        $yestarday_balance_2_charges="0";
	                    }
					}
					// exit();
					################################# JV End######################
					################################# Payment Start######################
					$api_url_P = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=MCX&TRANS_TYPE=P&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
					// echo $api_url_P;
					// exit();
					$model = $this->load->model("Api_model");
					$result_P = $this->Api_model->api_data_get($api_url_P);

				    $array_P = json_decode($result_P);

				    if(!empty($array_P))
					{
					    $Client_P = $array_P[0];
					    $_P = 0;
				
					    foreach ($Client_P as $value_P) 
					    {
					    	$farray_P[$_P] = $value_P;
							$_P++;
						}
					}
					if(empty($farray_P[1]))
					{
						// echo "tert";
						$actual_P="";
						$yestarday_balance_charges_P = 0;
		                $yestarday_balance_2_charges_P = 0;
					}
					else
					{
						// echo "data";
						$act_P=$farray_P[1];
						$act_P_all=$farray_P;
						// $actual_P=$act_P[0][3];
						foreach ($act_P as $key_P => $row_P) {
					 	$sort_P[$key_P] = strtotime(date_format(date_create(str_replace(",", "", $row_P[7])),"Y/m/d"));
						}
						array_multisort($sort_P, SORT_ASC, $act_P);

						$i_P = 0;
		                $yestarday_balance_charges_P = 0;
		                $yestarday_balance_2_charges_P = 0;
		                foreach ($act_P as $key_index_P => $data_row) 
		                {
			                if (str_contains($act_P[$i_P][13], 'FUND TRANSFER') || str_contains($act_P[$i_P][13], 'Inter Exchange')) {
			                }
			                else
			                {  
			                	if($act_P[$i_P][12] != "" || $act_P[$i_P][11] != "")
	                            {
	                                if($act_P[$i_P][12] == 0)
	                                {
	                                    $yestarday_balance_charges_P -= $act_P[$i_P][11];
	                                    $yestarday_balance_2_charges_P += $act_P[$i_P][11];
	                                }
	                                else
	                                {
	                                	$yestarday_balance_charges_P += $act_P[$i_P][12];
	                                    $yestarday_balance_2_charges_P -= $act_P[$i_P][12];
	                                }
	                            }
			                }
			                $i_P++;
		            	}
		            	// echo $yestarday_balance_charges;
		            	// exit();
		            	if(isset($yestarday_balance_2_charges_P))
	                    { 
	                        $yestarday_balance_2_charges_P = $yestarday_balance_2_charges_P <= 0 ? abs($yestarday_balance_2_charges_P) : -$yestarday_balance_2_charges_P ;
	                        // echo ($yestarday_balance_2_charges_P);
	                    }
	                    else
	                    {
	                        $yestarday_balance_2_charges_P="0";
	                    }
					}
					// echo $yestarday_balance_2_charges_P;
					// exit();
					################################# Payment End ######################
					################################# Receipt Start ######################
					$api_url_R = "192.168.102.101:8080/techexcelapi/index.cfm/FADAYBOOK/FADAYBOOK1?&COMPANY_CODE=MCX&TRANS_TYPE=R&FROM_DATE=".$final_convert_date_new_fromdate_charges."&TO_DATE=".$final_convert_date_new_todate_eq_charges."&CLIENT_CODE=".$client_code."&TOP_RECORD=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year_charges.""; 
					// echo $api_url_R;
					// exit();
					$model = $this->load->model("Api_model");
					$result_R = $this->Api_model->api_data_get($api_url_R);

				    $array_R = json_decode($result_R);

				    if(!empty($array_R))
					{
					    $Client_R = $array_R[0];
					    $_R = 0;
				
					    foreach ($Client_R as $value_R) 
					    {
					    	$farray_R[$_R] = $value_R;
							$_R++;
						}
					}
					if(empty($farray_R[1]))
					{
						$actual_R="";
						$yestarday_balance_charges_R = 0;
		                $yestarday_balance_2_charges_R = 0;
					}
					else
					{
						$act_R=$farray_R[1];
						$act_R_all=$farray_R;
						// $actual_R=$act_R[0][3];
						foreach ($act_R as $key_R => $row_R) {
					 	$sort_R[$key_R] = strtotime(date_format(date_create(str_replace(",", "", $row_R[7])),"Y/m/d"));
						}
						array_multisort($sort_R, SORT_ASC, $act_R);

						$i_R = 0;
		                $yestarday_balance_charges_R = 0;
		                $yestarday_balance_2_charges_R = 0;
		                foreach ($act_R as $key_index_R => $data_row) 
		                {
			                if (str_contains($act_R[$i_R][13], 'FUND TRANSFER') || str_contains($act_R[$i_R][13], 'Inter Exchange')) {
			                }
			                else
			                {  
			                	if($act_R[$i_R][12] != "" || $act_R[$i_R][11] != "")
	                            {
	                                if($act_R[$i_R][12] == 0)
	                                {
	                                    $yestarday_balance_charges_R -= $act_R[$i_R][11];
	                                    $yestarday_balance_2_charges_R += $act_R[$i_R][11];
	                                }
	                                else
	                                {
	                                	$yestarday_balance_charges_R += $act_R[$i_R][12];
	                                    $yestarday_balance_2_charges_R -= $act_R[$i_R][12];
	                                }
	                            }
			                }
			                $i_R++;
		            	}
		            	// echo $yestarday_balance_charges;
		            	// exit();
		            	if(isset($yestarday_balance_2_charges_R))
	                    { 
	                        $yestarday_balance_2_charges_R = $yestarday_balance_2_charges_R <= 0 ? abs($yestarday_balance_2_charges_R) : -$yestarday_balance_2_charges_R ;
	                        // echo ($yestarday_balance_2_charges_R);
	                    }
	                    else
	                    {
	                        $yestarday_balance_2_charges_R="0";
	                    }
					}
				################################# Receipt End ######################
				#########################API FA DAY
					$this->session->set_userdata('ApbackOffice_client_future_profit_and_loss',$future_total);
					$this->session->set_userdata('ApbackOffice_client_future_turnover_profit_and_loss',$total_future_turnover);
					$this->session->set_userdata('ApbackOffice_client_future_unrealized_profit_and_loss',$future_unrealized);
					$this->session->set_userdata('ApbackOffice_client_options_profit_and_loss',$options_total);
					$this->session->set_userdata('ApbackOffice_client_options_turnover_profit_and_loss',$total_options_turnover);
					$this->session->set_userdata('ApbackOffice_client_options_unrealized_profit_and_loss',$options_unrealized);
					$this->session->set_userdata('ApbackOffice_client_fo_Broekrage_profit_and_loss',$actual_brokerage);
					$this->session->set_userdata('ApbackOffice_client_JV_charges_com_profit_and_loss',$yestarday_balance_2_charges);
					$this->session->set_userdata('ApbackOffice_client_P_charges_com_profit_and_loss',$yestarday_balance_2_charges_P);
					$this->session->set_userdata('ApbackOffice_client_R_charges_com_profit_and_loss',$yestarday_balance_2_charges_R);
				}

					$client_code=$_SESSION['ApbackOffice_client_code_profit_and_loss'];
					$client_name=$_SESSION['ApbackOffice_client_name_profit_and_loss'];
					$pan=$_SESSION['ApbackOffice_client_pan_profit_and_loss'];
					// exit();
					$data=array($client_code,$client_name,$pan);
					$this->load->view('User/PDF/commodity_pnl.php',["data"=>$data,'final_convert_date_new_todate_fo'=>$final_convert_date_new_todate_fo,'final_convert_date_new_fromdate'=>$final_convert_date_new_fromdate,"commodity_pnl"=>$commodity_pnl,"commodity_pnl_all"=>$commodity_pnl_all,"commodity_future_data"=>$commodity_future_data,"commodity_option_data"=>$commodity_option_data]);
				}
				else
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Client code and Other Parameters.!!");
					$this->load->view('User/header.php');
					$this->load->view('User/Account/profitandloss.php');
					$this->load->view('User/footer.php');
				}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	// risk_common_report
	public function risk_common_report()
	{	
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_SESSION['risk_commen_client_code'])) 
			{
				unset($_SESSION['risk_commen_client_code']);
			}

			$this->load->view('User/header.php');
			$this->load->view('User/Account/risk_common_report.php');
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	public function risk_common_report_form()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_POST['client_code']))
		{
			$ses_client_code_new_text = strtoupper($_POST['client_code']);
			$exchange_code = $_POST['exchange_code'];
			///////////////////////////Check Code
				$trading_user=$_SESSION['No_of_client_list'];
				$ses_client_code_new=0;
				foreach ($trading_user as $people) {

					if (in_array($ses_client_code_new_text, $people, TRUE)){

						$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
					}
				}
				if($ses_client_code_new=="0"){
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					redirect(base_url('Accounts/risk_common_report'));
				}
				///////////////////////////Check Code
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
	    		$year=$_SESSION['finacial_year_apbackoffice'];
	    		$finacial_years=$this->get_finacial_year_range($year);
	    		$year=$finacial_years['year'];
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

			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Risk_View/Risk_View1?&COMPANY_CODE=".$exchange_code."&CLIENT_ID=".$ses_client_code_new."&BRANCH=".$_SESSION['APBackOffice_user_code']."&INTERNET_TRADING=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

		    $model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);
			$arr = json_decode($result);

			    if(!empty($arr))
				{
				    $Client_master_data = $arr[0];	//saprate data column and row wise
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
				}
				else
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
					redirect(base_url('Accounts/risk_common_report'));
				}

			$back_data = $farray[1];
			$this->session->set_userdata('risk_commen_client_code',$ses_client_code_new);
			$this->load->view('User/header.php');
			$this->load->view('User/Account/risk_common_report.php',["back_data"=>$back_data]);
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	public function risk_common_report_excel()
	{

		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['risk_commen_client_code']))
		{
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
				$year=$_SESSION['finacial_year_apbackoffice'];
			}
			else
			{
				$year=date("Y");
			}
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Risk_View/Risk_View1?&COMPANY_CODE=1&CLIENT_ID=".$_SESSION['risk_commen_client_code']."&BRANCH=".$_SESSION['APBackOffice_user_code']."&INTERNET_TRADING=All&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

		    $model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);
			$arr = json_decode($result);

			    if(!empty($arr))
				{
				    $Client_master_data = $arr[0];	//saprate data column and row wise
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
				}

			$back_data = $farray[1];

			// $this->load->view('User/header.php');
			$this->load->view('User/Excel/risk_common_excel.php',["back_data"=>$back_data]);
			// $this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	//End risk_common_report
	public function Collect_view()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{

				if(isset($_POST['client_code']))
				{
					$ses_client_code_new_text=strtoupper($_POST['client_code']);
					$compnay_code=$_POST['company_code'];

					if(isset($_SESSION['Collection_client_code']))
					{
						unset($_SESSION['Collection_client_code']);
					}

						///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
							
						}
					}
					if($ses_client_code_new=="0"){
						unset($_SESSION['Collection_client_code']);
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Collect_view'));
					}
					///////////////////////////Check Code
					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
    					$year=$_SESSION['finacial_year_apbackoffice'];
   		 				$finacial_years=$this->get_finacial_year_range($year);
    					$year=$finacial_years['year'];
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
					$to_date=date_create($_POST['to_date']);
			    	$to_date=date_format($to_date,"d/m/Y");

			    	$branch_code=$_SESSION['APBackOffice_user_code'];

			    	$this->session->set_userdata('Collection_client_code',$ses_client_code_new);

					$api_url="192.168.102.101:8080/techexcelapi/index.cfm/Collection_View/Collection_View1?&TO_DATE=".$to_date."&COMPANY_CODE=".$compnay_code."&CLIENT_ID=".$ses_client_code_new."&BRANCH=".$branch_code."&STOCK=&WITH_HAIRCUT=&CLIENT_TYPE=&PERIOD=&VIEW_SHORTMARGIN=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
					$model = $this->load->model("Api_model");
					$result = $this->Api_model->api_data_get($api_url);

					$arr = json_decode($result);

					if(!empty($arr))
					{
					    $Client_master_data = $arr[0];										//saprate data column and row wise
					    $i = 0;
					    $status = 'N0';
					    foreach ($Client_master_data as $key => $value) 
					    {
					    	$farray[$i] = $value;
							$i++;
						}
					}
					$back_data = $farray[1];

					if(empty($back_data))
					{

						unset($_SESSION['Collection_client_code']);
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Collect_view'));
					}
					else
					{
						$this->session->set_userdata('APBackOffice_Collection_report',$back_data);
						$this->session->set_userdata('APBackOffice_success',"Successfully retrieved common collect view!");
						$this->load->view('User/header.php');
						$this->load->view('User/Account/collect_view.php',["back_data"=>$back_data]);
						$this->load->view('User/footer.php');
					}
				}
				else
				{
					if(isset($_SESSION['Collection_client_code']))
					{
						unset($_SESSION['Collection_client_code']);
					}

					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
					    $year=$_SESSION['finacial_year_apbackoffice'];
					    $final_convert_date_new_todate="31/03/".$year;
					    $final_convert_date_new_fromdate="01/04/".$year-1;
					}
					else
					{
					    $year=date("Y");
					    $final_convert_date_new_todate="31/03/".$year;
					    $final_convert_date_new_fromdate="01/04/".$year-1;
					}
					if($year>=date('Y'))
					{
						$year=date("Y");
					}

					$branch_code=$_SESSION['APBackOffice_user_code'];
					$api_url="192.168.102.101:8080/techexcelapi/index.cfm/Collection_View/Collection_View1?&TO_DATE=".$final_convert_date_new_todate."&COMPANY_CODE=BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF&CLIENT_ID=&BRANCH=".$branch_code."&STOCK=&WITH_HAIRCUT=&CLIENT_TYPE=&PERIOD=&VIEW_SHORTMARGIN=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

							
						$model = $this->load->model("Api_model");
						$result = $this->Api_model->api_data_get($api_url);

						$arr = json_decode($result);

						if(!empty($arr))
						{
						    $Client_master_data = $arr[0];										//saprate data column and row wise
						    $i = 0;
						    $status = 'N0';
						    foreach ($Client_master_data as $key => $value) 
						    {
						    	$farray[$i] = $value;
								$i++;
							}
						}
						$back_data = $farray[1];
						$this->session->set_userdata('APBackOffice_Collection_report',$back_data);
						$this->load->view('User/header.php');
						$this->load->view('User/Account/collect_view.php',["back_data"=>$back_data]);
						$this->load->view('User/footer.php');
				}

			}
			else
			{
				redirect(base_url('Dashboard'));
			}
	}
	public function Collection_Excel()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['APBackOffice_Collection_report']))
		{
			$back_data=$_SESSION['APBackOffice_Collection_report'];
			$this->load->view('User/Excel/collection_excel.php',["back_data"=>$back_data]);
		}
	}	
	public function Global_Brokerage_Summary()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if($data=$this->input->post())
			{

				$ses_client_code_new_text=strtoupper($data['client_code']);
				$company_code=$data['company_code'];

				if(isset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code']))
				{
					unset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code']);
				}
				$from_date=date_create($data['from_date']);
				$from_date=date_format($from_date,"d/m/Y");

				$to_date=date_create($data['to_date']);
				$to_date=date_format($to_date,"d/m/Y"); 

				$date_option=date('d/m/Y'); 

			    ///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Global_Brokerage_Summary'));
					}
					///////////////////////////Check Code
			    if(isset($_SESSION['finacial_year_apbackoffice']))
				{
	    			$year=$_SESSION['finacial_year_apbackoffice'];
	    			$finacial_years=$this->get_finacial_year_range($year);
	    			$year=$finacial_years['year'];
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
			    $api_url="192.168.102.101:8080/techexcelapi/index.cfm/Reports2/R905?&Company_List=".$company_code."&From_Date=".$from_date."&To_Date=".$to_date."&Branch_CODE=".$_SESSION['APBackOffice_user_code']."&Client_List=".$ses_client_code_new."&Remeshire_List=&DateOption=".$date_option."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

			    $model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

				$arr = json_decode($result);
		
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
				if(isset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code']))
				{
					unset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code']);
				}
				if(empty($back_data))
				{

					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code or empty data!");
					if(isset($_SESSION['ApbackOffice_client_name_ledger_detail']))
					{
						unset($_SESSION['ApbackOffice_client_name_ledger_detail']);
					}
					redirect(base_url('Accounts/Global_Brokerage_Summary'));
				}
				else
				{	
					$this->session->set_userdata('ApbackOffice_client_f_date_global_borkerage',$_POST['from_date']);
					$this->session->set_userdata('ApbackOffice_client_t_date_global_borkerage',$_POST['to_date']);
					$this->session->set_userdata('APBackOffice_Global_Brokerage_Summary',$back_data);
					$this->session->set_userdata('APBackOffice_Global_Brokerage_Summary_client_code',$ses_client_code_new);
					$this->load->view('User/header.php');
					$this->load->view('User/Account/book.php',['back_data'=>$back_data]);
					$this->load->view('User/footer.php');
				}
			}
			else
			{
				if(isset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code']))
				{
					unset($_SESSION['APBackOffice_Global_Brokerage_Summary_client_code']);
				}
				if(isset($_SESSION['ApbackOffice_client_f_date_global_borkerage']))
				{
					unset($_SESSION['ApbackOffice_client_f_date_global_borkerage']);
				}
				if(isset($_SESSION['ApbackOffice_client_t_date_global_borkerage']))
				{
					unset($_SESSION['ApbackOffice_client_t_date_global_borkerage']);
				}
				if(isset($_SESSION['APBackOffice_Global_Brokerage_Summary']))
				{
					unset($_SESSION['APBackOffice_Global_Brokerage_Summary']);
				}
				$this->load->view('User/header.php');
				$this->load->view('User/Account/book.php');
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	public function Global_Brokerage_Summary_excel()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['APBackOffice_Global_Brokerage_Summary']))
		{
			$back_data=$_SESSION['APBackOffice_Global_Brokerage_Summary'];
			$this->load->view('User/Excel/Global_Brokerage_Summary_excel.php',["back_data"=>$back_data]);
		}
	}

	public function Client_wise_dr_cr()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{	
			if(isset($_POST['client_code']) && !empty($_POST['client_code']))
			{
					$ses_client_code_new_text=strtoupper($_POST['client_code']);
					$exchange_code=$_POST['exchange_code'];
					$branch_code=$_SESSION['APBackOffice_user_code'];
					///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Client_wise_dr_cr'));
					}
					///////////////////////////Check Code
					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
						$year=$_SESSION['finacial_year_apbackoffice'];
					}
					else
					{
						$year=date("Y");
					}
					if($year>=date('Y'))
					{
						$year=date("Y");
					}
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Risk_View/Risk_View1?&COMPANY_CODE=".$exchange_code."&CLIENT_ID=".$ses_client_code_new."&BRANCH=".$branch_code."&INTERNET_TRADING=&POLICY=4api_dr_cr&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

					
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


					if(empty($back_data)){

						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						// unset($_SESSION['ApbackOffice_client_name_Client_wise_dr_cr_detail']);
						redirect(base_url('Accounts/Client_wise_dr_cr'));
					}
					else
					{
						$this->session->set_userdata('ApbackOffice_Client_wise_dr_cr',$back_data);
						$this->session->set_userdata('ApbackOffice_code_Client_wise_dr_cr',$ses_client_code_new);
						$this->load->view('User/header.php');
						$this->load->view('User/Account/branch_wise_summary.php',['back_data'=>$back_data]);
						$this->load->view('User/footer.php');
					}
				}
				elseif(isset($_POST['exchange_code']))
				{
					$exchange_code=$_POST['exchange_code'];
					$branch_code=$_SESSION['APBackOffice_user_code'];

					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
						$year=$_SESSION['finacial_year_apbackoffice'];
					}
					else
					{
						$year=date("Y");
					}
					if($year>=date('Y'))
					{
						$year=date("Y");
					}
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Risk_View/Risk_View1?&COMPANY_CODE=".$exchange_code."&CLIENT_ID=&BRANCH=".$branch_code."&INTERNET_TRADING=&POLICY=4api_dr_cr&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
					
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

					if(empty($back_data)){

						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						// unset($_SESSION['ApbackOffice_client_name_Client_wise_dr_cr_detail']);
						redirect(base_url('Accounts/Client_wise_dr_cr'));
					}
					else
					{
						// $this->session->set_userdata('ApbackOffice_client_name_Client_wise_dr_cr_detail',$back_data[0][33]);
						$this->session->set_userdata('ApbackOffice_Client_wise_dr_cr',$back_data);
						if(isset($_SESSION['ApbackOffice_code_Client_wise_dr_cr']))
						{
							unset($_SESSION['ApbackOffice_code_Client_wise_dr_cr']);
						}
						$this->load->view('User/header.php');
						$this->load->view('User/Account/branch_wise_summary.php',['back_data'=>$back_data]);
						$this->load->view('User/footer.php');
					}
				}
				else
				{
					if(isset($_SESSION['ApbackOffice_Client_wise_dr_cr']))
					{
						unset($_SESSION['ApbackOffice_Client_wise_dr_cr']);
					}
					$this->load->view('User/header.php');
					$this->load->view('User/Account/branch_wise_summary.php');
					$this->load->view('User/footer.php');
				}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Client_wise_dr_cr_excel()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['ApbackOffice_Client_wise_dr_cr']))
		{
			$back_data=$_SESSION['ApbackOffice_Client_wise_dr_cr'];
			$this->load->view('User/Excel/Client_wise_dr_cr_excel.php',['back_data'=>$back_data]);
		}

	}
	public function Client_wise_dr_cr_pdf()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['ApbackOffice_Client_wise_dr_cr']))
		{
			$back_data=$_SESSION['ApbackOffice_Client_wise_dr_cr'];
			if(isset($_SESSION['ApbackOffice_code_Client_wise_dr_cr']))
			{
				$ses_client_code_new=$_SESSION['ApbackOffice_code_Client_wise_dr_cr'];

				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
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

				$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

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
					// redirect(base_url('Accounts/profit_and_loss'));
				}
				$master_back_data=$farray_master[1];
				$pan=$master_back_data[0][16];
				$client_code=$master_back_data[0][9];
				$client_name=$master_back_data[0][10];
				$data=array($client_code,$client_name,$pan);
				$this->load->view('User/PDF/Client_wise_dr_cr_pdf.php',['back_data'=>$back_data,'data'=>$data]);
			}
			else
			{	
				$data=array("","","");
				$this->load->view('User/PDF/Client_wise_dr_cr_pdf.php',['back_data'=>$back_data,'data'=>$data]);
			}	
		}
		else
		{
			$this->session->set_userdata('APBackOffice_info',"Not Found Data!");
			redirect(base_url('Accounts/Client_wise_dr_cr'));
		}
		
	}
	public function calculateFiscalYearForDate($month)
	{
		if($month > 4)
		{
			$y = date('Y');
			$pt = date('Y', strtotime('+1 year'));
			$fy = $y."/04/01".",".$pt."/03/31";
		}
		else
		{
			$y = date('Y', strtotime('-1 year'));
			$pt = date('Y');
			$fy = $y."/04/01".",".$pt."/03/31";
		}
		return $fy;
	}
	public function Legder_detail()
	{
		if(isset($_SESSION['APBackOffice_user_code'])){

				if(isset($_POST['client_code']))
				{
					$ses_client_code_new_text=strtoupper($_POST['client_code']);

					$from_date=date_create($_POST['from_date']);
				    $from_date=date_format($from_date,"d/m/Y");

				    $to_date=date_create($_POST['to_date']);
				    $to_date=date_format($to_date,"d/m/Y");

					$margin=$_POST['margin'];

					$exchange_code=$_POST['exchange_code'];

					///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Legder_detail'));
					}
					///////////////////////////Check Code
					if(isset($_SESSION['finacial_year_apbackoffice']))
					{
    					$year=$_SESSION['finacial_year_apbackoffice'];
    					$finacial_years=$this->get_finacial_year_range($year);
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
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date."&ToDate=".$to_date."&Client_code=".$ses_client_code_new."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$p_year.""; 

					
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


					if(empty($back_data)){

						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						unset($_SESSION['ApbackOffice_client_name_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_code_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_f_date_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_t_date_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_exchange_code_ledger_detail']);
						unset($_SESSION['ApbackOffice_client_margin_code_ledger_detail']);
						redirect(base_url('Accounts/Legder_detail'));
					}
					else
					{
						$this->session->set_userdata('ApbackOffice_client_name_ledger_detail',$back_data[0][33]);
						$this->session->set_userdata('ApbackOffice_client_code_ledger_detail',$ses_client_code_new);
						$this->session->set_userdata('ApbackOffice_client_f_date_ledger_detail',$_POST['from_date']);
						$this->session->set_userdata('ApbackOffice_client_t_date_ledger_detail',$_POST['to_date']);
						$this->session->set_userdata('ApbackOffice_client_exchange_code_ledger_detail',$exchange_code);
						$this->session->set_userdata('ApbackOffice_client_margin_code_ledger_detail',$margin);
						$this->load->view('User/header.php');
						$this->load->view('User/Account/ledger_detail.php',['back_data'=>$back_data]);
						$this->load->view('User/footer.php');
					}
				}
				else
				{
					unset($_SESSION['ApbackOffice_client_name_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_code_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_f_date_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_t_date_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_exchange_code_ledger_detail']);
					unset($_SESSION['ApbackOffice_client_margin_code_ledger_detail']);
					$this->load->view('User/header.php');
					$this->load->view('User/Account/ledger_detail.php');
					$this->load->view('User/footer.php');
				}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Late_payment_charges()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['client_code']))
			{
				$ses_client_code_new_text=strtoupper($_POST['client_code']);
				///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Late_payment_charges'));
					}
					///////////////////////////Check Code
				
				$from_date=date_create($_POST['from_date']);
				$from_date=date_format($from_date,"d/m/Y");

				$to_date=date_create($_POST['to_date']);
				$to_date=date_format($to_date,"d/m/Y");
				$exchange_code=$_POST['exchange_code'];

				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
	    			$year=$_SESSION['finacial_year_apbackoffice'];
	    			$finacial_years=$this->get_finacial_year_range($year);
	    			$year=$finacial_years['year'];
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

				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/LATEPAYMENTCHARGES/LATEPAYMENTCHARGES1?&FROM_DATE=".$from_date."&TO_DATE=".$to_date."&COMPANY_CODE=".$exchange_code."&FAMILY_MERGE=&MERGE_COMPANY=Y&MERGE_BRANCH=&ASSOCIATE_AC=&CREDIT_INTEREST=&INC_SHORT_MARGIN=Y&REPORT_VIEW=C&INTEREST_PICKUP=S&LOGIC_VALUE=IE&BRANCH_CODE=".$branch_code."&LEDGER=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

						
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


						if(empty($back_data)){

							$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
							redirect(base_url('Accounts/Late_payment_charges'));
						}
						else
						{
							$to_date_ses=$_POST['to_date'];
							$from_date_ses=$_POST['from_date'];
							$this->session->set_userdata('ApbackOffice_Late_payment_charges',$back_data);
							$this->session->set_userdata('ApbackOffice_Late_payment_charges_code',$ses_client_code_new);
							$this->session->set_userdata('ApbackOffice_client_todate_form_late_payment',$to_date_ses);
							$this->session->set_userdata('ApbackOffice_client_form_late_payment',$from_date_ses);
							$this->load->view('User/header.php');
							$this->load->view('User/Account/Late_payment_charges.php',['back_data'=>$back_data]);
							$this->load->view('User/footer.php');
						}
			}
			else
			{
				$this->load->view('User/header.php');
				$this->load->view('User/Account/Late_payment_charges.php');
				$this->load->view('User/footer.php');
			}
			
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Late_payment_charges_excel()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['ApbackOffice_Late_payment_charges']))
		{
			$back_data=$_SESSION['ApbackOffice_Late_payment_charges'];
			$this->load->view('User/Excel/Late_payment_charges_excel.php',['back_data'=>$back_data]);
		}
	}
	public function ledger_detail_excel()
	{
		

		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['ApbackOffice_client_code_ledger_detail']))
		{
			$ses_client_code=$_SESSION['ApbackOffice_client_code_ledger_detail'];

			$from_date=$_SESSION['ApbackOffice_client_f_date_ledger_detail'];
			$to_date=$_SESSION['ApbackOffice_client_t_date_ledger_detail'];

			$from_date=date_create($from_date);
			$from_date=date_format($from_date,"d/m/Y");

			$to_date=date_create($to_date);
			$to_date=date_format($to_date,"d/m/Y");

			$exchange_code=$_SESSION['ApbackOffice_client_exchange_code_ledger_detail'];
			$margin=$_SESSION['ApbackOffice_client_margin_code_ledger_detail'];

		///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/receipt_request'));
					}
					///////////////////////////Check Code
			if(isset($_SESSION['finacial_year_apbackoffice']))
					{
						$year=$_SESSION['finacial_year_apbackoffice'];
					}
					else
					{
						$year=date("Y");
					}
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date."&ToDate=".$to_date."&Client_code=".$ses_client_code_new."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
		    $model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);
			$arr = json_decode($result);


			    if(!empty($arr))
				{
				    $Client_master_data = $arr[0];	//saprate data column and row wise
				    $i = 0;
				    $status = 'N0';
				    foreach ($Client_master_data as $key => $value) 
				    {
				    	$farray[$i] = $value;
						$i++;
					}
					$back_data = $farray[1];
				}
			// $this->load->view('User/header.php');
			$this->load->view('User/Excel/legder_detail_excel.php',["back_data"=>$back_data]);
			// $this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Ageing()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{

			$branch_code = $_SESSION['APBackOffice_user_code'];
			$company_code = "BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MF_BSE";
			$start_year = strftime("%Y", time());
			$day1 = 5;
			$day2 = 10;
			$day3 = 15;
			$day4 = 20;
			$day5 = 30;

			$to_date = date('d/m/Y');

			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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
			 
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ageing/Ageing?&START_YEAR=".$start_year."&COMPANY_CODE=".$company_code."&BRANCH_CODE=".$branch_code."&FAMILY_GROUP=&ACCOUNTCODE=&VOUCHERDATE=".$to_date."&TYPE=&MERGECOMP=Y&DAY1=".$day1."&DAY2=".$day2."&DAY3=".$day3."&DAY4=".$day4."&DAY5=".$day5."&ACCROSSYEAR=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

			    $model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

			    $arr = json_decode($result);

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

			$ageing_data = $farray[1];

			if(isset($_SESSION['Collection_client_code'])) 
			{
				unset($_SESSION['Collection_client_code']);
			}

			$this->session->set_userdata('ApbackOffice_Ageing_report',$ageing_data);
			$this->load->view('User/header.php');
			$this->load->view('User/Account/ageing.php',['ageing_data'=>$ageing_data]);
			$this->load->view('User/footer.php');
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}

	public function Ageing_form()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{

			$branch_code = $_POST['branch_code'];
			$start_year = $_POST['start_year'];
			$company_code = $_POST['company_code'];
			$ses_client_code_new_text = strtoupper($_POST['client_code']);
			$day1 = $_POST['day1'];
			$day2 = $_POST['day2'];
			$day3 = $_POST['day3'];
			$day4 = $_POST['day4'];
			$day5 = $_POST['day5'];

	        $to_date=date_create($_POST['to_date']);
	        $to_date=date_format($to_date,"d/m/Y");
	        ///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/Ageing'));
					}
					///////////////////////////Check Code
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ageing/Ageing?&START_YEAR=".$start_year."&COMPANY_CODE=".$company_code."&BRANCH_CODE=".$branch_code."&FAMILY_GROUP=&ACCOUNTCODE=".$ses_client_code_new."&VOUCHERDATE=".$to_date."&TYPE=&MERGECOMP=Y&DAY1=".$day1."&DAY2=".$day2."&DAY3=".$day3."&DAY4=".$day4."&DAY5=".$day5."&ACCROSSYEAR=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
			    $model = $this->load->model("Api_model");
				$result = $this->Api_model->api_data_get($api_url);

			    $arr = json_decode($result);

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
				else
				{
					redirect(base_url('Accounts/Ageing'));
				}

			$ageing_data = $farray[1]; 
			$this->session->set_userdata('ApbackOffice_Ageing_report',$ageing_data);
			$this->session->set_userdata('Collection_client_code',$ses_client_code_new);
			$this->load->view('User/header.php');
			$this->load->view('User/Account/ageing.php',['ageing_data'=>$ageing_data]);
			$this->load->view('User/footer.php');
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function ageing_excel()
	{
		if(isset($_SESSION['APBackOffice_user_code']) && isset($_SESSION['ApbackOffice_Ageing_report']))
		{
			$ageing_data=$_SESSION['ApbackOffice_Ageing_report'];
			$this->load->view('User/Excel/ageing_excel.php',['ageing_data'=>$ageing_data]);
		}
	}
	public function smart_reports()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{

			if(isset($_POST['client_code']))
			{
				$ses_client_code_new_text=strtoupper($_POST['client_code']);

				if(isset($_SESSION['APBackOffice_client_code']))
				{
					unset($_SESSION['APBackOffice_client_code']);
				}

				$from_date=date_create($_POST['from_date']);
			    $from_date=date_format($from_date,"d/m/Y");

			    $to_date=date_create($_POST['to_date']);
			    $to_date=date_format($to_date,"d/m/Y");
			    ///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Accounts/smart_reports
'));
					}
					///////////////////////////Check Code
			  	if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
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
			    $api_url_holding = "http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$ses_client_code_new."&To_date=".$to_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
				// echo $api_url;
				// exit();
				$model = $this->load->model("Api_model");
				$result_holding = $this->Api_model->api_data_get($api_url_holding);

			    $arr_holding = json_decode($result_holding);
			    
			    $Client_master_data_holding = $arr_holding[0];
			    $i = 0;
	
			    foreach ($Client_master_data_holding as $key => $value_holding) 
			    {
			    	$farray_holding[$i] = $value_holding;
					$i++;
				}
				// echo "<pre>";
				// print_r($farray);
				// exit();
				$this->session->set_userdata('Apb_client_holding_data',$farray_holding);

			    $api_url_summary = "192.168.102.101:8080/techexcelapi/index.cfm/ClientFASummary/ClientFASummary?&ClientId=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

			    $model = $this->load->model("Api_model");
				$result_summary = $this->Api_model->api_data_get($api_url_summary);

				$arr_summary = json_decode($result_summary);

				if(!empty($arr_summary))
				{
				    $Client_master_data_summary = $arr_summary[0];
				    $i = 0;
				
				    foreach ($Client_master_data_summary as $key => $value_summary) 
				    {
				    	$farray_summary[$i] = $value_summary;
						$i++;
					}
					$this->session->set_userdata('Apb_client_summary_data',$farray_summary);
				}

				// $summary_data = $farray_summary[1];
				// echo "<pre>";
				// print_r($summary_data);
				// echo "</pre>";
				// exit();

				$exchange_code="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF";
				$margin='N';
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date."&ToDate=".$to_date."&Client_code=".$ses_client_code_new."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 

						
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
				$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Smart Report!");
				$this->session->set_userdata('APBackOffice_client_code',$ses_client_code_new);
				$this->session->set_userdata('ApbackOffice_client_name',$back_data[0][33]);
				$this->session->set_userdata('ApbackOffice_from_date_smart',$_POST['from_date']);
				$this->session->set_userdata('ApbackOffice_to_date_smart',$_POST['to_date']);
					
				$this->load->view('User/header.php');
				$this->load->view('User/Account/smart_report.php',["back_data"=>$back_data]);
				$this->load->view('User/footer.php');

			}
			else
			{
				if(isset($_SESSION['APBackOffice_client_code']))
				{
					unset($_SESSION['APBackOffice_client_code']);
				}
				if(isset($_SESSION['ApbackOffice_client_name']))
				{
					unset($_SESSION['ApbackOffice_client_name']);
				}
				if(isset($_SESSION['Apb_client_summary_data']))
				{
					unset($_SESSION['Apb_client_summary_data']);
				}
				if(isset($_SESSION['Apb_client_holding_data']))
				{
					unset($_SESSION['Apb_client_holding_data']);
				}
				if(isset($_SESSION['ApbackOffice_from_date_smart']))
				{
					unset($_SESSION['ApbackOffice_from_date_smart']);
				}
				if(isset($_SESSION['ApbackOffice_to_date_smart']))
				{
					unset($_SESSION['ApbackOffice_to_date_smart']);
				}
				
				$this->load->view('User/header.php');
				$this->load->view('User/Account/smart_report.php');
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	public function client_bank_data()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$ses_client_code_new_text=$_POST['client_code'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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
			///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						echo "0";
						exit();
					}
					///////////////////////////Check Code
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
					
				    
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
				}

			foreach ($farray[1] as $value) {
				 echo '<option value="'.$value[12].'">'.$value[12].'-'.$value[16].'</option>';
			}
		}	
	}
	public function client_name_data()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$ses_client_code_new_text=$_POST['client_code'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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

			///////////////////////////Check Code

					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						echo "0";
						exit();
					}
					///////////////////////////Check Code
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
					
				    
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
				}
				// echo "<pre>";
				// print_r($farray[1]);
				// exit();
				if(!empty($farray[1]))
				{
					echo $farray[1][0][11];
				}
				// if(empty($farray[1]))
				// {
				// 	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
				// 	redirect(base_url('Accounts/receipt_request'));
				// }		
		}
	}
	public function closing_bal()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$ses_client_code_new_text=$_POST['client_code'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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

			$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code_new_text, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						echo "0";
						exit();
					}
			$grp_wise='y';
			// $voucher_date=date_create($_POST['voucher_date']);
			// $voucher_date=date_format($voucher_date,"d/m/Y");
			$voucher_date =date("d/m/Y", strtotime('+5 days'));

			// $api_url = "192.168.102.101:8080/techexcelapi/index.cfm/LedgerSummary/LedgerSummary?&ClientId=".$client_code."&VOUCHERDATE=".$voucher_date."&GRPWISE=".$grp_wise."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientFASummary/ClientFASummary?&ClientId=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
			// echo $api_url;
			// exit();
			$model = $this->load->model("Api_model");
			$result = $this->Api_model->api_data_get($api_url);

			$arr = json_decode($result);
		
			if(!empty($arr))
			{
				$Client_master_data = $arr[0];
				$i = 0;
			
				foreach ($Client_master_data as $key => $value) 
				{
					$farray[$i] = $value;
					$i++;
				}
				echo json_encode($farray[1]);
			}
		}
	}
	
	public function receipt_request_id()
	{
		$receipt_request_id=$_POST['receipt_request_id'];

		$KYC_db_local = $this->load->database('KYC_db_local',TRUE);
		$sql_receipt="EXEC Proc_AP_ReceiptGet_data '$receipt_request_id'";
		$result_receipt_data = $KYC_db_local->query($sql_receipt)->result_array();
		echo json_encode($result_receipt_data);
	}
	public function receipt_branch_code()
	{
		
		$exchange_code=$_POST['exchange_code'];

		$KYC_db_local = $this->load->database('KYC_db_local',TRUE);
		$sql_receipt="EXEC Proc_AP_Receipt_BankCodeSearch '$exchange_code'";
		$result_branch_code = $KYC_db_local->query($sql_receipt)->result_array();
		echo json_encode($result_branch_code);
	}

	public function receipt_bank_code_tdrow()
	{
		// print_r($_POST);exit();
		$Exchange_Code=$_POST['Exchange_Code'];
		$KYC_db_local = $this->load->database('KYC_db_local',TRUE);
		$sql_receipt="EXEC Proc_AP_Receipt_BankCodeSearch '$Exchange_Code'";
		$result_branch_code = $KYC_db_local->query($sql_receipt)->result_array();
		echo json_encode($result_branch_code);
	}
	public function receipt_bank_code_insert()
	{
		$exchange_code=$_POST['exchange_code'];
		$KYC_db_local = $this->load->database('KYC_db_local',TRUE);
		$sql_receipt="EXEC Proc_AP_Receipt_BankCodeSearch '$exchange_code'";
		$result_branch_code = $KYC_db_local->query($sql_receipt)->result_array();
		echo json_encode($result_branch_code);
	}
	public function view_img()
	{
		if($data1=$this->input->post())
		{
			$_SESSION['ses_path_img'] = $_POST['path1'];
		}
		else
		{
			$this->load->view("User/Account/Account_View_Image/client_ProofImg.php");
		}
	}
	public function client_bank_data2_online()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$ses_client_code=$_POST['client_code_online'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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
			// ///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						echo "0";
						exit();
					}
					///////////////////////////Check Code
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

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
				// echo "<pre>";/
				$email=$farray_master[1][0][15];
				// exit();

			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
					
				    
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
				}

// HDFC0000067#00671200040479#9978085180#JITENDRABHAI AMARSINHBHAI CHAUHAN#SURAT#JITU_3651@YAHOO.COM
			foreach ($farray[1] as $value) {

				 echo '<option value="'.$value[4].'#'.$value[12].'#'.$value[20].'#'.$value[11].'#'.$value[5].'#'.$email.'">'.$value[12].'-'.$value[16].'</option>';
			}
		}	
	}
	public function client_bank_data2()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$ses_client_code=$_POST['client_code'];
			if(isset($_SESSION['finacial_year_apbackoffice']))
			{
			    $year=$_SESSION['finacial_year_apbackoffice'];
			    $finacial_years=$this->get_finacial_year_range($year);
			    $year=$finacial_years['year'];
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
			///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID'];
						}
					}
					if($ses_client_code_new=="0"){
						echo "0";
						exit();
					}
					///////////////////////////Check Code
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$ses_client_code_new."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

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
				// echo "<pre>";/
				$email=$farray_master[1][0][15];
				// exit();

			$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
					
				    
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
				}

// HDFC0000067#00671200040479#9978085180#JITENDRABHAI AMARSINHBHAI CHAUHAN#SURAT#JITU_3651@YAHOO.COM
			foreach ($farray[1] as $value) {

				 echo '<option value="'.$value[4].'#'.$value[12].'#'.$value[20].'#'.$value[11].'#'.$value[5].'#'.$email.'">'.$value[12].'-'.$value[16].'</option>';
			}
		}	
	}
	public function Emandate_online()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['btn_submit_mandate_online']))
			{
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
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

				$client_code=$_POST['client_code_online'];
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$client_code."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
					
				    
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
					    $farray2[$i] = $value;
						$i++;
					}
				$this->session->set_userdata('APBackOffice_client_bank_detail_online',$farray2);
				}

				$bank_account_emandate=$_POST['bank_account_emandate'];
				$amount_emandate=$_POST['online_bank_amount'];
				$explode_data=explode("#", $bank_account_emandate);
				$exp = $explode_data[1];
				$clientbank_back_data = $_SESSION['APBackOffice_client_bank_detail_online'][1];
				// print_r($clientbank_back_data);
				// exit();
				foreach ($clientbank_back_data as $farray) {
					if($exp == $farray[12] )
					{
						$array=array($farray[0],$farray[11],$farray[16],$farray[12],$farray[21],$farray[19],$farray[22],$farray[15],$farray[20],$farray[22]);
					}
				}
				$emandate_data = "emandate";
				$this->load->view('User/Account/emandate_online.php',["emandate_data" => $emandate_data,"farray" => $array]);

			}
			else
			{
				$this->load->view('User/header.php');
				$this->load->view('User/Account/Emandate.php');
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('APBackOffice'));
		}
	}
	public function Emandate_physical()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['btn_submit']))
			{
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
				    $year=$_SESSION['finacial_year_apbackoffice'];
				    $finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
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

				$client_code=$_POST['client_code'];
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$client_code."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
					
				    
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
					    $farray2[$i] = $value;
						$i++;
					}
				$this->session->set_userdata('APBackOffice_client_bank_detail',$farray2);
				}
				// HDFC0000067#00671200040479#9978085180#JITENDRABHAI AMARSINHBHAI CHAUHAN#SURAT#JITU_3651@YAHOO.COM
				$clientbank_back_data = $_SESSION['APBackOffice_client_bank_detail'][1];
				$today_date=date("d/m/Y");
				$today_date1=str_replace("/", "-", $today_date);
				$amont_number=$_POST['physical_Amount'];
				$number=$_POST['physical_Amount'];
				$acount_number=$_POST['physical_bank_emandate'];
				$explode_data=explode("#", $acount_number);
				$exp = $explode_data[1];
				$no = floor($number);
			   	$point = round($number - $no, 2) * 100;
			   	$hundred = null;
			   	$digits_1 = strlen($no);
			  	$i = 0;
			   	$str = array();
			   	$words = array('0' => '', '1' => 'One', '2' => 'two',
			    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
			    '7' => 'seven', '8' => 'eight', '9' => 'nine',
			    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
			    '13' => 'thirteen', '14' => 'fourteen',
			    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
			    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
			    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
			    '60' => 'sixty', '70' => 'seventy',
			    '80' => 'eighty', '90' => 'ninety');
			   	$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
			   	$array[]="";
			   	while ($i < $digits_1) 
			   	{
			     	$divider = ($i == 2) ? 10 : 100;
			     	$number = floor($no % $divider);
			     	$no = floor($no / $divider);
			    	 $i += ($divider == 10) ? 1 : 2;
			    	if ($number) 
			    	{
				        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				        $str [] = ($number < 21) ? $words[$number] .
				            " " . $digits[$counter] . $plural . " " . $hundred
				            :
				            $words[floor($number / 10) * 10]
				            . " " . $words[$number % 10] . " "
				            . $digits[$counter] . $plural . " " . $hundred;
			    	} else $str[] = null;
			  	}
			 	$str = array_reverse($str);
			 	$result = implode('', $str);
			 	$points = ($point) ?
			    "." . $words[$point / 10] . " " . 
			          $words[$point = $point % 10] : '';
			  	$amount_word=strtoupper($result) . "RUPEES  " . strtoupper($points) . " ONLY /-";	

				foreach($clientbank_back_data as $farray) 
				{
					// print_r($exp."<br>");
					if($exp == $farray[12] )
					{
						$array=array($farray[0],$today_date1,$amont_number,$amount_word,$farray[12],$farray[16],$farray[21],$farray[19],$farray[20], $explode_data[5],  $explode_data[3]);
					}
				}
				$emandate_data = "emandate";
				 // Go and create IPO PDF
				$this->load->view('User/PDF/offline_emandate_PDF.php',["emandate_data" => $emandate_data,"farray" => $array]);

			}
			else
			{
				$this->load->view('User/header.php');
				$this->load->view('User/Account/Emandate.php');
				$this->load->view('User/footer.php');
			}
			
		}
	}
}