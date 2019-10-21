<div class="form-group">
    {!! Html::decode(  Form::label('type','Type <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::select('type',['Admin'=>'Admin','Client'=>'Client','Customer'=>'Customer'],null,['class'=>'form-control','required','placeholder'=>'Select User Type ','required']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('name','Name <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'Enter name here','required']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Html::decode(  Form::label('phone','Phone <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        {!! Form::number('phone',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter phone number here','required']) !!}
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
    {!! Form::label('address','Address',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
    <div class="col-lg-10">
        {!! Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Enter address here','rows'=>3]) !!}
    </div>
</div>
<div class="form-group">
    {!! Html::decode( Form::label('file','Profile Photo',['class'=>'col-lg-2 col-sm-2 control-label','required']) )!!}
    <div class="col-lg-10">

        <div class="fileupload fileupload-new" data-provides="fileupload">
                    <span class="btn btn-white btn-file">
                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Profile Photo</span>
                    <span class="fileupload-exists">
                        <i class="fa fa-undo"></i> Change</span>
                        {!! Form::file('profile_picture',null,['class'=>'default']) !!}
                    </span>
            <span class="fileupload-preview" style="margin-left:5px;"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
        </div>

    </div>
</div>
{{--customer not need to this field --}}
<div id="notCustomer">
    <div class="form-group">
        {!! Html::decode(  Form::label('nid','NID',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
        <div class="col-lg-10">
            <p class="error"></p>
            <div class="iconic-input right">

                {!! Form::text('nid',null,['class'=>'form-control','placeholder'=>'Enter NID here']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(  Form::label('passport','Passport',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
        <div class="col-lg-10">
            <div class="iconic-input right">

                {!! Form::text('passport',null,['class'=>'form-control','placeholder'=>'Enter Passport Number here']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(  Form::label('birth_certificate','Birth Certificate',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
        <div class="col-lg-10">
            <div class="iconic-input right">

                {!! Form::text('birth_certificate',null,['class'=>'form-control','placeholder'=>'Enter Birth Certificate Id here']) !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Html::decode(  Form::label('type','Status <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
    <div class="col-lg-10">
        <div class="iconic-input right">

            {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive'],null,['class'=>'form-control','required','placeholder'=>'Select Status','required']) !!}

        </div>

    </div>
</div>

@if(!isset($admin))
    <div class="form-group">
        {!! Html::decode( Form::label('password','Password <sup> <span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
        <div class="col-lg-10 passwordDiv">
            <div class="iconic-input right">

                {!! Form::password('password',['class'=>'form-control password','required','placeholder'=>'Enter password here']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(  Form::label('password_confirmation','Confirm Password<sup><span class="red">*</span></sup>',['class'=>'col-lg-2 col-sm-2 control-label']) )!!}
        <div class="col-lg-10 ">
            <div class="iconic-input right">

                {!! Form::password('password_confirmation',['class'=>'form-control cPassword','required','placeholder'=>'Re-enter password here']) !!}
            </div>

        </div>
    </div>
@endif