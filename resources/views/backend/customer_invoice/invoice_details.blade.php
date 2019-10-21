@extends('layouts.backend.master')
@section('content')
    <div class="container"  >
        <div class="row"  >
            <section class="panel panel-primary">
                <header class="panel-heading " >
                    Invoice Preview
                </header>
                <div class="panel-body">
                    @include('backend.customer_invoice._invoice_design')
                </div>
            </section>
        </div>
    </div>

@endsection
@push('css')
    <style>
        .valalign{
            text-align: right;
        }
    </style>

@endpush
@push('js')
@endpush