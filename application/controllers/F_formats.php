<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class F_formats extends CI_Controller {

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));

		}else
		{
			$file_path = "E:/KYC/KYC DOCUMENT/New_name/";
 
			$pdffiles = array();
			$valid_files = array('pdf','xlsx','txt','csv','docx','doc','xls','jpg','png');

			if(is_dir($file_path)){

			  foreach(scandir($file_path) as $file)
			  {

			    $ext = pathinfo($file, PATHINFO_EXTENSION);

			    if(in_array($ext, $valid_files)){

			     	array_push($pdffiles, $file);
			    }   
			}
		}
		// foreach ($pdffiles as $value) {
		// 	$file_name =str_replace(array(' ', '&' ), '_', $value);
		// 	rename ("E:/KYC/KYC DOCUMENT/$value", "E:/KYC/KYC DOCUMENT/New_name/$file_name");
		// }

		$this->load->view('User/header.php');
		$this->load->view('User/f_formats.php',['pdffiles'=>$pdffiles]);
		$this->load->view('User/footer.php'); 
	}
	}
	public function KYC_doc_download()
	{
		$file_name= $_GET['file_name']; 

       	$file = ("E:/KYC/KYC DOCUMENT/New_name/$file_name");
       	
       	if(file_exists($file))
       	{
	        $filetype=filetype($file);

	        $filename=basename($file);

	        header ("Content-Type: ".$filetype);

	        header ("Content-Length: ".filesize($file));

	        header ("Content-Disposition: attachment; filename=".$filename);

	        readfile($file);
	    }
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('F_formats'));
	    }
	}
}
