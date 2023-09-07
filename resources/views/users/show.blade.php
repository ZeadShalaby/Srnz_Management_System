<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">
    <link href="{{ asset('css/departments.show.css') }}" rel="stylesheet">

    <title>Users Information</title>
</head>

<body>
    @extends('extends')
    @section('content')
        @if (session('status'))
            @extends('layout.message-users-update')
            @section('update_user')
            @endsection
        @endif
        <br>

        <aside class="profile-card">
            <header>
                <!-- here’s the avatar -->
                <a target="_blank" href="#">
                    <img src="{{ asset('image/users/' . $users->profile_photo) }}" alt="departments" class="hoverZoomLink">
                </a>

                <!-- the username -->
                <h1>
                    Users Name
                </h1>

                <!-- and role or location -->
                <h2>
                    {{ $users->name }}
                </h2>

            </header>

            <!-- bit of a bio; who are you? -->
            <div class="profile-bio">

                <h1>
                    Departments Code
                </h1>

                <h2>
                    {{ $users->email }}
                    <br>
                    {{ $users->gmail }}
                    <br>
                    {{ $users->phone }}
                    <br>
                    {{ $users->password }}
                    <br>
                    @if ($users->role == 2)
                        {{ 'Customer' }}
                    @else
                        {{ 'Admin' }}
                    @endif
                </h2>

            </div>


        </aside>




        <br>
    @endsection
</body>

</html>
