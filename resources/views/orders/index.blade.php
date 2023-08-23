<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link href="{{asset('css/card-orders.css')}}" rel="stylesheet">
    <link href="{{asset('css/loadorders.css')}}" rel="stylesheet">
    <link href="{{asset('css/orders-img.css')}}" rel="stylesheet">
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
            
            <div class="containeres" style="margin-top: 200px">
                <div class="boxs">
                <div class="icon-image">
                  <div class="icon">
                    <img src="{{asset('image/all/img1.jpg')}}" alt="" />
                </div>
                  <div class="hover-image one">
                    <div class="img">
                        @if(!isset($department->img))
                        <img src="{{asset('image/all/img1.jpg')}}" alt="" />
                        @else
                        <img src="{{asset('image/departments/'.$department->img)}}" alt="" />
                        @endif
                    </div>
                    <div class="content">
                      <div class="details">
                        <div class="name">{{$department->name}}</div>
                        <div class="job">{{$department->code}}</div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            </div>              
        </a>
               
   @endforeach
    </div>
    <br><br><br> 

    <div class="AllData">
    @foreach ($orders as $order)
    <div class="OrderRow{{$order->id}}">

        <div class="container">
            <div class="box">
                <a href="{{route('orders.show',$order->id)}}" style="text-decoration: none">

                <div class="icon-images" style="margin-top: -30px">

                    <div class="icons" >
                        <img src="{{asset('image/all/img1.jpg')}}" alt="users" />                
                        <div  class="spann" style="color: aquamarine;margin-left:90px;" >{{$order->user->name}}</div>
                    </div>
                    </div>
                    
                    <br>
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
                        <p >COST :{{$order->price}} <span style="color: rgb(59, 212, 105)">$</span></p>
                        <span style="display: none">{{$start=1}}</span>
                        <span style="display: none">{{$orderid=$order->id}}</span>

                        @while ($start<=5)
                        @if($orderid>5)
                        <span style="display: none"> {{ $orderid %=5 }}</span>
                        @endif
                         
                         
                              @if($orderid<$start)
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
        <div class="under_imgs">
            @isset($order->view)
            <img src="{{url('image\all\view.png')}}" alt="vieweer" style="width: 30px"> {{''}}{{$order->view}}
        @else
        <img src="{{url('image\all\nview.png')}}" alt="vieweer" style="width: 30px">
        @endisset
        
    <!-- Delete Orders -->    
    <div style="margin-top: -18px">
    <button order_id={{$order->id}} id='delete' class="delete_btn"  style="margin-left: 150px;"><i class="fa fa-trash"></i></button>        
        </div>
    <br><br>
            </div>
        </div>
    </div>
         
    </div>
    @endforeach
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
