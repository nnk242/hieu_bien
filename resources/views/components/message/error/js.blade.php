@if (\Session::has('error'))
    <script src="https://unpkg.com/izitoast/dist/js/iziToast.min.js"></script>
    <script>
        iziToast.error({
            timeout: 5000,
            icon: 'fa fa-trash',
            title: 'Error',
            message: '{!! \Session::get('error') !!}'
        })
    </script>
@endif
