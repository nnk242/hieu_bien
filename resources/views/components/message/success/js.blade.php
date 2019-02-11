@if (\Session::has('success'))
    <script src="https://unpkg.com/izitoast/dist/js/iziToast.min.js"></script>
    <script>
        iziToast.success({
            timeout: 5000,
            icon: 'fa fa-check',
            title: 'OK',
            message: '{!! \Session::get('success') !!}'
        })
    </script>
@endif
