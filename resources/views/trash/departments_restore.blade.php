<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restore Departments</title>
</head>
<body>
    @extends('extends')
    @section('content')
    <div class="alert alert-success" id="success_msg" style="display: none;">
       Department Restore Sucessfuly .
    </div>

    <h1>Restore Departments</h1>
    <br><br>

    @foreach ($departments as $department)
    <div class="DepartmentRow{{$department->id}}">
        {{$department->id}}-{{$department->name}}-{{$department->code}}
<br>
{{$department->img}}
 <br><br>
 <div style="margin-top: -30px">
    

        <button  department_id={{$department->id}} class="restore_btn btn btn-danger" style="margin-left: 900px;margin-top: -65px;">restore</button>
</div>
    </div>
    @endforeach
    <br>
    {{ $departments->links() }}

    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>

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