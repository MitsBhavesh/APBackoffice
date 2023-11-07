<?php

class Call_process extends CI_Controller{

    public function index()
    {
        if(isset($_SESSION['APBackOffice_user_code']))
        {
        	$branch_code=$_SESSION['APBackOffice_user_code'];
        	$AP_No_Of_Client=$this->load->database('AP_No_Of_Client',TRUE);
        	$sql="EXEC Proc_SubCall_FileGET '$branch_code'";

			$result = $AP_No_Of_Client->query($sql)->result_array();
			$this->load->view('User/header.php');
			$this->load->view('User/call_process.php',['result'=>$result]);
			$this->load->view('User/footer.php');
		}
		else{
			redirect(base_url('Dashboard'));
		}
    }
    public function Upload_file()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			$branch_code=$_SESSION['APBackOffice_user_code'];
			date_default_timezone_set("Asia/Calcutta"); 
			$current_date = date("dmYhis");
			$Uploaded_date = date("d-m-Y");
			$Update = date("d/m/Y");
			
			$target_dir = 'E:/SUBCall_Process/'.$branch_code."/".$Uploaded_date."/";

			if (!file_exists($target_dir)) {

				mkdir('E:/SUBCall_Process/'.$branch_code."/".$Uploaded_date."/", 0777, true);
			}
			$file = $_FILES['zip_file']['name'];

			$fileName = strtolower($file);
			$allowedExts = array('zip');
			$extension = explode(".", $fileName);   
			$extension = end($extension);
			$ip_address= $this->input->ip_address();

			if(in_array($extension, $allowedExts))
			{
			   	$temp_name = $_FILES['zip_file']['tmp_name'];
				$path_filename_ext = $target_dir.$branch_code."_".$current_date.".".$extension;
				$new_file_name=$branch_code."_".$current_date.".".$extension;
				$AP_No_Of_Client=$this->load->database('AP_No_Of_Client',TRUE);
				$sql ="EXEC Proc_SubCall_FileInsert '$Uploaded_date','$new_file_name','$path_filename_ext','$branch_code','$ip_address'";
				$result = $AP_No_Of_Client->query($sql);
			   	move_uploaded_file($temp_name,$path_filename_ext);

			   	// exit();
			   	$this->session->set_userdata('APBackOffice_success',"Uploaded!");
				redirect(base_url('Call_process'));
			}
			else
			{
				$this->session->set_userdata('APBackOffice_danger_alert',"Only .ZIP File Supported!");
				redirect(base_url('Call_process'));
			}
			
		}
		else
		{
			redirect(base_url('Call_process'));
		}
	}
	public function List_File()
	{
		if(isset($_SESSION['APBackOffice_user_code']))
		{
			if($data=$this->input->post())
			{
				$from_date=$data['from_date'];
				$to_date=$data['to_date'];
				
				
				if(isset($_SESSION['Arham_recording_from_date']))
				{
					unset($_SESSION['Arham_recording_from_date']);
				}
				if(isset($_SESSION['Arham_recording_to_date']))
				{
					unset($_SESSION['Arham_recording_to_date']);
				}
				$this->session->set_userdata('Arham_recording_from_date',$from_date);
				$this->session->set_userdata('Arham_recording_to_date',$to_date);
				$AP_No_Of_Client=$this->load->database('AP_No_Of_Client',TRUE);
				$sql ="exec Proc_SubCall_Process_date '$from_date','$to_date'";

				$result = $AP_No_Of_Client->query($sql)->result_array();
				// print_r($sql);exit();

				$this->load->view('User/header.php');
				$this->load->view('User/call_process.php',['result'=>$result]);
				$this->load->view('User/footer.php');

			}
		}
	}

}
