<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Favourite</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/card-fav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hide-fav.css') }}">

</head>

<body>

    @extends('extends')
    @section('content')
        @if (session('error'))
            @extends('layout.errormessage')
            @section('message_danger')
            @endsection
        @endif
        @extends('layout.message-info')
    @section('messages_info')
    @endsection
    <div id="divshow" style="visibility: hidden;">

        <div class="InterestedRowall">
            @foreach ($interesteds as $interested)
                <div class="InterestedRow{{ $interested->id }}">
                    <div class="container">
                        <div class="box">
                            @if ($countcheck <= 3)
                                <div class="containers" style="margin-top:-400px; margin-left: 50px;">
                                @else
                                    <div class="containers">
                            @endif

                            <div class="wrapper">
                                <a href="#">
                                    <img src="{{ asset('image/all/try.png') }}" alt="">
                                    <div class="heart">
                                        <i class="fa-solid fa-heart"></i>
                                    </div>
                                </a>

                                <div class="title">
                                    <p>
                                        @isset($interested->order->name)
                                            {{ $interested->order->name }}@else{{ 'null ordername' }}
                                        @endisset
                                    </p>
                                </div>
                                <div class="place">
                                    <span>{{ $interested->order->price }}<span style="color: green;font-weight: bold">
                                            $</span></span>

                                </div>
                            </div>

                            <div class="heart2">

                                <li> <i class="fa-solid fa-heart"></i></li>
                            </div>

                            <div class="icons">
                                <li><a href="#"><button interested_id={{ $interested->id }}
                                            class="remove_btn btn btn-danger" style="border:none"><span
                                                class="fa fa-remove"></span></button></a></li>
                                <li><a href="{{ route('ordersite.show', $interested->order_id) }}"
                                        style="text-decoration: none">
                                        <span class="fa fa-eye"></span></a></li>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        @endforeach
    </div>
    </div>
    </div>

    <!--- hide favourite  --->
    <div id="divhide" class="divhide" style="visibility: visible;">

        <div class="backs"></div>
        <div class="hearts"></div>

    </div>


    <!-- delay Departments -->
    <script>
        function showdiv() {
            document.getElementById("divshow").style.visibility = "visible";
            document.getElementById("divhide").style.visibility = "hidden";

        }
        setTimeout("showdiv()", 3200);
    </script>


    <script>
        // card favourite
        const img = document.querySelector("img");
        const icons = document.querySelector(".icons");
        img.onclick = function() {
            this.classList.toggle("active");
            icons.classList.toggle("active");
        }
    </script>

    <script>
        // remove favourite
        $(document).on('click', '.remove_btn', function(e) {
            e.preventDefault();

            var interested_id = $(this).attr('interested_id');

            $.ajax({
                type: 'DELETE',
                url: "{{ route('interesteds.destroy', 10) }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': interested_id
                },
                success: function(data) {

                    if (data.status == true) {
                        $('#Delete_Favourites').show();
                    }
                    $('.InterestedRow' + data.id).remove();
                },
                error: function(reject) {

                }
            });
        });

        // Delete all favourite with Ajax

        $(document).on('click', '.removeall_btn', function(e) {
            e.preventDefault();

            var removeall_btn = 10;

            $.ajax({

                type: 'DELETE',
                url: "{{ route('interesteds.destroy', 5) }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'removeall_btn': removeall_btn,
                },
                success: function(data) {

                    if (data.status == true) {
                        $('#Delete_Favourites').show();
                    }
                    $('.InterestedRowall').remove();
                },
                error: function(reject) {

                }
            });
        });
    </script>

@endsection
</body>

</html>
