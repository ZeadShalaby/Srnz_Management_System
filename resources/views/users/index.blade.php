<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/card-users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/load-user.css') }}">

    <title>Users</title>
</head>

<body>
    <h1>Users
        <a href="{{ route('users.create') }}"> <img width="50px" height="50px" src="{{ URL('image/all/add1.png') }}"
                alt="add"> Create New Admin</i>
        </a>
    </h1>
    @extends('extends')
    @section('content')
        @extends('layout.message-users-delete')
    @section('delete_users')
    @endsection


    <br>


    <br><br>
    <div id="divshow" style="visibility: hidden;">

        <div class="AllData">
            @foreach ($users as $user)
                <div class="UserRow{{ $user->id }}">
                    <div class="container">
                        <div class="box">
                            <div class="card">
                                <div class="content">
                                    <div class="back">
                                        <div class="back-content">
                                            <div class="card_box">
                                                <span></span>
                                            </div>
                                            <svg stroke="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                                height="50px" width="50px" fill="#ffffff">

                                                <g stroke-width="0" id="SVGRepo_bgCarrier"></g>

                                                <g stroke-linejoin="round" stroke-linecap="round"
                                                    id="SVGRepo_tracerCarrier"></g>


                                                <g id="SVGRepo_iconCarrier">
                                                    @if ($user->role == $usersrole)
                                                        <img src="{{ asset('image/all/users.png') }}" alt="Customer"
                                                            style="margin-top: -70px;width: 120px">
                                                    @else
                                                        <img src="{{ asset('image/all/admin.png') }}" alt="Customer"
                                                            style="margin-top: -80px;width: 120px">
                                                    @endif
                                                </g>

                                            </svg>
                                            <strong>{{ $user->name }}</strong>


                                        </div>

                                    </div>
                                    <div class="front">

                                        <div class="img">
                                            <div class="circle">
                                            </div>
                                            <div class="circle" id="right">
                                            </div>
                                            <div class="circle" id="bottom">
                                            </div>
                                        </div>

                                        <div class="front-content">
                                            <small class="badge">
                                                @if ($user->role > $roles)
                                                    <span class="spans">
                                                        {{ 'Customer' }} </span>
                                                @else
                                                    {{ 'Admin' }}
                                                @endif
                                            </small>

                                            <small class="edit"> <a href="{{ route('users.edit', $user->id) }}"> <i
                                                        class="fa fa-edit"></i> </a></small>
                                            <small class="delete"><button user_id={{ $user->id }}
                                                    class="delete_btn btn btn-danger" id="delete_users"><i
                                                        class="fa fa-trash"></i></button></small>
                                            <a href="{{ route('users.show', $user->id) }}">
                                                <div class="description">
                                                    <div class="title">
                                                        <p class="title">
                                                            <img class="user_profile"
                                                                src="{{ asset('image/all/' . $user->profile_photo) }}"
                                                                alt="User_photo" />
                                                        </p>
                                                        <svg fill-rule="nonzero" height="15px" width="15px"
                                                            viewBox="0,0,256,256"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g style="mix-blend-mode: normal" text-anchor="none"
                                                                font-size="none" font-weight="none" font-family="none"
                                                                stroke-dashoffset="0" stroke-dasharray=""
                                                                stroke-miterlimit="10" stroke-linejoin="miter"
                                                                stroke-linecap="butt" stroke-width="1" stroke="none"
                                                                fill-rule="nonzero" fill="#20c997">
                                                                <g transform="scale(8,8)">
                                                                    <path d="M25,27l-9,-6.75l-9,6.75v-23h18z"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <p class="card-footer">

                                                        {{ $user->name }}
                                                        <br>
                                                        {{ $user->phone }}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>
        <br>

    </div>
    <!-- return search -->
    <div id="conte" class="searchdata">
    </div>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>


    <div id="divhide" class="divhide" style="visibility: visible;">

        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>

    </div>

    {{ $users->links() }}




    <!-- delay Departments -->
    <script>
        function showdiv() {
            document.getElementById("divshow").style.visibility = "visible";
            document.getElementById("divhide").style.visibility = "hidden";

        }
        setTimeout("showdiv()", 3200);
    </script>


    <!-- Delete MyOrder -->

    <script>
        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();

            var user_id = $(this).attr('user_id');

            $.ajax({
                type: 'DELETE',
                url: "{{ route('users.destroy', 10) }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': user_id
                },
                success: function(data) {

                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                    $('.UserRow' + data.id).remove();
                },
                error: function(reject) {

                }
            });
        });
    </script>

    <!-- Auto Complete Search -->

    <script type="text/javascript">
        var route = "{{ url('autocomplete-search-users') }}";
        $('#search').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>

    <!-- Search Data -->

    <script type="text/javascript">
        $('body').on('keyup', '#search', function() {
            //  alert('hello');
            var search_user = $(this).val();

            if (search_user) {
                $('.AllData').hide();
                $('.searchdata').show();

            } else {
                $('.AllData').show();
                $('.searchdata').hide();
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('users.search') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'info': search_user
                },
                success: function(data) {

                    $('#conte').html(data);

                },
                error: function(reject) {

                }
            });
        });
    </script>
@endsection



</body>

</html>
