<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Digital extends CI_Controller {

	public function index()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));

		}else
		{

		$this->load->view('User/header.php');
		$this->load->view('User/digital.php');
		$this->load->view('User/footer.php');
		}
	}

	public function Imagetotext()
	{
		$sourcelocation = $_SERVER['DOCUMENT_ROOT'].'\assets\images\small\Festival_post\IMG_AP_21092022105944.jpg';
		echo file_get_contents($sourcelocation);
		exit();
		//create the image from existing image
		  
		$image = imagecreatefromjpeg($sourcelocation);
		//destination file name where you want to store the new image
		
		$output = $_SERVER['DOCUMENT_ROOT'].'\assets\images\small\img-56.jpg';
		//declaring the colors
		$orig_width = imagesx($image);
  		$orig_height = imagesy($image);
		// // Allocate A Color For The background
  // 		$bcolor=imagecolorallocate($image, 0x00,0x80,0x00);

  // 		//Create background
  // 		imagefilledrectangle($image,  0, $orig_height*0.8, $orig_width, $orig_height, $bcolor);
		  
		$white = imagecolorallocate($image,255,255,255);
		  
		$black = imagecolorallocate($image,0,0,0);
		//font size of the text
		$font_size = 10;
		//rotation of the text
		$rotation = 0;
		//x- coordinate where you want to pace the text
		$origin_x = 390;
		//y- coordinate where you want to pace the text
		$origin_y =490;
		//font style of the text.we need to give the location of.ttf file
		// $font = "font\open-sans\OpenSans-Bold.ttf";  
		$font =$_SERVER['DOCUMENT_ROOT'].'\assets\fonts\GreatVibes-Regular.otf';
		// echo $font;exit();
		 //text you want to add to the image
		$AP_No_Of_Client = $this->load->database('AP_No_Of_Client', TRUE);
		$branch_code=$_SESSION['APBackOffice_user_code'];
		$sql="EXEC Proc_API_APGETDATA '$branch_code'";
		$result = $AP_No_Of_Client->query($sql)->result_array();
		$ap_name=$result[0]['REMESHIRE_NAME'];

		$text="Best Wishes From ".$ap_name;
		$text1 = imagettftext($image,$font_size,$rotation,$origin_x,$origin_y,$black,$font,$text);
		
		imagejpeg($image,$output);


		//
		$stamp = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'\logo.png');

		$im = imagecreatefromjpeg($output);

		$save_watermark_photo_address = $_SERVER['DOCUMENT_ROOT'].'\assets\images\small\img-56.jpg';

		// echo $save_watermark_photo_address;

		// Set the margins for the stamp and get the height/width of the stamp image

		$marge_right = 550;
		$marge_bottom = 450;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);


		// Copy the stamp image onto our photo using the margin offsets and the photo 
		// width to calculate positioning of the stamp. 

		imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

		// Output and free memory
		// header('Content-type: image/png');

		imagejpeg($im, $save_watermark_photo_address, 100); 
		imagedestroy($im);

		//
		redirect(base_url('Digital'));
	}

	public function Festival_post()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));
		}
		else
		{	
			$KYC_db_local = $this->load->database('KYC_db_local', TRUE);
			$sql="exec Proc_AP_DigitalGetCategoty 'Festival_post'";

			$result = $KYC_db_local->query($sql)->result_array();
			
			// $AP_No_Of_Client = $this->load->database('AP_No_Of_Client', TRUE);
// echo "<pre>";
// print_r($result);
// exit();
			// foreach ($result as $key => $value) {
			// 	$sourcelocation = $value['File_path'];
			// 	// //create the image from existing image
				  
			// 	$image = imagecreatefromjpeg($sourcelocation);
			// 	// //destination file name where you want to store the new image
			// 	$path="//192.168.102.202/e/xampp/htdocs/APBackOffice/assets/images/small/Festival_post/";
			// 	// move_uploaded_file($tmp_name, "$uploads_dir/$name");

			// 	$basename = pathinfo($value['File_path']);
				
			// 	$output = $basename['filename']."_".$_SESSION['APBackOffice_user_code'].".".$basename['extension'];
			// 	// //declaring the colors
			// 	$orig_width = imagesx($image);
		  	// 	$orig_height = imagesy($image);
		  	// 	$white = imagecolorallocate($image,255,255,255);
		  
			// 	$black = imagecolorallocate($image,0,0,0);
			// 	//font size of the text
			// 	$font_size = 11;
			// 	//rotation of the text
			// 	$rotation = 0;
			// 	//x- coordinate where you want to pace the text
			// 	$origin_x = 390;
			// 	//y- coordinate where you want to pace the text
			// 	$origin_y =490;
			// 	//font style of the text.we need to give the location of.ttf file
			// 	// $font = "font\open-sans\OpenSans-Bold.ttf";  
			// 	$font =$_SERVER['DOCUMENT_ROOT'].'\assets\fonts\OpenSans-Bold.ttf';

			// 	//text you want to add to the image
				
			// 	$branch_code=$_SESSION['APBackOffice_user_code'];
			// 	$sql1="EXEC Proc_API_APGETDATA '$branch_code'";
			// 	$result1 = $AP_No_Of_Client->query($sql1)->result_array();
			// 	$ap_name=$result1[0]['REMESHIRE_NAME'];
			// 	$text="Best Wishes From ".$ap_name;
			// 	$text1 = imagettftext($image,$font_size,$rotation,$origin_x,$origin_y,$white,$font,$text);
				
			// 	imagejpeg($image,$output);

			// 	imagedestroy($image);
			// 	 // exit();
				
			// }

			$this->load->view('User/header.php');
			$this->load->view('User/Digital/Festival_post.php',["result"=>$result]);
			$this->load->view('User/footer.php');
		}
	}
	public function Sale_Kit()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));
		}
		else
		{	
			$KYC_db_local = $this->load->database('KYC_db_local', TRUE);
			$sql="exec Proc_AP_DigitalGetCategoty 'Sale_post'";
			$result = $KYC_db_local->query($sql)->result_array();

			$this->load->view('User/header.php');
			$this->load->view('User/Digital/Sale_Kit.php',["result"=>$result]);
			$this->load->view('User/footer.php');
		}
	}
	public function Product_post()
	{
		if(!isset($_SESSION['APBackOffice_user_code'])){

			redirect(base_url('APBackOffice'));
		}
		else
		{	
			$KYC_db_local = $this->load->database('KYC_db_local', TRUE);
			$sql="exec Proc_AP_DigitalGetCategoty 'Product_post'";
			$result = $KYC_db_local->query($sql)->result_array();

			$this->load->view('User/header.php');
			$this->load->view('User/Digital/Product_post.php',["result"=>$result]);
			$this->load->view('User/footer.php');
		}
	}
}