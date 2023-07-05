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
    <h1>Orders</h1>
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
    <a href="{{route('orders.show',$order->id)}}" class="inside-page__btn inside-page__btn--beach">
        {{$order->id}}-{{$order->name}}
        <br>
        {{$order->user->name}}
        <br>
        {{$order->description}}
        <br>
        {{$order->price}}
    </a>

    <form action="{{route('orders.favourite',$order->id)}}" method="POST">
        @csrf
<input style="width: 0%;height: 0%;background-color:white;border: rgb(255, 255, 255) " name="id" type="text"value="{{$order->id}}">
        @if(session('favourite')==$order->id)

        <button  name="favourite" class="btn btn-lg"><i class="fa fa-heart" style="color: red;" type="submit"></i></button> 
        @else
        <button  name="favourite" class="btn btn-lg"><i class="fa fa-heart" style="color: gold;" type="submit"></i></button> 
        @endif
    </form>

        <br><br>

    @endforeach
    <br>
    {{ $orders->links() }}

    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <br>
    @endsection
    
</body>
</html>