@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-lg-10">
            <section class="panel">
                <header class="panel-heading">
                    Create  Invoice
                </header>
                <div class="panel-body">
                    @include('layouts.backend._validationErrorMessages')
                    {!! Form::open(['route'=>'invoice.store','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) !!}
                    @include('backend.invoice._form')


                    <div class="form-group">
                        <div class="col-sm-12">

                            {!! Form::submit('Preview',['class'=>'btn btn-success showPrevious pull-right']) !!}
                            <a href="{{ route('invoice.index') }}" class="btn btn-warning pull-left"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    {{--table copy--}}
                    <table id="new-row-model" style="display: none">
                        <tbody>
                        <tr>
                            <td class="col-sm-1">
                                <a class="deleteRow"> </a>
                                <a type="button" class="ibtnDel btn btn-md btn-danger " ><i class="fa fa-times"></i> </a>

                            </td>
                            <td class="col-sm-3"  >

                                <?php $item=request()->old('client_business_type_id'); ?>
                                @if(isset($item))
                                    <?php $items= App\ItemsModel::where('status','Active')->where('client_id', Auth::user()->id)->where('business_type_id',$item)->select("name","id","price")->get()?>
                                    <select name='items[0][item_id]'  class="form-control items_lists item" id="i0">
                                        <option>Select Item</option>
                                        @foreach($items as $i=>$itemValue)
                                            <option  value="{{$itemValue->id}}" price="{{ $itemValue->price }}">{{$itemValue->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name='items[0][item_id]'  class="form-control items_lists item" id="i0">
                                        <option>Select Item</option>

                                    </select>
                                @endif
                            </td>
                            <td class="col-sm-2"  >
                                <input type="number" step="any" value="1" min="1" name='items[0][quantity]' class="form-control qnt" placeholder="Quantity"/>

                            </td>
                            <td class="col-sm-2">
                                <input type="text" id="p0"   name='items[0][unit_price]'  class="form-control price" readonly placeholder="Unit Price"/>
                            </td>

                            <td class="col-sm-3">
                                <input type="text" name='items[0][total_amount]'  class="form-control total" readonly placeholder="Total"/>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

{{--@include('backend.invoice._invoicePreviewModal')--}}
@endsection

@push('css')
    <style>
        .crposition {
            padding-right: 10px;
            float: left;
        }
        .remove thead > tr > td{
            width: 20px!important;
        }

    </style>
    <link href="{!! asset('assets/select2/css/select2.min.css') !!}" rel="stylesheet" />
    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-datepicker/css/datepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-datetimepicker/css/datetimepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-datetimepicker/css/datetimepicker.css') }}" />

@endpush

@push('js')
    <script src="{!! asset('assets/select2/js/select2.min.js') !!}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-daterangepicker/moment.min.js') }}"></script>
    @include('backend.invoice._script')

@endpush