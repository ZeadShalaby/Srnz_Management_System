<!DOCTYPE html>
<html>
<head>
    <title>Login System in Laravel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <style type="text/css">
        body {
            background-image: url('https://www.spaceotechnologies.com/wp-content/uploads/2020/05/best-learning-management-systems-1.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h3 {
            text-align: center;
        }

        .container .alert {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        }

        .btn-primary {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Login</h3>
    <br/>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    @if(isset(Auth::user()->email))
        <script>window.location = "/login/successlogin";</script>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('/login/checklogin') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="identify">Email or Phone-Number</label>

            <input  type="text" id="email" name="email" class="form-control" value="{{old('email')}}"/>
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" value="{{old('password')}}"/>
        </div>
        <div class="form-group">
            <input type="submit" name="login" class="btn btn-primary" value="Login"/>
        </div>
    </form>
    <a href="{{ url('/redirect/google') }}">google</a>
    <a href="{{ url('/redirect/github') }}" style="margin-left: 50px;"> githup</a>


    <br>


</div>
<a href="{{route('registration.create')}}"> <img width="50px" height="50px" src="{{URL('image/add1.png')}}"  alt="add" > Singup</i>
</a>
</body>
</html>
