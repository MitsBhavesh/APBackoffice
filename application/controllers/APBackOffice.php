<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APBackOffice extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{

			$this->load->view('User/login.php');
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function Login()
	{
		if($data=$this->input->post())
		{
			$branch_code=$_POST['branch_code'];
			$password=$_POST['password'];
			// $this->session->set_userdata('APBackOffice_danger_alert',"Technical issue please wait! we will working on it!");
			// redirect(base_url('Dashboard'));
			$AP_No_Of_Client = $this->load->database('AP_No_Of_Client', TRUE);
			$AP_No_Of_Client1 = $this->load->database('AP_No_Of_Client_local', TRUE);

			$sql = "EXEC Proc_ApOffice_login '$branch_code','$password'";

			$result1 = $AP_No_Of_Client->query($sql)->result_array();

			
			//SELECT Branch_code,CONVERT(varchar(8000),DECRYPTBYPASSPHRASE('ACM',Password))as APassword FROM tbl_APOffice_Login WHERE Branch_code='ACM'
			if($result1[0][""] == "1")
			{
				$sql="EXEC Proc_API_APGETDATA '$branch_code'";

				// $sql="EXEC Proc_API_APCLIENTGET '$branch_code'";

				$result = $AP_No_Of_Client1->query($sql)->result_array();

				
				if(!empty($result))
				{
					if($password=='ascpl@123')
					{
						redirect(base_url('APBackOffice/Forgot_Password'));
					}	
					else
					{
						$this->session->set_userdata('APBackOffice_user_code',$branch_code);
						$this->session->set_userdata('APBackOffice_success_alert',"Login Successfully!");
						$this->session->set_userdata('finacial_year_apbackoffice',date('Y'));
						
						date_default_timezone_set('Asia/Kolkata');
						$myfile2 = fopen("login_log.txt", "a") or die("Unable to open file!");
						$txt2 = "\n".$branch_code."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
						fwrite($myfile2, $txt2);
						redirect(base_url('Dashboard'));
					}
				}
				elseif (empty($result)) 
				{
					// echo "hi";
					// exit();
					$sql="EXEC Proc_API_APCLIENTGET '$branch_code'";
					$result = $AP_No_Of_Client1->query($sql)->result_array();
				// 	print_r($result);
				// exit();


					if($password=='ascpl@123')
					{
						redirect(base_url('APBackOffice/Forgot_Password'));
					}
					else
					{
						$this->session->set_userdata('APBackOffice_user_code',$branch_code);
						$this->session->set_userdata('APBackOffice_success_alert',"Login Successfully!");
						$this->session->set_userdata('finacial_year_apbackoffice',date('Y'));
						
						date_default_timezone_set('Asia/Kolkata');
						
						$myfile2 = fopen("login_log2.txt", "a") or die("Unable to open file!");
						$txt2 = "\n".$branch_code."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
						fwrite($myfile2, $txt2);
						redirect(base_url('Dashboard'));
					}	

				} 
				else
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Invalid APcode Or Password!");
					$this->load->view('User/login.php');
				}
			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Invalid APcode Or Password!");
				$this->load->view('User/login.php');
			}

		}
		else
		{
			$this->load->view('User/login.php');
		}
	}
	public function logout()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			unset($_SESSION['APBackOffice_user_code']);
		}
		if(isset($_SESSION['APBackOffice_success_alert']))
		{
			unset($_SESSION['APBackOffice_success_alert']);
		}
		//Contract And Bill Session##########################
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
		if(isset($_SESSION['My_brokerage_client_code'])) 
		{
			unset($_SESSION['My_brokerage_client_code']);
		}
		if(isset($_SESSION['No_of_client_list'])) 
		{
			unset($_SESSION['No_of_client_list']);
		}
		if(isset($_SESSION['No_of_client'])) 
		{
			unset($_SESSION['No_of_client']);
		}
		if(isset($_SESSION['My_account_opening_authorize'])) 
		{
			unset($_SESSION['My_account_opening_authorize']);
		}
		if(isset($_SESSION['Total_Brokerage'])) 
		{
			unset($_SESSION['Total_Brokerage']);
		}
		if(isset($_SESSION['No_of_client_list'])) 
		{
			unset($_SESSION['No_of_client_list']);
		}
		if(isset($_SESSION['AP_Online_ipo_list_api'])) 
		{
			unset($_SESSION['AP_Online_ipo_list_api']);
		}
		if(isset($_SESSION['APBackOffice_IPO_TOKEN'])) 
		{
			unset($_SESSION['APBackOffice_IPO_TOKEN']);
		}
		session_destroy();
		echo '<script type="text/javascript">window.localStorage.clear();localStorage.removeItem("counter");</script>';

		redirect(base_url('APBackOffice'));
	}
	public function Change_Password()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if($data=$this->input->post())
			{
				// print_r($_POST);
				$branch_code=$_SESSION['APBackOffice_user_code'];
				$old_password=$_POST['old_password'];
				$new_password=$_POST['new_password'];
				$re_password=$_POST['re_password'];
				if($new_password==" ")
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Not Allowed!");
					redirect(base_url('APBackOffice/Change_Password'));
				}

				// exec AP_ChangePassword 'PPS','F9694D41','123456'
				$APOffice = $this->load->database('KYC_db', TRUE);

				$sql = "exec AP_ChangePassword '$branch_code','$old_password','$new_password'";
				// echo $sql;
				// exit();
				$result = $APOffice->query($sql);
				// print_r($result);
				// exit();
				if($result == "[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Invalid UserName or Password")
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Old Password Wrong or Password does't match!");
					redirect(base_url('APBackOffice/Change_Password'));
				}
				if($result == "[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Your old password and new password cannot be same.")
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Your old password and new password cannot be same.");
					redirect(base_url('APBackOffice/Change_Password'));
				}
				// $row = $result->row_array();
				// print_r($row);
				// exit();
				if($result)
				{
					$this->session->set_userdata('APBackOffice_success',"Change Password Succesfully!");
					 redirect(base_url('APBackOffice/Change_Password'));
				}
			}
			else
			{
				$this->load->view('User/header.php');
				$this->load->view('User/change_password.php');
				$this->load->view('User/footer.php');
			}
		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
	public function profile()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$AP_No_Of_Client = $this->load->database('AP_No_Of_Client_local', TRUE);
			$branch_code=$_SESSION['APBackOffice_user_code'];

			$sql="EXEC Proc_API_APGETDATA '$branch_code'";
			$result1 = $AP_No_Of_Client->query($sql)->result_array();
			// print_r($result1);
			// exit();
			
			// if(empty($result))
			// {
				
			// 	$sql1="EXEC Proc_API_APCLIENTGET '$branch_code'";
			// 	$result1 = $AP_No_Of_Client->query($sql1)->result_array();

			// 	$this->load->view('User/header.php');
			// 	$this->load->view('User/profile_new.php',['result1'=>$result1]);
			// 	$this->load->view('User/footer.php');
			// }
			// else
			// {
				// echo "No empty";
				// exit();
				// $result="";
				$this->load->view('User/header.php');
				$this->load->view('User/profile.php',['result1'=>$result1]);
				$this->load->view('User/footer.php');

			

			// foreach ($result as $key => $value) {
			// 	echo $value['COMPANY_CODE'];
				
			// }
			
			

		// }
	}

	else{
			redirect(base_url('Dashboard'));
		}
	}
	// public function testt()
	// {
	// 	if(($handle = fopen("Book1.csv", "r")) !== FALSE) 
	// 	{
	// 	    $n = 1;
	// 	    $AP_No_Of_Client = $this->load->database('AP_No_Of_Client', TRUE);
	// 	    while(($row = fgetcsv($handle))!== FALSE)
	// 	    {
	// 	        $branch_code=$row[0];
	// 	        $email=$row[1];
	// 	        $password='ascpl@123';

	// 	        $sql="exec Proc_APOffice_LoginInsert '$branch_code','$password','$email'";
	// 	        $result = $AP_No_Of_Client->query($sql)->result_array();
	// 	        print_r($result);
		        
	// 	    }
	// 	    ini_set('auto_detect_line_endings',FALSE);
	// 	}
	// }
	
	public function Forgot_Password()
	{
		
		if($data=$this->input->post())
		{
			
			$branch_code=$data['branch_code'];
			$email=$data['email'];
			// print_r($email);exit();
			$AP_No_Of_Client = $this->load->database('AP_No_Of_Client_local', TRUE);
			
			$sql="EXEC Proc_API_APGETDATA '$branch_code'";
			$result = $AP_No_Of_Client->query($sql)->result_array();
			// echo "<pre>";
			// print_r($result);exit();
			$ap_email=$result[0]['EMAIL_ID'];

			// print_r($result[0]['EMAIL_ID']);exit();
			// print_r($ap_email);
			// exit();

			if(strtolower($email)==strtolower($ap_email))
			{	
				$APOffice = $this->load->database('APOffice', TRUE);

				$sql = "exec Proc_APOffice_Forgot_password '$branch_code','$email'";
				$result = $APOffice->query($sql);
				
				if($result == "[Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Executing SQL directly; no cursor.")
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Wrong employee code or email!");
					redirect(base_url('APBackOffice/Forgot_password'));
				}

				$row = $result->row_array();
				// print_r($row);
				// exit();
				if($row)
				{
					$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'us2.smtp.mailhostbox.com',
					'smtp_port' => 587,
					'smtp_user' => 'donotreply@arhamshare.com', // change it to yours
					'smtp_pass' => 'H$#WTyZ0', // change it to yours
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					// 'wordwrap' => TRUE
					);
				    $message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'\application\views\template\forgot_pass.php');

				    foreach($row as $key => $value)
				    {
				    	$message = str_replace('{{ key }}', $value, $message);
				    }
				    
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$this->email->from('donotreply@arhamshare.com'); // change it to yours
					 // $this->email->to("axay.p@arhamshare.com");// change it to yours
					$this->email->to($ap_email);// change it to yours
					$this->email->subject('Forgot Password');
					$this->email->message($message);
					// print_r($message);exit();
					if($this->email->send())
					{
					  	$this->session->set_userdata('APBackOffice_success',"Succesfully send password to your email! sign in back");
					  	redirect(base_url('Dashboard'));
					}
					else
					{
					 	$this->session->set_userdata('APBackOffice_danger_alert',"Error send to mail ! try again!");
						redirect(base_url('APBackOffice/Forgot_password'));
					}
				}
				else
				{
					$this->session->set_userdata('APBackOffice_danger_alert',"Please Enter Employee Code and Email!");
					redirect(base_url('APBackOffice/Forgot_password'));
				}
			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Wrong email id!");
				redirect(base_url('APBackOffice/Forgot_password'));
			}

		}
		else
		{
			$this->load->view('User/forgotpassword.php');
		}
	}
	public function Select_year()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$Year=$_POST['finacial_year'];
			$this->session->set_userdata('finacial_year_apbackoffice',$Year);
			// if(isset($_SESSION['finacial_year_apbackoffice']))
			// {
			// 	unset($_SESSION['finacial_year_apbackoffice']);
			// }
			$HTTP_REFERER=$_SERVER['HTTP_REFERER'];
			redirect($HTTP_REFERER);
			// header("Refresh:0; url=page2.php");

		}
		else
		{
			redirect(base_url('Dashboard'));
		}
	}
}