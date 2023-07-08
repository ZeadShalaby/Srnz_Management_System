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
    @if(session('status'))
    <div class="alert alert-success">
    {{session('status')}}
    </div>
    @endif
    @if(session('deleteall'))
    <div class="alert alert-dark">
    {{session('deleteall')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
    {{session('error')}}
    </div>
    @endif
    <h1>Interesteds</h1>
    <br><br>
    @foreach ($interesteds as $interested)
    <a href="{{route('interesteds.show',$interested->id)}}" class="inside-page__btn inside-page__btn--beach">
        {{$interested->id}}-{{$interested->user->name}}-{{$interested->order->department->name}}
    </a>
        <br>
        <form action="{{route('interesteds.destroy',$interested->id)}}" method="POST" >
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"  style="margin-top: -25px;margin-left: 400px;">Remove</button>
        </form>
        <br><br>
        
    @endforeach
    <form action="{{route('interesteds.destroy',$user_id)}}" method="POST" >
        @csrf
        @method('DELETE')
        <button class="btn btn-dark"name="deleteall"style="margin-top: -165px;margin-left: 600px;">RemoveAll</button>
    </form>
    <br>
    {{ $interesteds->links() }}
    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
    <br>
    @endsection
</body>
</html>