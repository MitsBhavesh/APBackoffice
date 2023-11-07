
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
  {{-- <form action="{{url('/')}}/Registration" method = "post"> --}}
  <form method = "post">
    @csrf
    {{-- <pre> --}}
       {{-- @php
            print_r($errors->all());    
       @endphp --}}
    {{-- </pre> --}}
    <div class="container" style="width: 50%;">
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        {{-- <h1 class="text-center">{{$title}}</h1> --}}
        <h1 class="text-center">Registration</h1>
        <div class="form-group">
            <input type="hidden" name="id" id="id">
            <label for="exampleInputName">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName" value="{{old('name')}}" aria-describedby="namelHelp" placeholder="Enter Name">
             <span id="namelHelp" class="text-danger">
                @error('name')
                    {{$message}}
                @enderror
             </span>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="Enter email">
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