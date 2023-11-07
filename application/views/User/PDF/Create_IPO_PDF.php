<?php 
include('number_to_word.php');
use setasign\Fpdi\Fpdi;
require_once('fpdf.php');
require_once('FPDI-2.3.4/src/autoload.php');

$ipo_name = $_POST['bulk_ipo_name'];
$ipo_qty = $_POST['bulk_ipo_qty'];
$ipo_price = $_POST['bulk_ipo_price'];
$ipo_amount = $_POST['bulk_ipo_Amount'];
// print_r($sub_category); die;

if($ipo_name == "LICI")
{
	if($sub_category == "IND")
	{	
		$DisPrice = 45 * $ipo_qty;
		$ipo_amount = $ipo_amount - $DisPrice;
	}
	else if($sub_category == "POL")
	{	
		$DisPrice = 60 * $ipo_qty;
		$ipo_amount = $ipo_amount - $DisPrice;
	}
}
$csv = $_FILES['bulk_ipo_file']['tmp_name'];

	$handle = fopen($csv,"r");


	$check_file_get = 0;
	$KYC_db = $this->load->database('AP_No_Of_Client', TRUE);
	while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
	{
		// print_r($row);
		// echo "<pre>";
		// print_r($row[0]);
		$client_code_array = array($row[0]);
		// print_r($client_code_array);
		// exit(); 
		$trading_user=$_SESSION['No_of_client_list'];
		$ses_client_code_new=0;

		$result1=[];
		foreach ($trading_user as $people) {
			
			// if (in_array($client_code_array, $people, TRUE))
			// 	{
					// $ses_client_code_new=$people['TRADING_CLIENT_ID']??;
					$ses_client_code_new = array($people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID']);
					$result2=array_intersect($client_code_array,$ses_client_code_new);
					if(empty($result2))
					{

					}
					else
					{
						$result1[]=$result2;
					}
		
		}
		
		foreach ($result1 as $key => $value) 
		{
			if(!empty($value))
			{
				$sql = "select * from DP_CLIENTMASTER where UCC='$value[0]'";
				$ipo_pdf_data = $KYC_db->query($sql);

				if(!is_object($ipo_pdf_data))
				{
					continue;
				}

				$ipo_pdf_data = $KYC_db->query($sql)->result_array();

				if(empty($ipo_pdf_data))
				{
					continue;
				}
			
		$check_file_get++;
		// echo "<pre>";
		// print_r($row[0]);
		// exit;
	// 	echo "<br>";
	// 	print_r($ipo_pdf_data);
	// 	echo "<br>";
	// 	echo "<br>";
	// }
	// 	die();
	// 	if(1 == 1)
	// 	{
// print_r($data);

$pdf = new Fpdi();


// add a page
$pdf->AddPage();

$path = '//192.168.102.100\e\usermanagement\IPO_PDF/'.$ipo_name.'.pdf';

if($sub_category == "POL")
// if($sub_category == "SHA")
{
	$path = '//192.168.102.100\e\usermanagement\IPO_PDF/'.$ipo_name.'_POLHOLDER.pdf';
	// $path = 'E:/APBackOffice_PDF/IPO_PDF/'.$ipo_name.'_SHAREHOLDER.pdf';
}
else if($sub_category == "HNI")
{
	$path = '//192.168.102.100\e\usermanagement\IPO_PDF/'.$ipo_name.'_HNI.pdf';

}
// echo $sub_category;exit();
if(!file_exists($path))
{
	$this->session->set_userdata('APBackOffice_danger_alert',"PDF is not Found.");
	redirect(base_url('IPO/Physical'));
}
// $pdf->setSourceFile('E:/APBackOffice_PDF/IPO_PDF/DATAPATTENS.pdf');
$pdf->setSourceFile($path);

$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);

//set the source file
// $page_count = $pdf->setSourceFile('E:\BackOfficePDF\Update.pdf');
$pdf->SetFont('Helvetica','', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetXY(146, 23.5);
$pdf->Write(0,$row[1]);  //Application code

$pdf->SetFont('Helvetica','', 8);
$setx = 118.5;
$sety = 34.5;
$inm = 1;
$cname = str_split($ipo_pdf_data[0]['CLIENTNAME']);  //print_r($cname);
foreach ($cname as $value) 
{
	if($inm >= 16 && $inm <= 16)
	{
		$sety += 5;	
		$setx = 104.5;
	}
	$pdf->SetXY($setx,$sety);
	$pdf->Write(0,$value);  // Client Name
	$setx += 5.20;
	$inm++;
}
//  Address
$pdf->SetFont('Helvetica','', 7);
	$setx_add = 115;
	$sety_add = 44;
	$iadd = 0;
	$old_add = explode(' ',$ipo_pdf_data[0]['ADDRESS1'].','.$ipo_pdf_data[0]['ADDRESS2'].','.$ipo_pdf_data[0]['ADDRESS3']); //print_r($old_add); die();
	foreach ($old_add as $value) 
	{
		if ($iadd >= 3 && $iadd <= 3)
		{
			$setx_add = 112;
			$sety_add = 44+3; 
		}
		$pdf->SetXY($setx_add, $sety_add);
		$pdf->Write(0,$value);
		$setx_add = $pdf->GetX();
		$setx_add += 1;
		$iadd++;
		// break;
		// echo "<br>";
	}
// City,State,pincode
$city_state = $ipo_pdf_data[0]['CITY'].",".$ipo_pdf_data[0]['STATE'].",".$ipo_pdf_data[0]['PINCODE'];
$pdf->SetXY(103, 50.5);
$pdf->Write(0,$city_state);


$pdf->SetXY(146, 50.5);
$pdf->Write(0,$ipo_pdf_data[0]['EMAILID']);  // Email ID

$pdf->SetFont('Helvetica','', 8);
$mob = str_split($ipo_pdf_data[0]['MOBILE']);
$pdf->SetXY(139, 55.5);
$pdf->Write(0,$mob[0]);  // Mobile No 0

$pdf->SetXY(145, 55.5);
$pdf->Write(0,$mob[1]);  // Mobile No 1

$pdf->SetXY(150, 55.5);
$pdf->Write(0,$mob[2]);  // Mobile No 2

$pdf->SetXY(155, 55.5);
$pdf->Write(0,$mob[3]);  // Mobile No 3

$pdf->SetXY(160, 55.5);
$pdf->Write(0,$mob[4]);  // Mobile No 4

$pdf->SetXY(165, 55.5);
$pdf->Write(0,$mob[5]);  // Mobile No 5

$pdf->SetXY(170, 55.5);
$pdf->Write(0,$mob[6]);  // Mobile No 6

$pdf->SetXY(176, 55.5);
$pdf->Write(0,$mob[7]);  // Mobile No 7

$pdf->SetXY(181, 55.5);
$pdf->Write(0,$mob[8]);  // Mobile No 8

$pdf->SetXY(186, 55.5);
$pdf->Write(0,$mob[9]);  // Mobile No 9

// PAN
$pdf->SetFont('Helvetica','', 12);
$pan = str_split($ipo_pdf_data[0]['PAN']);
$pdf->SetXY(105, 65);
$pdf->Write(0,$pan[0]);  // PAN No 0

$pdf->SetXY(114, 65);
$pdf->Write(0,$pan[1]);  // PAN No 1

$pdf->SetXY(123, 65);
$pdf->Write(0,$pan[2]);  // PAN No 2

$pdf->SetXY(132, 65);
$pdf->Write(0,$pan[3]);  // PAN No 3

$pdf->SetXY(141, 65);
$pdf->Write(0,$pan[4]);  // PAN No 4

$pdf->SetXY(150, 65);
$pdf->Write(0,$pan[5]);  // PAN No 5

$pdf->SetXY(159, 65);
$pdf->Write(0,$pan[6]);  // PAN No 6

$pdf->SetXY(168, 65);
$pdf->Write(0,$pan[7]);  // PAN No 7

$pdf->SetXY(177, 65);
$pdf->Write(0,$pan[8]);  // PAN No 8

$pdf->SetXY(186, 65);
$pdf->Write(0,$pan[9]);  // PAN No 9

$boid = str_split($ipo_pdf_data[0]['DPID']);
$pdf->SetXY(13, 75);
$pdf->Write(0,$boid[0]);  // BOID 0

$pdf->SetXY(22, 75);
$pdf->Write(0,$boid[1]);  // BOID 1

$pdf->SetXY(31, 75);
$pdf->Write(0,$boid[2]);  // BOID 2

$pdf->SetXY(40, 75);
$pdf->Write(0,$boid[3]);  // BOID 3

$pdf->SetXY(48, 75);
$pdf->Write(0,$boid[4]);  // BOID 4

$pdf->SetXY(57, 75);
$pdf->Write(0,$boid[5]);  // BOID 5

$pdf->SetXY(66, 75);
$pdf->Write(0,$boid[6]);  // BOID 6

$pdf->SetXY(75, 75);
$pdf->Write(0,$boid[7]);  // BOID 7

$pdf->SetXY(84, 75);
$pdf->Write(0,$boid[8]);  // BOID 8

$pdf->SetXY(93, 75);
$pdf->Write(0,$boid[9]);  // BOID 9

$pdf->SetXY(101, 75);
$pdf->Write(0,$boid[10]);  // BOID 10

$pdf->SetXY(110, 75);
$pdf->Write(0,$boid[11]);  // BOID 11

$pdf->SetXY(119, 75);
$pdf->Write(0,$boid[12]);  // BOID 12

$pdf->SetXY(128, 75);
$pdf->Write(0,$boid[13]);  // BOID 13

$pdf->SetXY(137, 75);
$pdf->Write(0,$boid[14]);  // BOID 14

$pdf->SetXY(145, 75);
$pdf->Write(0,$boid[15]);  // BOID 15

$pdf->SetFont('Helvetica','', 8);
// $qtylen = strlen($ipo_pdf_data[0]['Qty']); //print_r($qtylen);
$qty = str_split($ipo_qty); //print_r($qty); // QTY
$set_x = 27;
foreach ($qty as $value) 
{
	$pdf->SetXY($set_x, 105.5);           
	$pdf->Write(0,$value);            
	$set_x +=6;

}

$Amt = str_split($ipo_amount);  // Amount in Figure
$setx = 44;
foreach ($Amt as $val) 
{
	$pdf->SetXY($setx, 125);
	$pdf->Write(0,$val);  
	$setx +=4.5;
}
$pdf->SetFont('Helvetica','', 6);
$amt_to_word = str_replace("\r", "", AmountInWords($ipo_amount));
$amt_to_word = str_replace("\n", "", $amt_to_word);
$amt_to_word = preg_replace('!\s+!', ' ', $amt_to_word);
// print(json_encode($amt_to_word));
// exit;
// $pdf->SetXY(21, 270);
$pdf->SetXY(105, 125);
$pdf->Write(0,$amt_to_word);  // Amount in Word 

$pdf->SetFont('Helvetica','', 8);
$accno = str_split($ipo_pdf_data[0]['BANK_ACCOUNTNO']);
$setx = 26;
foreach ($accno as $val) 
{
	$pdf->SetXY($setx, 131);
	$pdf->Write(0,$val);  // Bank Account NO.0
	$setx +=4.7;
}

$pdf->SetXY(36, 136);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetFont('Helvetica','', 15);
$pdf->SetXY(146, 186.5);
$pdf->Write(0,$row[1]);  // Application No.

$setx = 20;
$boid1 = str_split($ipo_pdf_data[0]['DPID']);
foreach ($boid1 as $value) 
{
	$pdf->SetXY($setx, 200);
	$pdf->Write(0,$value);  // BOID
	$setx +=6.8;
}

$setx = 129;
$pan1 = str_split($ipo_pdf_data[0]['PAN']);
foreach ($pan1 as $valu) 
{
	$pdf->SetXY($setx, 200);
	$pdf->Write(0,$valu);  // PAN No 
	$setx +=6.4;
}


$pdf->SetFont('Helvetica','', 7);
$pdf->SetXY(43, 208);
$pdf->Write(0,$ipo_amount);  // Amount in Figure

$pdf->SetXY(106, 208);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_ACCOUNTNO']);  // Bank Account NO.

$pdf->SetXY(36, 212.5);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetXY(41, 218);
$pdf->Write(0,$ipo_pdf_data[0]['CLIENTNAME']);  // Client Name

$pdf->SetXY(35, 223);
$pdf->Write(0,$ipo_pdf_data[0]['MOBILE']);  // Mobile No

$pdf->SetXY(81, 223);
$pdf->Write(0,$ipo_pdf_data[0]['EMAILID']);  // Email ID

$pdf->SetXY(45, 236);
$pdf->Write(0,$ipo_qty);  // QTY

$pdf->SetXY(52, 246);
$pdf->Write(0,$ipo_amount);  // Amount in Figure

$pdf->SetXY(48, 252);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_ACCOUNTNO']);  // Bank Account NO.

$pdf->SetXY(41, 256);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetFont('Helvetica','', 6);
$pdf->SetXY(133, 233);
$pdf->Write(0,$ipo_pdf_data[0]['CLIENTNAME']);  // Client Name

$pdf->SetXY(88, 239);
$pdf->Write(0,$ipo_pdf_data[0]['DPID']);  // BOID

$pdf->SetXY(88, 243);
$pdf->Write(0,$ipo_pdf_data[0]['PAN']);  // PAN No 

$pdf->SetFont('Helvetica','', 9);
$pdf->SetXY(21, 265);
$pdf->Write(0,$ipo_pdf_data[0]['UCC']);  // UCC Code.

$pdf->SetFont('Helvetica','', 15);
$pdf->SetXY(146, 255);
$pdf->Write(0,$row[1]);  // Application No.

$nm = $row[0]."_".$ipo_name; 
// if($sub_category == "SHA")
// {
// 	// $path = 'E:/usermanagement/IPO_PDF/'.$ipo_name.'_SHAREHOLDER.pdf';
// 	$nm = $row[0]."_".$ipo_name."_SHAREHOLDER"; 
// }
if($sub_category == "POL")
// if($sub_category == "SHA")
{
	// $path = 'E:/usermanagement/IPO_PDF/'.$ipo_name.'_SHAREHOLDER.pdf';
	$nm = $row[0]."_".$ipo_name."_POLHOLDER"; 
	// $nm = $row[0]."_".$ipo_name."_SHAREHOLDER"; 
}

$stored_path = "E:/APBackOffice_PDF/Stored_IPO_Data/";
$pdf->Output('F',$stored_path.$nm.'.pdf');	// Pdf Upload in Folder
}
}
}
// die();
fclose($handle);

$csv = $_FILES['bulk_ipo_file']['tmp_name'];
$handle = fopen($csv,"r");



// $image1 = "http://cdn.screenrant.com/wp-content/uploads/Darth-Vader-voiced-by-Arnold-Schwarzenegger.jpg";
// $image2 = "http://cdn.screenrant.com/wp-content/uploads/Star-Wars-Logo-Art.jpg";

// $files = array($image1, $image2);
// print_r($check_file_get);
// $tmpFile = tempnam('/tmp', '');
if($check_file_get != 0)
{
	unlink("E:/xampp/htdocs/APBackOffice/temp.zip");
	$zip = new ZipArchive;
	$tmpFile = "temp.zip";
	$zip->open($tmpFile, ZipArchive::CREATE);
	// exit();
	// foreach ($files as $file) {

	while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
	{
		// print_r($row);
		$client_code_array = array($row[0]);
		// print_r($client_code_array); 
		$trading_user=$_SESSION['No_of_client_list'];
		$ses_client_code_new=0;

		$result1=[];
		foreach ($trading_user as $people) {
			
			// if (in_array($client_code_array, $people, TRUE))
			// 	{
					// $ses_client_code_new=$people['TRADING_CLIENT_ID']??;
					$ses_client_code_new = array($people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID']);
					$result2=array_intersect($client_code_array,$ses_client_code_new);
					if(empty($result2))
					{

					}
					else
					{
						$result1[]=$result2;
					}

		}
		foreach ($result1 as $key => $value) 
		{
			if(!empty($value))
			{
				
				$nm = $value[0]."_".$ipo_name; 
				if($sub_category == "POL")
				// if($sub_category == "SHA")
				{
					// $path = 'E:/APBackOffice_PDF/IPO_PDF/'.$ipo_name.'_SHAREHOLDER.pdf';
					$nm = $value[0]."_".$ipo_name."_POLHOLDER"; 
					// $nm = $row[0]."_".$ipo_name."_SHAREHOLDER"; 
				}
				$stored_path = "E:/APBackOffice_PDF/Stored_IPO_Data/";
				$file = $stored_path.$nm.'.pdf';
				if(file_exists($file))
				{
					$zip->addFile($file,$nm.'.pdf');
				} 
			}
		}

	}
	// print_r($zip);
	// 	echo "<br>";
	$zip->close();
}
else
{
	// echo "<script>alert('Invalid CSV File.');</script>";
	// echo "<script>window.location = '".base_url('BranchIPO')."'</script>";
	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client List Data not Found OR CSV File Invalid!");
	redirect(base_url('IPO/Physical'));
}

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$ipo_name."_".date('d/m/Y his').'.zip');
header('Content-Length: ' . filesize($tmpFile));
readfile($tmpFile);
exit;
?>