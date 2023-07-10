<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit CUSTOMER</title>
</head>
<body>
    @extends('extends')
    @section('content')
    <h1>EDIT CUSTOMER</h1>
    <br>
    <form action="{{route('users.update',$users->id)}}" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%">
        @csrf
        @method('put')
        <div>
            <label style="color: aliceblue">Name</label>
            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ $users->name }}">
            @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
       

        <div>
            <label style="color: aliceblue">department_id</label>
            <input class="form-control" type="text" placeholder="code" name="department_id" value="{{ $users->department_id }}">
            @error('department_id')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">description</label>
            <input class="form-control" type="text" placeholder="code" name="description" value="{{ $users->description }}">
            @error('description')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">price</label>
            <input class="form-control" type="text" placeholder="code" name="price" value="{{ $users->price }}">
            @error('price')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        

        <div>
            <label style="color: aliceblue">path</label>
            <input class="form-control" type="file" placeholder="Img" name="path" value="{{ $users->path }}">
            @error('path')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <button class="btn btn-success" style="margin-left: 46%;margin-top: 5%"type="submit">Save</button>
        </div>
    </form>
    @endsection

</body>
</html>