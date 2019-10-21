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
                $('.discount').html(data);
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
            url: 'client_discount/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                toastr.success(data.message, 'Successfully Delete', {timeOut: 5000});
                $('.item' + data.discount.id).remove();

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
            url: "{{route('client_discount.status')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.changeStatusid').text(),
                'status':$('.dname').text()
            },
            success: function(data) {
                toastr.success(data.message, 'Successfully Change Status', {timeOut: 5000});

                if(data.status.status=='Unused'){
                    var label="label-warning";
                    //  $('.status' + data.status.id).replaceWith("<span style='text-align: center' class='label  " + label + "'>" +data.status.status +" </span>");
                }
                if(data.status.status=='Used')
                {
                    var label="label-warning";
                    $('.action' + data.status.id).replaceWith("<li class='action"+data.status.id+"'><a href='#' class='status-modal' data-id='"+data.status.id+"' data-title='Using' > <i class='fa fa-check-square-o' ></i> Using </a><li>");
                }
                if(data.status.status=='Unused')
                {
                    var label="label-danger";
                    $('.action' + data.status.id).replaceWith(" ");
                }
                if(data.status.status=='Using')
                {
                    var label="label-success";
                    $('.action' + data.status.id).replaceWith("<li class='action"+data.status.id+"'><a href='#' class='status-modal' data-id='"+data.status.id+"' data-title='Used' > <i class='fa fa-lock' ></i> Used </a></li>");
                }

                $('.status' + data.status.id).replaceWith("<td class='status"+data.status.id+"'><span style='text-align: center' class='label  " + label + "'>" +data.status.status +" </span></td>");
            }
        });
    });


    $(function() {
        window.prettyPrint && prettyPrint();

        $('.default-date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate:new Date(),
        });
    });

   // Expire Date
    $(document).ready(function() {


        $(".notexpiredate").change(function() {
            if(this.checked) {
                $(".expiredate").prop('required',false);
                $(".expiredate").prop('readonly',true);
                $(".expiredate").val(null);
            }else {
                $(".expiredate").prop('required',true);
                $(".expiredate").prop('readonly',false);
            }
        });

        $(".expiredate").prop('required',true);


    });
</script>