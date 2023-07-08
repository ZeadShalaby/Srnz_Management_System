<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders Information</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
   <h1>SHOW Users</h1>
   <br>
  <span><h1 style="color: blue">profile_photo : </h1>  <h2 style="color: coral"> {{$users->profile_photo}} </h2>  </span>
  <span><h1 style="color: blue">Name : </h1>  <h2 style="color: coral">        {{$users->name}} </h2>  </span>
  <span><h1 style="color: blue">Email : </h1>  <h2 style="color: coral">        {{$users->email}} </h2>  </span>
  <span><h1 style="color: blue">gmail : </h1>  <h2 style="color: coral">       {{$users->gmail}} </h2>  </span>
  <span><h1 style="color: blue">phone : </h1>  <h2 style="color: coral">       {{$users->phone}} </h2>  </span>
  <span><h1 style="color: blue">password : </h1>  <h2 style="color: coral"> {{$users->password}} </h2>  </span>
  <span><h1 style="color: blue">role : </h1>  <h2 style="color: coral">       {{$users->role}} </h2>  </span>

 
  
    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>


    <br>
    @endsection
</body>
</html>