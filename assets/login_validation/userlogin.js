// Start login validation
function validate_SignIn()
{
   // alert('hello');
   var signin_error = 0;
   var branch_code = document.getElementById('branch_code').value;
   var pwd = document.getElementById('pwd').value;
   // alert(pwd);

   if (!/^[A-Za-z0-9]/.test(branch_code))
   {
       document.getElementById('error_branch_code').innerHTML = "Please Enter Branch Code";
       signin_error++;
   }
   else
   {
       document.getElementById('error_branch_code').innerHTML = "";
   }

   if (!/^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/.test(pwd))
   {
       document.getElementById('error_password').innerHTML = "Please Enter Password";
       signin_error++;
   }
   else
   {
       document.getElementById('error_password').innerHTML = "";
   }
   if(signin_error != 0)
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
       // alert('jjjjj');
       validate_SignIn();
   });
}); 

// End login Validation

// Start date of birth validation
function validate_SignInDateOfBirth()
{
  var signin_date_error = 0;
  var dateofbirth = document.getElementById('dateofbirth').value;
  // alert(dateofbirth);
  if(dateofbirth == '')
  {
    document.getElementById('error_date_of_birth').innerHTML = "Please Enter Date Of Birth";
    signin_date_error++;
  }
  else
  {
    document.getElementById('error_date_of_birth').innerHTML = "";
  }
  if(signin_date_error != 0)
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
         // alert('jjjjj');
         validate_SignInDateOfBirth();
     });
 }); 
// End date of birth validation