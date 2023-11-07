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
  <form action="{{route('login-user')}}" method = "post">
   
    @csrf
   <!--  <pre>
        @php
            print_r($errors->all());    
       @endphp 
     </pre>  -->
    <div class="container" style="width: 50%;">
        <h1 class="text-center">Login</h1>
        @if (session('status'))
            <h6 class="alert alert-danger">{{ session('status') }}</h6>
        @endif
        @if (session('status_login'))
            <h6 class="alert alert-success">{{ session('status_login') }}</h6>
        @endif
        @if (session('status_logout'))
            <h6 class="alert alert-success">{{ session('status_logout') }}</h6>
        @endif
        @if (session('fail'))
            <h6 class="alert alert-danger">{{ session('fail') }}</h6>
        @endif
        
        <div class="form-group">
            <input type="hidden" name="id" id="id">
            <label for="exampleInputemail">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputemail" value="" aria-describedby="emaillHelp" placeholder="Enter Name">
             <span id="emaillHelp" class="text-danger">
                @error('email')
                    {{$message}}
                @enderror
             </span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="" aria-describedby="passwordHelp" placeholder="Enter Password">
            <span id="passwordHelp" class="text-danger">
                @error('password')
                    {{$message}}
                @enderror
            </span> 
        </div>
       
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </div>
</form>
  </body>
</html>