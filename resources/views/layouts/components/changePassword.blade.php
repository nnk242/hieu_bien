<div id="modal-change-password" data-izimodal-title="Đổi mật khẩu?" data-izimodal-subtitle="Thay đổi mật khẩu"
     style="display: none">
    <form METHOD="POST" action="{{route('password.change')}}" id="form-remove">
        {{ csrf_field() }}
        <div class="m-3">
            <div class="form-group">
                <input class="form-control" type="password" name="old_password" placeholder="Mật khẩu cũ" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Mật khẩu mới" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="re_password" placeholder="Nhập lại khẩu mới" required>
            </div>
            <div class="text-center p-2">
                <button class="btn btn-warning" type="submit">Có</button>
                <button class="btn btn-behance" data-izimodal-close="">không</button>
            </div>
        </div>
    </form>
</div>

<script>

    $(document).on('click', '#changePassword', function (event) {
        event.preventDefault()
        $('#modal-change-password').iziModal('open')
    });
    //alert
    $('#modal-change-password').iziModal({
        headerColor: '#3565b2',
        width: 400,
        timeout: 10000000,
        pauseOnHover: true,
        timeoutProgressbar: true,
        attached: 'bottom',
        autoOpen: 0
        // loop: false
    });
</script>
