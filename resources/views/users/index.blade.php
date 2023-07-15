<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    @extends('extends')
    @section('content')
<div class="alert alert-success" id="success_msg" style="display: none;">
    Delete Sucessfuly .
</div>

    <h1>Users
    <a href="{{route('users.create')}}"> <img width="50px" height="50px" src="{{URL('image/add1.png')}}"  alt="add" > Create New Admin</i>
    </a>
    </h1>
    <br>
    <div class="container mt-5">
        <div classs="form-group">
            
            <button id="searchs" class=" btn btn-danger" name="searchs"> <i class='bx bx-search' ></i></button>
            <input type="text" id="search_user" name="search" placeholder="Search" class="form-control" />

        </div>
    </div>

    <br><br>
    <div class="AllData">

    @foreach ($users as $user)
    <div class="UserRow{{$user->id}}">
    <a href="{{route('users.show',$user->id)}}" class="inside-page__btn inside-page__btn--beach">
        
        {{$user->id}}-{{$user->name}}-
        @if($user->role > $roles) 
        <span class="spans">  
        {{"Customer"}} </span>
        @else
        {{"Admin"}}   
        @endif
        <br>
        {{$user->profile_photo}}
        

    </a>
        
    <div style="margin-top: -30px">
        <a href="{{route('users.edit', $user->id)}}" class="btn btn-info"
            
           style="margin-left: 800px;margin-top: -20px;"> EDIT </a>
    
    
            <button user_id={{$user->id}} class="delete_btn btn btn-danger" style="margin-left: 900px;margin-top: -65px;">DELETE</button>
       
    </div>
</div>
    <br><br>
    @endforeach
    </div>

    <br>

<!-- return search -->
<div id="conte" class="searchdata">
 </div> 
 
    {{ $users->links() }}

    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('users.admin')}}" class="btn btn-info" type="submit">Admins</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>

 <!-- Delete MyOrder -->   

    <script>

        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
        
              var user_id =  $(this).attr('user_id');
             
            $.ajax({
                type: 'DELETE',
                 url: "{{route('users.destroy',10)}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :user_id
                },
                success: function (data) {
        
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.UserRow'+data.id).remove();
                }, error: function (reject) {
        
                }
            });
        });
          
        </script>

<!-- Auto Complete Search -->

        <script type="text/javascript">
            var route = "{{ url('autocomplete-search-users') }}";
            $('#search_user').typeahead({
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
    $('body').on('keyup','#search_user',function(){
      //  alert('hello');
        var search_user = $(this).val();

        if(search_user)
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
                 url: "{{route('users.search')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'info' :search_user
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