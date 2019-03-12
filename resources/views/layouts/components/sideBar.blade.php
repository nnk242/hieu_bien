<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <i class="fa fa-user-circle fa-2x"></i>
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{Auth::user()->name}}</p>
                        <div>
                            <small class="designation text-muted">{{Auth::user()->role}}</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                <a href="{{route('post.create')}}">
                    <button class="btn btn-success btn-block">Thêm bài viết mới
                        <i class="mdi mdi-plus"></i>
                    </button>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('category.index')}}">
                <i class="menu-icon mdi mdi-content-copy"></i>
                <span class="menu-title">Danh mục</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route("post.index")}}">
                <i class="menu-icon mdi mdi-newspaper"></i>
                <span class="menu-title">Bài viết</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('price.index')}}">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Bảng giá</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('doctor.index')}}">
                <i class="menu-icon fa fa-user-md" aria-hidden="true"></i>
                <span class="menu-title">Giới thiệu bác sĩ</span>
            </a>
        </li>
    </ul>
</nav>
