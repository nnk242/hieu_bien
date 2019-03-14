@extends('layouts.admin')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route('category.index')}}"><button class="btn btn-outline-warning"><i class="fa fa-angle-left"></i>Danh mục</button></a>
                        <a href="{{route('category.create')}}"><button class="btn btn-outline-success"><i class="fa fa-plus"></i>Thêm danh mục</button></a>
                    </div>
                    <h4 class="card-title">Sửa bài viết</h4>
                    <p class="card-description">
                        {{$category->title}}
                    </p>
                    <form class="forms-sample" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề"
                                   value="{{$category->title}}" name="title" required>
                        </div>
                        <div class="form-group">
                            <input name="link_image" hidden>
                            <label for="image">Hình ảnh tiêu đề</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control" id="image" name="image"
                                       placeholder="Upload Image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="introduce">Giới thiệu bài viết</label>
                            <textarea class="form-control" id="introduce" rows="2" placeholder="Giới thiệu bài viết"
                                      name="introduce" required>{{$category->introduce}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="my-editor">Nội dung</label>
                            <textarea cols="60" id="my-editor" style="width: 100%" placeholder="Nội dung" name="content"
                                      required>{!! old('content', $category->content) !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Tác giả... <code>Bạn muốn dùng tên tài khoản hay tên khác?</code></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="no" {{$category->author === Auth::user()->name? 'checked': ''}}> Không
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="yes" id="show-input-author" {{$category->author === Auth::user()->name? '': 'checked'}}> Có
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Tác giả" {{$category->author === Auth::user()->name? 'hidden': ''}} id="input-author"
                                   value="{{$category->author}}" name="author">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Ẩn hiện bài viết</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="show" {{$category->status == 'show' ? 'checked':''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="hide" {{$category->status == 'hide' ? 'checked':''}}> Ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>
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
    <script src="/admin/ckeditor/ckeditor.js"></script>
    <script>
        $("input[name='author_type']").on('click', function () {
            $("#show-input-author:checked").val() === 'yes' ? $('#input-author').removeAttr("hidden") : $('#input-author').attr("hidden", 'true')
        })

    </script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
