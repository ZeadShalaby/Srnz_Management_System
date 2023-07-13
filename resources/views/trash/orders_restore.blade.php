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
    
    @if (session('error'))
    <div class="alert alert-danger">
        
        {{session('error')}}
    </div>
    @endif

    <div class="alert alert-success" id="success_msg" style="display: none;">
        Orders Restore successfully .
    </div>

    <h1>Orders</h1>
<br>
    @foreach ($orders as $order)
    <div class="OrderRow{{$order->id}}">
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
    
        <button order_id={{$order->id}} class="restore_btn btn btn-danger" style="margin-left: 900px;margin-top: -65px;">restore</button>
        <br><br>
    </div>
    @endforeach
    <br>
    {{ $orders->links() }}

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>

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