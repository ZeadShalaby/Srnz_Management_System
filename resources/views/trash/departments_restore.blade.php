<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restore Departments</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h1>Restore Departments</h1>
    <br><br>
    @foreach ($departments as $department)
        {{$department->id}}-{{$department->name}}-{{$department->code}}
<br>
{{$department->img}}
 <br><br>
 <div style="margin-top: -30px">
    

   <a href="{{ route('departments.restore', [ 'id'=> $department->id]) }}">
        <button class="btn btn-danger" style="margin-left: 900px;margin-top: -65px;">restore</button>
   </a>
    </form>
</div>

    @endforeach
    <br>

    <a href="{{route('orders.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('users.index')}}"class="btn btn-dark">Users</a>
    <a href="{{route('interesteds.index')}}"class="btn btn-dark">Interesteds</a>
    <a href="{{route('departments.index')}}"class="btn btn-dark">Departments</a>

    <br>
    @endsection
</body>
</html>