@extends('layouts.frontend.frontend')

@section('css')
    @include('components.message.css')
@endsection

@section('content')
    <main>
        <section id="main">
            <div class="row">
                <div class="content col-md-9">
                    <p class="content-title">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Bai viet cập nhật
                    </p>
                    @foreach($posts as $post)
                        <div>
                            <div class="item">
                                <h2 class="post" data-id="{{$post->id}}"><a href="#" title="{{$post->title}}"
                                                                data-toggle="tooltip">{{$post->title}}</a>
                                </h2>
                                <div>
                                    <span class="fa fa-eye" aria-hidden="true">
                                    </span> {{$post->view}}&nbsp;-&nbsp;<span class="fa fa-clock-o" aria-hidden="true">
                                    </span>&nbsp;{{time_elapsed_string($post->created_at)}}
                                </div>
                                <div class="row description">
                                    <div class="col-md-4 mb-3">
                                        <div class="custom-item-img"
                                             style="background-image: url({{$post->image? $post->image: 'https://66.media.tumblr.com/46731882a838df1797b48fc8dd3a7a04/tumblr_pkqo6ifwv21rogvb0o1_1280.jpg'}}); width: 100%"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <a href="#" title="Cấy ghép IMPLANT" data-toggle="tooltip">
                                            <p>
                                                {!! str_limit(strip_tags($post->content), $limit = 150, $end = '...') !!}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {!! $posts->appends(request()->except('page'))->links() !!}
                </div>
                <!-- // End content -->

                <!-- Start sidebar -->
                <div class="sidebar col-md-3">
                    @include('layouts.frontend.components.category')
                    <div class="stories">
                        <div class="form-group">
                            <p class="sidebar-title">
                                <i class="fas fa-comment-alt"></i>bai viet hay
                            </p>

                            <div class="item-sidebar">
                                <span class="rank-story-sidebar">1</span>
                                <div class="item-story-sidebar">
                                    <h2 class="name"><a href="Cấy ghép IMPLANT" title=""
                                                        data-toggle="tooltip">Cấy ghép IMPLANT</a></h2>
                                    <span class="stats">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 9999 -
                                    <i class="fa fa-clock-o"
                                       aria-hidden="true"> 1 nam truoc</i>
                                </span>
                                </div>
                            </div>
                            <div class="item-sidebar">
                                <span class="rank-story-sidebar">2</span>
                                <div class="item-story-sidebar">
                                    <h2 class="name"><a href="Cấy ghép IMPLANT" title=""
                                                        data-toggle="tooltip">Cấy ghép IMPLANT</a></h2>
                                    <span class="stats">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 9999 -
                                    <i class="fa fa-clock-o"
                                       aria-hidden="true"> 1 nam truoc</i>
                                </span>
                                </div>
                            </div>
                            <div class="item-sidebar">
                                <span class="rank-story-sidebar">3</span>
                                <div class="item-story-sidebar">
                                    <h2 class="name"><a href="Cấy ghép IMPLANT" title=""
                                                        data-toggle="tooltip">Cấy ghép IMPLANT</a></h2>
                                    <span class="stats">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 9999 -
                                    <i class="fa fa-clock-o"
                                       aria-hidden="true"> 1 nam truoc</i>
                                </span>
                                </div>
                            </div>
                            <div class="item-sidebar">
                                <span class="rank-story-sidebar">1</span>
                                <div class="item-story-sidebar">
                                    <h2 class="name"><a href="Cấy ghép IMPLANT" title=""
                                                        data-toggle="tooltip">Cấy ghép IMPLANT</a></h2>
                                    <span class="stats">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 9999 -
                                    <i class="fa fa-clock-o"
                                       aria-hidden="true"> 1 nam truoc</i>
                                </span>
                                </div>
                            </div>
                            <div class="item-sidebar">
                                <span class="rank-story-sidebar">2</span>
                                <div class="item-story-sidebar">
                                    <h2 class="name"><a href="Cấy ghép IMPLANT" title=""
                                                        data-toggle="tooltip">Cấy ghép IMPLANT</a></h2>
                                    <span class="stats">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 9999 -
                                    <i class="fa fa-clock-o"
                                       aria-hidden="true"> 1 nam truoc</i>
                                </span>
                                </div>
                            </div>
                            <div class="item-sidebar">
                                <span class="rank-story-sidebar">3</span>
                                <div class="item-story-sidebar">
                                    <h2 class="name"><a href="Cấy ghép IMPLANT" title=""
                                                        data-toggle="tooltip">Cấy ghép IMPLANT</a></h2>
                                    <span class="stats">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 9999 -
                                    <i class="fa fa-clock-o"
                                       aria-hidden="true"> 1 nam truoc</i>
                                </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="top-story mb-5">
                        <div class="form-group">
                            <p class="sidebar-title">
                                <span class="fa fa-tags" aria-hidden="true"></span>TAGS
                            </p>
                            <div class="tag-item">
                                <span class="fa fa-hashtag"></span><a href="#"
                                                                      title="Hay qua" data-toggle="tooltip">tag hay
                                    qua</a>
                            </div>
                        </div>

                    </div>
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
