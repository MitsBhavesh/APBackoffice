{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
</style>

<div class="container">
{{-- <a href="{{route('arhamreg.create')}}"> --}}
{{-- <a href=""> --}}
  {{-- <button class="btn btn-primary d-inline-block m-2 float-right" data- 
  toggle="modal" data-target="#exampleModal">Add</button> --}}
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
    Add
  </button>
{{-- </a> --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <form action="{{$url}}" method = "post"> --}}
        <form action="{{url('/')}}/Registration" method = "post">
          @csrf
          {{-- <pre> --}}
             {{-- @php
                  print_r($errors->all());    
             @endphp --}}
          {{-- </pre> --}}
          <div class="container">
              {{-- @if (session('status'))
                  <h6 class="alert alert-success">{{ session('status') }}</h6>
              @endif --}}
              {{-- <h1 class="text-center">Registration</h1> --}}
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
<h2 style="text-align: center;">View Registration Records</h2>
@if (session('status'))
<h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table center" style="">
  <tr>
    {{-- <th>Id</th> --}}
    <th>Name</th>
    <th>Email</th>
    <th>Password</th>
    <th>Confirm Password</th>
    {{-- <th>Edit</th>
    <th>Delete</th> --}}
    <th>Action</th>
  </tr>
    <tbody>
        @foreach ($users as $user)
        <tr>
           {{-- <td>{{ $user->id }}</td> --}}
           <td>{{ $user->name }}</td>
           <td>{{ $user->email }}</td>
           <td>{{ $user->password }}</td>
           <td>{{ $user->confirm_password }}</td>
           {{-- <td>
            <button type="button" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-danger">Delete</button>
           </td> --}}
           <td>
            <a href="{{route('arhamreg.edit',['id'=>$user->id])}}">
            {{-- <a href="javascript:void(0)"> --}}
              {{-- <button class="btn btn-outline-primary" name="btn_update">Edit</button> --}}
              <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal1" data-target="#exampleModalCenter1">
                Edit</button>
            </a>

            <div class="modal fade1" id="exampleModalCenter1" tabindex="-1" role="dialog1" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered1" role="document1">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title1" id="exampleModalLongTitle1">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    {{-- <form action="{{$url}}" method = "post"> --}}
                    <form action="{{url('/')}}/Update" method = "post">
                      @csrf
                      <div class="container">
                          <div class="form-group">
                              {{-- <input type="hidden" name="id" id="id"> --}}
                              <label for="exampleInputName">Name</label>
                              <input type="text" name="name" class="form-control" id="exampleInputName" value="{{$user->name}}" aria-describedby="namelHelp" placeholder="Enter Name">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$user->email}}" aria-describedby="emailHelp" placeholder="Enter email">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputCPassword1">Confirm Password</label>
                              <input type="password" name="confirm_password" class="form-control" id="exampleInputCPassword1" placeholder="Confirm Password">           
                          </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                  </div>
                </div>
              </div>
            </div>
           
            {{-- <a href="{{url('/Delete')}}/{{$user->id}}"><button class="btn btn-outline-danger" name="btn_delete">Delete</button></a></td> --}}
            <a href="{{route('arhamreg.Delete',['id'=>$user->id])}}"><button class="btn btn-outline-danger" name="btn_delete" onclick="Delete()">Delete</button></a></td>
        </tr>
        @endforeach
    </tbody>
    
</table>
</div>

<script>
  function Delete()
  {
    alert('Are You Sure Want to Delete this Data');
  }
</script>


