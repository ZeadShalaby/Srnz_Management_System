<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN PAGE</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($SeAdmin)
        <div class="alert alert-success">
           {{'Welcome Back : '}}{{ $SeAdmin->name }}
        </div>
    @endif
   <h1> Admin Page</h1>
   <br>

    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
     <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
     <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('logout')}}"class="btn btn-success">Logout</a>


    <br>
    @endsection
</body>
</html>