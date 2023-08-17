<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{URL('image/home/srnz.png')}}" type="image/svg+xml">
    <title>Interesteds</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if(session('error'))
    @extends('layout.errormessage')
    @section('message_danger')
        
    @endsection
    </div>
    @endif
    @extends('layout.message-info')
    @section('messages_info')
        
    @endsection
    <h1>Favourites</h1>
    <br><br>
    <div class="InterestedRowall">
    @foreach ($interesteds as $interested)
    <div class="InterestedRow{{$interested->id}}">
    <a href="{{route('interesteds.show',$interested->id)}}" class="inside-page__btn inside-page__btn--beach">
        {{$interested->id}}-@isset($interested->user->name){{$interested->user->name}}@else{{'null'}}@endisset-@isset($interested->order->name){{$interested->order->name}}@else{{'null ordername'}}@endisset--@isset($interested->order->department->name){{$interested->order->department->name}}@else{{'null'}}@endisset-
    </a>
        <br>

            <button interested_id={{$interested->id}} class="remove_btn btn btn-danger"  style="margin-top: -25px;margin-left: 400px;">Remove</button>
        
        <br><br>
    </div>
    @endforeach
    @foreach ($interesteds as $interested)
        <button  class="removeall_btn btn btn-dark" name="deleteall"style="margin-top: -165px;margin-left: 600px;">RemoveAll</button>
        @break
    </form>
    @endforeach
    </div>
    
    <script>

        $(document).on('click', '.remove_btn', function (e) {
            e.preventDefault();
        
              var interested_id =  $(this).attr('interested_id');
             
            $.ajax({
                type: 'DELETE',
                 url: "{{route('interesteds.destroy',10)}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :interested_id
                },
                success: function (data) {
        
                    if(data.status == true){
                        $('#Delete_Favourites').show();
                    }
                    $('.InterestedRow'+data.id).remove();
                }, error: function (reject) {
        
                }
            });
        });

// Delete all favourite with Ajax

        $(document).on('click', '.removeall_btn', function (e) {
                    e.preventDefault();
                     
                var removeall_btn = 10;

                    $.ajax({
                      
                        type: 'DELETE',
                        url: "{{route('interesteds.destroy',5)}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'removeall_btn':removeall_btn,
                        },
                        success: function (data) {
                
                            if(data.status == true){
                                $('#Delete_Favourites').show();
                            }
                            $('.InterestedRowall').remove();
                        }, error: function (reject) {
                
                        }
                    });
                });
                
        </script>
    @endsection
</body>
</html>