@include('_includes.links')

<!-- Begin page -->
<div id="layout-wrapper">

    @include('_includes.top')

    @include('_includes.sidebar')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @include('_includes.footer')
    </div>

</div>
<!-- END layout-wrapper -->


@include('_includes.scripts')