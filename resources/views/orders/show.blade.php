<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/orders.show.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">
    <title>Orders Information</title>
</head>

<body>
    @extends('extends')
    @section('content')
        @if (session('status'))
            @extends('layout.message-update-success')
            @section('messages_success')
            @endsection
        @endif
        <h1>SHOW Orders</h1>
        <br>
        <aside class="profile-card">
            <header>
                <!-- here’s the avatar -->
                <a target="_blank" href="#">
                    <img src="{{ asset('image/orders/' . $orders->path) }}" alt="orders" class="hoverZoomLink">
                </a>

                <!-- the username -->
                <h1>
                    Orders Name
                </h1>

                <!-- and role or location -->
                <h2>
                    {{ $orders->name }}
                </h2>

            </header>
            <h2> @isset($orders->user->name)
                    {{ $orders->user->name }} @else{{ 'null user name' }}
                @endisset
            </h2>
            <h2> @isset($orders->department->name)
                    {{ $orders->department->name }} @else{{ 'null department name' }}
                @endisset
            </h2>
            <h2> {{ $orders->gmail }} </h2>
            <h2> {{ $orders->phone }} </h2>
            <p> {{ $orders->description }} </p>
            <h2> {{ $orders->price }} </h2>
            <!-- bit of a bio; who are you? -->
            <div class="profile-bio">

                <h1>
                </h1>

                <h2>
                </h2>

            </div>



        </aside>





        <br>
    @endsection
</body>

</html>
