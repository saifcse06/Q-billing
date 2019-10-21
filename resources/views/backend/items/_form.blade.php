

<div class="form-group">
    {!! Html::decode(  Form::label('business_type','Business Type  <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::select('business_type_id',$allBusinessType,null,['class'=>'form-control','required','placeholder'=>'Select Business Type ']) !!}
        </div>
    </div>
</div>


<div class="form-group">
    {!! Html::decode(  Form::label('name','Name <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'Enter name here']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('price' ,'Price <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::number('price',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter Price','step'=>"0.01",'required']) !!}
    </div>
</div>



<div class="form-group">
    {!! Html::decode(  Form::label('details','Details',['class'=>'col-lg-2 col-sm-2 control-label'])) !!}
    <div class="col-lg-10">
        {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Enter Details Here','rows'=>3]) !!}
    </div>
</div>


<div class="form-group">
    {!! Html::decode(  Form::label('Status','Status <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input radios" >
            <label class="label_radio r_on crposition" for="Active"  >
                {!! Form::radio('status','Active',null,['id'=>'Active']) !!}
                Active
            </label>
            <label class="label_radio r_off crposition" for="Inactive">
                {!! Form::radio('status','Inactive',null,['id'=>'Inactive']) !!}
                Inactive
            </label>


        </div>

    </div>
</div>




