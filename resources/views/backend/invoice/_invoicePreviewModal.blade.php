@extends('layouts.backend.master')
@section('content')
    <!-- Modal -->
    <div class="container"  >
        <div class="row"  >

                    <section class="panel panel-primary">
                        <header class="panel-heading " >
                            Invoice Preview
                            <div class="pull-right">

                            </div>

                        </header>
                        <div class="panel-body">

                    <div class="row">
                        <div class="col-md-offset-1 col-md-11">
                            <a href="{{route('invoice.create')}}" class="btn btn-warning btn-lg pull-left">Cancel</a>
                            <form action="{{route('invoice.save_all')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="bnt btn-info btn-lg pull-right" > Save Invoice</button>
                            </form>
                            <!-- invoice start-->
                            <section>
                                <div class="panel panel-primary">
                                    <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                                    <div class="panel-body">

                                        @foreach($invoiceDetails as $k=>$v)

                                            <div class="row invoice-list">
                                                <div class="text-center corporate-id">
                                                    @if($v['business_type']['logo'])
             <img src="{{asset('/project_files/client_logo')}}/{{$v['business_type']['logo']}}" alt="{{$v['business_type']['name']}}" height="50px">

                                                    @else
                                                        <img src="{{ asset('img/logo.png') }}" style="width: 100px;height: 50px">
                                                    @endif

                                                </div>
                                                <div class="col-lg-4 col-sm-4">
                                                    <h4>BILLING ADDRESS</h4>
                                                    <p>
                                                        {{Auth::user()->name}}<br>
                                                    <address style="margin-bottom:5px;">{{Auth::user()->address}}</address>
                                                    Tel: {{Auth::user()->phone}}
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 col-sm-4">
                                                    <h4>SHIPPING ADDRESS</h4>
                                                    <p>

                                                        {{$v['customer_info']->name}}<br>
                                                    <address style="margin-bottom:5px;">{{$v['customer_info']->address}}</address>
                                                    Cell: {{$v['customer_info']->phone}}<br>
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 col-sm-4">
                                                    <h4>INVOICE INFO</h4>
                                                    <ul class="unstyled">
                                                        <li>Invoice Number		: <strong>{{$v['invoice_no']}}</strong></li>
                                                        <li>Invoice Date		: {{\Carbon\Carbon::now()->format('jS \o\f F, Y ')}}</li>
                                                        <li>Due Date			: {{\Carbon\Carbon::parse($v['invoice_details']['last_payment_date'])->format('jS \o\f F, Y g:i a')}}</li>
                                                        <li>Invoice Status		: UnPaid</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item</th>
                                                    <th class="hidden-phone">Description</th>
                                                    <th class="">Unit Cost</th>
                                                    <th class="">Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sub_total=0.00; ?>
                                                @foreach($v['invoice_details']['item_all'] as $k=>$i)
                                                    <?php
                                                    $total=$i['price'] * (int) $v['invoice_details']['items'][$k]['quantity'];
                                                    ?>
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$i['name']}}</td>
                                                        <td class="hidden-phone"> {{$i['details']}}</td>
                                                        <td class="" style="text-align: right;">৳ {{number_format($v['invoice_details']['items'][$k]['unit_price'],2)}}</td>
                                                        <td>{{$v['invoice_details']['items'][$k]['quantity'] }}</td>
                                                        <td style="text-align: right;">৳ {{ number_format($total,2) }} </td>
                                                    </tr>
                                                    <?php $sub_total+=$total; ?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div>

                                                </div>

                                                <div class="col-lg-4 invoice-block pull-right">
                                                    <table style="float: right;" class="table table-striped table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <td style="text-align: left;" class="col-6">
                                                                <strong>Sub - Total amount :</strong>
                                                            </td>
                                                            <td style="text-align: right;" class="col-6">

                                                                ৳ {{  number_format($sub_total,2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;" class="col-6">
                                                                <strong>Discount <b>(-)</b> <i>@if($v['discount']['type']=="Percentage")  {{$v['discount']['value']}}%  @endif</i> :</strong>
                                                            </td>
                                                            <td style="text-align: right;" class="col-6">
                                                                <?php
                                                                if($v['discount']['type']=="Percentage"){
                                                                    $discount=$sub_total*($v['discount']['value']/100);
                                                                }elseif($v['discount']['type']=="Fixed"){
                                                                    $discount=$v['discount']['value'];
                                                                }elseif($v['discount']['value']==null){
                                                                    $discount=0.00;
                                                                }

                                                                ?>

                                                                ৳ {{ number_format($discount,2) }}

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;" class="col-6">
                                                                <strong>VAT  {{ $v['business_type']['tax'] }}<i>%</i>:</strong>
                                                            </td>
                                                            <td style="text-align: right;" class="col-6">
{{--                                                                {!! dd($discount) !!}--}}
                                                                <?php $vat=(($sub_total-$discount)*$v['business_type']['tax'])/100; ?>
                                                                ৳ {{  number_format($vat,2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;" class="col-6">
                                                                <strong>TDR  <i>
                                                                        @if($v['business_type']['tdr_type']=="Percentage")  {{$v['business_type']['total_tdr']}}%  @endif</i>:</strong>
                                                            </td>
                                                            <td style="text-align: right;" class="col-6">
                                                                {{--                                                                {!! dd($discount) !!}--}}
                                                                <?php $total=(($sub_total-$discount)+$vat); ?>
                                                                <?php
                                                                if($v['business_type']['tdr_type']=="Percentage"){
                                                                    $totalTDR=$total*($v['business_type']['total_tdr']/100);
                                                                }elseif($v['business_type']['tdr_type']=="Fixed"){
                                                                    $totalTDR=$v['business_type']['total_tdr'];
                                                                }elseif($v['business_type']['total_tdr']==null){
                                                                    $totalTDR=0.00;
                                                                }

                                                                ?>
                                                                ৳ {{  number_format($totalTDR,2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: left;" class="col-6">
                                                                <strong>Grand Total:</strong>
                                                            </td>
                                                            <td style="text-align: right;" class="col-6">

                                                                ৳ {{ number_format(($sub_total-$discount)+$vat+$totalTDR,2)}}


                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <div class="text-center invoice-btn">
                                                <a class="btn btn-primary btn-lg" href="{{route('invoice_preview.edit',$v)}}"><i class="fa fa-edit"></i> Edit Invoice </a>
                                            </div>

                                            <hr>
                                        @endforeach

                                        {{--<div class="text-center invoice-btn">--}}
                                        {{--<a class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Invoice </a>--}}
                                        {{--<a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>--}}
                                        {{--</div>--}}
                                    </div>

                                </div>
                            </section>
                            <!-- invoice end-->
                            <a href="{{route('invoice.create')}}" class="btn btn-warning btn-lg pull-left">Cancel</a>

                            <form action="{{route('invoice.save_all')}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="bnt btn-info btn-lg pull-right" > Save Invoice</button>
                            </form>
                        </div>
                    </div>

                </div>
                {{--<div class="modal-footer">--}}
                {{--<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>--}}
                {{--<button class="btn btn-warning" type="button"> Confirm</button>--}}
                {{--</div>--}}
                    </section>
        </div>
    </div>
    <!-- modal -->
@endsection
@push('css')


@endpush

@push('js')


@endpush