<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders Information</title>
</head>
<body>
    @extends('extends')
    @section('content')
    
    <div class="alert alert-success" id="success_msg" style="display: none;">Add your favourite .</div>
    <div class="alert alert-danger" id="error_msg" style="display: none;">Alredy Aded Favourite .</div>
    <div class="alert alert-success" id="success_msg" style="display: none;">Delete Sucessfuly .</div>

   <h1>SHOW Orders</h1>
   <br>
   <button  orders_id = {{$orders->id}} name="favourite" class="AddFav btn btn-lg" ><i class="fa fa-heart" id ="fav{{$orders->id}}" style="color: gold;" ></i></button> 

    @isset($interesteds)
    @foreach ($interesteds as $interested)
    @if(($interested->user_id==$userid)&($interested->order_id==$orders->id))
    <div style="margin-top: -48px">
    <button orders_id = {{$orders->id}}  name="favourite" class="AddFav btn btn-lg" ><i class="fa fa-heart" style="color: red;" ></i></button> 
    </div>
    @endif
    @endforeach
    @else
     
    @endisset 


<br>
  <span><h1 style="color: blue">Name : </h1>  <h2 style="color: coral">        {{$orders->name}} </h2>  </span>
  <span><h1 style="color: blue">User : </h1>  <h2 style="color: coral">       @isset($orders->user->name) {{$orders->user->name}} @else{{'null user name'}}@endisset</h2>  </span>
  <span><h1 style="color: blue">Department : </h1>  <h2 style="color: coral"> @isset($orders->department->name) {{$orders->department->name}} @else{{'null department name'}}@endisset</h2>  </span>
  <span><h1 style="color: blue">gmail : </h1>  <h2 style="color: coral">       {{$orders->gmail}} </h2>  </span>
  <span><h1 style="color: blue">phone : </h1>  <h2 style="color: coral">       {{$orders->phone}} </h2>  </span>
  <span><h1 style="color: blue">description : </h1>  <h2 style="color: coral"> {{$orders->description}} </h2>  </span>
  <span><h1 style="color: blue">price : </h1>  <h2 style="color: coral">       {{$orders->price}} </h2>  </span>
  <span><h1 style="color: blue">path : </h1>  <h2 style="color: coral">        {{$orders->path}} </h2>  </span>

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
  
  <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
  <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
  <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
  <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>



    <br>
    @endsection
</body>
</html>