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
    <div class="alert alert-success" id="success_msg" style="display: none;">
        Delete Sucessfuly .
     </div>
    <h1>Departments
        <a href="{{route('departments.create')}}"> <img width="50px" height="50px" src="{{URL('image/all/add1.png')}}"  alt="add" ></i>
        </a>
    </h1>
    <div class="container mt-5">
        <div classs="form-group">
            
                <button type="submit" name="search"> <i class='bx bx-search' ></i></button>
                <input type="text" id="search_dep" name="search" placeholder="Search" class="form-control" />
                
        </div>
    </div>
    
   
    <br><br>
<div class="AllData">
    @foreach ($departments as $department)
    <div class="DepartmentRow{{$department->id}}">
    <a href="{{route('departments.show',$department->id)}}" class="inside-page__btn inside-page__btn--beach">
        {{$department->id}}-{{$department->name}}-{{$department->code}}
<br>
{{$department->img}}
    </a>
 <br><br>
 <div style="margin-top: -30px">
    <a href="{{route('departments.edit', $department->id)}}" class="btn btn-info"
        
       style="margin-left: 800px;margin-top: -20px;"> EDIT </a>


    
        <button department_id={{$department->id}} class="delete_btn btn btn-danger" style="margin-left: 900px;margin-top: -65px;">DELETE</button>
</div>
    </div>
    @endforeach
</div>
    <br>

<!-- return search -->
<div id="conte" class="searchdata">
</div>

    {{ $departments->links() }}

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>


    <br>
 
 <!-- Delete Departments -->   
    <script>

        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
        
              var department_id =  $(this).attr('department_id');
             
            $.ajax({
                type: 'DELETE',
                 url: "{{route('departments.destroy',10)}}",
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
    
<!-- Auto Complite Search -->
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search-departments') }}";
        $('#search_dep').typeahead({
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


    $('body').on('keyup','#search_dep',function(){
      //  alert('hello');
        var search_dep = $(this).val();

        if(search_dep)
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
                 url: "{{route('departments.search')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'info' :search_dep
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