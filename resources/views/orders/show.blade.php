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
   <h1>SHOW Orders</h1>
   <br>
  <span><h1 style="color: blue">Name : </h1>  <h2 style="color: coral">        {{$orders->name}} </h2>  </span>
  <span><h1 style="color: blue">User : </h1>  <h2 style="color: coral">       @isset($orders->user->name) {{$orders->user->name}} @else{{'null user name'}}@endisset</h2>  </span>
  <span><h1 style="color: blue">Department : </h1>  <h2 style="color: coral"> @isset($orders->department->name) {{$orders->department->name}} @else{{'null department name'}}@endisset</h2>  </span>
  <span><h1 style="color: blue">gmail : </h1>  <h2 style="color: coral">       {{$orders->gmail}} </h2>  </span>
  <span><h1 style="color: blue">phone : </h1>  <h2 style="color: coral">       {{$orders->phone}} </h2>  </span>
  <span><h1 style="color: blue">description : </h1>  <h2 style="color: coral"> {{$orders->description}} </h2>  </span>
  <span><h1 style="color: blue">price : </h1>  <h2 style="color: coral">       {{$orders->price}} </h2>  </span>
  <span><h1 style="color: blue">path : </h1>  <h2 style="color: coral">        {{$orders->path}} </h2>  </span>

  
  
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