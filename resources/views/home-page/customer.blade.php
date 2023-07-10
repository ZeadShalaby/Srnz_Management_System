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
    @if ($SeCustomer)
        <div class="alert alert-success">
           {{'Welcome Back : '}}{{ $SeCustomer->name }}
        </div>
    @endif
   <h1> Customer Page</h1>
   <br>
    <a href="{{ route('ordersite.index',$SeCustomer->id) }}" class="btn btn-dark">Orders</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('logout')}}"class="btn btn-success">Logout</a>

    <br>
    @endsection
</body>
</html>