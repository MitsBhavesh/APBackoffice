// Start Bank Validation 
 function AddBank_Validation() 
 {
	// alert('hiiii');
	// Bank Name
	var bank_name = document.getElementById('bank_name').value;
	var error = 0;
	// alert(bank_name)
	if(!/^[A-Za-z/ /]+$/.test(bank_name))
	{
		document.getElementById('error_bank_name').innerHTML = "Invalid Bank Name ";
		error++;
	}
	else
	{
		var bank_name = bank_name.replace(/  +/g, ' ');
		var chk_space = bank_name.charAt(0);
		// alert(chk_space);
		if(bank_name == "" || bank_name == " " || chk_space == " ")
		{
		document.getElementById('error_bank_name').innerHTML = "Enter Valid Bank name ";
		}
		else
		{
		document.getElementById('error_bank_name').innerHTML = "";
		}
	}
  	// Account Number
	var account_no = document.getElementById('account_no').value;
	if (/\D/.test(account_no))    
	{
		document.getElementById('error_account_no').innerHTML = "Invalid Account  Number ";
		error++;
	}
	else if (account_no == "")
	{
		document.getElementById('error_account_no').innerHTML = "Enter Account Number ";
		error++;
	}
	else
	{
		document.getElementById('error_account_no').innerHTML = "";
		// var oldbankvalid = $("#oldbankvalid").html();
		// // alert(oldbankvalid);
		// var strArray = oldbankvalid.split("#");
		// // alert(strArray);
		// for(var i = 0; i < strArray.length; i++){
		// // alert("<p>" + strArray[i] + "</p>");
		// // alert(account_no);
		// 	if(strArray[i] == account_no)
		// 	{
		// 		error++;
		// 		document.getElementById('error_account_no').innerHTML = "Bank account already exists!";
		// 		break;
		// 	}
		// 	else
		// 	{
		// 		document.getElementById('error_account_no').innerHTML = "";
		// 	}
		// }
	}  
	 //IFSC Code
	var ifsc_code = document.getElementById('ifsc_code').value;
	if(!/^[A-Za-z0-9]{11}$/.test(ifsc_code))
	{
		document.getElementById('error_ifsc_code').innerHTML = "Invalid IFSC Code ";
		error++;
	}
	else
	{
		document.getElementById('error_ifsc_code').innerHTML = "";
	}  
 	//MICR Code
	var micr_code = document.getElementById('micr_code').value;
	if (!/^\d{9}$/.test(micr_code))
	{
		document.getElementById('error_micr_code').innerHTML = "Invalid MICR Code ";
		error++;
	}
	else if (micr_code  == "")
	{
		document.getElementById('error_micr_code').innerHTML = "Enter MICR Code ";
		error++;
	}
	else
	{
		document.getElementById('error_micr_code').innerHTML = "";
	} 
	// alert(micr_code);return false;
 	if(error != 0)
    {
      return false;
    }
    else
    {
    	return true;
    }
 }
 $(document).ready(function(){
    $(".form-control").keyup(function(){
        AddBank_Validation();
    });
}); 

// End Bank Validation

