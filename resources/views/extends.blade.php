<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/extends.css')}}">
    <link rel="stylesheet" href="{{asset('css/slide.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">


    <title>Document</title>
</head>
<body>

    
  <div class="container">
    @yield('content')
  </div>

  @if(auth()->user()->role == 1)
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">Srnz Project</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
          <i class='bx bx-search' ></i>
         <input type="text" id="search" name="search"  placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      <li>
        <a href="{{route('homepage')}}">
          <i class='bx bx-home'></i>
          <span class="links_name">HOMEPAGE</span>
        </a>
         <span class="tooltip">homepage</span>
      </li>
      <li>
       <a href="{{route('users.index')}}">
         <i class='bx bx-user' ></i>
         <span class="links_name">User</span>
       </a>
       <span class="tooltip">User</span>
     </li>
     <li>
      <a href="{{route('users.admin')}}">
        <i class='bx bx-user' ></i>
        <span class="links_name">Admin</span>
      </a>
      <span class="tooltip">Admin</span>
    </li>
     <li>
      <a href="{{route('orders.index')}}">
        <i class='bx bx-cart-alt' ></i>
        <span class="links_name">Orders</span>
      </a>
      <span class="tooltip">Orders</span>
    </li>
     
     <li>
       <a href="{{route('departments.index')}}">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Departments</span>
       </a>
       <span class="tooltip">Departments</span>
     </li>
     <li>
       <a href="{{route('orders.restore.index')}}">
         <i class='bx bx-folder' ></i>
         <span class="links_name">File Orders</span>
       </a>
       <span class="tooltip">Orders Restore</span>
     </li>
     <li>
      <a href="{{route('departments.restore.index')}}">
        <i class='bx bx-folder' ></i>
        <span class="links_name">File Departments</span>
      </a>
      <span class="tooltip">Departments Restore</span>
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
           <img src="{{asset('image/users/'.$SeAdmin->profile_photo)}}" alt="profileImg">
           <div class="name_job">
             <div class="name">{{$SeAdmin->name}}</div>
             <div class="job">{{$SeAdmin->phone}}</div>
           </div>
         </div>
        
         <a href="{{route('logout')}}" name="logout" id="log_out"> <i class='bx bx-log-out'id="log_out" ></i></a>
         <span class="tooltip_logout">log_out</span>
  
     </li>
    </ul>
  </div>
  @else
    <div class="sidebar">
      <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
      <div class="logo_name">Srnz_Project</div>
      <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
    <li>
      <i class='bx bx-search' ></i>
    <input type="text" id="search" placeholder="Search...">
    <span class="tooltip">Search</span>
    </li>
    <li>
      <a href="{{route('homepage')}}">
        <i class='bx bx-home'></i>
        <span class="links_name">HOMEPAGE</span>
      </a>
      <span class="tooltip">homepage</span>
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
    <li>
      <a href="{{route('ordersite.index')}}">
      <i class='bx bx-cart-alt' ></i>
      <span class="links_name">Order</span>
      </a>
      <span class="tooltip">Order</span>
      </li>
    <li>
    <a href="{{route('orders.restore.site.index')}}">
    <i class='bx bx-folder' ></i>
    <span class="links_name">File Orders</span>
    </a>
    <span class="tooltip">Orders Restore</span>
    </li>
    
    <li>
    <a href="{{route('interesteds.index')}}">
    <i class='bx bx-heart' ></i>
    <span class="links_name">Saved</span>
    </a>
    <span class="tooltip">Saved</span>
    </li>
    <li>
    <a href="#delete_account#"id="delete_account">
      <i class='bx bx-trash' ></i>
      <span class="links_name">Delete_Account</span>
      </a>
      <span class="tooltip">Delete_Account</span>
      </li>
    <li>
    <a href="#" >
    <i class='bx bx-cog' ></i>
    <span class="links_name">Setting</span>
    </a>
    <span class="tooltip">Setting</span>
    </li>
    <li class="profile">
    <div class="profile-details">
      <img {{asset('image/users/'.$SeCustomer->profile_photo)}} alt="profileImg">
      <div class="name_job">
        <div class="name">{{$SeCustomer->name}}</div>
        <div class="job">{{$SeCustomer->phone}}</div>
      </div>
    </div>
    
    <a href="{{route('logout')}}" name="logout" > <i class='bx bx-log-out' id="log_out" ></i></a>
    <span class="tooltip_logout">log_out</span>
    
    </li>
    </ul>
    </div>
  @endif


  <script>
    let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");
  
  closeBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("open");
  menuBtnChange();//calling the function(optional)
  });
  
  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
  });
  
  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
  if(sidebar.classList.contains("open")){
  closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
  }else {
  closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
  }
  }
  
  </script>
  
  </body>
  </html><!---->