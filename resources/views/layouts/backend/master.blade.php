<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.backend._head')

</head>

<body>

<section id="container">
    <!--header start-->
    <header class="header white-bg">
        @include('layouts.backend._header')
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        @include('layouts.backend._nav')
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @include('layouts.backend._messages')
            @yield('content')
        </section>
    </section>
    <!--main content end-->


    <!--footer start-->
    <footer class="site-footer">
        @include('layouts.backend._footer')
    </footer>
    <!--footer end-->
</section>
@include('layouts.backend._scripts')
</body>
</html>
