<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/departments.show.css')}}" rel="stylesheet">
    <title>Departments Information</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
   <h1>SHOW DEPARTMENTS</h1>
   <br>
 

    
    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>  
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>


    <br>
   


    <aside class="profile-card">
        <header>
          <!-- here’s the avatar -->
          <a target="_blank" href="#">
            <img src="{{asset('image/departments/'.$departments->img)}}" alt="departments" class="hoverZoomLink" >
          </a>
      
          <!-- the username -->
          <h1>
          Departments Name
        </h1>
      
          <!-- and role or location -->
          <h2>
            {{$departments->name}}   
                     </h2>
      
        </header>
      
        <!-- bit of a bio; who are you? -->
        <div class="profile-bio">
      
            <h1>
                Departments Code
              </h1>
           
              <h2>
                {{$departments->code}}   
                         </h2>
      
        </div>
      
        
      </aside>

    @endsection
</body>
</html>