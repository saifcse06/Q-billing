<script>
    // add a new Customer
    $(document).on('click', '#add-modal', function() {
        $('.modal-title').text('Add New Customer');
        $('#addModal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: '{{route('customer.store')}}',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#name').val(),
                'email': $('#email').val(),
                'phone':$('#phone').val(),
                'address':$('#address').val(),
            },
            success: function(data) {
                $('.errorTitle').addClass('hidden');
                $('.errorContent').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addModal').modal('show');
                        var messages='';
                        $.each(data.errors,function (index, message) {
                            messages+=message+'<br>';
                        })
                        toastr.error(messages, 'Error Alert', {timeOut: 10000});
                    }, 500);

                    if (data.errors.title) {
                        $('.errorTitle').removeClass('hidden');
                        $('.errorTitle').text(data.errors.title);
                    }
                    if (data.errors.content) {
                        $('.errorContent').removeClass('hidden');
                        $('.errorContent').text(data.errors.content);
                    }
                } else {
                    $('#name').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#address').val('');
                    toastr.success('Successfully added New Customer Alert', {timeOut: 5000});
                    // $('#postTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }
            },
        });
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
            url: 'client_customer_group_pivot/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                toastr.success(data.message, 'Successfully Delete', {timeOut: 5000});
                $('.item' + data.client_cg.id).remove();

            }
        });
    });

    // Status Active and Inactive
    $(document).on('click', '.status-modal', function() {
        $('#footer_status_button').text(" Change");
        $('#footer_status_button').addClass('fa-check');
        $('#footer_status_button').removeClass('fa-trash');
        // $('.statusBtn').removeClass('btn-success');
        $('.statusBtn').addClass('btn-warning');
        $('.statusBtn').addClass('status');
        $('.modal-title').text('Status');
        $('.changeStatusid').text($(this).data('id'));
        $('.deleteContent').show();
        // $('.form-horizontal').hide();
        $('.dname').html($(this).data('title'));
        $('#statusChange').modal('show');
    });
    $('.modal-footer').on('click', '.statusBtn', function() {

        $.ajax({
            type: 'post',
            url: "{{route('client_customer_group_pivot.status')}}",
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

    //multiselect start

    /** select 2 */

    $(".selectCustomer").select2({
        ajax: {
            url: "<?php echo url('ajaxSearchUserByMobileNumber') ?>",
            dataType: 'json',
            delay: 250,

            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (data, params) {
                globalData = data;
                return {
                    results: $.map(globalData, function (item) {
                        return {
                            id: item.id,
                            title :  item.name_phone
                        }
                    })
                };
            },
        },
        createTag: function (tag) {
            if(!globalData.length)
                return {
                    id: tag.term,
                    title :  tag.term
                };
        },
        tags:true,
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 6,
        maximumSelectionLength: 10,
        templateResult: formatData,
        templateSelection: formatDataSelection,
        multiple : true
    });


    function formatData (data) {
        if(data.disabled)
            return;

        var markup = data.title;
        return markup;
    }

    function formatDataSelection (data) {
        return data.title;
    }
    /** select 2 */

    //multiselect end
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


</script>