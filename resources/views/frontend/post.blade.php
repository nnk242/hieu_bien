@extends('layouts.frontend.frontend')

@section('css')
    @include('components.message.css')
@endsection

@section('content')
    <main>

        <div class="row" id="story">
            <div class="content col-md-9">
                @if(isset($post)!=0)
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </a>
                        @foreach($categories as $category)@if($category->id == $post->category_id)<a
                            class="breadcrumb-item"
                            href="{{route('frontend.category',['category' => $category->title_seo])}}"> {{$category->title}}</a>@endif
                        @endforeach
                        <span class="breadcrumb-item active"><a
                                href="{{ url($post->title_seo) }}">{!! $post->title !!}</a></span>
                    </nav>
                    <div class="description-story item">
                        <h1 class="name">{!! $post->title !!}</h1>
                        <span><i class="fa fa-eye"
                                 aria-hidden="true"></i> {!! post_views($post->view) !!}&nbsp;-&nbsp;<i
                                class="fa fa-clock-o"
                                aria-hidden="true"> {{ time_elapsed_string($post->created_at) }}</i><br/>
                        </span>
                        <div class="tag-item" style="float: none">
                            @foreach(explode(',', $post->tag) as $key=>$value)
                                <span class="fa fa-hashtag"></span><a
                                    href="{{route('frontend.tag', ['tag' => isset(explode(',', $post->tag_seo)[$key])?explode(',', $post->tag_seo)[$key]: 'nhakhoa'])}}"
                                    title="{{$value}}" data-toggle="tooltip">{{$value}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="item">
                        <p class="content-story">
                            {!! $post->content !!}
                        </p>
                    </div>
                @else
                    <a href="{{url('/')}}" title="Trang chủ." data-toggle="tooltip"><h5>Bài viết không tồn tại...</h5>
                    </a>
                @endif
            </div>
            <!-- // End content -->
            <!-- Start sidebar -->
            <div class="sidebar col-md-3">
                @include('layouts.frontend.components.category')

                @include('layouts.frontend.components.top')

                @include('layouts.frontend.components.tag')

            </div>
        </div>
    </main>
@endsection
@section('js')
    @include('components.message.success.js')
    @include('components.message.error.js')
@endsection
