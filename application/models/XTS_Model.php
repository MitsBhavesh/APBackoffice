<?php
class XTS_Model extends CI_model
{
	function __construct() 
	{
    	parent::__construct();
    }
    public function XTS_APIDataget($DataPayload) 
    {
    	// echo "hiiii";
    	// print_r($DataPayload);
    	// echo "<br>";
    	// print_r($DataPayload['client_code']);
    	// return;
    	$payload = '{
	            "userID": "Symphony",
	            "password": "sft@1234$"
	            }';

		$header_data = array('Content-Type: application/json');
		// Token Generate
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://192.168.102.9:3000/backofficeapi/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$payload,
		  CURLOPT_HTTPHEADER => $header_data,
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$login_data = json_decode($response);
		// print_r($login_data->result->Token);
		$token = $login_data->result->Token;
		// print_r($token);
		// exit();

		//Get  Haircut value in excel file
		$today_date=date('dmY');
		$PathLastHold = "E:/PLEDGE/Pledge_AP/Pledge_file/APPSEC_COLLVAL_".$today_date.".csv";
		// $PathLastHold = "E:/PLEDGE/Pledge_ARH/Pledge_file/APPSEC_COLLVAL_04032022.csv";
		if (($open = fopen($PathLastHold, "r")) !== FALSE) 
		{
			while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
			{        
			$array[] = $data; 
			}
			fclose($open);
		}
		// echo "<pre>";
		  //To display array data
		  // var_dump($array);
		foreach ($array as $value) 
		{
			if($DataPayload['ISIN']==$value[2])
			{
				$Haircut_Value=$value[4];
				break;
			}
		   // print_r($value);
		}
		// return;
		$payload = '[{
		            "LoginId": "ADMIN",
				    "ClientId": "'.$DataPayload['client_code'].'",
				    "RMSHoldings": [{
				    	"ISIN" : "'.$DataPayload['ISIN'].'",
						"HoldingType" : "2",
						"HoldingQuantity" : '.$DataPayload['Holding_Quantity'].', 
						"ValuationType" : 1,
						"Haircut" : '.$Haircut_Value.', 
						"CollateralQuantity" : '.$DataPayload['CollateralQuantity'].',
						"BuyAvgPrice" : '.$DataPayload['BuyAvgPrice'].'
				    	}]
		            }]';
// "BuyAvgPrice" : '.$DataPayload['BuyAvgPrice'].'
		 // print_r($payload);
		 // return;
		$auth=str_replace('"', "", json_encode($token));
		$auth=str_replace('\r\n', "", $auth);
		$header_data = array('authorization:'.$auth.'','Content-Type: application/json');


		//APi 
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://192.168.102.9:3000/backofficeapi/updatermsholding',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$payload,
		  CURLOPT_HTTPHEADER => $header_data,
		));

		$response = curl_exec($curl);

		curl_close($curl);

		// print_r($response);
		return $response;
   	}
}


// $payload = '[{
		//             "LoginId": "ADMIN",
		// 		    "ClientId": "A0551",
		// 		    "RMSHoldings": [{
		// 		    	"ISIN" : "INE030A01027",
		// 				"HoldingType" : "2", // As itis
		// 				"HoldingQuantity" :2, //Net
		// 				"ValuationType" : 1,
		// 				"Haircut" : 10.50, // From excel File haircut value
		// 				"CollateralQuantity" : 1, // pledge qty
		// 				"BuyAvgPrice" : 28

		// 		    	}]
		//             },
		//             {
		//             "LoginId": "ADMIN",
		// 		    "ClientId": "A0551",
		// 		    "RMSHoldings": [{
		// 		    	"ISIN" : "INE335Y01020",
		// 				"HoldingType" : "2", // As itis
		// 				"HoldingQuantity" :29, //Net
		// 				"ValuationType" : 1,
		// 				"Haircut" : 21.3, // From excel File haircut value
		// 				"CollateralQuantity" : 1, // pledge qty
		// 				"BuyAvgPrice" : 28
		// 		    	}]
		//             }]';
?>



