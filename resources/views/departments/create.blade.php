<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADD Departments </title>
</head>
<body>
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
    <h1>CREATE DEPARTMENTS</h1>
    <div id='error' class="alert alert-danger error-text code_error" style="display: none">
        
    </div>

    <form id = 'departmentsForm' action="{{route('departments.store')}}" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%;display:none">
        @csrf
        <div>
            <label style="color: aliceblue">Name</label>
            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">

        </div>

        <div>
            <label style="color: aliceblue">Code</label>
            <input class="form-control" type="text" placeholder="code" name="code" value="{{ old('code') }}">
        </div>

        <div>
            <label style="color: aliceblue">Img</label>
            <input class="form-control" type="file" placeholder="Img" name="img" value="{{ old('img') }}">

        </div>

        <div>
            <button id="save" class="btn btn-success" style="margin-left: 46%;margin-top: 5%">Save</button>
        </div>
    </form>
    <br><br>
    <button id="create" class="btn btn-success" style="margin-left: 46%;margin-top: 5%">Save</button>

<div style="margin-top: 450px">

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('departments.restore.index')}}"class="btn btn-dark">DE-restore</a>
    <a href="{{route('orders.restore.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>

</div>

<script>

    const create = document.getElementById('create');
        
        create.addEventListener('click', () => {
            $('#departmentsForm').show();

        });
    
       
    </script>

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