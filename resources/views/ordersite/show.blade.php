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
    @if (session('favourite'))
    <div class="alert alert-success">  
        {{"Add your favourite"}}
    </div>
    @endif
    @if (session('faverror'))
    <div class="alert alert-danger">  
        {{session('faverror')}}
    </div>
    @endif

   <h1>SHOW Orders</h1>
   <br>

   <form action="{{route('ordersite.favourite',$orders->id)}}" method="POST" >
    @csrf
<input style="width: 0%;height: 0%;background-color:white;border: rgb(255, 255, 255) " name="id" type="text"value="{{$orders->id}}">
    @if(session('favourite')==$orders->id)
    <button  name="favourite" class="btn btn-lg" type="submit"><i class="fa fa-heart" style="color: red;" ></i></button> 
    @else
    <button  name="favourite" class="btn btn-lg" type="submit"><i class="fa fa-heart" style="color: gold;" ></i></button> 

    @isset($interesteds)
    @foreach ($interesteds as $interested)
    @if(($interested->user_id==$userid)&($interested->order_id==$orders->id))
    <div style="margin-left: 8.5px;margin-top: -48px">
    <button  name="favourite" class="btn btn-lg" type="submit"><i class="fa fa-heart" style="color: red;" ></i></button> 
    </div>
    @endif
    @endforeach
    @else
     
    @endisset 

    @endif
</form>

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
  <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
  <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
  <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>



    <br>
    @endsection
</body>
</html>