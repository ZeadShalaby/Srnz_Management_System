<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Departments</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <h1>Departments
        <a href="{{route('departments.create')}}"> <img width="50px" height="50px" src="{{URL('image/add1.png')}}"  alt="add" ></i>
        </a>
    </h1>
    <div class="container mt-5">
        <div classs="form-group">
            <form action="{{route('departments.search')}}" method="POST">
                @csrf
                <button type="submit" name="search"> <i class='bx bx-search' ></i></button>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" />
                </form>
        </div>
    </div>
    
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search-departments') }}";
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

    @foreach ($departments as $department)
    <a href="{{route('departments.show',$department->id)}}" class="inside-page__btn inside-page__btn--beach">
        {{$department->id}}-{{$department->name}}-{{$department->code}}
<br>
{{$department->img}}
    </a>
 <br><br>
 <div style="margin-top: -30px">
    <a href="{{route('departments.edit', $department->id)}}" class="btn btn-info"
        
       style="margin-left: 800px;margin-top: -20px;"> EDIT </a>


    <form action="{{route('departments.destroy',$department->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" style="margin-left: 900px;margin-top: -65px;">DELETE</button>
    </form>
</div>

    @endforeach
    <br>
    {{ $departments->links() }}

    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">restore</a>

    <br>
    @endsection
</body>
</html>