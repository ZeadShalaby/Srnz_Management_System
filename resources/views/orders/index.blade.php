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
        Delete Sucessfuly .
    </div>
    <h1>Orders</h1>
<br>
 <div class="container mt-5">
        <div classs="form-group">
            
            <button id="searchs" class=" btn btn-danger" name="searchs"> <i class='bx bx-search' ></i></button>
            <input type="text" id="search" name="search" placeholder="Search" class="form-control" />

        </div>
    </div>

    <br><br>

    <div class="AllData">
    @foreach ($orders as $order)
    <div class="OrderRow{{$order->id}}">
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
        {{$order->path}}

    </a>
    <div>
        <br>
    @isset($order->view)
     <img src="{{url('image\all\view.png')}}" alt="vieweer" style="width: 30px"> {{''}}{{$order->view}}
    @else
    <img src="{{url('image\all\nview.png')}}" alt="vieweer" style="width: 30px">
    @endisset</div>

  
<!-- Delete Orders -->    
<button order_id={{$order->id}} class="delete_btn btn btn-danger"  style="margin-left: 150px;margin-top: -50px">DELETE</button>
   
        
  
        <br><br>
    </div>
    @endforeach
</div>

<!-- return search -->
<div id="conte" class="searchdata">
</div>

    <br>
    {{ $orders->links() }}

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <br>

    <script>

        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
        
              var order_id =  $(this).attr('order_id');
             
            $.ajax({
                type: 'DELETE',
                 url: "{{route('orders.destroy',10)}}",
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

<!--- Auto Comblete Search --->
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


<!-- Search Data --> 

<script type="text/javascript">
    $('body').on('keyup','#search',function(){
      //  alert('hello');
        var SearchOrders = $(this).val();

        if(SearchOrders)
        {
           $('.AllData').hide();
           $('.searchdata').show();

        }
        else
        {
            $('.AllData').show();
            $('.searchdata').hide();
        }

        $.ajax({
                type: 'POST',
                 url: "{{route('orders.search')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'info' :SearchOrders
                },
                success: function (data) {
                      
                $('#conte').html(data);

                }, error: function (reject) {
        
                }
            });


           
    });
    </script>

@endsection
</body>
</html>