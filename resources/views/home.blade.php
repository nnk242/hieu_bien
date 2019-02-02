@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <textarea cols="60" id="nicEdit" style="width: 100%"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('components.nicEdit.nicEdit')
@endsection
