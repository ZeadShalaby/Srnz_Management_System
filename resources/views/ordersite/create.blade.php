<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">
    <link href="{{ asset('css/loadorders.css') }}" rel="stylesheet">

    <title>ADD Orders </title>
</head>

<body>
    <div id="divshow" style="visibility: hidden;">

        @extends('extends')
        @section('cintent')
        @endsection
        @if (session('status'))
            @extends('layout.message-create')
            @section('messages_create')
            @endsection

        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('important'))
            <div class="alert alert-danger">
                {{ session('important') }}
            </div>
        @endif



        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="bold"></div>

        <div class="wrapper" style="margin-left: 100px">

            <form action="{{ route('ordersite.store') }}" id="ordersForm" method="post" enctype="multipart/form-data">
                @csrf
                <h2 style="color: aliceblue">Add Orders</h2>

                <div class="upload-btn-wrapper">

                    <button class="btn-upload"><img class="img-upload" src="{{ URL('image\all\upload_black.png') }}"
                            alt="upload"></button>
                    <input type="file" name="path" />
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <label lang="email" id="label">Name_Orders</label>
                    <input type="text" placeholder="Name" name="name" value="{{ old('name') }}">

                </div>


                <div class="container">
                    <div class="select">
                        <select name="department_id">
                            <option value="  ">Departments</option>
                            @foreach ($departments as $department)
                                <option value=" {{ $department->id }} ">{{ $department->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <br><br>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <label for="password" id="label">description</label>
                    <input type="text" placeholder="code" name="description" value="{{ old('description') }}">

                </div>

                <div class="input-box">
                    </span>
                    <label for="password" id="label">Price</label>
                    <input type="number" placeholder="code" name="price" value="{{ old('price') }}">

                </div>





                <button class="create" id="save">Save</button>

            </form>
        </div>
    </div>

    <div id="divhide" class="divhide" style="visibility: visible;">
        <div class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>
    </div>


    <!-- delay orders -->
    <script>
        function showdiv() {
            document.getElementById("divshow").style.visibility = "visible";
            document.getElementById("divhide").style.visibility = "hidden";

        }
        setTimeout("showdiv()", 3200);
    </script>


</body>

</html>
