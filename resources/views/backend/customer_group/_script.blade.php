<script>
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
            url: 'customer_group/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
             toastr.success(data.message, 'Successfully Delete Customer Group', {timeOut: 5000});
                $('.item' + data.cg.id).remove();

            }
        });
    });

    // Status Active and Inactive
    $(document).on('click', '.status-modal', function() {
        $('#footer_status_button').text(" Change");
        $('#footer_status_button').addClass('fa-check');
        $('#footer_status_button').removeClass('fa-trash');
        $('.statusBtn').removeClass('btn-success');
        $('.statusBtn').addClass('btn-warning');
        $('.statusBtn').addClass('status');
        $('.modal-title').text('Status');
        $('.changeStatusid').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('title'));
        $('#statusChange').modal('show');
    });
    $('.modal-footer').on('click', '.statusBtn', function() {

        $.ajax({
            type: 'post',
            url: "{{route('customer_group.status')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.changeStatusid').text(),
                'status':$('.dname').text()
            },
            success: function(data) {

                toastr.success(data.message, 'Successfully Change Status', {timeOut: 5000});

                if(data.status.status=='Pending'){
                    var label="label-warning";
                    //  $('.status' + data.status.id).replaceWith("<span style='text-align: center' class='label  " + label + "'>" +data.status.status +" </span>");
                }
                if(data.status.status=='Inactive')
                {
                    var label="label-warning";
                    $('.action' + data.status.id).replaceWith("<li class='action"+data.status.id+"'><a href='#' class='status-modal' data-id='"+data.status.id+"' data-title='Active' > <i class='fa fa-check-square-o' ></i> Active </a><li>");
                }
                if(data.status.status=='Rejected')
                {
                    var label="label-danger";
                    $('.action' + data.status.id).replaceWith(" ");
                }
                if(data.status.status=='Active')
                {
                    var label="label-success";
                    $('.action' + data.status.id).replaceWith("<li class='action"+data.status.id+"'><a href='#' class='status-modal' data-id='"+data.status.id+"' data-title='Inactive' > <i class='fa fa-lock' ></i> Inactive </a></li>");
                }

                $('.status' + data.status.id).replaceWith("<td class='status"+data.status.id+"'><span style='text-align: center' class='label  " + label + "'>" +data.status.status +" </span></td>");
            }
        });
    });
</script>