<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid" style="margin-top:0px;">
         <!-- start page title -->
         <!-- end page title -->
         <?php include("alert.php"); ?>
         </br>
         <div class="row">
            <div class="col-md-12" id="msg"></div>
        </div>
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="col-xl-12">
                     <div class="tab-content text-muted mt-xl-0" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-price-one" role="tabpanel"
                           aria-labelledby="v-pills-tab-one">
                           <div class="row">
                              <div class="col-xl-12">
                                 <div class="card-header"
                                    style="background-color: #0b5639!important;padding: 9px!important;">
                                    <h6 class="card-title" style="color:#ffff!important;"><i class="fas fa-users me-2"
                                       style="color: #ffff;"></i>Nominee Link Generator</h6>
                                 </div>
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-4">
                                          <div class="form-group mb-4 pb-2">
                                             <label for="exampleInputPassword1">Client Code:</label>
                                             <input type="text" class="form-control" name="Client_code" id="Client_code" required="" placeholder="Enter Client Code" onkeyup="this.value = this.value.toUpperCase();">
                                             <span style="color: red;" id="error_codes"></span>
                                          </div>
                                       </div>
                                       <div class="col-4">
                                          <div class="form-group">
                                             <button class="btn btn-primary"name="Client_code_submit"  id="submit"  type="submit" style="margin-top: 29px;" onclick="create_link();">Create Link</button>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="form-group mb-4 pb-2">
                                             <label for="link">Link:</label>
                                             <div class="row">
                                             <div class="col-lg-6">
                                                <input type="text" class="form-control" name="Client_code_copy" id="Client_code_copy" value="<?php echo $link  ?? '' ?>" readonly>
                                             </div>
                                             <div class="col-lg-4">
                                                <!-- <button class="btn btn-primary"name="copylink" onclick="copy_clippboard()" id="submit" value="Upload" type="submit" >Referral Link</button> -->
                                                <button type="button" class="btn btn-outline-btn btn-outline-success waves-effect waves-light" onclick="copy_clippboard()"><i class="fa fa-clone" aria-hidden="true"></i> Copy</button>
                                                <button type="button" class="btn btn-outline-btn btn-outline-success waves-effect waves-light"><a href="https://api.whatsapp.com/send?text=Hi" data-action="share/whatsapp/share" class=""><i class="fa fa-whatsapp" style="font: 14px;"></i></a></button>
                                               <button type="button" onclick="send_mail();" class="btn btn-outline-btn btn-outline-success waves-effect waves-light"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                             </div>
                                          </div>
                                          </div>
                                       </div>
                                    </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- End Technical Research -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   function copy_clippboard()
   {
     var copyText = document.getElementById("Client_code_copy");
     copyText.select();
     copyText.setSelectionRange(0, 99999)
     document.execCommand("copy");
   }
</script>

<script>
   function create_link(argument) 
   {
      var Client_code=$('#Client_code').val();

      $.ajax({
          type: "POST",
          url: '<?php echo base_url(); ?>KYC/createlink_pnl',
          data: { Client_code:Client_code},
          success: function(data)
          {   
            if(data=="00")
            {
               $("#error_codes").html("Invalid Client Code");
            }
            else
            {
               $("#error_codes").html("");
               $("#Client_code_copy").val(data);
            }
          }
     });
   }
</script>
<script>
   function send_mail()
   {
      var client_code=$('#Client_code').val();
      var link=$('#Client_code_copy').val();
      // alert(link)
      if (link=="") {
         var _el = $('<div>')
            _el.hide()
            _el.addClass('alert alert-danger alert-dismissible fade show')
            _el.text("Please enter code to generate link!");
            $('#msg').append(_el)
            _el.show('slow')

            setTimeout(() => {
               _el.hide('slow')
                  .remove()
            }, 3000);
         return true;
      }
      $.ajax({
         type: "POST",
         url: '<?php echo base_url(); ?>KYC/send_mail',
         data: { client_code:client_code,link:link },
         beforeSend: function() {
         var _el = $('<div>')
            _el.hide()
            _el.addClass('alert alert-warning alert-dismissible fade show')
            _el.text("Sending Mail.......!");
            $('#msg').append(_el)
            _el.show('slow')

            setTimeout(() => {
               _el.hide('slow')
                  .remove()
            }, 2500);
         },
         success: function(data)
         {   
            if(data=="1")
            {
               $('#msg').html();
               var _el = $('<div>')
                            _el.hide()
                            _el.addClass('alert alert-success alert-dismissible fade show')
                            _el.text("Mail send Successfully!");
                            $('#msg').append(_el)
                            _el.show('slow')
                            setTimeout(() => {
                                _el.hide('slow')
                                    .remove()
                            }, 2500);
            }
            else
            {
               $('#msg').html();
               var _el = $('<div>')
                            _el.hide()
                            _el.addClass('alert alert-danger alert-dismissible fade show')
                            _el.text("Sending mail failed!");
                            $('#msg').append(_el)
                            _el.show('slow')

                            setTimeout(() => {
                                _el.hide('slow')
                                    .remove()
                            }, 2500);
            }
         }
     });
}

</script>