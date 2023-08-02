<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
 <link rel="stylesheet" href="{{asset('css/register.css')}}">
    

    <title>Create CUSTOMER</title>
</head>
<body style=" background-image:url({{URL('image/all/background.png')}});">
    @extends('layout.regist')
    @section('register')
        
    <div class="alert alert-success" id="success_msg" style="display: none; color:blue">
        Create Sucessfuly .
     </div>
     
 
    <div class="container">
        <form  id="form" class="form">
            @csrf

            <h2>Register SRNZ</h2>
          <div class="form-control" id="Name">
            <label for="username">Username</label>
            <input id="username" class="form-control" type="text" placeholder="UserName" name="name" value="{{ old('name') }}">
            <small>Error message</small>
          </div>
          <div class="form-control" id="Email">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="text" placeholder="Enter/Email" name="email" value="{{ old('email') }}">
            <small>Error message</small>
          </div>
          <div class="form-control" id="Gmail">
            <label for="password2">Gmail</label>
            <input id="gmail" class="form-control" type="text" placeholder="Enter/Gmail" name="gmail" value="{{ old('gmail') }}">
            <small>Error message</small>
          </div>
          <div class="form-control" id="Phone">
            <label for="password2">Phone</label>
            <input id="phone" class="form-control" type="text" placeholder="Enter/Phone" name="phone" value="{{ old('phone') }}">
            <small>Error message</small>
          </div>
          <div class="form-control" id="Password">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" placeholder="Enter/Password" name="password" value="{{ old('password') }}">
            <small>Error message</small>
          </div>
          <button id="create" type="submit" class="nn btn btn-success" >Create</button>
        </form>
      </div>

     
      @endsection

      


     
    
</body>
</html>