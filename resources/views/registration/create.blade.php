<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create CUSTOMER</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <h1>Create CUSTOMER</h1>
    <br>
    <form action="{{route('registration.store')}}" method="post" enctype="multipart/form-data" style="margin-top:10%;margin-left: 20%;position: absolute; background-color: black ;border: 2px solid rgb(64, 64, 64) ;border-radius: 20px;width: 50%">
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
            <label style="color: aliceblue">Email</label>
            <input class="form-control" type="text" placeholder="email" name="email" value="{{ old('email') }}">
            @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">password</label>
            <input class="form-control" type="password" placeholder="password" name="password" value="{{ old('password') }}">
            @error('password')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label style="color: aliceblue">gmail</label>
            <input class="form-control" type="text" placeholder="gmail" name="gmail" value="{{ old('gmail') }}">
            @error('gmail')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        

        <div>
            <label style="color: aliceblue">phone</label>
            <input class="form-control" type="text" placeholder="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        
        
<br>

        <div>
            <button class="btn btn-success" style="margin-left: 46%;margin-top: -5%"type="submit">Create</button>
        </div>
    </form>
    @endsection

</body>
</html>