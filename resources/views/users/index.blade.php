<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    @extends('extends')
    @section('content')
    <h1>Users</h1>
    @foreach ($users as $user)
    <a href="{{route('users.show',$user->id)}}" class="inside-page__btn inside-page__btn--beach">
        
        {{$user->id}}-{{$user->name}}-@if($user->gender > 1) <span class="spans">   {{"Customer"}} </span>
        @else{{"Admin"}}
            
        @endif
        <br>
        {{$user->profile_photo}}
        

    </a>
        <br><br>
    @endforeach
    <br>
    {{ $users->links() }}

    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
<br>
    @endsection
</body>
</html>