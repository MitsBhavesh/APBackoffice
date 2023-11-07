<!doctype html>
<html lang="en">
  <head>
    @stack('title')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <style>

      /* NAVIGATION */
      nav {
        width: 100%;
        margin: 0 auto;
        background: #fff;
        padding: 0px 0;
      }
      
      nav ul li {
        display: inline-block;
      }
      nav ul li a {
        display: block;
        padding: 15px;
        text-decoration: none;
        color: #aaa;
        font-weight: 800;
        text-transform: uppercase;
        margin: 0 10px;
      }
      nav ul li a,
      nav ul li a:after,
      nav ul li a:before {
        transition: all .5s;
      }
      nav ul li a:hover {
        color: #555;
      }
      
      
      /* stroke */
      nav.stroke ul li a,
      nav.fill ul li a {
        position: relative;
      }
      nav.stroke ul li a:after,
      nav.fill ul li a:after {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 0%;
        content: '.';
        color: transparent;
        background: #aaa;
        height: 1px;
      }
      nav.stroke ul li a:hover:after {
        width: 100%;
      }
      
      nav.fill ul li a {
        transition: all 2s;
      }
      
      nav.fill ul li a:after {
        text-align: left;
        content: '.';
        margin: 0;
        opacity: 0;
      }
      nav.fill ul li a:hover {
        color: #fff;
        z-index: 1;
      }
      nav.fill ul li a:hover:after {
        z-index: -10;
        animation: fill 1s forwards;
        -webkit-animation: fill 1s forwards;
        -moz-animation: fill 1s forwards;
        opacity: 1;
      }
      
      /* Circle */
      nav.circle ul li a {
        position: relative;
        overflow: hidden;
        z-index: 1;
      }
      nav.circle ul li a:after {
        display: block;
        position: absolute;
        margin: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        content: '.';
        color: transparent;
        width: 1px;
        height: 1px;
        /* border-radius: 10%; */
        background: transparent;
      }
      nav.circle ul li a:hover:after {
        -webkit-animation: circle 1.5s ease-in forwards;
      }
      
      /* SHIFT */
      nav.shift ul li a {
        position:relative;
        z-index: 1;
      }
      nav.shift ul li a:hover {
        color: white;
      }
      nav.shift ul li a:after {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        width: 100%;
        height: 1px;
        content: '.';
        color: transparent;
        background: #274602;
        visibility: none;
        opacity: 0;
        z-index: -1;
      }
      nav.shift ul li a:hover:after {
        opacity: 1;
        visibility: visible;
        height: 100%;
      }
      
      
      
      /* Keyframes */
      @-webkit-keyframes fill {
        0% {
          width: 0%;
          height: 1px;
        }
        50% {
          width: 100%;
          height: 1px;
        }
        100% {
          width: 100%;
          height: 100%;
          background: #333;
        }
      }
      
      /* Keyframes */
      @-webkit-keyframes circle {
        0% {
          width: 1px;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          margin: auto;
          height: 1px;
          z-index: -1;
          background: #eee;
          /* border-radius: 0%; */
        }
        100% {
          background: #aaa;
          height: 5000%;
          width: 5000%;
          z-index: -1;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          margin: auto;
          /* border-radius: 0; */
        }
      }
        </style>
  </head>

  <body>
    {{-- <h1 class="text-center">Welcome to my Page</h1> --}}
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid" style="background-color: #4caf5059;">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" class="btn btn-outline-primary" aria-current="page" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" class="btn btn-outline-primary" href="{{url('/Registration')}}">Registration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" class="btn btn-outline-primary" href="{{url('/ShowData')}}">Show Data</a>
            </li>
            
          </ul>
          
        </div>
      </div>
    </nav> --}}


    <section style="background: #f1c40f; color: rgba(0, 0, 0, 0.5);">
      {{-- <h2>Shift</h2> --}}
      <nav class="shift">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('/Registration')}}">Registration</a></li>
          <li><a href="{{url('/ShowData')}}">Show</a></li>
          <li><a href="{{url('/Login')}}">Login</a></li>
          <li><a href="{{route('logout')}}">LogOut</a></li>
        </ul>
      </nav>
    </section> 
      
    