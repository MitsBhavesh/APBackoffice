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
<a href="{{route('arhamreg.create')}}">
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
    Add
  </button>
</a>

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
            {{-- <a href="#"> --}}
              {{-- <button class="btn btn-outline-primary" name="btn_update">Edit</button> --}}
              <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#exampleModalCenter1">
                Edit</button>
            </a>

           
           
            {{-- <a href="{{url('/Delete')}}/{{$user->id}}"><button class="btn btn-outline-danger" name="btn_delete">Delete</button></a></td> --}}
            <a href="{{route('arhamreg.Delete',['id'=>$user->id])}}"><button class="btn btn-outline-danger" name="btn_delete">Delete</button></a></td>
        </tr>
        @endforeach
    </tbody>
    
</table>
</div>