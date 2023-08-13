<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link href="{{asset('css/orders-img.css')}}" rel="stylesheet">
    <link href="{{asset('css/card-orders.css')}}" rel="stylesheet">

    <title>Orders</title>
</head>
<body>
 
    @extends('extends')
    @section('content')
    <div class="alert alert-success" id="success_msg" style="display: none;">Add your favourite .</div>
    <div class="alert alert-danger" id="error_msg" style="display: none;">Alredy Aded Favourite .</div>
    <div class="alert alert-success" id="delete_msg" style="display: none;">Delete Sucessfuly .</div>

    <h1>Orders <a href="{{route('ordersite.create')}}"> <img width="50px" height="50px" src="{{URL('image/all/addgallery.png')}}"  alt="add" ></i>
    </a></h1>
   
    <br>
    <div class="departments">
        @foreach ($Departments as $department)
        <a href="{{route('registration.show',$department->id)}}" class="inside-page__btn inside-page__btn--beach">
            
                <img src="{{asset('image/departments/'.$department->img)}}" alt="{{$department->name}}" class="hoverZoomLink" id="img" >
              
        </a>
               
        
        <span style="color: red">-</span>
        @endforeach
    </div>
    <br><br>
    <div class="AllData">  
        @foreach ($orders as $order)
        <div class="OrderRow{{$order->id}}">
            <div class="container">
                <div class="box">
   <a href="{{route('ordersite.show',$order->id)}}" style="text-decoration: none">
    
           <span style="color: aquamarine" >{{$order->user->name}}</span>
<br><br>
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
                        <p>COST :{{$order->price}}</p>

                    </div>
                        
                    </div>
                </article>
     
</a>

@isset($sefav)
    
    @else
        
        <div>
        @isset($order->view)
        <img src="{{url('image\all\view.png')}}" alt="vieweer" style="width: 30px"> {{''}}{{$order->view}}
        @else
        <img src="{{url('image\all\nview.png')}}" alt="vieweer" style="width: 30px">
        @endisset
        </div>    
        <div class="under_img">

<div style="margin-left: 200px;margin-top: -35px">
        <button  orders_id = {{$order->id}} name="favourite" class="AddFav btn btn-lg" ><i class="fa fa-heart" id ="fav{{$order->id}}" style="color: gold;" ></i></button> 
        @isset($interesteds)
        @foreach ($interesteds as $interested)
        @if(($interested->user_id==$userid)&($interested->order_id==$order->id))
       <div style="margin-top: -20px">
        <button orders_id = {{$order->id}}  name="favourite" class="AddFav btn btn-lg" ><i class="fa fa-heart" style="color: red;" ></i></button> 
       </div>
        @endif
        @endforeach
        

        @endisset 
</div>
        </div>
        @endif

        <br><br>
        @isset($orders_user)
        @foreach($orders_user as $oruser)
        @if($oruser->id==$order->id)
        <a href="{{route('ordersite.edit', $order->id)}}" class="btn btn-info"
        
            style="margin-left: 200px;margin-top: -150px;"> EDIT </a>
     
       
            <button order_id={{$order->id}} class="delete_btn btn btn-danger"  style="margin-top: -200px;margin-left: 400px;">DELETE</button>
      
        @else
        @endif
        @endforeach 
        @endisset 
       </div>
       </div>
</div>
    @endforeach
     </div>
     <div style="margin-left: 1000px">
        {{$orders->links()}}
    </div>
    
<!-- return search -->
<div id="conte" class="searchdata">
</div>

    <script>
 // AddFavourite with ajax

        $(document).on('click', '.AddFav', function (e) {
            e.preventDefault();
        
              var order_id =  $(this).attr('orders_id');
             
            $.ajax({
                type: 'post',
                 url: "{{route('ordersite.favourite')}}",
                data: {
                     '_token': "{{csrf_token()}}",
                     'id' :order_id
                },
                success: function (data) {
        
                    if(data.status == true){
                        $('#success_msg').show();
                        $('#error_msg').hide();
                        var id ='fav'+data.id;
                        const btn = document.getElementById(id);
                        btn.style.color = 'red';

                    }
                    else{
                        $('#error_msg').show();
                        $('#success_msg').hide();
                    }

                }, error: function (reject) {
        
                }
            });
        });
          
        </script>


    <script>
 // delete with ajax
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
        
              var order_id =  $(this).attr('order_id');
             
            $.ajax({
                type: 'DELETE',
                 url: "{{route('ordersite.destroy',10)}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :order_id
                },
                success: function (data) {
        
                    if(data.status == true){
                        $('#delete_msg').show();
                    }
                    $('.OrderRow'+data.id).remove();
                }, error: function (reject) {
        
                }
            });
        });
          
        </script>

        <script type="text/javascript">
        // auto complete search 
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