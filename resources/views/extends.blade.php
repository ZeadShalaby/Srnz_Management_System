<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">

    </script>


    
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="{{asset('css/extends.css')}}">
    <link rel="stylesheet" href="{{asset('css/slide.css')}}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    
    <div class="container">
        @yield('content')
    </div>
    @extends('layout.slide')
    @section('slide_script')
    <div class="sidebar">
        <div class="logo-details">
          <i class='bx bxl-c-plus-plus icon'></i>
            <div class="logo_name">CodingLab</div>
            <i class='bx bx-menu' id="btn" ></i>
        </div>
        <ul class="nav-list">
          <li>
              <i class='bx bx-search' ></i>
             <input type="text" placeholder="Search...">
             <span class="tooltip">Search</span>
          </li>
          <li>
            <a href="#">
              <i class='bx bx-grid-alt'></i>
              <span class="links_name">Dashboard</span>
            </a>
             <span class="tooltip">Dashboard</span>
          </li>
          <li>
           <a href="#">
             <i class='bx bx-user' ></i>
             <span class="links_name">User</span>
           </a>
           <span class="tooltip">User</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-chat' ></i>
             <span class="links_name">Messages</span>
           </a>
           <span class="tooltip">Messages</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-pie-chart-alt-2' ></i>
             <span class="links_name">Analytics</span>
           </a>
           <span class="tooltip">Analytics</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-folder' ></i>
             <span class="links_name">File Manager</span>
           </a>
           <span class="tooltip">Files</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-cart-alt' ></i>
             <span class="links_name">Order</span>
           </a>
           <span class="tooltip">Order</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-heart' ></i>
             <span class="links_name">Saved</span>
           </a>
           <span class="tooltip">Saved</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-cog' ></i>
             <span class="links_name">Setting</span>
           </a>
           <span class="tooltip">Setting</span>
         </li>
         <li class="profile">
             <div class="profile-details">
               <img src="profile.jpg" alt="profileImg">
               <div class="name_job">
                 <div class="name">Prem Shahi</div>
                 <div class="job">Web designer</div>
               </div>
             </div>
            
            <button name="logout"><i class='bx bx-log-out' id="log_out" ></i></button>
          <span class="tooltip_logout">log_out</span>
    
         </li>
        </ul>
      </div>
@endsection
</body>
</html><!---->