<?php 
$ProfileData =  json_encode(Session()->get('Login_Email')[0]);
$UserId = Session()->get('Login_Email')[0]->ID;
// print_r($UserId);
// exit;
?>
<?php  
$conn = DB::connection('sqlsrv');
$nres = $conn->select("SET NOCOUNT ON; EXEC pro_seletNotification ");
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="horizontal-menu-template">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5" />
        <!-- <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="-1" /> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
        <!-- End Google Tag Manager -->
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="assets\img\favicon.png" />
        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.googleapis.com/" /> -->
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin /> -->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" /> -->
        <!-- Icons -->
        <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />
        <!-- Core CSS -->
        <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="assets/css/demo.css" />
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
        <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
        <!-- Page CSS -->
        <!-- Helpers -->
        <script src="assets/vendor/js/helpers.js"></script> 
        <script src="assets/vendor/libs/jquery/jquery.js"></script>
        
        <!-- <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> -->

        <script>
          const base_url = '{{url('/')}}';
        </script>
        <script src="assets/js/config.js"></script>  

        <style type="text/css">
          .menu-icon {
            color: #364f4b !important;
          }
          .menu-link {
            color: #364f4b !important;
          }
        </style>
        <style>
          .cardborder {
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            align-items: center;
          }
          .alert-success {
            background-color: #364f4b !important;
            border-color: #364f4b !important;
            color: #fff !important;
          }
          .cardcenter {
            align-self: center;
          }
          
          #nav ul {
            position: absolute;
            padding: 0;
            left: 0;
            display: none;
            /* hides sublists */
          }

          #nav li:hover ul ul {
            display: none;
          }

          /* hides sub-sublists */

          #nav li:hover ul {
            display: block;
          }

          /* shows sublist on hover */

          #nav li li:hover ul {
            display: block;
            /* shows sub-sublist on hover */
            margin-left: 200px;
            /* this should be the same width as the parent list item */
            margin-top: -35px;
            /* aligns top of sub menu with top of list item */
          }
          .bg-menu-theme .menu-inner>.menu-item.active>.menu-link {
            color: #696cff;
            background-color: rgb(31 61 56 / 24%) !important;
          }
        </style>
      </head>
      <body>
        
        @php  Session()->get('Login_Email')[0] @endphp
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
          <div class="layout-container">
           <!-- Navbar -->
           <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="container-xxl">
              <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="assets\img\logo.jpg" style="max-width: 200px; height:auto;">
                  </span>   
                </a>                       
                <a href="javascript:void(0);" style="background-color:#364f4b;" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                 <i class="bx bx-chevron-left bx-sm align-middle"></i>
               </a>
               <!-- End og -->
             </div>
             <!-- change 1 -->
             <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
               <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                 <i class="bx bx-menu bx-sm"></i>
               </a>
             </div>
             <!-- end change 1 -->
                        <!-- <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                          <a href="{{url('/')}}/post"> -->
                            <!-- logoA -->
                                <!-- <img src="assets\img\logo.jpg" style="max-width: 200px; height:auto;" />
                            </a>
                          </div> -->
                          
                          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            
                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                              <!-- User -->
                              @if(!empty(Session()->get('Login_Email')[0]->profile_pic))
                              
                              
                              @php $objData = explode("/", Session()->get('Login_Email')[0]->profile_pic) @endphp
                              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                                <ul class="navbar-nav flex-row align-items-center ms-auto">         
                                  <!-- Notification -->
                                  <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                      <i class="bx bx-bell bx-sm"></i>
                                      @php $cntNot = ""; @endphp
                                      @foreach($nres as $value)
                                      @php $titleArray = explode(",", $value->users); @endphp
                                      @if(!in_array($UserId, $titleArray))
                                      @php $cntNot++; @endphp
                                      @endif
                                      @endforeach

                                      @if(!empty($cntNot))
                                      <span class="badge bg-danger rounded-pill badge-notifications">{{$cntNot}}</span>
                                      @endif
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end py-0 scrollable-container" data-bs-popper="static">
                                      <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                          <h5 class="text-body mb-0 me-auto">Notification</h5>
                                          <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read" data-bs-original-title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
                                        </div>
                                      </li>

                                      <li class="dropdown-notifications-list scrollable-container ps" style="    overflow: auto !important;">
                                        <ul class="list-group list-group-flush scrollable-container">
                                          @foreach($nres as $value)
                                          @php $objData1 = explode("/", $value->image) @endphp
                                          @php $titleArray = explode(",", $value->users); @endphp
                                          @php $var = "false"; @endphp
                                          @php $bgcolor = ""; @endphp
                                          @if(!in_array($UserId, $titleArray))
                                          @php $var = "true,".$value->Id; @endphp
                                          @endif
                                          @if(in_array($UserId, $titleArray))
                                          @php $bgcolor = "background-color: #f3f3f3;"; @endphp
                                          @endif
                                          <li class="list-group-item list-group-item-action dropdown-notifications-item card-for-not" style="{{$bgcolor}}" data-value="{{$value->category}},{{$var}}">
                                            <div class="d-flex">
                                              <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                  <img src="assets/img/digital/{{ $objData1[count($objData1) - 1] }}" alt="" class="w-px-40 h-auto rounded-circle">
                                                </div>
                                              </div>
                                              <div class="flex-grow-1">
                                                <!-- <h6 class="mb-1">Arhamshare Add new</h6> -->
                                                <h5 class="card-title">@php print_r( $value->title);  @endphp</h5>
                                                <p class="mb-0">{{$value->category}}</p>
                                                <small class="text-muted">@php print_r( $value->create_date);  @endphp</small>
                                              </div>
                                              <!-- @php print_r($UserId); @endphp -->
                                              @if(!in_array($UserId, $titleArray))
                                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot" style="background-color:green;"></span></a>
                                                <!-- <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a> -->
                                              </div>
                                              @endif
                                            </div>
                                            
                                          </li>
                                          @endforeach    

                                        </ul>
                                        
                                      </ul>
                                    </li>
                                    <!--/ Notification -->
                                    <!-- User -->
                                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                      <!-- change -->
                                      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <div class="avatar avatar-online">
                                          <img class="card-img-top " style="max-width: 40px; border-radius: 60%; margin: 5px; max-height: 40px;" id="scream" src="assets/img/digital/{{ $objData[count($objData) - 1] }}" alt="Card image cap" />
                                        </div>
                                      </a>
                                      <!-- End -->
                                      <ul class="dropdown-menu dropdown-menu-end" data-bs-popper="static">

                                        <li>
                                          <a class="dropdown-item" href="{{url('/edit_profile')}}">
                                            <div class="d-flex">
                                              <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                  <img class="card-img-top " style="max-width: 40px; border-radius: 60%; margin: 5px; max-height: 40px;" id="scream" src="assets/img/digital/{{ $objData[count($objData) - 1] }}" alt="Card image cap" />
                                                </div>
                                              </div>
                                              <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">@php print_r(Session()->get('Login_Email')[0]->name); @endphp </span>
                                                <small class="text-muted">@php print_r(Session()->get('Login_Email')[0]->APCode); @endphp </small>
                                              </div>
                                            </div>
                                          </a>
                                        </li>
                                        
                                        <li>
                                          <a class="dropdown-item" href="{{url('/')}}/edit_profile">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                            <input type="hidden" value="<?php echo Session()->get('Login_Email')[0]->ID; ?>">
                                          </a>
                                        </li>
                                        
                                        <li>
                                          <a class="dropdown-item" href="{{url('/')}}/Logout">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                          </a>
                                        </li>

                                      </ul>
                                    </li>
                                    <!--/ User -->
                                    
                                    
                                  </ul>
                                </div>
                                
                                @endif
                                <!--/ User -->
                              </ul>
                            </div>
                          </div>
                        </nav>
                        <!-- / Navbar -->
                        <!-- Layout container -->
                        <div class="layout-page">
                          <!-- Content wrapper -->
                          <div class="content-wrapper" style="align-items: center;">
                            <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0"
                            data-bg-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">                      
                            <div class="container-xxl d-flex h-100">                        
                              <a href="#" class="menu-horizontal-prev d-none"></a>
                              <div class="menu-horizontal-wrapper">
                                <ul class="menu-inner" style="margin-left: 0px;">
                                  <!-- Dashboards -->
                                        <!-- <li class="menu-item">
                                            <a href="{{url('/')}}/dashboards" class="menu-link">
                                                <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
                                                <div data-i18n="Dashboards">Dashboards</div>
                                            </a>
                                          </li> -->
                                          <!-- Post -->
                                          <li class="menu-item {{ request()->is('post') ? 'active' : '' }}">
                                            <a href="{{url('/')}}/post" class="menu-link">
                                              <i class="menu-icon  fa-solid fa-image"></i>
                                              <div data-i18n="Post">&nbsp;Post</div>
                                            </a>
                                          </li>
                                          <!-- Video -->
                                          <li class="menu-item {{ request()->is('video') ? 'active' : '' }}">
                                            <a href="{{url('/')}}/video" class="menu-link">
                                              <i class="menu-icon  fa-brands fa-youtube"></i>
                                              <div data-i18n="View">&nbsp;Video</div>
                                            </a>
                                          </li>
                                          <!-- Updates -->
                                          <li class="menu-item {{ request()->is('update') ? 'active' : '' }}">
                                            <a href="{{url('/')}}/update" class="menu-link">
                                              <i class="menu-icon  fa-sharp fa-solid fa-pen"></i>
                                              <div data-i18n="View">&nbsp;Updates</div>
                                            </a>
                                          </li>
                                          <!-- news -->
                                          <li class="menu-item {{ request()->is('news') ? 'active' : '' }}">
                                            <a href="{{url('/')}}/news" class="menu-link">
                                              <i class="menu-icon  fa-regular fa-newspaper"></i>
                                              <div data-i18n="View">&nbsp;News</div>
                                            </a>
                                          </li>

                                        </ul>
                                      </div>
                                    </div>
                                  </aside>
