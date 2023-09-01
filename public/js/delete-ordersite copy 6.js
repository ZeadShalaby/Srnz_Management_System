// delete with ajax
$(document).on('click', '.delete_btn', function (e) {
    e.preventDefault();

      var order_id =  $(this).attr('order_id');
     
    $.ajax({
        type: 'DELETE',
         url: "{{route('ordersite.destroy',10)}}",
        data: {
            '_token': "{{csrf_token()}}",
            'id' :order_id
        },
        success: function (data) {

            if(data.status == true){
                $('#delete_msg').show();
            }
            $('.OrderRow'+data.id).remove();
        }, error: function (reject) {

        }
    });
});
  