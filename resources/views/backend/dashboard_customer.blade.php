@extends('layouts.backend.master')
@section('content')
    <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol terques">
                    <i class="fa fa-file-text"></i>
                </div>
                <div class="value">
                    <h1 class="countPaid">
                        0
                    </h1>
                    <p>Paid Invoice</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="fa fa-file-text"></i>
                </div>
                <div class="value">
                    <h1 class="countUnpaid">
                        0
                    </h1>
                    <p>Unpaid Invoice</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="fa fa-money"></i>
                </div>
                <div class="value">
                    <h1 class="paidAmount">
                      0
                    </h1>
                    <p>Paid Amount</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-money"></i>
                </div>
                <div class="value">
                    <h1 class="unPaidAmount">
                      0
                    </h1>
                    <p>UnPaid Amount</p>
                </div>
            </section>
        </div>
    </div>
    <!--state overview end-->
@endsection
@push('css')

@endpush
@push('js')
    {{--<script src="{{ asset('js/count.js') }}"></script>--}}
    <script>
        function countPaidInvoice(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countPaid'),
                run_count = 1,
                int_speed = 24;

            var int = setInterval(function() {
                if(run_count < div_by){
                    $display.text(speed * run_count);
                    run_count++;
                } else if(parseInt($display.text()) < count) {
                    var curr_count = parseInt($display.text()) + 1;
                    $display.text(curr_count);
                } else {
                    clearInterval(int);
                }
            }, int_speed);
        }
        var  totalPaidInvoice="{{$total_paid}}";
        countPaidInvoice(totalPaidInvoice);

        function countUnPaidInvoice(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countUnpaid'),
                run_count = 1,
                int_speed = 24;

            var int = setInterval(function() {
                if(run_count < div_by){
                    $display.text(speed * run_count);
                    run_count++;
                } else if(parseInt($display.text()) < count) {
                    var curr_count = parseInt($display.text()) + 1;
                    $display.text(curr_count);
                } else {
                    clearInterval(int);
                }
            }, int_speed);
        }
        var  totalunPaidInvoice="{{$total_unpaid}}";
        countUnPaidInvoice(totalunPaidInvoice);


        function TotalpaidAmount(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.paidAmount'),
                run_count = 1,
                int_speed = 24;

            var int = setInterval(function() {
                if(run_count < div_by){
                    $display.text(speed * run_count);
                    run_count++;
                } else if(parseInt($display.text()) < count) {
                    var curr_count = parseInt($display.text()) + 1;
                    $display.text(curr_count);
                } else {
                    clearInterval(int);
                }
            }, int_speed);
        }
        var paidAmount="{{$total_paidAmount}}";
        TotalpaidAmount(parseFloat(paidAmount));

        function unpaidAmountCount(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.unPaidAmount'),
                run_count = 1,
                int_speed = 24;

            var int = setInterval(function() {
                if(run_count < div_by){
                    $display.text(speed * run_count);
                    run_count++;
                } else if(parseInt($display.text()) < count) {
                    var curr_count = parseInt($display.text()) + 1;
                    $display.text(curr_count);
                } else {
                    clearInterval(int);
                }
            }, int_speed);
        }
        var  unpaidAmountValue="{{$total_unpaidAmount}}";
       unpaidAmountCount(unpaidAmountValue);

    </script>
@endpush