<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/user_create.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/load-user.css')}}">

    <title>Edit CUSTOMER</title>
</head>
<body>
    @extends('extends')
    @section('content')
    <br>

    <div id="divshow" style="visibility: hidden;">

    <div class="square">

        <i style="--clr:#fffd44;"></i>
        
        <i style="--clr:#ff0057;"></i>
        
        <i style="--clr:#f20de6; "></i>
        
        <div class="login">
        <form class="login" action="{{route('users.update',$users->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @if($users->role=='1')
            <h2>EDIT ADMIN</h2>
            @else
            <h2>EDIT CUSTOMER</h2>
            @endif
        
        <div class="inputBx" id="username">
            <label >UserName</label>
            <input  type="text" placeholder="UserName" name="name" value="{{ $users->name }}">
            @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror 
                
        </div>
      
        <div class="inputBx" id="email"> 
            <label>Email</label>  
            <input  type="text" placeholder="Enter Email" name="email" value="{{ $users->email }}">
            @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
      
        <div class="inputBx" id="password"> 
            <label>Password</label>  
            <input  type="password" placeholder="Password" name="password" value="{{ $users->password }}">
            @error('password')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror        
        </div>
        
        <div class="inputBx" id="gmail"> 
            <label>Gmail</label>  
            <input  type="text" placeholder="Enter Gmail" name="gmail" value="{{ $users->gmail }}">
            @error('gmail')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror        
        </div>
       
        <div class="inputBx" id="phone" style="margin-left: -250px"> 
            <label>Phone</label>  
            <input  type="text" placeholder="Phone" name="phone" value="{{ $users->phone }}">
            @error('phone')
            <div class="alert alert-danger">
                {{ $message }}
            </div> 
            @enderror     
        </div>
    
        <div class="inputBx">
      <button  type="submit" id="create_Admin"> 
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Save</button>
        </div>

        <div>
           @if($users->role ==1)
          <h2> {{"Admin"}} </h2>
           @else
          <h2> {{"Customer"}}</h2>
           @endif
           </span>
        </div>
        
        </form>
        </div> 
    </div>
    <div class="bg-div">
        <img src="{{URL('image\all\logo_srnz.png')}}" alt="img" />
    </div>

</div>

    <div id="divhide" class="divhide" style="visibility: visible;">

        <div class="spinner" style="margin-top: -100px">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
          </div>
        
        </div>
    
    <!-- delay Departments -->   
    <script>
        function showdiv(){
          document.getElementById("divshow").style.visibility = "visible";
          document.getElementById("divhide").style.visibility = "hidden";
    
         }
         setTimeout("showdiv()",3200);
      </script>
    

    @endsection

</body>
</html>