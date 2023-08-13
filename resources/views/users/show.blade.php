<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

    <title>Orders Information</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        @extends('layout.message-users-update')
        @section('update_user')
            
        @endsection
    @endif
   <h1>SHOW Users</h1>
   <br>
  <span><h1 style="color: blue">profile_photo : </h1>  <h2 style="color: coral"> {{$users->profile_photo}} </h2>  </span>
  <span><h1 style="color: blue">Name : </h1>  <h2 style="color: coral">        {{$users->name}} </h2>  </span>
  <span><h1 style="color: blue">Email : </h1>  <h2 style="color: coral">        {{$users->email}} </h2>  </span>
  <span><h1 style="color: blue">gmail : </h1>  <h2 style="color: coral">       {{$users->gmail}} </h2>  </span>
  <span><h1 style="color: blue">phone : </h1>  <h2 style="color: coral">       {{$users->phone}} </h2>  </span>
  <span><h1 style="color: blue">password : </h1>  <h2 style="color: coral"> {{$users->password}} </h2>  </span>
  <span><h1 style="color: blue">role : </h1>  <h2 style="color: coral">   @if($users->role == 2)  {{"Customer"}} @else {{"Admin"}} @endif  </h2>  </span>

 
  
    

    <br>
    @endsection
</body>
</html>