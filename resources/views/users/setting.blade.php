<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/setting.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover-image.css')}}">
    <link rel="stylesheet" href="{{asset('css/load-setting.css')}}">
    <link rel="stylesheet" href="{{asset('css/star.css')}}">


    <title>Setting</title>
</head>
<body>
  
  @extends('extends')
  @section('content')
  @endsection

  <div id="divshow" style="visibility: hidden;">

    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
          <div class="container-fluid">
            <!-- Brand -->
            <!-- Form -->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
              <div id="search">
                <svg viewBox="0 0 420 60" xmlns="http://www.w3.org/2000/svg">
                  <rect class="bar"/>
                  
                  <g class="magnifier">
                    <circle class="glass"/>
                    <line class="handle" x1="32" y1="32" x2="44" y2="44"></line>
                  </g>
              
                  <g class="sparks">
                    <circle class="spark"/>
                    <circle class="spark"/>
                    <circle class="spark"/>
                  </g>
              
                  <g class="burst pattern-one">
                    <circle class="particle circle"/>
                    <path class="particle triangle"/>
                    <circle class="particle circle"/>
                    <path class="particle plus"/>
                    <rect class="particle rect"/>
                    <path class="particle triangle"/>
                  </g>
                  <g class="burst pattern-two">
                    <path class="particle plus"/>
                    <circle class="particle circle"/>
                    <path class="particle triangle"/>
                    <rect class="particle rect"/>
                    <circle class="particle circle"/>
                    <path class="particle plus"/>
                  </g>
                  <g class="burst pattern-three">
                    <circle class="particle circle"/>
                    <rect class="particle rect"/>
                    <path class="particle plus"/>
                    <path class="particle triangle"/>
                    <rect class="particle rect"/>
                    <path class="particle plus"/>
                  </g>
                </svg>
                <input type=search name=q aria-label="Search for inspiration"/>
              </div>
              
              <div id="results">
                
              </div>
            </form>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center" style="  margin-top: 35px;" >
                    <span class="avatar avatar-sm rounded-circle" style="  margin-top: -5px;">
                      @if(isset($users->profile_photo))
                      <img alt="Image placeholder" src="{{asset('image/all/profile.png')}}">
                     @else
                     <img src="{{asset('image/users/'.$users->profile_photo)}}" alt="Image users">
                     @endif
                    </span>
                    <div class="media-body ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold">{{$users->name}}</span>
                    </div>
                  </div>
                </a>
               
              </li>
            </ul>
          </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url({{asset('image/all/gback.svg')}}); background-size: 50%; background-position: center left;background-color: #000000;">
          <!-- Mask -->
          <!--<span class="mask bg-gradient-default opacity-8"></span>-->
          <!-- Header container -->
          <div class="container-fluid d-flex align-items-center">
            <div class="row" style="margin-left: 120px;margin-top: -20px;">
              <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello {{$users->name}}</h1>
                <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                <a href="#!" class="btn btn-info">Edit profile</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Page content -->
        <form @if($users->role == 2)action="{{route('registration.update',$users->id)}}"@else action="{{route('users.update',$users->id)}}"@endif name="formseting" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
        <div class="container-fluid mt--7">
          <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
              <div class="card card-profile shadow">
                <div class="row justify-content-center">
                  <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                      <a href="#">
                        @if(isset($users->profile_photo))
                        <div class="profile-pic">
                          <label class="-label" for="file">
                            <span class="glyphicon glyphicon-camera"><img class="hover" src="{{asset('image/all/camera.png')}}" alt="camera"></span>
                          </label>
                          <input id="file" name="profile_photo" type="file" value="{{$users->profile_photo}}" />
                          <img src="{{asset('image/all/profile.png')}}" class="rounded-circle">
                        </div>
                     @else
                     <div class="profile-pic">
                      <label class="-label" for="file">
                        <span class="glyphicon glyphicon-camera"><img class="hover" src="{{asset('image/all/camera.png')}}" alt="camera"></span>
                      </label>
                      <input id="file" type="file" name="profile_photo" onchange="loadFile(event)"/>
                      <img src="{{asset('image/users/'.$users->profile_photo)}}" alt="Image users">
                    </div>
                     @endif
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                  <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                    <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                  </div>
                </div>
                <div class="card-body pt-0 pt-md-4">
                  <div class="row">
                    <div class="col">
                      <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                        <div>
                          <span class="heading"  style="color: rgb(190, 40, 120)">{{$CountOrders}}</span>
                          <span class="description">orders</span>
                        </div>
                        <div>
                          <span class="heading"  style="color: rgb(190, 40, 120)">{{$CountFav}}</span>
                          <span class="description">favourite</span>
                        </div>
                        <div>
                          <span class="heading"  style="color: rgb(190, 40, 120)">89</span>
                          <span class="description">Comments</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h3 style="color: rgb(190, 40, 120)">
                      {{$users->name}}<span class="font-weight-light"></span>
                    </h3>
                    <div class="h5 font-weight-300" style="color: rgb(143, 141, 141)">
                      <i class="ni location_pin mr-2"></i>Bucharest, Romania
                    </div>
                    <div class="h5 mt-4" style="color: rgb(143, 141, 141)">
                      <i class="ni business_briefcase-24 mr-2" ></i>Solution Manager - Creative Tim Officer
                    </div>
                    <div style="color: rgb(143, 141, 141)">
                      <i class="ni education_hat mr-2"></i>University of Computer Science
                    </div>
                    <hr class="my-4" >
                    <p style="color: rgb(143, 141, 141)">Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                    <a href="#">Show more</a>
                  </div>
    
    
                  
    
                </div>
    
                <div class="animate" >
                  <div class="loader" style="--bg: hsl(185.97889774641104, 100%, 85%)">
                      <div class="dot" style="--index: 0"></div>
                      <div class="dot" style="--index: 1"></div>
                      <div class="dot" style="--index: 2"></div>
                      <div class="dot" style="--index: 3"></div>
                      <div class="dot" style="--index: 4"></div>
                      <div class="dot" style="--index: 5"></div>
                      <div class="dot" style="--index: 6"></div>
                      <div class="dot" style="--index: 7"></div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-xl-8 order-xl-1">
              <div class="card bg-secondary shadow">
               
                <div class="card-header bg-blue border-0" >
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0" style="color: azure;font-weight: bold">@if($users->role == $check)Gender : Admin @else Gender : Customer @endif</h3>
                    </div>
                    <div class="col-4 text-right">
                      <a href="#!" user_id='{{$users->id}}' class="btn btn-sm btn-primary"  style="background-color: #0b1526;"><button  name="setting" style="color: white;background-color: black;font-weight: bold;border: none;cursor: pointer;">Settings</button> </a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-username">Username</label>
                            <input type="text" id="input-username" class="form-control form-control-alternative" name="name" placeholder="Username" value="{{$users->name}}">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-email">Email Address</label>
                            <input type="email" id="input-email" class="form-control form-control-alternative" name="email" placeholder="jesse@example.com" value="{{$users->email}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Gmail Address</label>
                            <input type="email" id="input-first-name" class="form-control form-control-alternative" name="gmail" placeholder="Email Address" value="{{$users->gmail}}">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-last-name">Password</label>

                            <input type="password" id="input-last-name" class="form-control form-control-alternative" name="password" placeholder="Password" value="{{$users->password}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Phone Number</label>
                            <input type="text" id="input-first-name" class="form-control form-control-alternative" name="phone" placeholder="Phone Number" value="{{$users->phone}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-address">Address</label>
                            <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-city">City</label>
                            <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="New York">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-country">Country</label>
                            <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="United States">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label" for="input-country">Postal code</label>
                            <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">
                          </div>
                        </div>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">

                      </div>
                    </div>
                    <hr class="my-4">
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">About me</h6>
                    <div class="pl-lg-4">
                      <div class="form-group focused">
                        <label>About Me</label>
                        <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          
    <footer class="footer-section">
      <div class="container">
          <div class="footer-cta pt-5 pb-5">
              <div class="row">
                  <div class="col-xl-4 col-md-4 mb-30">
                      <div class="single-cta">
                          <i class="fas fa-map-marker-alt"></i>
                          <div class="cta-text">
                              <h4>Find us</h4>
                              <span>subra, sw Egypt, Menofuia</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-4 col-md-4 mb-30">
                      <div class="single-cta">
                          <i class="fas fa-phone"></i>
                          <div class="cta-text">
                              <h4>Call us</h4>
                              <span>20153068530</span>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-4 col-md-4 mb-30">
                      <div class="single-cta">
                          <i class="far fa-envelope-open"></i>
                          <div class="cta-text">
                              <h4>Mail us</h4>
                              <span>zeadshalaby1@gmail.com</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="footer-content pt-5 pb-5">
              <div class="row">
                  <div class="col-xl-4 col-lg-4 mb-50">
                      <div class="footer-widget">
                          <div class="footer-logo">
                              <a href="index.html"><img src="https://i.ibb.co/QDy827D/ak-logo.png" class="img-fluid" alt="logo"></a>
                          </div>
                          <div class="footer-text">
                              <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do eiusmod tempor incididuntut consec tetur adipisicing
                              elit,Lorem ipsum dolor sit amet.</p>
                          </div>
                          <div class="footer-social-icon">
                              <span>Follow us</span>
                              <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                              <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                              <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                      <div class="footer-widget">
                          <div class="footer-widget-heading">
                              <h3>Useful Links</h3>
                          </div>
                          <ul>
                              <li><a href="#">Home</a></li>
                              <li><a href="#">about</a></li>
                              <li><a href="#">services</a></li>
                              <li><a href="#">portfolio</a></li>
                              <li><a href="#">Contact</a></li>
                              <li><a href="#">About us</a></li>
                              <li><a href="#">Our Services</a></li>
                              <li><a href="#">Expert Team</a></li>
                              <li><a href="#">Contact us</a></li>
                              <li><a href="#">Latest News</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                      <div class="footer-widget">
                          <div class="footer-widget-heading">
                              <h3>Subscribe</h3>
                          </div>
                          <div class="footer-text mb-25">
                              <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                          </div>
                          <div class="subscribe-form">
                              <form action="#">
                                  <input type="text" placeholder="Email Address">
                                  <button><i class="fab fa-telegram-plane"></i></button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="copyright-area">
          <div class="container">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                      <div class="copyright-text">
                        <p>Copyright &copy; 2023, All Right Reserved <a href="https://github.com/ZeadShalaby">Zead Shalaby</a></p>
                      </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                      <div class="footer-menu">
                          <ul>
                              <li><a href="#">Home</a></li>
                              <li><a href="#">Terms</a></li>
                              <li><a href="#">Privacy</a></li>
                              <li><a href="#">Policy</a></li>
                              <li><a href="#">Contact</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
   </footer>
</div>

<div id="divhide" class="divhide" style="visibility: visible;">

<!-- SPINNER ORBITS -->
<div class="spinner-box">

<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
<div id='stars4'></div>
<div id='stars5'></div>
<div id='stars6'></div>
<div id='stars7'></div>
<div id='stars7'></div>


  <div class="blue-orbit leo">
  </div>

  <div class="green-orbit leo">
  </div>
  
  <div class="red-orbit leo">
  </div>
  
  <div class="white-orbit w1 leo">
  </div><div class="white-orbit w2 leo">
  </div><div class="white-orbit w3 leo">
  </div>
</div>

  
  </div>

<!-- delay setting -->   
<script>
  function showdiv(){
    document.getElementById("divshow").style.visibility = "visible";
    document.getElementById("divhide").style.visibility = "hidden";

   }
   setTimeout("showdiv()",3600);
</script>



  <script>

    $(document).on('click', '#setting', function (e) {
        e.preventDefault();

        var formData = new FormData($('#formseting')[0]);
        var user_id =  $(this).attr('user_id');

        $.ajax({
            type: 'put',
            enctype: 'multipart/form-data',
            url: "{{route('users.update',5)}}",
            data: {
                    '_token': "{{csrf_token()}}",
                    'id' :user_id,
                    'formData':formData,
                },
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {

                if (data.status == true) {
                    $('#error').hide();
                    $('#name_error_msg').hide();
                    $('#code_error_msg').hide();
                    $('#success_msg').show();
                    document.getElementById("departmentsForm").reset();  

                }
                if (data.type == 'code') {
                    $('#error').hide();
                    $('#name_error_msg').hide();
                    $('#code_error_msg').show();
                }
                if (data.type == 'name') {
                    $('#error').hide();
                    $('#code_error_msg').hide();
                    $('#name_error_msg').show();
                }

            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
               
                $.each(response.errors, function (key, val) {
                    $("#error").text(val[0]).show();
                });}
               
        });
    });


</script>
</body>
</html>