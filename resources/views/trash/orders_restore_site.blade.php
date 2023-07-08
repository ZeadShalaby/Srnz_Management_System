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
            <form action="{{route('orders.search.restore')}}" method="POST">
            @csrf
            <button type="submit" name="searchs_restore"> <i class='bx bx-search' ></i></button>
            <input type="text" id="search" name="search" placeholder="Search" class="form-control" />
            </form>

        </div>
    </div>
    
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search-orders-restore') }}";
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
    <a href="#" class="inside-page__btn inside-page__btn--beach">
        {{$order->id}}-{{$order->name}}
        <br>
        {{$order->user->name}}
        <br>
        {{$order->description}}
        <br>
        {{$order->price}}
    </a>


   <br><br>
    <a href="{{ route('orders.restore.site', [ 'id'=> $order->id]) }}">
        <button class="btn btn-danger" style="margin-left: 900px;margin-top: -65px;">restore</button>
   </a>
        <br><br>

    @endforeach
    <br>

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">Or-restore</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>

    <br>
    @endsection
    
</body>
</html>