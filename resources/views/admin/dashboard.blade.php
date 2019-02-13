@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-inbox-arrow-down text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Tin nhắn hôm nay</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{$todayMessage}}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> {{ (int)$yesterdayMessage != 0 ? 'Bằng '.((int)$todayMessage/(int)$yesterdayMessage)*100 . ' %' : 'Tăng ' . $todayMessage . ' tin nhắn'}} tương tác gửi tin nhắn so với hôm qua
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Bài viết hôm nay</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{$todayPost}}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Tuần qua đã đăng {{$weekPost}} bài viết
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
