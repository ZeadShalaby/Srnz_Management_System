<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration </title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    <h1>Registration</h1>
    
    <form action="{{route('ordersite.store')}}" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%">
        @csrf
        <div>
            <label style="color: aliceblue">Name</label>
            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
       

        <div>
            <label style="color: aliceblue">department_id</label>
            <input class="form-control" type="text" placeholder="code" name="department_id" value="{{ old('department_id') }}">
            @error('department_id')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">description</label>
            <input class="form-control" type="text" placeholder="code" name="description" value="{{ old('description') }}">
            @error('description')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">price</label>
            <input class="form-control" type="text" placeholder="code" name="price" value="{{ old('price') }}">
            @error('price')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        

        <div>
            <label style="color: aliceblue">path</label>
            <input class="form-control" type="file" placeholder="Img" name="path" value="{{ old('path') }}">
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
    <br><br>
<div style="margin-top: 450px">

    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>

</div>
    @endsection
</body>
</html>