<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/department_create.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

    <title>ADD Departments </title>
</head>
<body style="background-color: rgb(27, 26, 26)">
   
    @extends('extends')
    @section('content')
    <div class="alert alert-success" id="success_msg" style="display: none;">
        Create Sucessfuly .
     </div>
     <div class="alert alert-danger" id="name_error_msg" style="display: none;">
        Name Oreday Exist .
     </div>
     <div class="alert alert-danger" id="code_error_msg" style="display: none;">
        Code Oreday Exist .
     </div>
    <h1 id="h1">CREATE DEPARTMENTS</h1>
    <div id='error' class="alert alert-danger error-text code_error" style="display: none">
        
    </div>


    <div class="login">
        <div class="login__content">
            
          
            <div class="login__img">
               
                <img src="{{URL('image\all\img-login.svg')}}" alt="background_departments">
                
            </div>

            <div class="login__forms">
                <form  class="login__registre" id = 'departmentsForm' action="{{route('departments.store')}}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <h1 class="login__title">Create Departments</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" placeholder="Department_Name" class="login__input" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="text" placeholder="DEpartment_Code" class="login__input" name="code" value="{{ old('code') }}">
                    </div>

                   
                        <input  type="file" id="file" name="img" value="{{ old('img') }}" />
                        <label for="file" class="btn-2"><img id="upload" src="{{URL('image\all\upload_black.png')}}" alt="upload"></label>

                    <a href="#"  id="save" class="login__button">Create</a>
   
                </form>
             
            </div>
        </div>
    </div>


    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>




<script>

    $(document).on('click', '#save', function (e) {
        e.preventDefault();

        var formData = new FormData($('#departmentsForm')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('departments.store')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {

                if (data.status == true) {
                    $('#error').hide();
                    $('#name_error_msg').hide();
                    $('#code_error_msg').hide();
                    $('#success_msg').show();
                }
                if (data.type == 'code') {
                    $('#error').hide();
                    $('#name_error_msg').hide();
                    $('#code_error_msg').show();
                }
                if (data.type == 'name') {
                    $('#error').hide();
                    $('#code_error_msg').hide();
                    $('#name_error_msg').show();
                }

            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
               
                $.each(response.errors, function (key, val) {
                    $("#error").text(val[0]).show();
                });}
               
        });
    });


</script>

    @endsection
</body>
</html>