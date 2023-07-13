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
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <h1>Users
    <a href="{{route('users.create')}}"> <img width="50px" height="50px" src="{{URL('image/add1.png')}}"  alt="add" > Create New Admin</i>
    </a>
    </h1>
    <br>
    <div class="container mt-5">
        <div classs="form-group">
            <form action="{{route('users.search')}}" method="POST">
                @csrf
                <button type="submit" name="search"> <i class='bx bx-search' ></i></button>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" />
                </form>
        </div>
    </div>
    
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search-users') }}";
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
    <br><br>

    @foreach ($users as $user)
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
    
    
        <form action="{{route('users.destroy',$user->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" style="margin-left: 900px;margin-top: -65px;">DELETE</button>
        </form>
    </div>
        <br><br>
    @endforeach
    <br>
    {{ $users->links() }}

    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('users.admin')}}" class="btn btn-info" type="submit">Admins</a>


    @endsection
</body>
</html>