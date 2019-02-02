@extends('layouts.admin')
@section('css')
    @include('components.message.css')
@endsection

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa bài viết</h4>
                    <p class="card-description">
                        {{$post->title}}
                    </p>
                    <form class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="title">title</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề"
                                   value="{{$post->title}}" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="introduce">Giới thiệu bài viết</label>
                            <textarea class="form-control" id="introduce" rows="2" placeholder="Giới thiệu bài viết"
                                      name="introduce" required>{{$post->introduce}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="nicEdit">Nội dung</label>
                            <textarea cols="60" id="nicEdit" style="width: 100%" placeholder="Nội dung" name="content"
                                      required>{{$post->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">City</label>
                            <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    @include('components.message.success.js')
    @include('components.message.error.js')
    @include('components.nicEdit.nicEdit')
@endsection
