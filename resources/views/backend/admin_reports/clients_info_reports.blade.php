@extends('layouts.backend.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Client Business Type List
                </header>
                <div class="panel-body">
                    <div class="content">
                        <div class="row">
                            {{ Form::open(['method'=>'get']) }}
                            <div class="col-md-3 col-md-offset-3">
                                {{ Form::text('name',null,['class'=>'form-control js-example-basic-single','placeholder'=>'Business Name']) }}
                            </div>

                            @if(Auth::user()->type=='Admin')
                                <div class="col-md-3">
                                    {!! Form::select('status',['Active'=>'Active','Inactive'=>'Inactive','Pending'=>'Pending','Rejected'=>'Rejected'],null,['class'=>'form-control','placeholder'=>'Select Status']) !!}
                                </div>
                            @endif
                            @if(Auth::user()->type=='Client')
                                <div class="col-md-3">
                                    {!! Form::select('status',['Active'=>'Active','Pending'=>'Pending','Inactive'=>'Inactive'],null,['class'=>'form-control','placeholder'=>'Select All']) !!}
                                </div>
                            @endif
                            <div class="col-md-3">
                                {{ Form::button('<i class="fa fa-search"></i> Search',['type'=>'submit','class'=>'btn btn-primary']) }}
                            </div>

                            {{ Form::close() }}
                        </div>

                    </div>
                    <br>

                    @if (isset($allbusinesstype) && count($allbusinesstype) > 0)
                        <div class="table-responsive businesstype">
                    @include('backend.admin_reports._client_business_table')

                        </div>

                    @endif
                     @if(isset($allbusinesstype) && count($allbusinesstype)==0)
                        <a href="{{ route('clients.report') }}?type=Client" class="btn btn-warning pull-left"><i class="fa fa-arrow-left"></i> Back</a>

                    @endif
                    @if (isset($allClientInfo)&&count($allClientInfo))
                        <div class="table-responsive businesstype">
                            @include('backend.admin_reports._client_table')
                        </div>

                    @endif
                </div>
            </section>



        </div>
    </div>
@endsection
@push('css')
    <style>
        .crposition {
            padding-right: 10px;
            float: left;
        }
        .dataTables_wrapper .dataTables_filter input{
        margin-left: 0px;
                 }
        .dataTables_length, .dataTables_filter{
            padding: 0px;
        }
        .dataTables_filter label input{
            width: auto;
        }
    </style>
    <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet" />
    <!--dynamic table-->
    <link href="{{ asset('assets/data-table/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <!--Date Range or date Picker-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />
@endpush
@push('js')
    <!--dynamic table initialization -->
    <script src="{{ asset('assets/data-table/dataTables.min.js') }}"></script>
    <!--dynamic table initialization -->
    <script src="{{ asset('assets/advanced-datatable/scripts/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/advanced-datatable/scripts/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/advanced-datatable/scripts/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/advanced-datatable/scripts/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/advanced-datatable/scripts/pdfmake/0.1.32/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/advanced-datatable/scripts/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/advanced-datatable/scripts/buttons.print.min.js') }}"></script>
    <script>
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
            sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
            sOut += '<tr><td>Extra info:</td><td>And any further details here (img etc)</td></tr>';
            sOut += '</table>';

            return sOut;
        }

        $(document).ready(function() {

            $('.dynamic-reportTable').dataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

            } );

            /*
             * Insert a 'details' column to the table
             */
            var nCloneTh = document.createElement( 'th' );
            var nCloneTd = document.createElement( 'td' );
            nCloneTd.innerHTML = '<img src="img/details_open.png">';
            nCloneTd.className = "center";

            $('#hidden-table-info thead tr').each( function () {
                this.insertBefore( nCloneTh, this.childNodes[0] );
            } );

            $('#hidden-table-info tbody tr').each( function () {
                this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
            } );

            /*
             * Initialse DataTables, with no sorting on the 'details' column
             */
            var oTable = $('#hidden-table-info').dataTable( {
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0 ] }
                ],
                "aaSorting": [[1, 'asc']]
            });
        });
    </script>
    @endpush