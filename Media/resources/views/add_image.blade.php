<!DOCTYPE html>
<html>
<head>
<title>Student Management | Add</title>
</head>
<body>
@if (session('status'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif
<div class="row container-fluid" style="padding-top: 80px;">
	<div class="card col-md-3">
		<ul style="padding-top:10px;">
			  <li>
			    <a href="{{url('/')}}/insert" class="active">insert recored</a>
			  </li>
			  <li>
			    <a href="{{url('/')}}/viewrecord" class="active">view recored</a>
			  </li>
		</ul>
	</div>	
	<div class="col-md-9">
	  <form method = "post" action="{{url('/Edit_profile')}}">
		
		@csrf
		<div class="col-md mb-4 mb-md-0">
    <div class="card">
      <h5 class="card-header">Add Data</h5>
      <div class="card-body">
         <div class="row">  
          <div class="col-md-4">
            <label class="form-label" for="basic-default-name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="John Doe" required="">
          </div>
          <div class="col-md-4">
            <label class="form-label" for="basic-default-email">Mobile No.</label>
            <input type="text" name="mobile"  class="form-control" placeholder="+91 98653 20147" required="">
          </div>
          <div class="col-md-4">
          <label class="form-label" for="basic-default-email">AP Code</label>
            <input type="text" name="APCode"  class="form-control" placeholder="AP Code" required="">
          </div>
          <div class="col-md-12">
            <label class="form-label" for="basic-default-dob">Address</label>
            <input type="Address" class="form-control flatpickr-validation flatpickr-input" name="Address" required="">
          </div>
          <div class="col-md-12">
            <label class="form-label" for="basic-default-dob">image</label>
            <input type="file" class="form-control flatpickr-validation flatpickr-input" name="image" class="form-control">
          </div>
          <div class="row" style="margin-top: 20px;">
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
		
	  </form>
	</div>	
</div>	
</body>
</html>