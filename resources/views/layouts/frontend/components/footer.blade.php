<footer>
    <div class="pt-3 container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <h3 class="text-center text-light">Phản hồi với chúng tôi</h3>
                <form class="border-bottom pb-4" method="POST" action="{{route('frontend.sendMessage')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="text-light">Họ và tên</label>
                        <input type="text" class="form-control" id="name"
                               placeholder="Nhập họ và tên" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-light">Email</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="Nhập email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="content" class="text-light">Nội dung</label>
                        <textarea type="password" class="form-control" id="content"
                                  placeholder="Nhập nội dung không quá 500 từ" rows="5" minlength="20" maxlength="500" name="content" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="max-width: 998px; width: 100%; margin: auto" class="mt-3">
        <div class="row">
            <div class="col-md-4">
                <h3 class="ml-3 text-light">Lien he</h3>
                <ul class="custom-info">
                    <li>
                        <i class="fab fa-facebook-square custom-color-fb"></i><a href="#"> fb</a>
                    </li>
                    <li>
                        <i class="fas fa-phone-volume custom-color-phone"></i><a href="#"> 0123456789</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3 class="ml-3 text-light">Dia chi</h3>
                <ul class="custom-info">
                    <li>
                        <i class="fas fa-map-marker-alt text-success"></i><a href="#"> tetetajdjasdjjadjklalsdhl
                            jasdjk asdha</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3 class="ml-3 text-light">Thong tin ho tro</h3>
                <ul class="custom-info">
                    <li>
                        <i class="fas fa-arrow-right text-info"></i><a href="#"> Lien he nha khoa</a>
                    </li>
                    <li>
                        <i class="fas fa-arrow-right text-info"></i><a href="#"> Dieu khoan dich vu</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</footer>
