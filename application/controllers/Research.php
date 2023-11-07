<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Research extends CI_Controller {

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('Dashboard'));
		}
		else
		{
			$client_code=array("A0342","A0501","A0502","A0520","A0772","A0868","A0915","A1201","A1202","A1446");
			$this->load->view('User/header.php');
			$this->load->view('User/research.php',['client_code'=>$client_code]);
			$this->load->view('User/footer.php');
		}
	
	}
	public function Technical_Daily_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Daily_Report.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/DailyReports/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}


	public function Technical_Index_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Index.pdf";   
	 	// $today_date=date('dmY');
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/2_INVESTMENTMAXIMIZER/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}

	public function Technical_Stock_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Stock.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/6_FUNDAMENTALSTOCKBASKET/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}

	public function Technical_DiwaliMonth_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Diwali_Month.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/TechnicalResearch/3_FESTIVALPICK/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}


	public function Fundamental_DailyMarket_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Daily_Market.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/1_IPORESEARCH/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}

	public function Fundamental_Result_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Result.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/5_QTRRESULTUPDATE/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}

	public function Fundamental_Investment_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Investment.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/2_INVESTMENTMAXIMIZER/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}

	public function Fundamental_SIP_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="SIP.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/3_SIPMAXIMIZER/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}
	
	public function Fundamental_DiwaliMonth_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="Diwali_Month.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/4_FESTIVALPICK/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}
	
	public function PremiumProduct_ArhamMaximizer_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="ArhamMaximizer.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/7_PREMIUMRESEARCHARHAM MAXIMIZER/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}

	public function PremiumProduct_ArhamIQ_Report()
	{
	 	// $f="daily_report.xlsx"; 
		$f="ArhamIQ.pdf";   
	 	// $today_date=date('dmY');
   		//	$file = ("E:/RESEARCH_FILE/Technical_Daily_File/$today_date/$f");
       	$file = ("E:/RESEARCH_FILE/ReseaarchReports/FundamentalResearch/8_FUNDAMENTALCARD/$f");
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
	    else
	    {
	    	$_SESSION['APBackOffice_danger_alert'] = "File not found!";
	    	redirect(base_url('Research'));
	    }
	   
	}
}
