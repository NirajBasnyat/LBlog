<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>


<!-- App js -->
<script src="{{asset('assets/js/app.js')}}"></script>

@if(Session::has('success') || Session::has('error'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: '{{session("success") ? 'success' : 'error'}}',
            title: '{{session("success") ?? session("error")}}',
            showConfirmButton: false,
            timer: 1500
        })

    </script>
@endif


@livewireScripts
@stack('custom_js')

</body>

</html>
