<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Admin</title>
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
     <div class="alert alert-danger" id="email_error_msg" style="display: none;">
        email Oreday Exist .
     </div>
     <div id='error' class="alert alert-danger error-text code_error" style="display: none"></div>
    <h1>Create Admin</h1>
    <br>
    <form action="{{route('users.store')}}" id="usersForm" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%">
        @csrf
        <div>
            <label style="color: aliceblue">Name</label>
            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            
        </div>
       

        <div>
            <label style="color: aliceblue">Email</label>
            <input class="form-control" type="text" placeholder="email" name="email" value="{{ old('email') }}">
            
        </div>
        <div>
            <label style="color: aliceblue">password</label>
            <input class="form-control" type="password" placeholder="password" name="password" value="{{ old('password') }}">
           
        </div>
        <div>
            <label style="color: aliceblue">gmail</label>
            <input class="form-control" type="text" placeholder="gmail" name="gmail" value="{{ old('gmail') }}">
            
        </div>
        

        <div>
            <label style="color: aliceblue">phone</label>
            <input class="form-control" type="text" placeholder="phone" id="phone" name="phone" value="{{ old('phone') }}">
            
        </div>

        
        
<br>

        <div>
            <button class="btn btn-success" id="save" style="margin-left: 46%;margin-top: -5%" >Create</button>
        </div>
    </form>

<script>

        $(document).on('click', '#save', function (e) {
            e.preventDefault();
    
            var formData = new FormData($('#usersForm')[0]);
    
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('users.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
    
                    if (data.status == true) {
                        $('#error').hide();
                        $('#success_msg').show();
                    }
                    if (data.type == 'email') {
                        $('#error').hide();
                        $('#name_error_msg').hide();
                        $('#success_msg').hide();
                        $('#email_error_msg').show();
                    }
                    if (data.type == 'name') {
                        $('#error').hide();
                        $('#email_error_msg').hide();
                        $('#success_msg').hide();

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