@extends('layouts.backend.master')
@section('content')
    <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-group"></i>

                </div>
                <div class="value">
                    <h1 class="countAdmin">
                        0
                    </h1>
                    <p>Admin</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol terques">
                    <i class="fa fa-group"></i>
                </div>
                <div class="value">
                    <h1 class="countClient">
                        0
                    </h1>
                    <p>Clients</p>
                </div>
            </section>
        </div>

        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="fa fa-group"></i>
                </div>
                <div class="value">
                    <h1 class="countCustomer">
                        0
                    </h1>
                    <p>Only Customer</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-money"></i>
                </div>
                <div class="value">
                    <h1 class="countPayAmount">
                        0
                    </h1>
                    <p>Transaction Amount</p>
                </div>
            </section>
        </div>

        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="fa fa-times"></i>
                </div>
                <div class="value">
                    <h1 class="failedTransaction">
                        0
                    </h1>
                    <p>Transaction Failed</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
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
    </div>
    <!--state overview end-->
@endsection
@push('css')

@endpush
@push('js')
    {{--<script src="{{ asset('js/count.js') }}"></script>--}}
    <script>
        function countUpClient(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countClient'),
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
        var  totalClient="{{$total_client}}"
        countUpClient(totalClient);

        function countUpTotalAdmin(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countAdmin'),
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
        var totalAdmin="{{$total_admin}}";
        countUpTotalAdmin(totalAdmin);

        function countUpCustomer(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countCustomer'),
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
        var totalCustomer="{{$total_customer}}"
        countUpCustomer(totalCustomer);

        function countUpTransaction(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countPayAmount'),
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
        var totalTransaction="{{$total_transaction}}";
        countUpTransaction(totalTransaction)

        function countUpUnpaid(count)
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
        var unpaidInvoice="{{$uppaidInvoice}}";
        countUpUnpaid(unpaidInvoice)

        function countUpPaid(count)
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
        var PaidInvoice="{{$paidInvoice}}";
        countUpPaid(PaidInvoice)
    </script>
@endpush