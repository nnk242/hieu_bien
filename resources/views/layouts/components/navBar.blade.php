<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('dashboard')}}">
            <i class="fa fa-heart-o"></i>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}">
            <i class="fa fa-heart"></i>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                   data-toggle="dropdown">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    @if($newInbox->count() !== 0)<span class="count">{{$newInbox->count()}}</span>@endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                     aria-labelledby="notificationDropdown">
                    <a href="{{route('inbox.index')}}" class="dropdown-item">
                        <p class="mb-0 font-weight-normal float-left">Bạn có {{$newInbox->count()}} tin nhắn mới
                        </p>
                        <span class="badge badge-pill badge-warning float-right">Xem tất cả</span>
                    </a>
                    @foreach($newInbox as $key => $value)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="{{route('messages.show', ['message' => $value->id])}}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">{{ str_limit($value->ip, $limit = 50, $end = '...') }}</h6>
                                <p class="font-weight-light small-text">
                                    {{ str_limit($value->message, $limit = 27, $end = '...') }}
                                </p>
                            </div>
                        </a>
                        @break($key === 3)
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                   data-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    @if($newMessage->count() !== 0)<span class="count">{{$newMessage->count()}}</span>@endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                     aria-labelledby="notificationDropdown">
                    <a href="{{route('messages.index')}}" class="dropdown-item">
                        <p class="mb-0 font-weight-normal float-left">Bạn có {{$newMessage->count()}} thông báo mới
                        </p>
                        <span class="badge badge-pill badge-warning float-right">Xem tất cả</span>
                    </a>
                    @foreach($newMessage as $key => $value)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="{{route('messages.show', ['message' => $value->id])}}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">{{ str_limit($value->email, $limit = 50, $end = '...') }}</h6>
                                <p class="font-weight-light small-text">
                                    {{ str_limit($value->content, $limit = 27, $end = '...') }}
                                </p>
                            </div>
                        </a>
                        @break($key === 3)
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <span class="profile-text">Hello, {{ Auth::user()->name }} !</span>
                    <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item mt-2" href="#" id="changePassword">
                        Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
