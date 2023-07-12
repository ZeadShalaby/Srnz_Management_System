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
    
    @if (session('status'))
    <div class="alert alert-success">  
        {{session('status')}}
    </div>
    @endif
    
    @if (session('error'))
    <div class="alert alert-danger">
        
        {{session('error')}}
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
        @isset($order->user->name)
        {{$order->user->name}}
        @else{{"users deleted"}}
        @endisset
        <br>
        {{$order->description}}
        <br>
        {{$order->price}}
    </a>

   @if($userid==$check)
    <form action="{{route('orders.destroy',$order->id)}}" method="POST" >
        @csrf
        @method('DELETE')
        <button class="btn btn-danger"  style="margin-left: 150px;">DELETE</button>
    </form>
   
        
    @else
        
    @endif
        <br><br>

    @endforeach
    <br>
    {{ $orders->links() }}

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <br>
    @endsection
    
</body>
</html>