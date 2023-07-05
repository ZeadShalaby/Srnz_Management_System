<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interesteds</title>
</head>
<body>
    @extends('extends')
    @section('content')
    <h1>Interesteds</h1>
    @foreach ($interesteds as $interested)
    <a href="{{route('interesteds.show',$interested->id)}}" class="inside-page__btn inside-page__btn--beach">
        {{$interested->id}}-{{$interested->user->name}}-{{$interested->order->department->name}}
    </a>
        <br>
    @endforeach
    <br>
    {{ $interesteds->links() }}

    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <br>
    @endsection
</body>
</html>