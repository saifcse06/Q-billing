
<div class="form-group">
    {!! Html::decode(  Form::label('business_type','Business Type  <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">
            @if(isset($discoutnedit) && $discoutnedit->use >0)

            {!! Form::select('client_business_type_id',$allBusinessType,null,['class'=>'form-control','required','placeholder'=>'Select Business Type','readonly','disable']) !!}
          @else
                {!! Form::select('client_business_type_id',$allBusinessType,null,['class'=>'form-control','required','placeholder'=>'Select Business Type']) !!}

            @endif
        </div>
    </div>
</div>


<div class="form-group">
    {!! Html::decode(  Form::label('title','Title <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::text('title',null,['class'=>'form-control','required','placeholder'=>'Enter Title']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Html::decode( Form::label('edate',' Expire Date   <sup> (<span class="red">*</span>)</sup>',['class'=>'col-lg-2 col-sm-2 control-label'])) !!}
    <div class="col-lg-6 col-xs-12">

        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{date('d-m-Y')}}"  class="input-append default-date-picker date dpYears">

            {!! Form::text('expire_date',null,['class'=>'form-control expiredate','size'=>'16' ]) !!}
            <span class="input-group-btn add-on">
        <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
            </span>
        </div>
         <span class="help-block">  <input type="checkbox" class="notexpiredate" name="not_expire_date" value="{{date('2030-12-31')}}">Unlimited </span>
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('Type','Type <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input radios" >
            @if(isset($discoutnedit) && $discoutnedit->use >0)
            <label class="label_radio r_on crposition" for="Fixed"  >
                {!! Form::radio('type','Fixed',null,['id'=>'Fixed']) !!}
                Fixed
            </label>
            <label class="label_radio r_off crposition" for="Percentage">
                {!! Form::radio('type','Percentage',null,['checked','id'=>'Percentage']) !!}
                Percentage
            </label>
            @else
                <label class="label_radio r_on crposition" for="Fixed"  >
                    {!! Form::radio('type','Fixed',null,['id'=>'Fixed','readonly','disable']) !!}
                    Fixed
                </label>
                <label class="label_radio r_off crposition" for="Percentage">
                    {!! Form::radio('type','Percentage',null,['checked','id'=>'Percentage','readonly','disable']) !!}
                    Percentage
                </label>
            @endif
        </div>

    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('value' ,'Value <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        @if(isset($discoutnedit) && $discoutnedit->use >0)
        {!! Form::number('value',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter Discount Value','step'=>"0.01",'required','readonly','disable']) !!}
            @else
            {!! Form::number('value',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter Discount Value','step'=>"0.01",'required']) !!}

        @endif
    </div>
</div>







