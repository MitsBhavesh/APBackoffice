<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }


	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));
		}
		else
		{
			
		$KYC_db_odbc1 = $this->load->database('AP_No_Of_Client_local', TRUE);
		$KYC_db_odbc = $this->load->database('AP_No_Of_Client', TRUE);
		$ap_code=$_SESSION['APBackOffice_user_code'];
		if(!isset($_SESSION['My_account_opening_authorize']))
		{

			$sql_login = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Login'"; 
			$sql_pending = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Pending'";
			$sql_authorize = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Authorize'";
			$sql_rejection = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='Rejection'"; 
			$sql_finished = "SELECT * from EKYC_ClientMaster where IntroducerCode='$ap_code' and EntryStatus='TechFinished'";

			$login=$KYC_db_odbc->query($sql_login)->num_rows();
			$pending=$KYC_db_odbc->query($sql_pending)->num_rows();
			$authorize=$KYC_db_odbc->query($sql_authorize)->num_rows();
			$rejection=$KYC_db_odbc->query($sql_rejection)->num_rows();
			$finished=$KYC_db_odbc->query($sql_finished)->num_rows();

			$total=$login+$pending+$authorize+$rejection+$finished;

			if($total!="0")
			{
				$percentage=$finished/$total*100;
			}
			else
			{
				$percentage="0";
			}
		
			$this->session->set_userdata('My_account_opening_authorize',$percentage);
		}
			if(!isset($_SESSION['No_of_client']))
			{
				
				if($_SESSION['APBackOffice_user_code']=="RAJ")
				{
					$sql_client_master="SELECT * from IPO_PH_ClientMaster where [BRANCH CODE] in ('RAJ','RAJ35','RAJ36','RJBM','RJCM','RJHU','RJKP','JAM01','JAM02','JAMIK','YMZ','APJ','JDH')";
					$result=$KYC_db_odbc->query($sql_client_master)->num_rows();

					$result_data=$KYC_db_odbc->query($sql_client_master)->result_array();
				}
				else
				{
					$sql_client_master="exec Proc_API_APCLIENTGET '$ap_code'";

					$result=$KYC_db_odbc1->query($sql_client_master)->num_rows();

					$result_data=$KYC_db_odbc1->query($sql_client_master)->result_array();
				}

				$this->session->set_userdata('No_of_client',$result);
				$this->session->set_userdata('No_of_client_list',$result_data);
			}
			// echo "<pre>";
			// print_r($_SESSION['No_of_client_list']);
			// exit();
			// $KYC_db = $this->load->database('KYC_db_test', TRUE);

			// $sql = "EXEC Proc_AP_MarketNews_Get";
			// $results = $KYC_db->query($sql)->result_array();
			// print_r($results);exit();
			// $curl = curl_init();
			// $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
			// curl_setopt_array($curl, array(
			//   CURLOPT_URL => 'https://newsapi.org/v2/top-headlines?country=in&category=business&apiKey=dba26aec8c7148e08962967083622b44',
			//   CURLOPT_RETURNTRANSFER => true,
			//   CURLOPT_ENCODING => '',
			//   CURLOPT_MAXREDIRS => 10,
			//   CURLOPT_TIMEOUT => 0,
			//   CURLOPT_FOLLOWLOCATION => true,
			//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			//   CURLOPT_CUSTOMREQUEST => 'GET',
			//   CURLOPT_USERAGENT=>$agent,
			// ));

			// $response = curl_exec($curl);

			// curl_close($curl);
			// // echo $response;
			// // exit();
			// $array=json_decode($response,true);

			// print_r($array['articles'][0]['source']);
			// exit();
			$results=[];
			
			$this->load->view('User/header.php');
			$this->load->view('User/dashboard.php',["results"=>$results]);
			$this->load->view('User/footer.php');
		}
	}
	public function Total_client()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$KYC_db_odbc1 = $this->load->database('AP_No_Of_Client_local', TRUE);
			$ap_code=$_SESSION['APBackOffice_user_code'];
			$sql_client_master="exec Proc_API_APCLIENTGET '$ap_code'";
			$result=$KYC_db_odbc1->query($sql_client_master)->num_rows();
			echo $result;
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Pending_action()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$this->load->view('User/header.php');
			$this->load->view('User/pending_action.php');
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function traded_and_non_traded_client()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
				$trading_user=$_SESSION['No_of_client_list'];

				$ses_client_code_new=0;
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
				}
				else
				{
					$year=date("Y");
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				foreach ($trading_user as $people) {
					$api_url = "192.168.102.101:8080/techexcelapi/index.cfm/TRADEDETAIL/TRADEDETAIL?&Client_code=".$people['TRADING_CLIENT_ID']."&from_date=01/11/2022&to_date=14/11/2022&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
						// echo $api_url;exit();
						$model = $this->load->model("Api_model");
						$result = $this->Api_model->api_data_get($api_url);
						$arr = json_decode($result);
						// print_r($arr);
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
						if(isset($farray))
						{

							$back_data = $farray[1];
						}
						else
						{
							$back_data[] ="";
						}

						if(!empty($back_data))
						{
							echo "<pre>";
							echo "not empty";
							print_r($people['TRADING_CLIENT_ID']);
						}
						else
						{
							echo "empty";
							echo "<pre>";
							print_r($people['TRADING_CLIENT_ID']);
						}
					}

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
		
	}
	public function Lead_conversion()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{

			$this->load->view('User/header.php');
			$this->load->view('User/lead_conversion.php');
			$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Modification()
	{

		if(isset($_SESSION['APBackOffice_user_code']))
		{

				$this->load->view('User/header.php');
				$this->load->view('User/client_detail_updation.php');
				$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function No_client()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
				// $AP_No_Of_Client=$
				$this->load->view('User/header.php');
				$this->load->view('User/no_client.php');
				$this->load->view('User/footer.php');

		}
		else
		{
			redirect(base_url('Dashboard'));
		}

	}
	public function My_brokerage()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if (isset($_SESSION['My_brokerage_client_code'])){

				unset($_SESSION['My_brokerage_client_code']);
			}
			if (isset($_SESSION['My_brokerage_FromDate'])){

				unset($_SESSION['My_brokerage_FromDate']);
			}
			if (isset($_SESSION['My_brokerage_ToDATE'])){

				unset($_SESSION['My_brokerage_ToDATE']);
			}
			if(isset($_POST['client_code']))
			{
				$arr="";
				$to_date1=date_create($_POST['to_date']);
				$to_date1=date_format($to_date1,"Y-m-d");

				$to_date=date_create($_POST['to_date']);
			    $to_date=date_format($to_date,"d/m/Y");

				$from_date1=date_create($_POST['from_date']);
				$from_date1=date_format($from_date1,"Y-m-d");

				$from_date=date_create($_POST['from_date']);
			    $from_date=date_format($from_date,"d/m/Y");

				$client_code=strtoupper($_POST['client_code']);
				///////////////////////////Check Code
					$trading_user=$_SESSION['No_of_client_list'];
					$ses_client_code_new=0;
					foreach ($trading_user as $people) {

						if (in_array($client_code, $people, TRUE)){

							$ses_client_code_new=$people['TRADING_CLIENT_ID'];
						}
					}
					if($ses_client_code_new=="0"){
						$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client code!");
						redirect(base_url('Dashboard/My_brokerage'));
					}
					///////////////////////////Check Code

				$this->session->set_userdata('My_brokerage_client_code',$client_code);
				$this->session->set_userdata('My_brokerage_FromDate',$from_date1);
				$this->session->set_userdata('My_brokerage_ToDATE',$to_date1);

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
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$from_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE&CLIENT_ID=".$client_code."&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
				// echo $api_url;exit();
				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);

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
				
				$back_data = $farray[1];
				$this->load->view('User/header.php');
				$this->load->view('User/my_brokerage.php',['back_data'=>$back_data]);
				$this->load->view('User/footer.php');

			}
			else
			{
				$arr="";
				$to_date = date("d/m/Y",strtotime("-1 days"));
	
				$current_month = date('m');
				$current_year = date('Y');
				$prev_date='01'.'/'.$current_month.'/'.$current_year;

				// $prev_date=date('d/m/Y',strtotime("-31 days"));
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
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
				// echo $api_url;exit();
				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				if(isset($farray)){
					$back_data = $farray[1];
				}else
				{
					$back_data[] ="";
				}
				

				$this->load->view('User/header.php');
				$this->load->view('User/my_brokerage.php',['back_data'=>$back_data]);
				$this->load->view('User/footer.php');
			}

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function monthWise_revenue_days()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$arr="";
			
			$to_date = date("d/m/Y",strtotime("+1  days"));
			// $prev_date=date('d/m/Y',strtotime("-31 days"));
			$current_month =  date('m');
			$current_year = date('Y');

			$prev_date='01'.'/'.$current_month.'/'.$current_year;


			$prev_month_fisrt_date=date("j/n/Y", strtotime("first day of previous month"));
			$prev_month_last_date=date("j/n/Y", strtotime("last day of previous month"));

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
			$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 


			$model = $this->load->model("Api_model");
			$result1 = $this->Api_model->api_data_get($api_url);
			$arr = json_decode($result1);
			// print_r($arr);
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
			$total=0;
			foreach ($farray[1] as $key => $value) {
		        $total+= $value['4'];
						
			}
			if(isset($_SESSION['Total_Brokerage'])){
				unset($_SESSION['Total_Brokerage']);
			}
			$this->session->set_userdata('Total_Brokerage',$total);
			echo $total;		
			}
			
		}
	public function monthWise_revenue_prevoius_month()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$arr="";
			
			$to_date = date("d/m/Y",strtotime("-1  days"));
			// $prev_date=date('d/m/Y',strtotime("-31 days"));
			$current_month =  date('m');
			$current_year = date('Y');

			$prev_date='01'.'/'.$current_month.'/'.$current_year;


			$prev_month_fisrt_date=date("j/n/Y", strtotime("first day of previous month"));
			$prev_month_last_date=date("j/n/Y", strtotime("last day of previous month"));

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
			$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_month_fisrt_date."&TO_DATE=".$prev_month_last_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 


			$model = $this->load->model("Api_model");
			$result1 = $this->Api_model->api_data_get($api_url);
			$arr = json_decode($result1);
			// print_r($arr);
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
			$total=0;
			if(!empty($farray))
			{
				foreach ($farray[1] as $key => $value)
				{
		        	$total+= $value['4'];
						
				}
			}
			echo $total;		
			}
			
		}
		public function monthWise_brokerage_excel()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$arr="";
				$branch_code=$_SESSION['APBackOffice_user_code'];


				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/01/".$year;
					$prev_date="01/01/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/01/".$year;
					$prev_date="01/01/".$year;
				}
				
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
					// echo $api_url;
				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_Jan',$total);		
			}
			$arr="";
				
				// $to_date = "28/02/".date('Y');
				// $prev_date="01/02/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }	
					$to_date = "28/02/".$year;
					$prev_date="01/02/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "28/02/".$year;
					$prev_date="01/02/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }	
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_Feb',$total);
			$arr="";
				
				$to_date = "31/03/".date('Y');
				$prev_date="01/03/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }	
					$to_date = "31/03/".$year;
					$prev_date="01/03/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/03/".$year;
					$prev_date="01/03/".$year;
				}	
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_March',$total);
			$arr="";
				
				$to_date = "30/04/".date('Y');
				$prev_date="01/04/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }	
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/04/".$year;
					$prev_date="01/04/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/04/".$year;
					$prev_date="01/04/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }	
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($api_url);
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
					echo "0";
				}
				else
				{

					$total=0;
					foreach ($farray[1] as $key => $value) {
				        $total+= $value['4'];
								
					}
					
					$this->session->set_userdata('monthWise_April',$total);
					$arr="";
				
				$to_date = "31/05/".date('Y');
				$prev_date="01/05/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/05/".$year;
					$prev_date="01/05/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/05/".$year;
					$prev_date="01/05/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_May',$total);
			$arr="";
				
				$to_date = "30/06/".date('Y');
				$prev_date="01/06/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "30/06/".$year;
					$prev_date="01/06/".$year;
				}
				else
				{
					$year=date("Y");
					$to_date = "30/06/".$year;
					$prev_date="01/06/".$year;
				}	
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_June',$total);
			$arr="";
				$to_date = "31/07/".date('Y');
				$prev_date="01/07/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/07/".$year;
					$prev_date="01/07/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/07/".$year;
					$prev_date="01/07/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_July',$total);
			$arr="";
				$to_date = "31/08/".date('Y');
				$prev_date="01/08/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/08/".$year;
					$prev_date="01/08/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/08/".$year;
					$prev_date="01/08/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_August',$total);
			$arr="";
				$to_date = "30/09/".date('Y');
				$prev_date="01/09/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "30/09/".$year;
					$prev_date="01/09/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/09/".$year;
					$prev_date="01/09/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_September',$total);	
			$arr="";
				$to_date = "31/10/".date('Y');
				$prev_date="01/10/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/10/".$year;
					$prev_date="01/10/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/10/".$year;
					$prev_date="01/10/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_Octomber',$total);
			$arr="";
				$to_date = "30/11/".date('Y');
				$prev_date="01/11/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "30/11/".$year;
					$prev_date="01/11/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/11/".$year;
					$prev_date="01/11/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_November',$total);
			$arr="";
				$to_date = "31/12/".date('Y');
				$prev_date="01/12/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/12/".$year;
					$prev_date="01/12/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/12/".$year;
					$prev_date="01/12/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			
			$this->session->set_userdata('monthWise_December',$total);
					$this->load->view('User/monthWise_brokerage_excel.php');
				}
			}
		}
		public function monthWise_December()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$to_date = "31/12/".date('Y');
				$prev_date="01/12/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/12/".$year;
					$prev_date="01/12/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/12/".$year;
					$prev_date="01/12/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_December',$total);		
			}
			
		}
		public function monthWise_November()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$to_date = "30/11/".date('Y');
				$prev_date="01/11/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "30/11/".$year;
					$prev_date="01/11/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/11/".$year;
					$prev_date="01/11/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_November',$total);		
			}
			
		}

		public function monthWise_Octomber()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$to_date = "31/10/".date('Y');
				$prev_date="01/10/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/10/".$year;
					$prev_date="01/10/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/10/".$year;
					$prev_date="01/10/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_Octomber',$total);		
			}
			
		}
		public function monthWise_September()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$to_date = "30/09/".date('Y');
				$prev_date="01/09/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "30/09/".$year;
					$prev_date="01/09/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/09/".$year;
					$prev_date="01/09/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_September',$total);		
			}
			
		}
		public function monthWise_August()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$to_date = "31/08/".date('Y');
				$prev_date="01/08/".date('Y');
				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/08/".$year;
					$prev_date="01/08/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/08/".$year;
					$prev_date="01/08/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }

				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_August',$total);		
			}
			
		}
		public function monthWise_July()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$to_date = "31/07/".date('Y');
				$prev_date="01/07/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/07/".$year;
					$prev_date="01/07/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/07/".$year;
					$prev_date="01/07/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,NSE_FNO,CD_NSE,MCX,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_July',$total);		
			}
			
		}

		public function monthWise_June()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				
				$to_date = "30/06/".date('Y');
				$prev_date="01/06/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "30/06/".$year;
					$prev_date="01/06/".$year;
				}
				else
				{
					$year=date("Y");
					$to_date = "30/06/".$year;
					$prev_date="01/06/".$year;
				}	
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_June',$total);		
			}
			
		}

		public function monthWise_May()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				
				$to_date = "31/05/".date('Y');
				$prev_date="01/05/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/05/".$year;
					$prev_date="01/05/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/05/".$year;
					$prev_date="01/05/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_May',$total);		
			}
			
		}
		public function monthWise_April()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				
				$to_date = "30/04/".date('Y');
				$prev_date="01/04/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }	
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/04/".$year;
					$prev_date="01/04/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "30/04/".$year;
					$prev_date="01/04/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }	
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($api_url);
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
					echo "0";
				}
				else
				{

					$total=0;
					foreach ($farray[1] as $key => $value) {
				        $total+= $value['4'];
								
					}
					echo $total;
					$this->session->set_userdata('monthWise_April',$total);
				}
						
			}
			
		}
		public function monthWise_March()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				
				$to_date = "31/03/".date('Y');
				$prev_date="01/03/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }	
					$to_date = "31/03/".$year;
					$prev_date="01/03/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/03/".$year;
					$prev_date="01/03/".$year;
				}	
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_March',$total);		
			}
			
		}
		public function monthWise_Feb()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				
				// $to_date = "28/02/".date('Y');
				// $prev_date="01/02/".date('Y');

				$branch_code=$_SESSION['APBackOffice_user_code'];
				
	
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }	
					$to_date = "28/02/".$year;
					$prev_date="01/02/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "28/02/".$year;
					$prev_date="01/02/".$year;
				}
				// if($year>=date('Y'))
				// {
				// 	$year=date("Y");
				// }	
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 

				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_Feb',$total);		
			}
			
		}
		public function monthWise_Jan()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$arr="";
				$branch_code=$_SESSION['APBackOffice_user_code'];


				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
					$year=$_SESSION['finacial_year_apbackoffice'];
					// if($year>=date('Y'))
					// {
					// 	$year=date("Y");
					// }
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];	
					$to_date = "31/01/".$year;
					$prev_date="01/01/".$year;
				}
				else
				{
					$year=date("Y");
					$finacial_years=$this->get_finacial_year_range($year);
				    $year=$finacial_years['year'];
					$to_date = "31/01/".$year;
					$prev_date="01/01/".$year;
				}
				
				$api_url = "http://192.168.102.101:8080/techexcelapi/index.cfm/Brk_RemeshireView/Brk_RemeshireView1?&FROM_DATE=".$prev_date."&TO_DATE=".$to_date."&COMPANY_CODE=BSE_CASH,NSE_CASH,BSE_FNO,NSE_FNO,CD_NSE,MCX,NSE_SLBM,ICEX,MF_BSE&CLIENT_ID=&BRANCH=".$branch_code."&SCRIP_SYMBOL=&POLICY=4api&UrlUserName=techapi&UrlPassword=techapi@123&UrlDatabase=capsfo&UrlDataYear=".$year.""; 
					// echo $api_url;
				$model = $this->load->model("Api_model");
				$result1 = $this->Api_model->api_data_get($api_url);
				$arr = json_decode($result1);
				// print_r($arr);
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
				$total=0;
				foreach ($farray[1] as $key => $value) {
			        $total+= $value['4'];
							
				}
			echo $total;
			$this->session->set_userdata('monthWise_Jan',$total);		
			}
			
		}
		function get_finacial_year_range($year)
		{
			$month = date('m');
			if($month<4){
			    $year = $year-1;
			}
			$start_date = date('d/m/Y',strtotime(($year).'-04-01'));
			$end_date = date('d/m/Y',strtotime(($year+1).'-03-31'));
			$response = array('start_date' => $start_date, 'end_date' => $end_date,'year'=>$year);
			return $response;
		}
		public function year()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				if(isset($_SESSION['finacial_year_apbackoffice']))
				{
		    		$year=$_SESSION['finacial_year_apbackoffice'];
		    		$finacial_years=$this->get_finacial_year_range($year);
		    		$year=$finacial_years['year'];
		    		echo $year;
				}
				else
				{
		   		 	$year=date("Y");
		    		$finacial_years=$this->get_finacial_year_range($year);
		    		$year=$finacial_years['year'];
		    		echo $year;
				}	
			}
		}
		public function My_brokerage_chart()
		{
			if(isset($_SESSION['APBackOffice_user_code']))
			{
				$this->load->view('User/header.php');
				$this->load->view('User/my_brokerage_chart.php');
				$this->load->view('User/footer.php');
			}
		}
	
}