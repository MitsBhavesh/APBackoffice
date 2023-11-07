<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap 4.3.1 CDN -->
   <!--  <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    /> -->
    <!-- FontAwesome 4.7.0 CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
      integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_new.css" type="text/css" />
    <title>Document</title>
  </head>
  <body style="background-color: #fff;">
        <div class="container-fluid">
            
    <div class="container px-1 px-md-4 py-5 mx-auto">

      <div class="card">
      	 
      		<form method="POST" action="<?php echo base_url();?>IPO/Tracking">
	      	<div class="row d-flex top">
	      		<?php include("alert.php"); ?>
		        	<div class="col-md-4">
			          	<div class="mb-2">
			          		 <label class="form-label" for="formrow-todate-input">Client Code:</label>
			          		<input type="text" class="form-control" name="client_code" placeholder="Enter Client Code">
				        </div>
			      	</div>
			      	<div class="col-md-1">
			      	 	<div class="mb-2" style="padding-top: 30px;">
			      	 		<button type="submit" name="btn_submit" class="btn btn-primary w-md" style="background-color: #0b5639;border-color: #acc840;">Submit</button>
			      	 	</div>
			      	</div>
	        </div>
	      	</form>
	       <?php
	      if(isset($result_tracking)){
	       foreach ($result_tracking as $key => $value)
	      	{
	      		?>
	      		
	      
        <div class="row d-flex justify-content-between px-3 top">

          	<div class="d-flex">
            <h5>
              Application Number:
              <span class="text-primary font-weight-bold"><?php echo $value['APPLICATION_NO'];?></span>
            </h5>
          	</div>
          	<div class="d-flex flex-column text-sm-right">
            <p class="mb-0">
              Client Name:<span class="font-weight-bold text-primary "><?php echo $value['CLIENT_NAME'];?></span>
            </p>
            <p  class="mb-0">
              BOID: <span class="font-weight-bold text-primary "><?php echo $value['CLIENTBENID'];?></span>
            </p>
            <p  class="mb-0">
              Symbol: <span class="font-weight-bold text-primary "><?php echo $value['SYMBOL'];?></span>
            </p>
          </div>
        </div>
        <!-- Add class "active" to progress -->
        <div class="row d-flex justify-content-center">
          <div class="col-12">
            <ul id="progressbar" class="text-center">
              <li class="<?php if($value['BID_STATUS']=='success'){echo "active";}else{echo "inactive";}?> step0"><p class="font-weight-bold"> <br />Bidding</p></li>
              <li class="<?php if($value['STATUS']=='success'){echo "active";}else{echo "inactive";}?>  step0"><p class="font-weight-bold"><?php echo strtoupper($value['STATUS']);?><br /></p></li>
              <li class="step0"><p class="font-weight-bold"></p></li>
              <li class="step0"><p class="font-weight-bold">Allocation</p></li>
            </ul>
          </div>
        </div>
	<?php } }?>
      </div>
    </div>
  </body>
</html>