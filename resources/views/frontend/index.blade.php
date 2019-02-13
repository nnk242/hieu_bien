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
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Bài viết cập nhật
                    </p>
                    @include('layouts.frontend.components.content')
                </div>
                <!-- // End content -->

                <!-- Start sidebar -->
                <div class="sidebar col-md-3">
                    @include('layouts.frontend.components.category')

                    @include('layouts.frontend.components.top')

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
