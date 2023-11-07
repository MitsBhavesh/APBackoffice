<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function index()
	{
		if(isset($_SESSION['APBackOffice_user_code'])){

			$this->load->view('User/header.php');
			$this->load->view('User/helpdesk1.php');
			$this->load->view('User/footer.php');
		}
		else{
			redirect(base_url('Dashboard'));
		}
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
	public function GenerateReport()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if(isset($_POST['report'])){
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

				$ses_client_code=strtoupper($_POST['client_code']);
				///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					// print_r($ses_client_code);
					// exit;
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($ses_client_code, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Reports'));
					}
					///////////////////////////Check Code
				
				$this->session->set_userdata('APBackOffice_client_code_report',$ses_client_code_new);

				if(isset($_SESSION['APBackOffice_client_client_master_data'])){
					unset($_SESSION['APBackOffice_client_client_master_data']);
				}

				if(isset($_SESSION['APBackOffice_client_bank_detail'])){
					unset($_SESSION['APBackOffice_client_bank_detail']);
				}

				// if($ses_client_code=="A2196"){

					$from_date=date_create($_POST['from_date']);

			        $from_date=date_format($from_date,"d/m/Y");

			        $to_date=date_create($_POST['to_date']);
			        $to_date=date_format($to_date,"d/m/Y");
			        if($_POST['report']=="ledger")
					{
						// print_r($_POST);return;
						$exchange_code="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF";
						
						$margin='N';

						if(2023>=$_SESSION['finacial_year_apbackoffice'])
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date."&ToDate=".$to_date."&Client_code=".$ses_client_code_new."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
						}
						else
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$from_date."&ToDate=".$to_date."&Client_code=".$ses_client_code_new."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
						}
						

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
							$this->session->set_userdata('APBackOffice_MoreReport_Ledgerdata',$farray);
						}
						$back_data = $farray[1];
						if(empty($back_data))
						{
							$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
							unset($_SESSION['ApbackOffice_client_name_ledger_detail']);
							redirect(base_url('Accounts/Legder_detail'));
						}
						// $back_data = $farray[1];
						$filename="ledger.php";
						$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Ledger!");
						$this->session->set_userdata('option_report_choose',$_POST['report']);
						$this->session->set_userdata('ApbackOffice_client_f_date_reportledger_detail',$from_date);
						$this->session->set_userdata('ApbackOffice_client_t_date_reportledger_detail',$to_date);
						$this->load->view('User/header.php');
						// ,"back_data"=>$back_data
						$this->load->view('User/helpdesk1.php',["filename"=>$filename]);
						$this->load->view('User/footer.php');

					}
					elseif($_POST['report']=="holding")
					{
						if(2022>=$_SESSION['finacial_year_apbackoffice'])
						{
							$api_url ="http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$ses_client_code_new."&To_date=".$to_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
						}
						else
						{
							$api_url ="http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$ses_client_code_new."&To_date=".$to_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
						}
						
						
						$model = $this->load->model("Api_model");
						$result_api = $this->Api_model->api_data_get($api_url);

		                $arr = json_decode($result_api);

		                $Client_master_data = $arr[0];
		                $i = 0;
		          
		                foreach ($Client_master_data as $key => $value) 
		                {
		                    $farray[$i] = $value;
		                    $i++;
		                    $this->session->set_userdata('APBackOffice_MoreReport_Holdingdata',$farray);
		                }

		                // $holding = $farray[1];
						$filename="holding.php";
						$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Holding report!");
						$this->session->set_userdata('option_report_choose',$_POST['report']);
						$this->session->set_userdata('ApbackOffice_client_t_date_reportledger_detail',$to_date);
						$this->load->view('User/header.php');
						// ,"holdint_data"=>$holding
						$this->load->view('User/helpdesk1.php',["filename"=>$filename]);
						$this->load->view('User/footer.php');	

					}
					elseif($_POST['report']=="kyc")
					{
						//Client Master
						if(2022>=$_SESSION['finacial_year_apbackoffice'])
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientList/ClientList?&CLIENT_ID=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";
						}
						else
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientList/ClientList?&CLIENT_ID=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
						}
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
							foreach ($Client_master_data as $key => $value) 
							{
							    $farray[$i] = $value;
								$i++;
							}
							$this->session->set_userdata('APBackOffice_client_client_master_data',$farray);
						}
						//Bank APi
						if(2022>=$_SESSION['finacial_year_apbackoffice'])
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

						}
						else
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/ClientBankDetailMultiple/ClientBankDetailMultiple1?&Client_id=".$ses_client_code_new."&FROM_DATE=&TO_DATE=&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
						}

						$model = $this->load->model("Api_model");
						$result_api = $this->Api_model->api_data_get($api_url);

		                $arr = json_decode($result_api);

		                if(!empty($arr))
						{
			                $Client_master_data = $arr[0];
			                $i = 0;
			                foreach ($Client_master_data as $key => $value) 
			                {
			                    $farray[$i] = $value;
			                    $i++;
			                }
			                $this->session->set_userdata('APBackOffice_client_bank_detail',$farray);
			            }

						$filename="kyc.php";
						$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved KYC Data!");
						$this->load->view('User/header.php');
						// $this->load->view('User/helpdesk1.php',["filename"=>$filename,"clientmaster_back_data"=>$clientmaster_back_data]);
						$this->load->view('User/helpdesk1.php',["filename"=>$filename]);
						$this->load->view('User/footer.php');
					}
					elseif($_POST['report']=="globalsummary")
					{
						// $to_date =  date("d/m/Y");
						$year = "2023";		
						$exchange_code = "BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE";		
						$opening_balance = "Y";

						// $api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=".$exchange_code."&Client_Code=".$ses_client_code_new."&Finstyr=".$year."&To_date=".$to_date."&WITHOpening=".$opening_balance."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=2022";
						if(2022>=$_SESSION['finacial_year_apbackoffice'])
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=".$exchange_code."&Client_Code=".$ses_client_code_new."&Finstyr=".$year."&To_date=".$to_date."&WITHOpening=".$opening_balance."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

						}
						else
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=".$exchange_code."&Client_Code=".$ses_client_code_new."&Finstyr=".$year."&To_date=".$to_date."&WITHOpening=".$opening_balance."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
						} 

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
							$this->session->set_userdata('APBackOffice_MoreReport_GlobalSummarydata',$farray);
						}
						// $globalDetails = $farray[1];
						$filename="global_summary.php";
						$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Global Summary!");
						$this->session->set_userdata('option_report_choose',$_POST['report']);
						$this->session->set_userdata('ApbackOffice_client_f_date_reportglobalsummary_detail',$from_date);
						$this->session->set_userdata('ApbackOffice_client_t_date_reportglobalsummary_detail',$to_date);
						$this->load->view('User/header.php');
						// ,"back_data"=>$globalDetails
						$this->load->view('User/helpdesk1.php',["filename"=>$filename]);
						$this->load->view('User/footer.php');
					}
					elseif($_POST['report']=="globaldetail")
					{

						// $api_url = "192.168.102.101:8080/techexcelapi/index.cfm/GlobalDetail/GlobalDetail?&FromClient=".$ses_client_code_new."&FromDate=".$from_date."&ToDate=".$to_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=2022"; 
						$year = "2023";
						if(2022>=$_SESSION['finacial_year_apbackoffice'])
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/GlobalDetail/GlobalDetail?&FromClient=".$ses_client_code_new."&FromDate=".$from_date."&ToDate=".$to_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

						}
						else
						{
							$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/GlobalDetail/GlobalDetail?&FromClient=".$ses_client_code_new."&FromDate=".$from_date."&ToDate=".$to_date."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
						}
						// echo $api_url;
						// exit;
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
							$this->session->set_userdata('APBackOffice_MoreReport_GlobalDetaildata',$farray);
						}
						// $back_data = $farray[1];
						$filename="global_detail.php";
						$this->session->set_userdata('APBackOffice_success',"Successfully Retrieved Global Detail!");
						$this->session->set_userdata('option_report_choose',$_POST['report']);
						$this->session->set_userdata('ApbackOffice_client_f_date_reportglobaldetail_detail',$from_date);
						$this->session->set_userdata('ApbackOffice_client_t_date_reportglobaldetail_detail',$to_date);
						$this->load->view('User/header.php');
						// ,"back_data"=>$back_data
						$this->load->view('User/helpdesk1.php',["filename"=>$filename]);
						$this->load->view('User/footer.php');
					}
					else
					{
						echo "No Data";die();
					}
			// 	}
			// 	else
			// 	{
			// 		$this->session->set_userdata('APBackOffice_danger_alert',$ses_client_code_new." not found client code!");

			// 		if(isset($_SESSION['APBackOffice_client_code'])){

			// 			unset($_SESSION['APBackOffice_client_code']);
			// 		}
			// 		redirect(base_url('Reports'));
			// }
			}else{
				$this->session->set_userdata('APBackOffice_danger_alert',"Please select reports.");
				redirect(base_url('Reports'));
			}

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	//Start excel code download
	public function report_ledger_excel_download()
	{
		// echo "hi report";exit();
		$this->load->view('User/Excel/morereport_ledger_excel.php');
	}
	public function report_holding_excel_download()
	{
		// echo "hi report holding";exit();
		$this->load->view('User/Excel/morereport_holding_excel.php');
	}
	public function report_globalsummary_excel_download()
	{
		// echo "hi report globalsummary";exit();
		$this->load->view('User/Excel/morereport_globalsummary_excel.php');
	}
	public function report_globaldetails_excel_download()
	{
		// echo "hi report globaldetail";exit();
		$this->load->view('User/Excel/morereport_globaldetails_excel.php');
	}
	//End excel code download
	//Start pdf code download
	public function report_Ledger_pdf_download()
	{
		// print_r($_SESSION['option_report_choose']);
		// exit();
		if($_SESSION['option_report_choose']=="ledger")
		{
			$client_code=$_SESSION['APBackOffice_client_code_report'];
			// print_r($client_code);
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

			// ######################## start get client detail api  ########################
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
			
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
			// EXIT();
			// ######################## start get client detail api ##############################
			$exchange_code="BSE_CASH,NSE_CASH,CD_NSE,MF_BSE,NSE_DLY,NSE_FNO,NSE_SLBM,MTF";		
			$margin='N';
			$report_ledger_fromdate=$_SESSION['ApbackOffice_client_f_date_reportledger_detail'];
			$report_ledger_todate=$_SESSION['ApbackOffice_client_t_date_reportledger_detail'];
			if(2022>=$_SESSION['finacial_year_apbackoffice'])
			{

				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$report_ledger_fromdate."&ToDate=".$report_ledger_todate."&Client_code=".$client_code."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

			}
			else
			{
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Ledger/Ledger1?&FromDate=".$report_ledger_fromdate."&ToDate=".$report_ledger_todate."&Client_code=".$client_code."&COCDLIST=".$exchange_code."&ShowMargin=".$margin."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
			}
			

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
				$this->session->set_userdata('APBackOffice_MoreReport_Ledgerdata',$farray);
				
			}
			$Reportledger_PNL=$farray[1];


			

			// print_r($report_ledger_fromdate);
			// echo "<br>";
			// print_r($report_ledger_todate);
			// exit();

			$this->load->view('User/PDF/report_ledger_pdf.php',["data"=>$data,"report_ledger_fromdate"=>$report_ledger_fromdate,"report_ledger_todate"=>$report_ledger_todate,"Reportledger_PNL"=>$Reportledger_PNL]);
			// $this->load->view('User/PDF/kyc_dp_ledger_pdf.php',["data"=>$data,"kyc_dpledger_fromdate"=>$kyc_dpledger_fromdate,"kyc_dpledger_todate"=>$kyc_dpledger_todate,"DPledger_PNL"=>$DPledger_PNL]);
			
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please select reports.");
			redirect(base_url('Reports'));
		}
	}
	//end pdf code download
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

	public function report_holding_pdf_download()
	{
		// echo "hfhd";
		// exit();

		if($_SESSION['option_report_choose']=="holding")
		{
			// echo "hiii";
			// exit();

			$client_code=$_SESSION['APBackOffice_client_code_report'];
			// print_r($client_code);
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

			// ######################## start get client detail api  ########################
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
			
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
			// EXIT();
			// ######################## end get client detail api  ########################

			// ######################## start get holding detail api  ########################
			$report_holding_todate=$_SESSION['ApbackOffice_client_t_date_reportledger_detail'];
			// print_r($report_holding_todate);
			// exit();
			if(2022>=$_SESSION['finacial_year_apbackoffice'])
			{

				$api_url ="http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$client_code."&To_date=".$report_holding_todate."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

			}
			else
			{
				$api_url ="http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$client_code."&To_date=".$report_holding_todate."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
			}
			
						
			$model = $this->load->model("Api_model");
			$result_api = $this->Api_model->api_data_get($api_url);

            $arr = json_decode($result_api);

            $Client_master_data = $arr[0];
            $i = 0;
      
            foreach ($Client_master_data as $key => $value) 
            {
                $farray[$i] = $value;
                $i++;
                $this->session->set_userdata('APBackOffice_MoreReport_Holdingdata',$farray);
            }
            $Reportholding_PNL = $farray[1];
            // echo "<pre>";
            // print_r($Reportholding_PNL);
            // exit();
            // ######################## end get holding detail api  ########################
            $this->load->view('User/PDF/report_holding_pdf.php',["data"=>$data,"report_holding_todate"=>$report_holding_todate,"Reportholding_PNL"=>$Reportholding_PNL]);
		                
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please select reports.");
			redirect(base_url('Reports'));
		}
	}
	public function report_global_summery_pdf_download()
	{
		// print_r($_SESSION['option_report_choose']);
		// exit();
		if($_SESSION['option_report_choose']=="globalsummary")
		{
			// echo "hiii";
			// exit();

			$client_code=$_SESSION['APBackOffice_client_code_report'];
			// print_r($client_code);
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

			// ######################## start get client detail api  ########################
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
			
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
			// EXIT();
			// ######################## end get client detail api  ########################

			// ######################## start get global summary detail api  ########################
			$report_globalsummery_fromdate=$_SESSION['ApbackOffice_client_f_date_reportglobalsummary_detail'];
			$report_globalsummery_todate=$_SESSION['ApbackOffice_client_t_date_reportglobalsummary_detail'];
			// print_r($report_globalsummery_todate);
			// exit();
			// $year =  "2022";			
			$exchange_code = "BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE";		
			$opening_balance = "Y";

			
			if(2022>=$_SESSION['finacial_year_apbackoffice'])
			{
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=".$exchange_code."&Client_Code=".$client_code."&Finstyr=".$year."&To_date=".$report_globalsummery_todate."&WITHOpening=".$opening_balance."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

				// $api_url ="http://192.168.102.101:8080/techexcelapi/index.cfm/Holding/Holding1?&Client_code=".$client_code."&To_date=".$report_holding_todate."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year."";

			}
			else
			{
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/Global/Global?&COCD=".$exchange_code."&Client_Code=".$client_code."&Finstyr=".$year."&To_date=".$report_globalsummery_todate."&WITHOpening=".$opening_balance."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year."";
			} 
			// print_r($api_url);
			// exit();
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
				$this->session->set_userdata('APBackOffice_MoreReport_GlobalSummarydata',$farray);
			}
            $Reportglobalsummary_PNL = $farray[1];
            // echo "<pre>";
            // print_r($Reportglobalsummary_PNL);
            // exit();
            // ######################## end get global summary detail api  ########################
          
            $this->load->view('User/PDF/report_globalsummary_pdf.php',["data"=>$data,"report_globalsummery_fromdate"=>$report_globalsummery_fromdate,"report_globalsummery_todate"=>$report_globalsummery_todate,"Reportglobalsummary_PNL"=>$Reportglobalsummary_PNL]);
		                
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please select reports.");
			redirect(base_url('Reports'));
		}
	}




	// start code global detail
	public function report_global_detail_pdf_download()
	{
		if($_SESSION['option_report_choose']=="globaldetail")
		{
			// echo "hiii";
			// exit();

			$client_code=$_SESSION['APBackOffice_client_code_report'];
			// print_r($client_code);
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

			// ######################## start get client detail api  ########################
			$api_url_client_master = "192.168.102.101:8080/techexcelapi/index.cfm/kycMaster/GetMaster?&ClientCode=".$client_code."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo2023&UrlDataYear=".$year.""; 
			
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
			// EXIT();
			// ######################## end get client detail api  ########################

			// ######################## start get global detail detail api  ########################
			$report_globaldetail_fromdate=$_SESSION['ApbackOffice_client_f_date_reportglobaldetail_detail'];
			$report_globaldetail_todate=$_SESSION['ApbackOffice_client_t_date_reportglobaldetail_detail'];
			// print_r($report_globalsummery_todate);
			// exit();
			// $year =  "2022";	
			if(2022>=$_SESSION['finacial_year_apbackoffice'])
			{
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/GlobalDetail/GlobalDetail?&FromClient=".$client_code."&FromDate=".$report_globaldetail_fromdate."&ToDate=".$report_globaldetail_todate."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 


			}
			else
			{
				$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/GlobalDetail/GlobalDetail?&FromClient=".$client_code."&FromDate=".$report_globaldetail_fromdate."&ToDate=".$report_globaldetail_todate."&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
			}		 
						
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
				$this->session->set_userdata('APBackOffice_MoreReport_GlobalDetaildata',$farray);
			}
            $Reportglobaldetail_PNL = $farray[1];
            // echo "<pre>";
            // print_r($Reportglobaldetail_PNL);
            // exit();
            // ######################## end get global detail detail api  ########################
          
            $this->load->view('User/PDF/report_globaldetail_pdf.php',["data"=>$data,"report_globaldetail_fromdate"=>$report_globaldetail_fromdate,"report_globaldetail_todate"=>$report_globaldetail_todate,"Reportglobaldetail_PNL"=>$Reportglobaldetail_PNL]);
		                
		}
		else
		{
			$this->session->set_userdata('APBackOffice_danger_alert',"Please select reports.");
			redirect(base_url('Reports'));
		}
	}
	// end code global detail



}
