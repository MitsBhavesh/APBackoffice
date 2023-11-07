<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AP_SME_IPO extends CI_Controller {

	public function index()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{

			$this->load->view('User/header.php');
			$this->load->view('User/IPO/sme_ipo.php');
			$this->load->view('User/footer.php');
		}
		else
		{	
			redirect(base_url('APBackOffice'));
		}
	}

	public function Get_FileData()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('APBackOffice'));
		}
		else
		{
			// print_r($_POST); die;
			if(empty($_POST))
			{
				echo "No Data"; die();
			}

			$sme_ipo_name =  str_replace(' ', '_', $_POST['sme_ipo_name']);
			if($sme_ipo_name == 'Please Select IPO')
			{
				echo "Select SME IPO Name"; die();
			}
			// $sme_ipo_qty = $_POST['sme_ipo_qty'];
			// $sme_ipo_price = $_POST['sme_ipo_price'];
			// $sme_ipo_Amount = $_POST['sme_ipo_Amount'];
			$data = $_POST;

			if(!empty($_POST['sme_ipo_type']) && isset($_POST['sme_ipo_type']))
			{
				if($_POST['sme_ipo_type'] == 'BSE')
				{
					$this->load->view('User/PDF/Create_SME_IPO_PDF.php',["data"=>$data]);
				}
				else if($_POST['sme_ipo_type'] == 'NSE')
				{
					$this->load->view('User/PDF/NSE_SME_IPO_PDF.php',["data"=>$data]);	
				}

			}


			// $path = '\\192.168.102.100\e\usermanagement\IPO_PDF\SME_SERIES/'.$sme_ipo_name.'_IPO_SME_SERIES.txt';
			// // print_r($path); die();

			// if(!file_exists($path))
			// {
			// 	echo "Invalid";
			// 	exit;
			// 	// $this->session->set_userdata('Arham_user_danger_alert',"Upload SME Series.");
			// 	// redirect(base_url('HelpDesk/IPOBulk_PDF'));
			// }

			// $get_txt_data = file_get_contents($path);
			// $ipo_price = explode('#',$get_txt_data); 
			// $ipo_name = explode('#',$get_txt_data); 

			// $get_price = $ipo_price[1];
			// $get_nm = $ipo_price[2];
			// $get_qty = explode(',',$ipo_price[0]);
			// print_r($get_qty); die;

			// if(!empty($get_qty))
			// {
			// 	foreach ($get_qty as $value)
			// 	{
			// 		// print_r($get_txt_data);
			// 		print_r("<option>".$value."</option>");
			// 	}
			// }			
		}
	}

	public function abc_test()
	{
		echo "<script>alert('Invalid CSV File.');</script>";
		echo "<script>window.location = '".base_url('AP_SME_IPO')."'</script>";
	}

	public function SME_QTY()
	{
		// echo "get data";	
		$path = file_get_contents('//192.168.102.100\e\usermanagement\IPO_PDF\SME_SERIES/'.$_POST["off_ipo"].'.txt');
		// print_r($path);
		$ArrOfSME = explode("#", $path);
		$ArrOfQty = explode(",", $ArrOfSME[0]);

		foreach ($ArrOfQty as $key => $value)
		{
			echo "<option value='".$value."'>".$value."</option>";
		}
	}

	public function SME_Price()
	{
		// echo "get data";	
		$path = file_get_contents('//192.168.102.100\e\usermanagement\IPO_PDF\SME_SERIES/'.$_POST["off_ipo"].'.txt');
		// print_r($path);
		$ArrOfSME = explode("#", $path);
		// $ArrOfQty = explode(",", $ArrOfSME[0]);
		print_r($ArrOfSME[1]);
		
		// foreach ($ArrOfQty as $key => $value)
		// {
		// 	echo "<option value='".$value."'>".$value."</option>";
		// }
	}
}