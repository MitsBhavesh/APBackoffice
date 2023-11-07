<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HelpDesk extends CI_Controller {

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code']))
		{
			redirect(base_url('Dashboard'));
		}
		else
		{
			
			$this->load->view('User/header.php');
			$this->load->view('User/helpdesk.php');
			$this->load->view('User/footer.php');
		}
	
	}
		public function kyc_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "dp1@arhamshare.com";
		$bcc1 = "rakesh@arhamshare.com";
		$bcc2 = "chitan.d@arhamshare.com";
		$bcc3 = "anand.s@arhamshare.com";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment ="";


		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_kyc.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);

		$this->sendEmail1($from_email,$to_email,$bcc1,$bcc2,$bcc3,$subject,$message,$attachment);
	}

	public function account_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "Accounts2@arhamshare.com";
		$bcc1 = "";
		$bcc2 = "";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_acc.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}

	public function rms_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "parag.j@arhamshare.com";
		$bcc1 = "nirav.d@arhamshare.com";
		$bcc2 = "manoj.p@arhamshare.com";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_rms.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}

	public function it_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "rohit.v@arhamshare.com";
		$bcc1 = "";
		$bcc2 = "";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_it.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}

	public function wms_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "dixit.j@arhamshare.com";
		$bcc1 = "";
		$bcc2 = "";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_wms.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}

	public function customercare_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "customer@arhamshare.com";
		$bcc1 = "";
		$bcc2 = "";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_cts.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}

	public function research_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "sahil.m@arhamshare.com";
		$bcc1 = "";
		$bcc2 = "";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_res.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}

	public function digital_help()
	{
		$from_email = "donotreply@arhamshare.com";
		$to_email = "jaydeep.s@arhamshare.com";
		$bcc1 = "";
		$bcc2 = "";
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		 	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('attch'))
            {
                $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
            }

		$attachment = $data['upload_data']['full_path'];
		date_default_timezone_set('Asia/Kolkata');
		$myfile2 = fopen("ticket_digital.txt", "a") or die("Unable to open file!");
		$txt2 = "\n".$subject."\n".$message."\n"."KYC"."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
		fwrite($myfile2, $txt2);
		$this->sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment);
	}




	public function sendEmail($from_email,$to_email,$bcc1,$bcc2,$subject,$message,$attachment)
    {
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

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->bcc(array($bcc1, $bcc2));
        $this->email->subject(strtoupper($_SESSION['APBackOffice_user_code'])."--".$subject);
        $this->email->message($message);
        $this->email->attach($attachment);
        
        if($this->email->send())
        {
        	$this->session->set_userdata('APBackOffice_success',"Your Request Send Successfully!");
        	redirect(base_url('HelpDesk'), 'refresh');
        }
        else
        {
        	$this->session->set_userdata('APBackOffice_danger_alert',"Your Request Send Failed!");
        	redirect(base_url('HelpDesk'), 'refresh');
        }

    }
    public function sendEmail1($from_email,$to_email,$bcc1,$bcc2,$bcc3,$subject,$message,$attachment)
    {
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

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($from_email);
        $this->email->to($to_email);
        $this->email->bcc(array($bcc1, $bcc2,$bcc3));
        $this->email->subject(strtoupper($_SESSION['APBackOffice_user_code'])."--".$subject);
        $this->email->message($message);
        $this->email->attach($attachment);
        
        if($this->email->send())
        {
        	$this->session->set_userdata('APBackOffice_success',"Your Request Send Successfully!");
        	redirect(base_url('HelpDesk'), 'refresh');
        }
        else
        {
        	$this->session->set_userdata('APBackOffice_danger_alert',"Your Request Send Failed!");
        	redirect(base_url('HelpDesk'), 'refresh');
        }

    }
	
}
