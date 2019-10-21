@extends('layouts.backend.master')
@section('content')
    <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol terques">
                    <i class="fa fa-user"></i>
                </div>
                <div class="value">
                    <h1 class="countEmployee">
                       0
                    </h1>
                    <p>Employee</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="fa fa-briefcase"></i>
                </div>
                <div class="value">
                    <h1 class="clientBusiness">
                        0
                    </h1>
                    <p>Business</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="value">
                    <h1 class=" count3">
                        0
                    </h1>
                    <p>Create Invoice</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="value">
                    <h1 class="countUnpaidInvoice">
                        0
                    </h1>
                    <p>Unpaid Invoice</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="fa fa-dollar"></i>
                </div>
                <div class="value">
                    <h1 class="countPaidAmount">
                        0
                    </h1>
                    <p>Paid Amount</p>
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
        function countUpEmployee(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countEmployee'),
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
        var  totalEmployee="{{$total_employee}}"
        countUpEmployee(totalEmployee);

        function countUpTotalClientBusiness(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.clientBusiness'),
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
        var totalClientBusiness="{{$total_client_business}}";
        countUpTotalClientBusiness(totalClientBusiness);

        function countUpInvoice(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.count3'),
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
        var totalInvoice="{{$total_invoice_create}}"
        countUpInvoice(totalInvoice);

        function countUpcountUnpaidInvoice(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countUnpaidInvoice'),
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
        var unpaidinvoice="{{$uppaidInvoice}}";
        countUpcountUnpaidInvoice(unpaidinvoice)

        function countPaidAmount(count)
        {
            var div_by = 100,
                speed = Math.round(count / div_by),
                $display = $('.countPaidAmount'),
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
        var paidamount="{{$paidAmount}}";
        countPaidAmount(paidamount)
    </script>
@endpush