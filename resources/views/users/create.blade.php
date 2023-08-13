<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/user_create.css')}}">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

    <title>Create Admin</title>
</head>
<body>
    
    @extends('extends')
    @section('content')
        @extends('layout.message-create')
        @section('messages_create')
        @endsection 

        @extends('layout.messageerror')
        @section('message_danger')
        @endsection 
    
     <div id='error' class="alert alert-danger error-text code_error" style="display: none;"></div>

    <br>
    
    <div class="square">

        <i style="--clr:#fffd44;"></i>
        
        <i style="--clr:#ff0057;"></i>
        
        <i style="--clr:#f20de6; "></i>
        
        <div class="login">
        <form class="login" action="{{route('users.store')}}" id="usersForm" method="post" enctype="multipart/form-data">
            @csrf
           
            <h2>Create Admin</h2>
        
        <div class="inputBx" id="username">
           
        <input  type="text" placeholder="Username" name="name" value="{{ old('name') }}">
                
        </div>
        
        <div class="inputBx" id="email"> 
        
            <input  type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}">

        </div>
        
        <div class="inputBx" id="password"> 
        
            <input  type="password" placeholder="password" name="password" value="{{ old('password') }}">
        
        </div>
        <div class="inputBx" id="gmail"> 
        
            <input  type="text" placeholder="gmail" name="gmail" value="{{ old('gmail') }}">
        
        </div>
        <div class="inputBx" id="phone"> 
        
            <input  type="text" placeholder="phone" id="phone" name="phone" value="{{ old('phone') }}">
        
        </div>
        <div class="inputBx">
      <button class="btn btn-success" type="submit" id="create_Admin"> 
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Create</button>
        </div>

        
        </form>
        </div> 
    </div>
    <div class="bg-div">
        <img src="{{URL('image\all\logo_srnz.png')}}" alt="img" />
    </div>





<script>

        $(document).on('click', '#create_Admin', function (e) {
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
                        document.getElementById("usersForm").reset();  

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