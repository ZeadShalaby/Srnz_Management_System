<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/restore.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

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
    
    @extends('layout.message-trash-ord')
    @section('trash_ord')
        
    @endsection
    
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
    <script>

        $(document).on('click', '.restore_btn', function (e) {
            e.preventDefault();
        
              var order_id =  $(this).attr('order_id');
             
            $.ajax({
                type: 'get',
                 url: "{{route('orders.restore.site')}}",
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