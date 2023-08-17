<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">

    <title>ADMIN PAGE</title>
</head>
<body>
    @if ($SeAdmin)
        @extends('layout.messages-success')
        @section('messages_success')
        @endsection
        
    @endif
    
    @extends('extends')
    @section('content')
    @if (session('status'))
        {{session('status')}}
    @endif
   
   <h1> Admin Page</h1>
   
    
    @endsection
</body>
</html>