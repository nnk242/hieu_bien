@extends('layouts.frontend.frontend')

@section('css')
    @include('components.message.css')
@endsection

@section('content')
    <main>
        <section id="main">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <h2 class="text-center">Đội ngũ bác sĩ</h2>
                            <div class="w-25" style="margin: auto; border-bottom: solid 3px #f4cc73"></div>
                            <div class="mt-3">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach($doctor as $key=>$value)
                                        <div class="tab-pane fade {{$key==0?'show active': ''}}" id="v-pills-{{$key}}"
                                             role="tabpanel"
                                             aria-labelledby="v-pills-profile-tab">
                                            <div class="item">
                                                <div>
                                                </div>
                                                <div class="row description">
                                                    <div class="col-md-4 mb-3">
                                                        <div class="custom-item-img"
                                                             style="background: url('{{$value->image}}') no-repeat center; background-size: cover; height: 180px; width: 180px; margin: 0 auto"
                                                        ></div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h5>{{$value->title}}</h5>
                                                        <ul>
                                                            <li>
                                                                Chuyên khoa: {{$value->expert}}
                                                            </li>
                                                            <li>
                                                                Học vấn: {{$value->education}}
                                                            </li>
                                                            <li>
                                                                Kinh nghiệm: {{$value->experience}}
                                                            </li>
                                                            @if(isset($value->description))
                                                                <li>
                                                                    {{$value->description}}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="nav nav-pills d-flex justify-content-center" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach($doctor as $key=>$value)
                                        <a class="mr-2 mt-2" id="v-pills-{{$key}}-tab" data-toggle="pill"
                                           href="#v-pills-{{$key}}" role="tab" aria-controls="v-pills-{{$key}}"
                                           aria-selected="{{$key==0?'true': 'false'}}">
                                            <div class="custom-item-img"
                                                 style="background: url('{{$value->image}}') no-repeat center; background-size: cover; height: 70px; width: 70px; margin: 0 auto">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2">
                            <h2 class="text-center">Dịch vụ nổi bật</h2>
                            <div class="w-25" style="margin: auto; border-bottom: solid 3px #f4cc73"></div>
                            <div class="mt-3">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach($doctor as $key=>$value)
                                        <div class="tab-pane fade {{$key==0?'show active': ''}}" id="v-pills-{{$key}}"
                                             role="tabpanel"
                                             aria-labelledby="v-pills-profile-tab">
                                            <div class="item">
                                                <div>
                                                </div>
                                                <div class="row description">
                                                    <div class="col-md-4 mb-3">
                                                        <div class="custom-item-img"
                                                             style="background: url('{{$value->image}}') no-repeat center; background-size: cover; height: 180px; width: 180px; margin: 0 auto"
                                                        ></div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h5>{{$value->title}}</h5>
                                                        <ul>
                                                            <li>
                                                                Chuyên khoa: {{$value->expert}}
                                                            </li>
                                                            <li>
                                                                Học vấn: {{$value->education}}
                                                            </li>
                                                            <li>
                                                                Kinh nghiệm: {{$value->experience}}
                                                            </li>
                                                            @if(isset($value->description))
                                                                <li>
                                                                    {{$value->description}}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="nav nav-pills d-flex justify-content-center" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach($doctor as $key=>$value)
                                        <a class="mr-2 mt-2" id="v-pills-{{$key}}-tab" data-toggle="pill"
                                           href="#v-pills-{{$key}}" role="tab" aria-controls="v-pills-{{$key}}"
                                           aria-selected="{{$key==0?'true': 'false'}}">
                                            <div class="custom-item-img"
                                                 style="background: url('{{$value->image}}') no-repeat center; background-size: cover; height: 70px; width: 70px; margin: 0 auto">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="content col-md-9">
                    <p class="content-title">
                        <i class="far fa-newspaper"></i> Bài viết cập nhật
                    </p>
                    @include('layouts.frontend.components.content')
                </div>
                <!-- // End content -->

                <!-- Start sidebar -->
                <div class="sidebar col-md-3">
                @include('layouts.frontend.components.category')

                @include('layouts.frontend.components.top')

                @include('layouts.frontend.components.tag')
                <!-- End sidebar -->

                </div>
            </div>
        </section>
    </main>
@endsection
@section('js')
    @include('components.message.success.js')
    @include('components.message.error.js')
@endsection
