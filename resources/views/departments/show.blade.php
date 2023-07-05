<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Departments Information</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
   <h1>SHOW DEPARTMENTS</h1>
   <br>
  <span><h1 style="color: blue">Name : </h1>  <h2 style="color: coral">  {{$departments->name}} </h2>  </span>
  <span><h1 style="color: blue">Cde  : </h1>  <h2 style="color: coral">  {{$departments->code}} </h2>  </span>
  <span><h1 style="color: blue">img  : </h1>  <h2 style="color: coral">  {{$departments->img}}  </h2>  </span>

    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">restore</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>


    <br>
    @endsection
</body>
</html>