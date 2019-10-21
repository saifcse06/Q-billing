<message>
        {{--set some message after action--}}

        @if (\Session::has('message'))
                <script>
                    toastr.success('{!! \Session::get("message") !!}');
                </script>
        @elseif(\Session::has('warning'))
                <script>
                    toastr.warning('{!! \Session::get("warning") !!}');
                </script>
        @elseif(\Session::has('info'))
                <script>
                    toastr.info('{!! \Session::get("info") !!}');
                </script>
        @elseif(\Session::has('danger'))
                <script>
                    toastr.error('{!! \Session::get("danger") !!}');
                </script>
        @endif
</message>
