
<!-- js placed at the end of the document so the pages load faster -->
<script class="include" type="text/javascript" src="{!! asset('js/jquery.dcjqaccordion.2.7.js') !!}"></script>
<script src="{!! asset('js/jquery.scrollTo.min.js') !!}"></script>

<script src="{!! asset('assets/toastr-master/toastr.js') !!}"></script>
<!--toastr js-->
@include('layouts.backend._messages')

<!--common script for all pages-->
<script src="{!! asset('js/common-scripts.js') !!}"></script>
<script src="{{ asset('js/custom.js') }}"></script>


@stack('js')