<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{!! asset('img/adn_favicon.png') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>  QUICK BILLING</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/bootstrap-reset.css') !!}" rel="stylesheet">
    <!--external css-->
    <link href="{!! asset('assets/font-awesome/css/font-awesome.css') !!}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{!! asset('css/style.css" rel="stylesheet') !!}">
    <link href="{!! asset('css/style-responsive.css') !!}" rel="stylesheet" />
    <link href="{!! asset('assets/toastr-master/toastr.css') !!}" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{!! asset('js/html5shiv.js') !!}"></script>
    <script src="{!! asset('js/respond.min.js') !!}"></script>
    <![endif]-->
    <style>
        .form-signin h2.form-signin-heading{
            background: none!important;
            color: black!important;
        }
        .formwidth{
            max-width: 50%!important;
        }
        .red{
            color: red;
        }
    </style>
</head>
<body>
<div class="login-body" style="text-align: center;">
    <div class="container">

        @yield('content')
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{!! asset('js/jquery.js') !!}"></script>
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.css') }}" />

    <script type="text/javascript" src="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
    <script src="{!! asset('assets/toastr-master/toastr.js') !!}"></script>
    <!--toastr js-->
    <!--toastr js-->
    @include('layouts.backend._messages')
    <script>
       // passport ,birth,Nid any one validation
       @if(url()->current()==route('client.registration') )
        $('#userform').on('submit', function() {
            if ($.trim($("[name=nid]").val()) == '' && $.trim($("[name=birth_certificate]").val()) == '' && $.trim($("[name=passport]").val()) == '') {
                $(".error").replaceWith("<h5 style='color: red;'><i>NID or Passport or Birth Certificate is Required </i></h5>");
                event.preventDefault();
            }
            if ($.trim($("[name=nid]").val()) != '' || $.trim($("[name=birth_certificate]").val()) != '' || $.trim($("[name=passport]").val()) != '') {
                $("#userform").submit();
            }

        });

        @endif
     //   password match validation message

        $('.btnCreate').click(function () {
            var password= $('.password').val();
            var cPassword= $('.cPassword').val();
            $('.passwordMessageDiv').remove();
            if(password != cPassword)
            {
                $('.passwordDiv').append('<i class="passwordMessageDiv red">Password mismatch</i>')
                event.preventDefault();
            }
        });

    </script>
</div>
</body>
</html>
