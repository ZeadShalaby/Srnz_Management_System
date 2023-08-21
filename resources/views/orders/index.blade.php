<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link href="{{asset('css/orders-img.css')}}" rel="stylesheet">
    <link href="{{asset('css/card-orders.css')}}" rel="stylesheet">
    <link href="{{asset('css/loadorders.css')}}" rel="stylesheet">

    <title>Orders</title>
</head>
<body>
    <div id="divshow" style="visibility: hidden;">

    @extends('extends')
    @section('content')
    
    @if (session('error'))
    @extends('layout.message-warning')
    @section('messages_Warning')
    @endsection
    
    @endif
    
    @extends('layout.message-danger')
    @section('message_danger')

    @endsection

    <h1>Orders</h1>
 
        <div class="departments">
        @foreach ($Departments as $department)
        <a href="{{route('registration.show',$department->id)}}" class="inside-page__btn inside-page__btn--beach">
            
                <img src="{{asset('image/departments/'.$department->img)}}" alt="{{$department->name}}" class="hoverZoomLink" id="img" >
              
        </a>
               
        
        <span style="color: red">-</span>
        @endforeach
    </div>

    <div class="AllData">
    @foreach ($orders as $order)
    <div class="OrderRow{{$order->id}}">

        <div class="container">
            <div class="box">
               <span style="color: aquamarine" >{{$order->user->name}}</span>
<br><br>
           <a href="{{route('orders.show',$order->id)}}" style="text-decoration: none">
                <article class="card">
                    <img
                    class="card__background"
                    src="{{asset('image/orders/try.png')}}"
                    alt="{{$order->name}}"
                    width="1920"
                    height="2193"
                    />
                    <div class="card__content | flow">
                    <div class="card__content--container | flow">
                        <h2 class="card__title">{{$order->name}}</h2>
                        <p class="card__description">
                            {{$order->description}}
                        </p>
                        <p >COST :{{$order->price}}</p>
                        <span style="display: none">{{$start=1}}</span>
                        @while ($start<=5)
                              @if($order->id<$start)
                              <span class="fa fa-star" style="color: rgb(242, 255, 0)"></span>
                              @else
                             <span class="fa fa-star" style="color: rgb(188, 188, 187)"></span>
                             @endif
                             <span style="display: none">{{$start++}}</span>
                        @endwhile
                    </div>
                        
                    </div>
                    
                </article>
           </a>
                <div class="under_img">
                    @isset($order->view)
                     <img src="{{url('image\all\view.png')}}" alt="vieweer" style="width: 30px"> {{''}}{{$order->view}}
                    @else
                    <img src="{{url('image\all\nview.png')}}" alt="vieweer" style="width: 30px">
                    @endisset
                  
                <!-- Delete Orders -->    
                <div style="margin-top: -2px">
                <button order_id={{$order->id}} id='delete' class="delete_btn"  style="margin-left: 150px;"><i class="fa fa-trash"></i></button>        
                    </div>
                <br><br>
                </div>
            </div>
          </div>
         
    </div>
    @endforeach
</div>

</div>

<div id="divhide" class="divhide" style="visibility: visible;">
    <div class="loader">
        <div class="inner one"></div>
        <div class="inner two"></div>
        <div class="inner three"></div>
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

<!-- return search -->
<div id="conte" class="searchdata">
</div>
<div style="margin-left: 1000px;">
    {{$orders->links()}}
</div>
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