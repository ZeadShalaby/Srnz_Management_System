<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Departments</title>
</head>
<body>
    @extends('extends')
    @section('content')
    <h1>EDIT DEPARTMENTS</h1>
    <br>
    <form action="{{route('departments.update',$departments->id)}}" enctype="multipart/form-data" method="post" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%">
        @csrf
        @method('put')
        <div>
            <label style="color: aliceblue">Name</label>
            <input class="form-control" type="text" placeholder="Name" name="name" value="{{$departments ->name }}">
            @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label style="color: aliceblue">Code</label>
            <input class="form-control" type="text" placeholder="code" name="code" value="{{$departments ->code}}">
            @error('code')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label style="color: aliceblue">Img</label>
           
            <input class="form-control" type="file" placeholder="Img" name="img" value="{{$departments ->img}}">
            @error('img')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <button class="btn btn-success" style="margin-left: 46%;margin-top: 5%"type="submit">EDiT</button>
        </div>
    </form>
    @endsection

</body>
</html>