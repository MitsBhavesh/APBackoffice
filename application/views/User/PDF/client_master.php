<?php
if(isset($_SESSION['ApbackOffice_client_client_master_data']))
{
    $clientmaster_columns = $_SESSION['ApbackOffice_client_client_master_data'][0];
    $clientmaster_back_data = $_SESSION['ApbackOffice_client_client_master_data'][1];

    // echo "<pre>"; 
    // print_r($clientmaster_columns); 
    // print_r($clientmaster_back_data); 
    // echo "</pre>"; 
    // exit(); 
}
use setasign\Fpdi\Fpdi;
require_once('fpdf.php');
require_once('FPDI-2.3.4/src/autoload.php');

$pdf = new Fpdi();
// add a page
$pdf->AddPage();
//set the source file
$pdf->setSourceFile('E:\APBackOffice_PDF\ClientMaster.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);

// now write some text above the imported page
$pdf->SetFont('Helvetica','', 7);
//$pdf->SetTextColor(255, 0, 0);
$pdf->SetTextColor(0, 0, 0);
// $pdf->SetTextColor(24, 61, 132);

// Line Number One:**********************

//Dp ID
$pdf->SetXY(20, 40);
$pdf->Write(0, $clientmaster_back_data[0][585]);

//Client Id
$pdf->SetXY(50, 40);
$pdf->Write(0, substr($clientmaster_back_data[0][583], 8));

//Sex M
$pdf->SetFont('Helvetica','', 5);
$pdf->SetXY(69.5, 39.5);
$pdf->Write(0,$clientmaster_back_data[0][34]);

//DP Int Ref No
$pdf->SetFont('Helvetica','', 7);
$pdf->SetXY(90, 40);
$pdf->Write(0, $clientmaster_back_data[0][2]);

//A/c status
$pdf->SetXY(120, 40);
$pdf->Write(0, $clientmaster_back_data[0][365]);

//A/c Opening Dt
$pdf->SetXY(152, 40);
$pdf->Write(0, $clientmaster_back_data[0][582]);

//Purchase Waiver
$pdf->SetXY(185, 40);
$pdf->Write(0, 'Y');

// Line Number Two:**********************

//BO Status
$pdf->SetXY(21, 45);
$pdf->Write(0, $clientmaster_back_data[0][348]);

//BO Sub Status
$pdf->SetXY(57, 45);
$pdf->Write(0, 'Individual-Resident Nagative Nomination');

//A/c Category
$pdf->SetXY(119, 45);
$pdf->Write(0, 'REGULAR BO');

//Freeze Status
$pdf->SetXY(153, 45);
$pdf->Write(0, 'Not Frozen');

//Registered for Easi
$pdf->SetXY(192, 45);
$pdf->Write(0, 'N');

//Line Number Three:**********************

//Nationality
$pdf->SetXY(21, 51);
$pdf->Write(0, $clientmaster_back_data[0][145]);

//Stmt Cycle
$pdf->SetXY(54, 51);
$pdf->Write(0, 'End of Month');

//Occupation
$pdf->SetXY(79, 53);
$pdf->Write(0, $clientmaster_back_data[0][430]);

//Closure Init By
$pdf->SetXY(120, 51);
$pdf->Write(0, '');

//Account Clouser Dt
$pdf->SetXY(150, 51);
$pdf->Write(0, '');

//Registered For Easiest
$pdf->SetXY(194, 51);
$pdf->Write(0, '');

// Line Number Four:**********************

//SMS Registered
$pdf->SetXY(22, 57);
$pdf->Write(0, 'YES');

//SMS Mobile No
$pdf->SetXY(55, 57);
$pdf->Write(0, $clientmaster_back_data[0][156]);

//UID
$pdf->SetXY(78, 57);
$pdf->Write(0, $clientmaster_back_data[0][360]);

//RBI Ref No
$pdf->SetXY(118, 57);
$pdf->Write(0, '');

//RBI Approval Dt
$pdf->SetXY(152, 57);
$pdf->Write(0, '');

//Mode of operation
$pdf->SetXY(185, 57);
$pdf->Write(0, '');

// Line Number Five:**********************

//BSDA Flag 
$pdf->SetXY(23, 62);
$pdf->Write(0, 'NO');

//RGESS Flag
$pdf->SetXY(57, 62);
$pdf->Write(0, 'NO');

//Pledge SI Flag
$pdf->SetXY(90, 62);
$pdf->Write(0, 'YES');

//Email D/L Flag
$pdf->SetXY(123, 62);
$pdf->Write(0, 'YES');

//Annual Report Flag
$pdf->SetXY(160, 62);
$pdf->Write(0, 'Electronic');

//Line Number Six:**********************

//First Holder Name
$pdf->SetXY(30, 69);
$pdf->Write(0, $clientmaster_back_data[0][206]);

//First Holder PAN
$pdf->SetXY(125, 69);
$pdf->Write(0, $clientmaster_back_data[0][189]);

//Date of Birth
$pdf->SetXY(183, 69);
$pdf->Write(0, $clientmaster_back_data[0][241]);

//Line Number Seven:**********************

//Second Holder Name
$pdf->SetXY(32, 75);
$pdf->Write(0, $clientmaster_back_data[0][304]);

//Second Holder PAN
$pdf->SetXY(127, 75);
$pdf->Write(0, '');

//Second Date of Birth
$pdf->SetXY(170, 75);
$pdf->Write(0, '');

//Line Numbe Eight:**********************

//Third Holder Name
$pdf->SetXY(30, 80);
$pdf->Write(0, '');

//Third Holder PAN
$pdf->SetXY(125, 80);
$pdf->Write(0, '');

//Third Date of Birth
$pdf->SetXY(170, 80);
$pdf->Write(0, '');


//Line Number Nine:**********************


//Correspondence Address
$pdf->SetXY(36, 87);
$pdf->Write(0, $clientmaster_back_data[0][9]);
$pdf->SetXY(36, 90);
$pdf->Write(0, $clientmaster_back_data[0][10]);
$pdf->SetXY(36, 93);
$pdf->Write(0, $clientmaster_back_data[0][11]);
$pdf->SetXY(36, 96);
$pdf->Write(0, $clientmaster_back_data[0][62]);
$pdf->SetXY(36, 99);
$pdf->Write(0, $clientmaster_back_data[0][63]);


//Permanent Address
$pdf->SetXY(127, 87);
$pdf->Write(0, $clientmaster_back_data[0][9]);
$pdf->SetXY(127, 90);
$pdf->Write(0, $clientmaster_back_data[0][10]);
$pdf->SetXY(127, 93);
$pdf->Write(0, $clientmaster_back_data[0][11]);
$pdf->SetXY(127, 96);
$pdf->Write(0, $clientmaster_back_data[0][62]);
$pdf->SetXY(127, 99);
$pdf->Write(0, $clientmaster_back_data[0][63]);

// Line Number Ten:**********************

//Phone/Fax
$pdf->SetXY(22, 110);
$pdf->Write(0, $clientmaster_back_data[0][156]);

//Phone/Email
$pdf->SetXY(22, 114);
$pdf->Write(0, $clientmaster_back_data[0][178]);

// Line Number Eleven:**********************

//Bank Details
//Bank Name
$pdf->SetFont('Helvetica','', 5);
$pdf->SetXY(9, 124);
$pdf->Write(0, $clientmaster_back_data[0][576]);
//Bank Address
$pdf->SetXY(9, 127);
$pdf->Write(0, $clientmaster_back_data[0][577]);

//Bank A/c Type
$pdf->SetFont('Helvetica','', 7);
$pdf->SetXY(125, 121);
$pdf->Write(0, $clientmaster_back_data[0][38]);

//Bank A/c No
$pdf->SetXY(125, 126);
$pdf->Write(0, str_replace("'", "", $clientmaster_back_data[0][575]));

//MICR Code
$pdf->SetXY(125, 131);
$pdf->Write(0, $clientmaster_back_data[0][581]);

//IFSC Code
$pdf->SetXY(125, 136);
$pdf->Write(0, $clientmaster_back_data[0][232]);

// Line Number Twelve:**********************

//Nominee name
$pdf->SetXY(9, 150);
$pdf->Write(0, $clientmaster_back_data[0][242]);

//%
$pdf->SetXY(73, 150);
$pdf->Write(0, '');

//Residual Sec Flag
$pdf->SetXY(105, 150);
$pdf->Write(0, '');

//Nominee's Guardian Details
$pdf->SetXY(137, 150);
$pdf->Write(0, '');

// Line Number Thirteen:**********************

//POA Details

//POA Master ID
$pdf->SetXY(9, 167);
$pdf->Write(0, '');

//POA Name
$pdf->SetXY(41, 167);
$pdf->Write(0, $clientmaster_back_data[0][111]);

//POA Refrence
$pdf->SetXY(138, 167);
$pdf->Write(0, '');

//Holder(1st-2nd-3rd)
$pdf->SetXY(170, 167);
$pdf->Write(0, '');

//Signature
$pdf->SetXY(150, 270);
$pdf->Write(0, 'Digitally signed by ARHAM SHARE');
$pdf->SetXY(150, 273);

date_default_timezone_set('Asia/Kolkata');
$pdf->Write(0, "Date: ".date('d M Y h:i:s'));
$pdf->SetXY(150, 276);
$pdf->Write(0, 'Reason:"Regulatory"');

$pdf->Output('I','Client_Details.'.'pdf');
?>
