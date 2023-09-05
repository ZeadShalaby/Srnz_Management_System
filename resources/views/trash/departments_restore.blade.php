<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/restore.css') }}">
    <link rel="stylesheet" href="{{ asset('css/load-depre.css') }}">

    <link rel="shortcut icon" href="{{ URL('image/home/srnz.png') }}" type="image/svg+xml">

    <title>Restore Departments</title>
</head>

<body id="body">
    @extends('extends')
    @section('content')
        @extends('layout.message-trash-dep')
    @section('trash_dep')
    @endsection

    <br><br>
    <div id="divshow" style="visibility: hidden;">

        @foreach ($departments as $department)
            <div class="container">
                <div class="box">
                    <div class="DepartmentRow{{ $department->id }}">
                        <a href="#restore" id="href" department_id={{ $department->id }} class="restore_btn "><img
                                class="restore"src="{{ URL('image/all/restore.png') }}" alt="folder"></a>
                        <img class="img" src="{{ URL('image/all/folders.png') }}" alt="folder">
                        <p style="text-align: center;font-size: 15px;color: blue">
                            {{ $department->name }}-{{ $department->code }}
                        </p>

                        <div class="path_dep">
                            @if (isset($department->img))
                                <div class="imgdep">
                                    <img class="photo" src="{{ asset('image/departments/' . $department->img) }}"
                                        alt="departments">
                                </div>
                            @else
                                @if ($department->id % 2 == 0)
                                    <img src="{{ asset('image/all/dep.png') }}" alt="departments">
                                @else
                                    <img src="{{ asset('image/all/logo.png') }}" alt="departments">
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div id="divhide" class="divhide" style="visibility: visible;">
        <div class="onefirst">
            <div class="animation-container">
                <div class="lightning-container">
                    <div class="lightning white"></div>
                    <div class="lightning red"></div>
                </div>
                <div class="boom-container">
                    <div class="shape circle big white"></div>
                    <div class="shape circle white"></div>
                    <div class="shape triangle big yellow"></div>
                    <div class="shape disc white"></div>
                    <div class="shape triangle blue"></div>
                </div>
                <div class="boom-container second">
                    <div class="shape circle big white"></div>
                    <div class="shape circle white"></div>
                    <div class="shape disc white"></div>
                    <div class="shape triangle blue"></div>
                </div>
            </div>


        </div>
    </div>
    <!-- delay orders -->
    <script>
        function showdiv() {
            document.getElementById("divshow").style.visibility = "visible";
            document.getElementById("divhide").style.visibility = "hidden";

        }
        setTimeout("showdiv()", 3600);
    </script>


    <script>
        $(document).on('click', '.restore_btn', function(e) {
            e.preventDefault();

            var department_id = $(this).attr('department_id');

            $.ajax({
                type: 'get',
                url: "{{ route('departments.restore') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': department_id
                },
                success: function(data) {

                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                    $('.DepartmentRow' + data.id).remove();
                },
                error: function(reject) {

                }
            });
        });
    </script>

@endsection
</body>

</html>
