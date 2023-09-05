<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/orders.show.css') }}" rel="stylesheet">
    <link href="{{ asset('css/orders.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">
    <title>Orders Information</title>
</head>

<body>
    @extends('extends')
    @section('content')

        <div class="alert alert-success" id="success_msg" style="display: none;">Add your favourite .</div>
        <div class="alert alert-danger" id="error_msg" style="display: none; color:rebeccapurple">Alredy Aded Favourite .
        </div>
        <div class="alert alert-success" id="success_msg" style="display: none;">Delete Sucessfuly .</div>

        <h1>SHOW Orders</h1>
        <br>



        <aside class="profile-card">
            <header>
                <!-- here’s the avatar -->
                <a target="_blank" href="#">
                    <img src="{{ asset('image/orders/' . $orders->path) }}" alt="departments" class="hoverZoomLink">
                </a>
                <button orders_id={{ $orders->id }} name="favourite" class="AddFav btn btn-lg"><i class="fa fa-heart"
                        id="fav{{ $orders->id }}" style="color: gold;"></i></button>
                @isset($interesteds)
                    @foreach ($interesteds as $interested)
                        @if (($interested->user_id == $userid) & ($interested->order_id == $orders->id))
                            <div style="margin-top: -48px;margin-left: 158px">
                                <button orders_id={{ $orders->id }} name="favourite" class="AddFav btn btn-lg"><i
                                        class="fa fa-heart" style="color: red;"></i></button>
                            </div>
                        @endif
                    @endforeach
                @else
                @endisset
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

            <!-- some social links to show off -->

        </aside>



        <script>
            // AddFavourite with ajax

            $(document).on('click', '.AddFav', function(e) {
                e.preventDefault();

                var order_id = $(this).attr('orders_id');

                $.ajax({
                    type: 'post',
                    url: "{{ route('ordersite.favourite') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': order_id
                    },
                    success: function(data) {

                        if (data.status == true) {
                            $('#success_msg').show();
                            $('#error_msg').hide();
                            var id = 'fav' + data.id;
                            const btn = document.getElementById(id);
                            btn.style.color = 'red';

                        } else {
                            $('#error_msg').show();
                            $('#success_msg').hide();
                        }

                    },
                    error: function(reject) {

                    }
                });
            });
        </script>


        <br>
    @endsection
</body>

</html>
