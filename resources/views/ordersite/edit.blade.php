<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="{{asset('css/order.css')}}">
    <title>Edit Orders</title>
</head>
<body>

    <div class="bold"></div>

    <div class="wrapper">

    <form action="{{route('ordersite.update',$orders->id,$orders->path)}}" id="ordersForm" method="post" enctype="multipart/form-data" >
        @csrf
        @method('put')
     <h2 style="color: aliceblue">Edit Orders</h2>

        <div class="upload-btn-wrapper">

            <button class="btn-upload"><img class="img-upload" src="{{asset('image/orders/'.$orders->path)}}" alt="upload"></button>

            <input type="file" name="path" />
            
          </div>      
        <div class="input-box">
         <span class="icon">
            <ion-icon name="mail"></ion-icon>  
         </span>
            <label lang="email" id="label">Name_Orders</label>
            <input  type="text" placeholder="Name" name="name" value="{{ $orders->name }}">
           
        </div>


        <div class= "container">
            <div class="select">
            <select  name="department_id">
                <option value=" {{$orders->department_id}} ">{{$orders->department->name}}</option>
                @foreach ($departments as $department)
                    <option value=" {{$department ->id}} ">{{$department ->name}}</option>
                @endforeach
            </select>
           
        </div> 
        </div>
        <br><br>
        <div class="input-box">
            <span class="icon">
               <ion-icon name="lock-closed"></ion-icon>
            </span>
               <label for="password" id="label">description</label>
               <input  type="text" placeholder="code" name="description" value="{{ $orders->description }}">
               
           </div>

           <div class="input-box">
            <span class="icon">
               <ion-icon name="lock-closed"></ion-icon>
            </span>
               <label for="password" id="label">Price</label>
               <input  type="text" placeholder="code" name="price" value="{{ $orders->price }}">
            </div> 
           

          
         

           <button class="create" type="submit" id="save" >Save</button>

</form>
    </div>

    <div style="margin-top: 650px">

        <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
        <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
        <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
        <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    
    </div>





    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
     </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
     </div>

@endif
@if(session('important'))
    <div class="alert alert-danger">
        {{session('important')}}
     </div>

@endif
    


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif







</body>
</html>