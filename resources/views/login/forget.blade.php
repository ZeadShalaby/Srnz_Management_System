<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-weidth,intal-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href=" https://icons8.com/icon/ejub91zEY6Sl/chrome">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/forget.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

    <title>Forget Account</title>
</head>
<body>
  @extends('layout.forget')
  @section('forget')
      
  <div class="background3">
      
    <div class="shape3"><div class="project"><a href="{{route('loginindex')}}" class="team_project" ><img src="{{URL('image/all/back.png')}}" alt="Back" class="img"></a></div></div>
    <div class="shape3"></div>
</div>
</div>
    <div class="main" style="margin-top: 87px;">
      <div class="container">
        <div class="wrapper">
          <header>Forgot password</header>
          <form method="" action="{{route('forget')}}" >
            {{ csrf_field() }}            
            <div class="field email">
              <div class="input-area">
                <input type="text" placeholder="Email Address" name="email">

                <i class="icon fa fa-envelope" id="icon1"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
              </div>
              <div class="error error-txt">Email can't be blank</div>
            </div>
            <div class="field password">
              <div class="input-area">
                <input type="password" placeholder="Last Password" name="password">
                <i class="icon fa fa-lock" id="icon1"></i>
                <i class="error error-icon fa fa-exclamation-circle"></i>
              </div>
              <div class="error error-txt">Password can't be blank</div>
            </div>
            <input type="submit" value="Login">

          </form>
          <div class="sign-txt">Not yet member? <a href="#">Send_Admin</a></div>
        </div>             
      </div>
    </div>


    @endsection


    
</body>


  

</html>