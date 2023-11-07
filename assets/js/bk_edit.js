function bk_online_validation() 
      {
    
        var error = 0; 
        //online ipo
        var ipo = document.getElementById('online_ipo').value;
          if(ipo  == "Please Select IPO")

           {
            document.getElementById('error_online_ipo').innerHTML = "Please Select IPO";
            error++;
           }
          else
          {
            document.getElementById('error_online_ipo').innerHTML = "";
          } 

        //online qty
          var qty = document.getElementById('online_qty').value;
          if(qty  == "")
           {
            document.getElementById('error_online_qty').innerHTML = "Please Select Quantity";
            error++;
           }
          else
          {
             document.getElementById('error_online_qty').innerHTML = "";

          }
           //online Bid Price
          var bid_price = document.getElementById('online_price').value;
          if(bid_price  == "")
           {
            document.getElementById('error_online_price').innerHTML = "Please Enter Bid Price";
            error++;
           }
          else
          {
            document.getElementById('error_online_price').innerHTML = "";
          } 

          //online Bid Amount
          var bid_amount = document.getElementById('online_Amount').value;
          if(bid_amount  == "")
           {
            document.getElementById('error_online_Amount').innerHTML = "Please Enter Bid Amount";
            error++;
           }
          else
          {
            document.getElementById('error_online_Amount').innerHTML = "";
          } 

          //Online IPO CDSL Number
          var cdsl_num = document.getElementById('online_cdsl_Amount').value;

          if (!/^\d{16}$/.test(cdsl_num))
          {
            document.getElementById('error_online_cdsl_Amount').innerHTML = "Please Enter CDSL Number";
            error++;
           }
          else
          {
            document.getElementById('error_online_cdsl_Amount').innerHTML = "";
          } 

          //Online IPO PAN Number
          var pan_num = document.getElementById('online_pan').value;
          // alert(pan_num);
          // if(pan_num =="")
          if (!/^([A-Z]){5}([0-9]){4}([A-Z]){1}?$/.test(pan_num))
          // if(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", pan_num))
           {
            document.getElementById('error_online_pan').innerHTML = "Please Enter PAN Number";
            error++;
           }
          else
          {
            document.getElementById('error_online_pan').innerHTML = "";
          } 

          //Online IPO Client NAME
          var client_name = document.getElementById('online_name').value;

          if(!/^[A-Za-z/ /]*$/.test(client_name))
           {
            document.getElementById('error_online_name').innerHTML = "Please Enter Your Name";
            error++;
           }
          else
          {
            var client_name = client_name.replace(/  +/g, ' ');
            var chk_space = client_name.charAt(0);
            if(client_name == "" || client_name == " " || chk_space == " ")
            {
              document.getElementById('error_online_name').innerHTML = "Invalid Client name ";
              error++;
            }
            else
            {
              document.getElementById('error_online_name').innerHTML = "";
            }
          }

          //Online IPO Mobile Number
          var mob_num = document.getElementById('online_mob_no').value;

          if (!/^\d{10}$/.test(mob_num))
           {
            document.getElementById('error_online_mob_no').innerHTML = "Please Enter Mobile Number";
            error++;
           }
          else
          {
            document.getElementById('error_online_mob_no').innerHTML = "";
          }

          //Online IPO Email ID
          var email_id = document.getElementById('online_email').value;

          if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email_id))
           {
            document.getElementById('error_online_email').innerHTML = "Please Enter Email ID";
            error++;
           }
          else
          {
            document.getElementById('error_online_email').innerHTML = "";
          }
          
          //online Bank UPI
          var bank_upi = document.getElementById('online_bnk_upi').value;
          if(bank_upi == "")
           {

            document.getElementById('error_online_bnk_upi').innerHTML = "Please Enter Bank UPI";
            error++;
           }
          else
          {
            var bank_upi = bank_upi.replace(/  +/g, ' ');
            var chk_space = bank_upi.charAt(0);
            if(bank_upi == "" || bank_upi == " " || chk_space == " ")
            {
              document.getElementById('error_online_bnk_upi').innerHTML = "Enter Valid Bank UPI ";
            }
            else
            {
              document.getElementById('error_online_bnk_upi').innerHTML = "";
            }
          } 
          if(error != 0)
          {
            return false;
          }
          
      }
         $(document).ready(function(){
           $("#myform1").keyup(function(){
             //alert('ggg');
              bk_online_validation();
           });
           // checkbox (cutt-off price) cutOffPrice
           $('.on_cut_price').click(function(){
              // alert('check');
              if ($(".on_cut_price").is(":checked")) {
                  $("#online_price").prop("readonly",true);
                  $('#online_price').val(cutOffPrice);
                  
              }
              else {
                  $("#online_price").prop("readonly",false);
                  $('#online_price').val(maxPrice);
              }
          });
       });