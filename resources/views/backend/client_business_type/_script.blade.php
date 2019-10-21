<script>
    //total tdr calculation
    $(document).on('change keyup','input','.my_tdr',function(){
       // var  my_tdr=   Number($(this).val());
        var  my_tdr= $("input[name='my_tdr']").val();
        var  services_tdr= $("input[name='services_tdr']").val();

       var totalTdr= parseFloat(my_tdr) + parseFloat(services_tdr);
        $("input[name='total_tdr']").val(totalTdr.toFixed(2));
    });
    // for ajax pagination without load
    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/img/loading2.gif" />');

            var url = $(this).attr('href');
            getArticles(url);
            window.history.pushState("", "", url);
        });

        function getArticles(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('.businesstype').html(data);
            }).fail(function () {
                alert('Business Type could not be loaded.');
            });
        }
    });


    // delete transaction ajax
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Yes");
        $('#footer_action_button').addClass('fa-check');
        $('#footer_action_button').removeClass('fa-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-warning');
        $('.actionBtn').addClass('status');
        $('.modal-title').text('Delete');
        $('#id_delete').val($(this).data('id'));
        $('#title_delete').val($(this).data('name'));
        $('#deleteModal').modal('show');
        id = $(this).data('id');
    });
    $('.modal-footer').on('click', '.actionBtn', function() {
        $.ajax({
            type: 'DELETE',
            url: 'client_business_type/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                toastr.success(data.message, 'Successfully Delete', {timeOut: 5000});
                $('.item' + data.businesstype.id).remove();

            }
        });
    });


</script>