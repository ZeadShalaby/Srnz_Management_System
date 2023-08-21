<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/department_create.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/hideshow.css')}}">
    <title>Edit Departments</title>
</head>
<body style="background-color: rgb(27, 26, 26);">
    @extends('extends')
    @section('content')
    <h1 id="h1">EDIT DEPARTMENTS</h1>
    <br>
    <div id="divshow" style="visibility: hidden;">

    <div class="login" style="margin-top:-80px">
        <div class="login__content">
            <div class="login__img">
                <img src="{{URL('image\all\img-login.svg')}}" alt="background_departments">
                
            </div>

            <div class="login__forms">
    <form action="{{route('departments.update',$departments->id,$departments->img)}}"  class="login__registre" enctype="multipart/form-data" method="post">
        @csrf
        @method('put')
        <h1 class="login__title">Edit Departments</h1>

        <div class="login__box">
            <i class='bx bx-user login__icon'></i>
            <input class="login__input" type="text" placeholder="Name" name="name" value="{{$departments ->name }}">
            @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="login__box">
            <i class='bx bx-lock-alt login__icon'></i>
            <input class="login__input" type="text" placeholder="code" name="code" value="{{$departments ->code}}">
            @error('code')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
       
            <button style="width: 100%" class="login__button" type="submit">EDiT</button>
        
    </form>


                
            </div>
        </div>
    </div>
    </div>
    <!--- hide show ---->
<div id="divhide" class="createhide" style="visibility: visible;align-items: center">
    <div class="card">
      <div class="header">
        <div class="img"></div>
        <div class="details">
          <span class="name"></span>
          <span class="about"></span>
        </div>
      </div>
      <div class="description">
        <div class="line line-1"></div>
        <div class="line line-2"></div>
        <div class="line line-3"></div>
      </div>
      <div class="btns">
        <div class="btn btn-1"></div>
        <div class="btn btn-2"></div>
      </div>
    </div>
  </div>

 <!-- Delay Departments Edit -->   
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