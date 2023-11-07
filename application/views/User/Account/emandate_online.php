<?php
	$today_date=date("Y/m/d");
	$today_date1=str_replace("/", "-", $today_date);
	//utilcode
	$UtilCode="NACH00000000000908";
	//shortcode
	$ShortCode="ASCPL";
	//MerchantCategoryCode
	$MerchantCategoryCode="U099";
	//Customer_DebitFrequency
	$Customer_DebitFrequency="ADHO";
	// print_r($Customer_DebitFrequency);return;
	//customersequencetype
	$Customer_SequenceType="RCUR";
	
 	$msgID=rand(10000000000000,100);
 	//client code
 	$client_code=$farray[0];
	//Cutomer name
	$name=$farray[1];
	$name=str_replace("(HUF)"," ",$name);
	//customer_account
	$acco_no=$farray[3];
	//ifsc_code
	$ifsc_no=$farray[4];
	//phone)number
	$p_num=$farray[8];
	//account_type
	$acc_type=$farray[9];
			// print_r($acc_type);return;
	if($acc_type=="Saving"){
		$account_type="s";
	}elseif($acc_type=="Current"){
		$account_type="c";
	}
	//debit_amount
	$debit_amount=$_POST['online_bank_amount'];
	//channel
	$Channel=$_POST['emandate_channel'];

	//checksum
		$data=$acco_no."|".$today_date1."|||".$debit_amount;
		$check_sum = hash('sha256',$data);
	//key
		$key = 'k2hLr4X0ozNyZByj5DT66edtCEee1x+6';
		$iv  = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
	//Encryption
		$Util_Code = "\x".bin2hex(openssl_encrypt($UtilCode, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
		$Short_Code =  "\x".bin2hex(openssl_encrypt($ShortCode, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
		$Customer_Name =  "\x".bin2hex(openssl_encrypt($name, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
		$Customer_Mobile =  "\x".bin2hex(openssl_encrypt($p_num, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
		$Customer_AccountNo =  "\x".bin2hex(openssl_encrypt($acco_no, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
		$Customer_Reference1 =  "\x".bin2hex(openssl_encrypt($client_code, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
		//$MsgId = bin2hex(openssl_encrypt($msgID, "AES-256-ECB", $key, OPENSSL_RAW_DATA));
			?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form id="PostForm" action="https://emandate.hdfcbank.com/Emandate.aspx" method="POST">
	<input type="hidden" ID="UtilCode" name="UtilCode" value="<?php echo $Util_Code;?>" /> 
	<input type="hidden" ID="Short_Code" name="Short_Code" value="<?php echo $Short_Code;?>" /> 
	<input type="hidden" ID="Merchant_Category_Code" name="Merchant_Category_Code" value="<?php echo $MerchantCategoryCode;?>" /> 
	<input type="hidden" ID="CheckSum" name="CheckSum" value="<?php echo $check_sum;?>" /> 
	<input type="hidden" ID="MsgId" name="MsgId" value="<?php echo $msgID;?>" /> 
	<input type="hidden" ID="Customer_Name" name="Customer_Name" value="<?php echo $Customer_Name;?>" />     
	<input type="hidden" ID="Customer_TelphoneNo" name="Customer_TelphoneNo" value="" /> 
	<input type="hidden" ID="Customer_EmailId" name="Customer_EmailId" value="" /> 
	<input type="hidden" ID="Customer_Mobile" name="Customer_Mobile" value="<?php echo $Customer_Mobile;?>" /> 
	<input type="hidden" ID="Customer_AccountNo" name="Customer_AccountNo" value="<?php echo $Customer_AccountNo;?>" /> 
	<input type="hidden" ID="Customer_StartDate" name="Customer_StartDate" value="<?php echo $today_date1;?>" /> 
	<input type="hidden" ID="Customer_ExpiryDate" name="Customer_ExpiryDate" value="" /> 
	<input type="hidden" ID="Customer_DebitAmount" name="Customer_DebitAmount" value="" /> 
	<input type="hidden" ID="Customer_MaxAmount" name="Customer_MaxAmount" value="<?php echo $debit_amount;?>"/> 
	<input type="hidden" ID="Customer_DebitFrequency" name="Customer_DebitFrequency" value="<?php echo $Customer_DebitFrequency;?>" /> 
	<input type="hidden" ID="Customer_SequenceType" name="Customer_SequenceType" value="<?php echo $Customer_SequenceType;?>" /> 
	<input type="hidden" ID="Customer_InstructedMemberId" name="Customer_InstructedMemberId" value="<?php echo $ifsc_no; ?>" /> 
	<input type="hidden" ID="Customer_Reference1" name="Customer_Reference1" value="<?php echo $Customer_Reference1; ?>" /> 
	<input type="hidden" ID="Customer_Reference2" name="Customer_Reference2" value="" /> 
	<input type="hidden" ID="Channel" name="Channel" value="<?php echo $Channel;?>" />
	<input type="hidden" ID="Filler1" name="Filler1" value="" /> 
	<input type="hidden" ID="Filler2" name="Filler2" value="" /> 
	<input type="hidden" ID="Filler3" name="Filler3" value="" /> 
	<input type="hidden" ID="Filler4" name="Filler4" value="" /> 
	<input type="hidden" ID="Filler5" name="Filler5" value="<?php echo $account_type;?>" /> 
	<input type="hidden" ID="Filler6" name="Filler6" value="" /> 
	<input type="hidden" ID="Filler7" name="Filler7" value="" /> 
	<input type="hidden" ID="Filler8" name="Filler8" value="" /> 
	<input type="hidden" ID="Filler9" name="Filler9" value="" />
	<input type="hidden" ID="Filler10" name="Filler10" value=""/>   
</form>
	<script type="text/javascript">
		document.getElementById("PostForm").submit();
		
	</script>
</body>
</html>