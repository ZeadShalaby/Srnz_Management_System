<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/restore.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link href="{{asset('css/shop.css')}}" rel="stylesheet">

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
    <div id="divshow" style="visibility: hidden;">

<br>

    @foreach ($orders as $order)
    <div class="container">
        <div class="box">
    
        <div class="OrderRow{{$order->id}}">
        <a href="#restore" id="href"  order_id={{$order->id}} class="restore_btn " ><img class="restore"src="{{URL('image/all/restore.png')}}" alt="folder"></a>
        <img class="img" src="{{URL('image/all/folders.png')}}" alt="folder">
    
        <p style="text-align: center;font-size: 15px;color: blue">
            @if(isset($order->user)){{$order->user->name}} @else Users Deleted : @endif {{$order->name}}  
            
        </p>
            <div class="path">
            <img  class="photo" src="image/orders/{{$order->path}}" alt="orders" style="">
            </div>
        </div>
    </div>
        </div>
    @endforeach

    </div>

    <div id="divhide" class="divhide" style="visibility: visible;">
        <div class="preloader">
            <svg class="cart" role="img" aria-label="Shopping cart line animation" viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
                    <g class="cart__track" stroke="hsla(0,10%,10%,0.1)">
                        <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" />
                        <circle cx="43" cy="111" r="13" />
                        <circle cx="102" cy="111" r="13" />
                    </g>
                    <g class="cart__lines" stroke="currentColor">
                        <polyline class="cart__top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" stroke-dasharray="338 338" stroke-dashoffset="-338" />
                        <g class="cart__wheel1" transform="rotate(-90,43,111)">
                            <circle class="cart__wheel-stroke" cx="43" cy="111" r="13" stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68" />
                        </g>
                        <g class="cart__wheel2" transform="rotate(90,102,111)">
                            <circle class="cart__wheel-stroke" cx="102" cy="111" r="13" stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68" />
                        </g>
                    </g>
                </g>
            </svg>
            <div class="preloader__text">
                <p class="preloader__msg">Bringing you the goods…</p>
            </div>
        </div>
    </div>

    <!-- delay orders -->   
<script>
    function showdiv(){
      document.getElementById("divshow").style.visibility = "visible";
      document.getElementById("divhide").style.visibility = "hidden";
    
     }
     setTimeout("showdiv()",3200);
    </script>

    <script>
        
        //restore orders

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