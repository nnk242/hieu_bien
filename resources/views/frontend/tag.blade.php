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
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> TAG: {{ '#'. $tag_ }}
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
