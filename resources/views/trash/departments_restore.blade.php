<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/restore.css')}}">
    <title>Restore Departments</title>
</head>
<body id="body">
    @extends('extends')
    @section('content')
    <div class="alert alert-success" id="success_msg" style="display: none;">
       Department Restore Sucessfuly .
    </div>

    <h1 id="h1">Restore Departments</h1>
    <br><br>

    @foreach ($departments as $department)
    <div class="container">
        <div class="box">     
    <div class="DepartmentRow{{$department->id}}">
        <a href="#restore" id="href"  department_id={{$department->id}} class="restore_btn " ><img class="restore"src="{{URL('image/all/restore.png')}}" alt="folder"></a>
        <img class="img" src="{{URL('image/all/folders.png')}}" alt="folder">
        <p style="text-align: center;font-size: 15px;color: blue">
            {{$department->name}}-{{$department->code}}
        </p>
        <img class="photo" src="image/departments/{{$department->img}}" alt="folder">

    </div>
</div>
    </div>
    @endforeach
    <br>
    {{ $departments->links() }}
<div style="margin-top: 500px">
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
</div>
    <br>

    <script>

        $(document).on('click', '.restore_btn', function (e) {
            e.preventDefault();
        
              var department_id =  $(this).attr('department_id');
             
            $.ajax({
                type: 'get',
                 url: "{{route('departments.restore')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :department_id
                },
                success: function (data) {
        
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.DepartmentRow'+data.id).remove();
                }, error: function (reject) {
        
                }
            });
        }); 
        </script>

    @endsection
</body>
</html>