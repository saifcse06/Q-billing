<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            {!! Html::decode(  Form::label('customerType','Customer Type<sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label']) )!!}
            <div class="col-sm-9">
                <div class="iconic-input radio" >


                    <label class="label_radio crposition" for="single"  >
                        {!! Form::radio('c_type','single',null,['id'=>'single']) !!}
                        Single
                    </label>
                    <label class="label_radio crposition" for="group">
                        {!! Form::radio('c_type','group',null,['id'=>'group']) !!}
                        Group
                    </label>

                </div>

            </div>
        </div>



        @if(isset($all_customer_group))
            <div class="form-group" id="groupdiv">
                {!! Html::decode(  Form::label('customerGroup','Select Group <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label']) )!!}
                <div class="col-sm-9">
                    <div class="iconic-input right">
                        {!! Form::select('customer_group_id',$all_customer_group,null,['class'=>'form-control group','required','placeholder'=>'Select Customer Type']) !!}

                    </div>
                </div>
            </div>
        @endif


        <div class="form-group" id="singlediv">
            {!! Html::decode(  Form::label('details','Customer List <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}
            <div class="col-sm-9">
                <div class="iconic-input right">
                    <select name="customer_id[]" class="form-control selectCustomer single" multiple></select>
                </div>
            </div>
        </div>




        <div class="form-group">
            {!! Html::decode(  Form::label('notification_method','Notification Method<sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label']) )!!}
            <div class="col-sm-9">
                <div class="iconic-input radio" >


                    <label class="label_radio r_on crposition" for="radio-01"  >
                        {!! Form::radio('notification_method','Email',null,['id'=>'radio-01','required'] ) !!}
                        Email
                    </label>
                    <label class="label_radio r_off crposition" for="radio-02">
                        {!! Form::radio('notification_method','SMS',null,['id'=>'radio-02','required']) !!}
                        SMS
                    </label>
                    <label class="label_radio r_off crposition" for="radio-03">
                        {!! Form::radio('notification_method','Both',null,['id'=>'radio-03','required']) !!}
                        Both
                    </label>

                </div>

            </div>
        </div>

        @if(isset($all_business_type))
            <div class="form-group">
                {!! Html::decode(  Form::label('businessType','Select Business<sup><span class="red">*</span></sup>',['class'=>'col-sm-3 control-label']) )!!}
                <div class="col-sm-9">
                    <div class="iconic-input right">
                        {!! Form::select('client_business_type_id',$all_business_type,null,['class'=>'form-control','required','placeholder'=>'Select Business Type']) !!}

                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Html::decode( Form::label('ndate',' Publish Date   <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}

            <div class="col-sm-9">
                <div data-date="{{date('Y-m-d')}}T15:25:00Z" class="input-group date form_datetime-adv">
                    {!! Form::text('publish_date',null,['class'=>'form-control','size'=>'16','required' ]) !!}

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode( Form::label('ndate',' Last Payment Date   <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}

            <div class="col-sm-9">
                <div data-date="{{date('Y-m-d')}}T15:25:00Z" class="input-group date form_datetime-adv">
                    {!! Form::text('last_payment_date',null,['class'=>'form-control','size'=>'16','required' ]) !!}

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Html::decode( Form::label('ndate',' Notification Date   <sup> <span class="red">*</span></sup>',['class'=>'col-sm-3 control-label'])) !!}

            <div class="col-sm-9">
                <div data-date="{{date('Y-m-d')}}T15:25:00Z" class="input-group date form_datetime-adv">
                    {!! Form::text('notification_date',null,['class'=>'form-control','size'=>'16','required' ]) !!}

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                    </div>
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
                <td class="remove">#</td>
                <td scope="col">Name</td>
                <td scope="col">Quantity</td>
                <td scope="col">Unit Price</td>
                <td scope="col">Total</td>
            </tr>
            </thead>
            <tbody>
            @if(request()->old('items')!=null)
                @foreach(request()->old('items') as $k=>$itemlist)

                    <tr>
                        <td class="col-sm-1"><a class="deleteRow"> </a>
                            @if($k==0)

                            @else
                                <a type="button" class="ibtnDel btn btn-md btn-danger " ><i class="fa fa-times"></i> </a>

                            @endif

                        </td>
                        <td class="col-sm-3" >
                            <?php $item=request()->old('client_business_type_id'); ?>
                            @if(isset($item))
                                <?php $items= App\ItemsModel::where('status','Active')->where('client_id', Auth::user()->id)->where('business_type_id',$item)->select("name","id","price")->get()?>
                                <select name='items[{{$k}}][item_id]'  class="form-control items_lists item" id="i0">
                                    <option value=" ">Select Item</option>
                                    @foreach($items as $i=>$itemValue)
                                        <option @if($itemlist['item_id'] == $itemValue->id) selected @endif value="{{$itemValue->id}}" price="{{ $itemValue->price }}">{{$itemValue->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name='items[{{$k}}][item_id]'  class="form-control items_lists item" id="i0">
                                    <option>Select Item</option>

                                </select>
                            @endif

                        </td>
                        <td class="col-sm-2">
                            <input type="number" value="{{$itemlist['quantity']}}" min="1" step="any" name='items[{{$k}}][quantity]'  class="form-control qnt" placeholder="Quantity"/>
                        </td>
                        <td class="col-sm-2">
                            <input type="text" id="p0" name='items[{{$k}}][unit_price]'  value="{{$itemlist['unit_price']}}" class="form-control price" readonly placeholder="Unit Price"/>

                        </td>

                        <td class="col-sm-3">
                            {{--<span> ৳ </span> --}}
                            <input type="text" name='items[{{$k}}][total_amount]' value="{{$itemlist['total_amount']}}"  class="form-control total" readonly placeholder="Total"/>
                        </td>

                    </tr>
                @endforeach

            @else
                <tr>
                    <td class="col-sm-1" ><a class="deleteRow"> </a>

                    </td>
                    <td class="col-sm-3" >
                        <select name='items[0][item_id]'  class="form-control items_lists item" id="i0">
                            <option>Select Item</option>
                        </select>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" value="1" min="1" step="any" name='items[0][quantity]'  class="form-control qnt" placeholder="Quantity"/>
                    </td>
                    <td class="col-sm-2">
                        <input type="text" id="p0" name='items[0][unit_price]'  class="form-control price" readonly placeholder="Unit Price"/>

                    </td>

                    <td class="col-sm-3">
                        {{--<span> ৳ </span> --}}
                        <input type="text" name='items[0][total_amount]'  class="form-control total" readonly placeholder="Total"/>
                    </td>

                </tr>
            @endif
            </tbody>
            <tfoot>
            <tr>
                <td class="col-sm-1" style="border: none;">


                </td>

                <td class="col-sm-3" style="border: none;">


                </td>
                <td class="col-sm-2" style="border: none;">


                </td>
                <td class="col-sm-2 col-sm-offset-7">
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
                <td class="col-sm-2 col-sm-offset-7">
                    Select Discount
                </td>
                <td class="col-sm-3 ">
                    <div class="iconic-input right">

                        <?php $item=request()->old('client_business_type_id'); ?>
                        @if(isset($item))
                            <?php $items= App\ClientDiscount::where('status', '!=', 'Used')->where('client_id', Auth::user()->id)->where('client_business_type_id',$item)->select("title","id","type","value")->get();?>
                            <select name='discount_id'  class="form-control" >
                                <option value=" ">Select Discount</option>
                                @foreach($items as $i=>$discountValue)
                                    <option @if(request()->old('discount_id')== $discountValue->id) selected @endif value="{{$discountValue->id}}"  >{{ $discountValue->title }} - {{$discountValue->value}} @if($discountValue->type=="Percentage") % @endif</option>
                                @endforeach
                            </select>
                        @else
                            {!! Form::select('discount_id',[''=>'Select Discount'],null,['class'=>'form-control' ]) !!}
                        @endif
                    </div>
                </td>

            </tr>

            <tr>
                <td colspan="5" style="text-align: left;">
                    <button type="button" class="btn btn-lg btn-block btn-primary" id="addrow"   ><i class="fa fa-plus-circle"></i>   Add Row</button>

                </td>
            </tr>

            <tr></tr>

            </tfoot>
        </table>


    </div>
</div>
