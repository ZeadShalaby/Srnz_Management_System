<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/load-home.css')}}">
    <link rel="stylesheet" href="{{asset('css/star.css')}}">
    <link rel="stylesheet" href="{{asset('css/setting.css')}}">
 

    <title>ADMIN PAGE</title>
</head>
<body>
    @if ($SeAdmin)
        @extends('layout.messages-success')
        @section('messages_success')
        @endsection
        
    @endif
    
    @extends('extends')
    @section('content')
    @if (session('status'))
        {{session('status')}}
    @endif
    
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
                      @if(isset($SeAdmin->profile_photo))
                      <img alt="Image placeholder" src="{{asset('image/all/profile.png')}}">
                     @else
                     <img src="{{asset('image/users/'.$SeAdmin->profile_photo)}}" alt="Image users">
                     @endif
                    </span>
                    <div class="media-body ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold">{{$SeAdmin->name}}</span>
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
          <!-- Header container -->
          <div class="container-fluid d-flex align-items-center">
            <div class="row" style="margin-left: 120px;margin-top: -20px;">
              <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello {{$SeAdmin->name}}</h1>
                <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                <a href="#!" class="btn btn-info">Edit profile</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Page content -->
        <form action="{{route('users.update',$SeAdmin->id)}}" name="formseting" method="post" enctype="multipart/form-data">
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
                        @if(isset($SeAdmin->profile_photo))
                        <div class="profile-pic" style="margin-top: -150px">
                          <label class="-label" for="file">
                          </label>
                          <img src="{{asset('image/all/profile.png')}}" class="rounded-circle">
                        </div>
                     @else
                     <div class="profile-pic" style="margin-top: -150px">
                      <label class="-label" for="file">
                      </label>
                      <img src="{{asset('image/users/'.$SeAdmin->profile_photo)}}" alt="Image users">
                    </div>
                     @endif
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4" style="margin-top: -20px">
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
                          <span class="heading">0</span>
                          <span class="description">orders</span>
                        </div>
                        <div>
                          <span class="heading">0</span>
                          <span class="description">favourite</span>
                        </div>
                        <div>
                          <span class="heading">0</span>
                          <span class="description">Comments</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h3>
                      {{$SeAdmin->name}}<span class="font-weight-light">, 27</span>
                    </h3>
                    <div class="h5 font-weight-300">
                      <i class="ni location_pin mr-2"></i>Bucharest, Romania
                    </div>
                    <div class="h5 mt-4">
                      <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                    </div>
                    <div>
                      <i class="ni education_hat mr-2"></i>University of Computer Science
                    </div>
                    <hr class="my-4">
                    <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                    <a href="#">Show more</a>
                  </div>
    
                  
    
                </div>
    
                <div class="animate">
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
                    </div>
                    <h3 class="mb-0" style="color: azure;font-weight: bold;margin-left: -560px">@if($SeAdmin->role == 1)Gender : Admin @else Gender : Customer @endif</h3>
                  </div>
                </div>
               
              
                <div class="card-body" style="background-color: rgb(35, 35, 36)">
                  <img src="{{asset('image/all/homes.gif')}}" alt="homes" style="height: 800px;width: 800px;border-radius: 30px;border: 2px solid rgb(16, 16, 17);margin-left: -7px;box-shadow: 5px cornflowerblue ">

                
                </div>
              
          </div>
        </div>
      </div>
          
    <footer class="footer-section" style="width: 102.7%">
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

    <!--  content  -->
    
    
        </div>
        </form>
    </div></div>
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
            </div>
        <figure style="margin-left: 40px;">
            <div></div><div></div>
            <div></div><div></div>
            <div></div><div></div>
            <div></div><div></div>
          </figure>
        </div>
    <!-- delay home -->   
    <script>
        function showdiv(){
          document.getElementById("divshow").style.visibility = "visible";
          document.getElementById("divhide").style.visibility = "hidden";
      
         }
         setTimeout("showdiv()",3600);
      </script>

   
    
   
</body>
</html>
