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
    <h1>CREATE DEPARTMENTS</h1>
    
    <form id = 'form' action="{{route('departments.store')}}" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%;display:none">
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
            <label style="color: aliceblue">Code</label>
            <input class="form-control" type="text" placeholder="code" name="code" value="{{ old('code') }}">
            @error('code')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <label style="color: aliceblue">Img</label>
            <input class="form-control" type="file" placeholder="Img" name="img" value="{{ old('img') }}">
            @error('img')
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
    <button id="create" class="btn btn-success" style="margin-left: 46%;margin-top: 5%"type="submit">Save</button>

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
            $('#form').show();

        });
    
    </script>

    @endsection
</body>
</html>