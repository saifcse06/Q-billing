

{!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'Enter name here','required','autofocus']) !!}
{!! Form::number('phone',null,['class'=>'form-control','min'=>'0','placeholder'=>'Enter phone number here','required','autofocus']) !!}
{!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter email here','autofocus']) !!}
{!! Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Enter address here','rows'=>3]) !!}
<br>
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

@if(url()->current()==route('client.registration') )
    {!! Form::text('nid',null,['class'=>'form-control','placeholder'=>'Enter NID here','autofocus']) !!}
    <p class="error"></p>
    {!! Form::text('passport',null,['class'=>'form-control','placeholder'=>'Enter Passport Number here','autofocus']) !!}

    {!! Form::text('birth_certificate',null,['class'=>'form-control','placeholder'=>'Enter Birth Certificate Id here','autofocus']) !!}
@endif

@if(!isset($admin))

    <div class="passwordDiv">
        {!! Form::password('password',['class'=>'form-control password','required','placeholder'=>'Enter password here']) !!}

    </div>
    {!! Form::password('password_confirmation',['class'=>'form-control cPassword','required','placeholder'=>'Re-enter password here']) !!}


@endif