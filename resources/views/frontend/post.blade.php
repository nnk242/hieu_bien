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
                            href="{{$category->title_seo}}"> {{$category->title}}</a>@endif
                        @endforeach
                        <span class="breadcrumb-item active"><a
                                href="{{ url($post->title_seo) }}">{!! $post->title !!}</a></span>
                    </nav>
                    <div class="description-story item">
                        <h1 class="name">{!! $post->title !!}</h1>
                        <span><i class="fa fa-eye" aria-hidden="true"></i> {!! post_views($post->view) !!}&nbsp;-&nbsp;<i
                                class="fa fa-clock-o"
                                aria-hidden="true"> {{ time_elapsed_string($post->created_at) }}</i><br/>
                        </span>
                    </div>
                    <div class="item">
                        <p class="content-story">
                            {{$post->content}}
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
                <div class="list-categories">
                    <p class="sidebar-title">
                        <i class="fa fa-th-list" aria-hidden="true"></i>Danh mục
                    </p>
                    <div class="categories">
                        @foreach($categories as $category)
                            <div class="item-sidebar">
                                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i><a
                                    href="{{ url($category->title_seo) }}" title="{{$category->title}}"
                                    data-toggle="tooltip">{{$category->title}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
@section('js')
    @include('components.message.success.js')
    @include('components.message.error.js')
@endsection
