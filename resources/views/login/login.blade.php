
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

    <title>Login System in Laravel</title>

    <!--Stylesheet-->
   
<body>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    @if(isset(Auth::user()->email))
        <script>window.location = "/login/successlogin";</script>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="background">
      
        <div class="shape"></div>
        <div class="shape"></div>
     
    </div>
   
  <div class="background3">
      
    <div class="shape3"><div class="forget"><a href="file:///D:/idea%20not%20field/Project_SW2/forget.html" class="forget-letter"></a></div></div>
    <div class="shape3"><div class="project"><a href="file:///D:/idea%20not%20field/Project_SW2/card%20move%20away.html" class="team_project" ></a></div>
 
</div>
</div>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    @if(isset(Auth::user()->email))
        <script>window.location = "/login/successlogin";</script>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form method="post" action="{{ url('/login/checklogin') }}">
        {{ csrf_field() }}
        <h3>Login Here</h3>

        <label for="username">Username/Phone</label>
        <input  type="text" id="username" name="email" class="input" value="{{old('email')}}"/>


        <label for = "password" name="password">Password</label>
        <input type="password" id="password" name="password" class="input" value="{{old('password')}}"/>
        <br>
        <a href="{{route('forgetindex')}}" style="text-decoration: none;color: rgb(0, 183, 255)"> forget passsword ..?</a>

        <input type="submit" name="login" class ="login" value="Login"/>

        <div class="social-media" style="margin-top: 10px">
          <a href="{{ url('/redirect/google') }}"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="{{ url('/redirect/google') }}"><i class="fab fa-google"></i></a>
          <a href="{{ url('/redirect/linkedin') }}"><i class="fa fa-linkedin-square"></i></a>
          <a href="{{ url('/redirect/github') }}"><i class="fa fa-github"></i></a>

        </div>
    </form>
    <a href="{{route('registration.create')}}"> <img width="50px" height="50px" src="{{URL('image/all/add1.png')}}"  alt="add" > </i>
    </a>
</body>

</html>
