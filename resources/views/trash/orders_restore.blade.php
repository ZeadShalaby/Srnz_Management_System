<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/restore.css')}}">
    <title>Orders</title>
</head>
<body id="body">

    @extends('extends')
    @section('content')
    
    @if (session('error'))
    <div class="alert alert-danger">
        
        {{session('error')}}
    </div>
    @endif

    <div class="alert alert-success" id="success_msg" style="display: none;">
        Orders Restore successfully .
    </div>

    <h1 id="h1">Orders Restore</h1>
<br>
    @foreach ($orders as $order)
    <div class="container">
        <div class="box">
    
        <div class="OrderRow{{$order->id}}">
        <a href="#restore" id="href"  order_id={{$order->id}} class="restore_btn " ><img class="restore"src="{{URL('image/all/restore.png')}}" alt="folder"></a>
        <img class="img" src="{{URL('image/all/folders.png')}}" alt="folder">
    
        <p style="text-align: center;font-size: 15px;color: blue">
            {{$order->user->name}} : {{$order->name}}  
            
        </p>
    
            <img class="photo" src="image/orders/{{$order->path}}" alt="orders">
    
        </div>
    </div>
        </div>
    @endforeach
    <br>
    {{ $orders->links() }}
    <div style="margin-top: 500px">
    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    </div>
    <br>

    <script>

        $(document).on('click', '.restore_btn', function (e) {
            e.preventDefault();
        
              var order_id =  $(this).attr('order_id');
             
            $.ajax({
                type: 'get',
                 url: "{{route('orders.restore')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :order_id
                },
                success: function (data) {
        
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.OrderRow'+data.id).remove();
                }, error: function (reject) {
        
                }
            });
        }); 
        </script>

    @endsection
    
</body>
</html>