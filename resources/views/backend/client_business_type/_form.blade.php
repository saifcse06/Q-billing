<div class="form-group">
    {!! Html::decode(  Form::label('name','Name <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'Enter name here']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('contact_name','Contact Name <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::text('contact_name',null,['class'=>'form-control','required','placeholder'=>'Enter Contact Name']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('phone','Phone <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::tel('phone_number',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter phone number here','required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('email','Email <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label'])) !!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter email here','required']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('address','Address <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label'])) !!}
    <div class="col-lg-10">
        {!! Form::textarea('address',null,['class'=>'form-control','required','placeholder'=>'Enter address here','rows'=>3]) !!}
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('tax','Tax % <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::number('tax',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter Tax Amount %','step'=>"0.01",'required']) !!}
    </div>
</div>


{{--<div class="form-group">--}}
    {{--{!! Html::decode(  Form::label('type','TDR Type <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}--}}
    {{--<div class="col-lg-10">--}}
        {{--<div class="iconic-input right">--}}

            {{--{!! Form::select('tdr_type',['Fixed'=>'Fixed','Percentage'=>'Percentage'],null,['class'=>'form-control','required','placeholder'=>'Select TDR Type ']) !!}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group">
    {!! Html::decode(  Form::label('customerType','TDR Type <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input radios" >
            <label class="label_radio r_on crposition" for="fixed"  >
                {!! Form::radio('tdr_type','Fixed',null,['id'=>'fixed']) !!}
                Fixed
            </label>
            <label class="label_radio r_off crposition" for="Percentage">
                {!! Form::radio('tdr_type','Percentage',null,['checked','id'=>'Percentage']) !!}
                Percentage
            </label>

        </div>

    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('tax','My TDR<sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::number('my_tdr',null,['class'=>'form-control my_tdr','min'=>'0','placeholder'=>'Enter My TDR Amount','required','step'=>"0.01"]) !!}
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('tax','Service TDR <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::number('services_tdr',null,['step'=>'0.01','class'=>'form-control services_tdr','min'=>'0','placeholder'=>'Enter Service TDR Amount','required','step'=>"0.01"]) !!}
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('tax','Total TDR <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::number('total_tdr',null,['class'=>'form-control total_tdr','min'=>'0','placeholder'=>'Total TDR Amount','required','step'=>"0.01",'readonly']) !!}
    </div>
</div>

<div class="form-group">
    {!! Html::decode( Form::label('logo','Logo <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">

        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Logo</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>

                                                    {!! Form::file('logo',null,['class'=>'default','required']) !!}
                                                </span>
            <span class="fileupload-preview" style="margin-left:5px;"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
            @if(isset($clientbusiness))
                <img src="{{ asset('project_files/client_logo') }}/{{$clientbusiness->logo}}" style="width: 100px;height: 50px">
            @endif
        </div>



    </div>
</div>