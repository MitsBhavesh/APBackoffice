{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@php
// print_r($data); exit;
@endphp
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  {{-- <form action="{{$url}}" method = "post"> --}}
  <form action="{{url('/edit/{id}')}}" method = "post">
    @csrf
    <pre>
       {{-- @php
            print_r($errors->all());    
       @endphp --}}
    </pre>
    <div class="container">
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <h1 class="text-center">Edit Page</h1>
        <div class="form-group">
            <input type="hidden" name="id" id="id">
            <label for="exampleInputName">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName" value="{{$data['name'];}}" aria-describedby="namelHelp" placeholder="Enter Name">
             <span id="namelHelp" class="text-danger">
                @error('name')
                    {{$message}}
                @enderror
             </span>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$data['email'];}}" aria-describedby="emailHelp" placeholder="Enter email">
            <span id="emailHelp" class="text-danger">
                @error('email')
                    {{$message}}
                @enderror
            </span> 
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
             <span id="passwordlHelp" class="text-danger">
                @error('password')
                    {{$message}}
                @enderror
            </span> 
        </div>
        <div class="form-group">
            <label for="exampleInputCPassword1">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" id="exampleInputCPassword1" placeholder="Confirm Password">
            <span id="c_passwordlHelp" class="text-danger">
                @error('confirm_password')
                    {{$message}}
                @enderror
            </span>            
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
  </body>
</html>