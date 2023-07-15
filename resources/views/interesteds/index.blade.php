<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interesteds</title>
</head>
<body>
    @extends('extends')
    @section('content')
    @if(session('error'))
    <div class="alert alert-danger">
    {{session('error')}}
    </div>
    @endif
    <div class="alert alert-success" id="success_msg" style="display: none;">
        Interested Remove successfully .
    </div>
    <div class="alert alert-success" id="success_all_msg" style="display: none;">
        All_Interested Remove successfully .
    </div>
    <h1>Interesteds</h1>
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
    <br>
    {{ $interesteds->links() }}
    <a href="{{route('homepage')}}"class="btn btn-dark">HomePage</a>
    <a href="{{route('ordersite.index')}}"class="btn btn-dark">Orders</a>
    <a href="{{route('orders.restore.site.index')}}"class="btn btn-dark">OR-restore</a>


    <br>

    
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
                        $('#success_msg').show();
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
                                $('#success_all_msg').show();
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