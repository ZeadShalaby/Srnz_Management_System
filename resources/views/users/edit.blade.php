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
            <label style="color: aliceblue">Email</label>
            <input class="form-control" type="text" placeholder="email" name="email" value="{{ $users->email }}">
            @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">password</label>
            <input class="form-control" type="text" placeholder="code" name="password" value="{{ $users->password }}">
            @error('password')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">gmail</label>
            <input class="form-control" type="text" placeholder="code" name="gmail" value="{{ $users->gmail }}">
            @error('gmail')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        

        <div>
            <label style="color: aliceblue">phone</label>
            <input class="form-control" type="text" placeholder="Img" name="phone" value="{{ $users->phone }}">
            @error('phone')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        
        
<br>

        <div>
            <label style="color: aliceblue">Role</label>
            <span style="color: red">
           @if($users->role ==1)
           {{"Admin"}}
           @else
           {{"Customer"}}
           @endif
           </span>
        </div>

        <div>
            <button class="btn btn-success" style="margin-left: 46%;margin-top: -5%"type="submit">Save</button>
        </div>
    </form>
    @endsection

</body>
</html>