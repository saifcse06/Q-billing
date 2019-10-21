<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword" content="ADN Digital">
<link rel="shortcut icon" href="{{ asset('img/adn_favicon.png') }}">

<title>{{ isset($title)?$title:'ADN Digital' }}</title>

<!-- Bootstrap core CSS -->
<link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('css/bootstrap-reset.css') !!}" rel="stylesheet">
<!--external css-->
<link href="{!! asset('assets/font-awesome/css/font-awesome.css') !!}" rel="stylesheet" />
<link href="{!! asset('assets/toastr-master/toastr.css') !!}" rel="stylesheet" type="text/css" />


<!-- Custom styles for this template -->

<link href="{!! asset('css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('css/style-responsive.css') !!}" rel="stylesheet" />
<link href="{!! asset('css/custom.css') !!}" rel="stylesheet">

@stack('css')
<style>
    /*footer fixed design*/
    .site-footer {
        position: fixed;
        width: 100%;
        bottom: 0px;
    }
    .adv-table .dataTables_filter label input{
        margin-top: -35px;
        -webkit-appearance: button!important;
    }
    .dataTables_wrapper .dataTables_filter{
        text-align: left;
    }
    .adv-table .dataTables_length select{
        padding: 1px 0px !important;
    }
</style>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="{!! asset('js/html5shiv.js') !!}"></script>
<script src="{!! asset('js/respond.min.js') !!}"></script>
<![endif]-->
<!-- Imoportant JS -->
<script src="{!! asset('js/jquery.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<!-- Imoportant JS -->