
<div class="form-group">
    {!! Html::decode(  Form::label('name','Customer Group <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">
            {!! Form::select('group_id',$allcustomergroup,null,['class'=>'form-control','required','placeholder'=>'Select Business Type']) !!}

        </div>
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('details','Customer List <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label'])) !!}
    <div class="col-lg-10">
        <div class="iconic-input right">
            <select name="customer_id[]" class="form-control selectCustomer" multiple></select>
{{--            {!! Form::select('customer_id[]',$alluser,null,['class'=>'form-control selectCustomer','required','multiple']) !!}--}}
        </div>
    </div>
</div>


