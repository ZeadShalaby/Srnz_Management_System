<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
</head>
<body>

    @extends('extends')
    @section('content')
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
    @if (session('error'))
    <div class="alert alert-danger">
        
        {{session('error')}}
    </div>
    @endif
    @if (session('status'))
    <div class="alert alert-success">
        
        {{session('status')}}
    </div>
    @endif
    <h1>Orders <a href="{{route('ordersite.create')}}"> <img width="50px" height="50px" src="{{URL('image/addgallery.png')}}"  alt="add" ></i>
    </a></h1>
   
<br>
 <div class="container mt-5">
        <div classs="form-group">
            <form action="{{route('orders.search')}}" method="POST">
            @csrf
            <button type="submit" name="searchs"> <i class='bx bx-search' ></i></button>
            <input type="text" id="search" name="search" placeholder="Search" class="form-control" />
            </form>

        </div>
    </div>
    
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search-orders') }}";
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>

    <br><br>
    @foreach ($orders as $order)
    <a href="{{route('ordersite.show',$order->id)}}" class="inside-page__btn inside-page__btn--beach">
       
        {{$order->id}}-{{$order->name}}
        <br>
        {{$order->user->name}}
        <br>
        {{$order->description}}
        <br>
        {{$order->price}}
    </a>


@isset($sefav)
    
    @else
    <form action="{{route('ordersite.favourite',$order->id)}}" method="POST">
        @csrf
<input style="width: 0%;height: 0%;background-color:white;border: rgb(255, 255, 255) " name="id" type="text"value="{{$order->id}}">
        @if(session('favourite')==$order->id)
        <button  name="favourite" class="btn btn-lg" type="submit"><i class="fa fa-heart" style="color: red;" ></i></button> 
        @else
        <button  name="favourite" class="btn btn-lg" type="submit"><i class="fa fa-heart" style="color: gold;" ></i></button> 

        @isset($interesteds)
        @foreach ($interesteds as $interested)
        @if(($interested->user_id==$userid)&($interested->order_id==$order->id))
        <div style="margin-left: 8.5px;margin-top: -48px">
        <button  name="favourite" class="btn btn-lg" type="submit"><i class="fa fa-heart" style="color: red;" ></i></button> 
        </div>
        @endif
        @endforeach
        @else
         
        @endisset 

        @endif
    </form>
    @endisset

        <br><br>
        @isset($orders_user)
        @foreach($orders_user as $oruser)
        @if($oruser->id==$order->id)
        <a href="{{route('ordersite.edit', $order->id)}}" class="btn btn-info"
        
            style="margin-left: 200px;margin-top: -150px;"> EDIT </a>
     
        <form action="{{route('ordersite.destroy',$order->id)}}" method="POST" >
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"  style="margin-top: -200px;margin-left: 400px;">DELETE</button>
        </form>
        @else
       
        @endif
        @endforeach 
        @endisset 

    @endforeach
    <br>
    {{ $orders->links() }}
    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <br>
    @endsection
    
</body>
</html>