<div class="row">
    <div class="col-sm-6">


        <input type="hidden" value="{{$user->id}}" name="customer_id">
        <input type="hidden" value="{{$client_business_type_id}}" name="client_business_type_id">
        <input type="hidden" value="{{$invoiceDetails[$user->id]['invoice_details']['customer_group_id']}}" name="customer_group_id">

        <div class="form-group">

            {!! Html::decode( Form::label('ndate',' Publish Date   <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}
            <div class="col-sm-9">
                <div data-date="{{date('Y-m-d')}}T15:25:00Z" class="input-group date form_datetime-adv">
                    {!! Form::text('publish_date',$invoiceDetails[$user->id]['invoice_details']['publish_date'] ,['class'=>'form-control','size'=>'16','required' ]) !!}
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                    </div>
                </div>
                {{--<span class="help-block"> Select Expire Date </span>--}}
            </div>
        </div>
        <div class="form-group">

            {!! Html::decode( Form::label('ndate',' Last Payment Date   <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}
            <div class="col-sm-9">
                <div data-date="{{date('Y-m-d')}}T15:25:00Z" class="input-group date form_datetime-adv">
                    {!! Form::text('last_payment_date',$invoiceDetails[$user->id]['invoice_details']['last_payment_date'],['class'=>'form-control','size'=>'16','required' ]) !!}
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                    </div>
                </div>
                {{--<span class="help-block"> Select Expire Date </span>--}}
            </div>
        </div>
        <div class="form-group">

            {!! Html::decode( Form::label('ndate',' Notification Date   <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}
            <div class="col-sm-9">
                <div data-date="{{date('Y-m-d')}}T15:25:00Z" class="input-group date form_datetime-adv">
                    {!! Form::text('notification_date',$invoiceDetails[$user->id]['invoice_details']['notification_date'],['class'=>'form-control','size'=>'16','required' ]) !!}
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                    </div>
                </div>
                {{--<span class="help-block"> Select Expire Date </span>--}}
            </div>
        </div>

        <div class="form-group">
            {!! Html::decode(  Form::label('notification_method','Notification Method<sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label']) )!!}
            <div class="col-sm-9">
                <div class="iconic-input radios" style="padding-top: 5px;">
                    @if($invoiceDetails[$user->id]['invoice_details']['notification_method'] == 'Email')
                        <label class="label_radio r_on crposition" for="radio-01"  >
                            {!! Form::radio('notification_method','Email',null,['checked'] ) !!}Email
                            {!! Form::radio('notification_method','SMS',null,[]) !!}SMS
                            {!! Form::radio('notification_method','Both',null,[]) !!}Both

                        </label>
                    @elseif(  $invoiceDetails[$user->id]['invoice_details']['notification_method'] == 'SMS')
                        <label class="label_radio r_off crposition" for="radio-02">
                            {!! Form::radio('notification_method','Email',null,[] ) !!}Email
                            {!! Form::radio('notification_method','SMS',null,['checked']) !!}SMS
                            {!! Form::radio('notification_method','Both',null,[]) !!}Both

                        </label>
                    @else
                        <label class="label_radio r_off crposition" for="radio-02">
                            {!! Form::radio('notification_method','Email',null,[] ) !!}Email
                            {!! Form::radio('notification_method','SMS',null,[]) !!}SMS
                            {!! Form::radio('notification_method','Both',null,['checked']) !!}
                            Both
                        </label>
                    @endif

                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="bootstrap snippet">
            <div class="panel-body inf-content">


                        <div class="table-responsive">
                            <table class="table table-condensed table-responsive table-user-information">
                                <tbody>

                                <tr>
                                    <td>
                                        <strong>
                                            <i class="fa fa-user  text-primary"></i>
                                            Name
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        {{$user->name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>
                                            <i class="fa fa-envelope-o"></i>
                                            Email
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        {{$user->email}}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>
                                            <i class="fa fa-phone"></i>
                                            Mobile
                                        </strong>
                                    </td>
                                    <td class="text-primary">
                                        {{$user->phone}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                </div>
            </div>
        </div>
    </div>
</div>


    <div class="row clearfix">
        <div class="col-md-12 column">
            <table id="item-data" class="table table-bordered table-hover table order-list">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Quantity</td>
                    <td>Unit Price</td>
                    <td>Total</td>

                </tr>
                </thead>
                <tbody>
              @foreach($invoiceDetails[$user->id]['invoice_details']['items'] as $k=>$item)

                <tr>
                    <td class="col-sm-1" >
                        <a class="deleteRow"> </a>

                        @if($k==0)

                        @else
                            <a type="button" class="ibtnDel btn btn-md btn-danger " ><i class="fa fa-times"></i> </a>

                        @endif
                    </td>
                    <td class="col-sm-3" >
                        <select name='items[{{$k}}][item_id]' class="form-control items_lists item" id="i0">
                            <option>Select Item</option>
                            @foreach($all_items as  $v)
                                <option @if($v->id == $item['item_id']) selected @endif value="{{$v->id}}" price="{{ $v->price }}">{{$v->name}} </option>
                            @endforeach

                        </select>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" value="{{$item['quantity']}}" min="1" step="any" name='items[{{$k}}][quantity]'  class="form-control qnt" placeholder="Quantity"/>
                    </td>
                    <td class="col-sm-2">
                        <input type="text" id="p0" value="{{$item['unit_price']}}" name='items[{{$k}}][unit_price]'  class="form-control price" readonly placeholder="Unit Price"/>

                    </td>

                    <td class="col-sm-3">
                        {{--<span> ৳ </span> --}}
                        <input type="text" name='items[{{$k}}][total_amount]' value="{{$item['total_amount']}}"  class="form-control total" readonly placeholder="Total"/>
                    </td>

                </tr>
              @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td class="col-sm-1" style="border: none;">

                    </td>
                    <td class="col-sm-3" style="border: none;">
                    </td>
                    <td class="col-sm-2" style="border: none;">
                    </td>
                    <td class="col-sm-2">
                        Total Amount
                    </td>

                    <td class="col-sm-3 ">
                        <input type="text" readonly  id="grandtotal" name="total_amount" class="form-control">
                    </td>

                </tr>
                <tr>
                    <td class="col-sm-1" style="border: none;">

                    </td>
                    <td class="col-sm-3" style="border: none;">
                    </td>
                    <td class="col-sm-2" style="border: none;">
                    </td>
                    <td class="col-sm-2 ">
                        Select Discount
                    </td>
                    <td class="col-sm-3 ">
                        @if(isset($discount_list))

                                        <select class="form-control" name="discount_id" >
                                            <option value=" ">No Discount</option>
                                            @foreach($discount_list as $v)
                                                <option @if($invoiceDetails[$user->id]['invoice_details']['discount_id'] == $v->id) selected @endif value="{{ $v->id }}" >{{ $v->title }} -   {{$v->value}} @if($v->type=="Percentage") % @endif  </option>
                                            @endforeach
                                        </select>

                        @endif
                    </td>

                </tr>
                <tr>

                    <td colspan="5" style="text-align: left;">

                        <button type="button" class="btn btn-lg btn-block btn-primary" id="addrow"  data-id="{{count($invoiceDetails[$user->id]['invoice_details']['items'])}}" ><i class="fa fa-plus-circle"></i>   Add Row</button>


                    </td>
                </tr>
                <tr></tr>
                </tfoot>
            </table>


        </div>
    </div>
