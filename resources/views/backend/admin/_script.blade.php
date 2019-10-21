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
                $('.userlistofadmin').html(data);
            }).fail(function () {
                alert('Data could not be loaded.');
            });
        }
// password match validation message

        $('.btnCreate').click(function () {
            var password= $('.password').val();
            var cPassword= $('.cPassword').val();
            $('.passwordMessageDiv').remove();
            if(password != cPassword)
            {
                $('.passwordDiv').append('<i class="passwordMessageDiv red">Password mismatch</i>')
                event.preventDefault();
            }
        });

    });

    // Status Active and Inactive
    $(document).on('click', '.status-modal', function() {
        $('#footer_action_button').text(" Change");
        $('#footer_action_button').addClass('fa-check');
        $('#footer_action_button').removeClass('fa-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-warning');
        $('.actionBtn').addClass('status');
        $('.modal-title').text('Status');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('status'));
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.status', function() {

        $.ajax({
            type: 'post',
            url: "{{route('admin.status')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text(),
                'status':$('.dname').text()
            },
            success: function(data) {

                toastr.success(data.message, 'Successfully Change Status', {timeOut: 5000});

                if(data.status.status=='Pending'){
                    var label="label-warning";
                    $('.status' + data.status.id).replaceWith("<span style='text-align: center' class='label  " + label + "'>" +data.status.status +" </span>");
                }
                if(data.status.status=='Suspended')
                {
                    var label="label-danger";
                    $('.action' + data.status.id).replaceWith(" ");
                }
                if(data.status.status=='Active')
                {

                    var label="label-success";
                    $('.action' + data.status.id).replaceWith("<li class='action"+data.status.id+"'><a href='#' class='status-modal' data-id='"+data.status.id+"' data-status='Inactive' >"+ " <i class='fa fa-lock' ></i> "  +" Inactive </a> </li>");
                }
                if(data.status.status=='Inactive')
                {

                    var label="label-warning";
                    $('.action' + data.status.id).replaceWith("<li class='action"+data.status.id+"'><a href='#' class='status-modal' data-id='"+data.status.id+"' data-status='Active' >"+ " <i class='fa fa-check-square' ></i> "  +" Active </a> </li>");
                }

                $('.status' + data.status.id).replaceWith("<td class='status"+data.status.id+"'><span style='text-align: center' class='label  " + label + "'>" +data.status.status +" </span></td>");

            }
        });
    });
    //selected customer info show and hide

        $("select[name=type]").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");

                if(optionValue!='Customer'){
                    //passport ,birth,Nid any one validation

                    // $('#userform').on('submit', function () {
                    //     if ($.trim($("[name=nid]").val()) == '' && $.trim($("[name=birth_certificate]").val()) == '' && $.trim($("[name=passport]").val()) == '') {
                    //         $(".error").replaceWith("<h5 style='color: red;'><i>NID or Passport or Birth Certificate is Required </i></h5>");
                    //         event.preventDefault();
                    //     }
                    //     if ($.trim($("[name=nid]").val()) != '' || $.trim($("[name=birth_certificate]").val()) != '' || $.trim($("[name=passport]").val()) != '') {
                    //         $("#userform").submit();
                    //     }
                    //     if (optionValue=='Customer'||$.trim($("[name=nid]").val()) == '' || $.trim($("[name=birth_certificate]").val()) == '' || $.trim($("[name=passport]").val()) == '') {
                    //         alert(1)
                    //         $("#userform").submit();
                    //     }
                    //
                    // });

                    // $("#notCustomer").not("." + optionValue).prop( "display", false );
                    // $("." + optionValue).prop( "display", false );
                    // $("#notCustomer").prop( "display", false );

                    $("#notCustomer").show();
                } else{


                    var hiddenDiv = document.getElementById("notCustomer");
                    hiddenDiv.style.display = (this.value == "") ? "none":"none";
                }
            });
        }).change();

</script>