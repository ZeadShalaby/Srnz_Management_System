<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADD Orders </title>
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
     <div id='error' class="alert alert-danger error-text code_error" style="display: none"></div>

    <h1>CREATE ORDERS</h1>
    
    <form action="{{route('ordersite.store')}}" id="ordersForm" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%">
        @csrf
        <div>
            <label style="color: aliceblue">Name</label>
            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            
        </div>
       

        <div>
            <label style="color: aliceblue">department_id</label>
            <select class="form-control" name="department_id">
                <option value="  ">Departments</option>
                @foreach ($departments as $department)
                    <option value=" {{$department ->id}} ">{{$department ->name}}</option>
                @endforeach
            </select>
           

        </div>
        <div>
            <label style="color: aliceblue">description</label>
            <input class="form-control" type="text" placeholder="code" name="description" value="{{ old('description') }}">
            
        </div>
        <div>
            <label style="color: aliceblue">price</label>
            <input class="form-control" type="text" placeholder="code" name="price" value="{{ old('price') }}">
            
        </div>
        

        <div>
            <label style="color: aliceblue">path</label>
            <input class="form-control" type="file" placeholder="Img" name="path" value="{{ old('path') }}">
        
        </div>

        <div>
            <button class="btn btn-success" style="margin-left: 46%;margin-top: 5%" id="save" >Save</button>
        </div>
    </form>
    <br><br>
<div style="margin-top: 550px">

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>

</div>

<script>

    $(document).on('click', '#save', function (e) {
        e.preventDefault();

        var formData = new FormData($('#ordersForm')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('ordersite.store')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {

                if (data.status == true) {
                    $('#error').hide();
                    $('#success_msg').show();
                }
            
                if (data.type == 'name') {
                    $('#error').hide();
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