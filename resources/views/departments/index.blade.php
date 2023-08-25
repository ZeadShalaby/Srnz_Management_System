<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <link rel="stylesheet" href="{{asset('css/card-dep.css')}}">
    <link rel="stylesheet" href="{{asset('css/hideshow.css')}}">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <title>Departments</title>
</head>
<body>
   

    @extends('extends')
    @section('content')
        
    @endsection
    

    @extends('layout.message-department')
    @section('messages_dep')
    @endsection
    
    <h1>Departments
        <a href="{{route('departments.create')}}"> <img width="50px" height="50px" src="{{URL('image/all/add1.png')}}"  alt="add" ></i>
        </a>
    </h1>

    
   
    <br><br>
<div id="divshow" style="visibility: hidden;">
<div class="AllData">
    @foreach ($departments as $department)
    <div class="DepartmentRow{{$department->id}}">
        <div class="container">
           <div class="box">
            <div class="item">
    
              <div class="item__image">
    
                <div class="image-switch__outer">
    
                  <div class="image-switch__inner">
                    @if(isset($department->img))
                    <img src="{{asset('image/departments/'.$department->img)}}" alt="departments">
                  @else
                  <img src="{{asset('image/all/course.svg')}}" alt="departments">
                  @endif
                </div>
                </div>
              </div>
              <div class="item__description">
                <div class="description-switch__outer">
                  <div class="description-switch__inner">
                 
                      <button department_id={{$department->id}} class="delete_btn btn btn-danger" ><i class="fa fa-trash" id="delete"></i></button>
                    <a href="{{route('departments.edit', $department->id)}}" class="edit_btn -info"> <i class="fa fa-edit" id="edit"></i> </a>
                    

                       <p>{{$department->name}}</p>
                      
                      <a href="{{route('departments.show',$department->id)}}" ><!--target="_blank"   open link in new page    -->  
                        <i class="fas fa-location-arrow" id="show"></i>
                      <div class="item__action-arrow">
                      </a>
    
                      </div>
                  </div>
                </div>
              </div>
              <div class="flap level0">
                
    
                <div class="flap level1 flip-right">
                    
                  <div class="flap level2 flip-down">
                    <div class="flap level3 flip-left"></div>
                    <div class="flap level3 flip-right">
                      <div class="flap level4 flip-up">
                        <div class="flap level5 flip-right">
                          <div class="flap level6 flip-left">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flap level2 flip-up">
                    <div class="flap level3 flip-left">
                      <div class="flap level4 flip-up"></div>
                      <div class="flap level5 flip-down">
                        <div class="flap level6 flip-left">
                          <div class="flap level7 flip-up">
                            <div class="flap level8 flip-left"></div>
                            <div class="flap level8 flip-right"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flap level1 flip-left">
                  <div class="flap level2 flip-up">
                    <div class="flap level3 flip-left">
                      <div class="flap level4 flip-down">
                        <div class="flap level5 flip-left">
                          <div class="flap level6 flip-right">
                            <div class="flap level7 flip-up">
                              <div class="flap level8--alt flip-right"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flap level2 flip-down">
                    <div class="flap level3 flip-right">
                      <div class="flap level4 flip-down">
                        <div class="flap level5 flip-up"></div>
                      </div>
                      <div class="flap level5 flip-up">                                
                        <div class="flap level6 flip-right"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item__hover-icon">
                <div class="icon-switch__outer">
                  <div class="icon-switch__inner">
                    @if($department->id % 2 == 0 )
                    <img src="{{asset('image/all/dep.png')}}" alt="departments">
                    @else             
                    <img src="{{asset('image/all/logo.png')}}" alt="departments">
                    @endif
                    <div class="code">
                    <span >{{$department->code}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       </div>
    </div>
    @endforeach
</div>
</div>
<!--- hide show ---->
<div id="divhide" class="divhide" style="visibility: visible;">
  <div class="card">
    <div class="header">
      <div class="img"></div>
      <div class="details">
        <span class="name"></span>
        <span class="about"></span>
      </div>
    </div>
    <div class="description">
      <div class="line line-1"></div>
      <div class="line line-2"></div>
      <div class="line line-3"></div>
    </div>
    <div class="btns">
      <div class="btn btn-1"></div>
      <div class="btn btn-2"></div>
    </div>
  </div>
</div>
    <br>
    {{$departments->links()}}

<!-- return search -->
<div id="conte" class="searchdata">
</div>
<div class="paginator" style="margin-left: 1200px; margin-top:-1000px">
    {{ $departments->links() }}
  </div>

 <!-- delay Departments -->   
  <script>
    function showconte(){
      document.getElementById("search").style.visibility = "hidden";

    }
    setTimeout("showdiv()",3200);

    function showdiv(){
      document.getElementById("divshow").style.visibility = "visible";
      document.getElementById("divhide").style.visibility = "hidden";

     }
     setTimeout("showdiv()",3200);
  </script>

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


<!-- Search Data --> 

<script type="text/javascript">


    $('body').on('keyup','#search',function(){
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

</body>
</html>