<script type="text/javascript">
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

    //employee group and single hide and show
    $(document).ready(function() {
        $("#groupdiv").hide();
        $("#singlediv").hide();
        $('#single').click(function () {
            $("#groupdiv").hide();
            $("#singlediv").show();
            $(".single").prop('required',true);
            $(".group").prop('required',false);
        });

        $('#group').click(function () {
            $("#groupdiv").show();
            $("#singlediv").hide();
            $(".single").prop('required',false);
            $(".group").prop('required',true);
        });

        @if(request()->old('c_type')=='group')
        $("#groupdiv").show();
        $("#singlediv").hide();

        @elseif(request()->old('c_type')=='single')
        $("#groupdiv").hide();
        $("#singlediv").show();
        @endif
    });



    //date and dateTime picker
    // $(function() {
    //     window.prettyPrint && prettyPrint();
    //     $('.default-date-picker').datepicker({
    //         format: 'dd-mm-yyyy',
    //         autoclose: true
    //     });
    // });

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    }
    if(mm<10){
        mm='0'+mm;
    }
    var sdate = yyyy+'-'+mm+'-'+dd;

    $(".form_datetime-adv").datetimepicker({
        format: "dd MM yyyy hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate:sdate,
        minuteStep: 10,
        pickerPosition: "bottom-left"

    });

    //business type under discount load
    $("select[name='client_business_type_id']").change(function(){

        var client_business_type_id = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: "{{route('ajax_load_discount')}}",
            method: 'POST',
            data: {client_business_type_id:client_business_type_id, _token:token},
            success: function(data) {
                $("select[name='discount_id']").html('');
                $("select[name='discount_id']").html(data.options);

                $(".items_lists").html('');
                $(".items_lists").html(data.items);
            }
        });
    });

    // multiple item add remove

    $(document).ready(function () {

        // quantity field value check read only add remove
        if ($('.item').val()){
            $('.qnt').attr('readonly',false);
        } else {
            $('.qnt').attr('readonly',true);
        }
        var counter = $('#item-data >tbody >tr').length;

        //table new row add like clone (copy)

        $("#addrow").on("click", function () {
            $('.qnt').attr('readonly',true);
            var rows = $("#new-row-model tbody").clone();
            var item_name = rows.first().find('select').eq(0).attr('id', 'i'+counter );
            var item_id = rows.first().find('select').eq(0).attr('name', 'items['+ counter + '][item_id]');

            var qnt=rows.first().find('.qnt').attr('name', 'items['+ counter + '][quantity]');
            var price=rows.first().find('.price').attr('name', 'items['+ counter + '][unit_price]');
            var total=rows.first().find('.total').attr('name', 'items['+ counter + '][total_amount]');
            $("#item-data tbody").append(rows.html());
            counter++;
            calculateGrandTotal();
        });

        //item drop down change read only add remove

        $(document).on('change','.item',function(){
            if ($('.item').val()){
                $('.qnt').attr('readonly',false);
            } else {
                $('.qnt').attr('readonly',true);
            }

            // start by setting everything to enabled and disabled
            $('select[name*="item_id"] option').attr('disabled',false);
            // loop each select and set the selected value to disabled in all other selects
            $('select[name*="item_id"]').each(function(){
                var $this = $(this);
                $('select[name*="item_id"]').not($this).find('option').each(function(){
                    if($(this).attr('value') == $this.val())
                        $(this).attr('disabled',true);
                });
            });

    //total price calculation

            var  price=   $('option:selected', this).attr('price');
            $(this).parent().parent().find('.price').val(price);
            $(this).parent().parent().find('.total').val(price);
            calculateGrandTotal();
        });

    //onkeyup calculation with quantity with unit price

        $(document).on('change keyup','input','.qnt',function(){
            var  qnt=   Number($(this).val());
            var  price=   parseFloat($(this).parent().parent().find('.price').val());
            $(this).parent().parent().find('.total').val(price*qnt);
            calculateGrandTotal();
        });

        //remove item from row
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1;
            calculateGrandTotal();
        });
        calculateGrandTotal();
    });

    // total amount calculation
    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();

    }
    //calculation total price
    function calculateGrandTotal() {
        var grandTotal = 0;
        $("table.order-list").find('.total').each(function () {
            grandTotal += +$(this).val();
        });

        $("#grandtotal").val(grandTotal.toFixed(2));
    }


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