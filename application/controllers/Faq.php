<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));

		}else
		{
			$KYC_db = $this->load->database('KYC_db_test', TRUE);
			$sql = "exec Proc_AP_FAQs_Get";
			$results = $KYC_db->query($sql)->result_array();

			$this->load->view('User/header.php');
			$this->load->view('User/faq.php',["results"=>$results]);
			$this->load->view('User/footer.php');
	}
	}
}
