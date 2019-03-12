@extends('layouts.admin')
@section('css')
    <!-- selectize -->
    <link href="/frontend/libs/selectize/css/bootstrap2.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/bootstrap3.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/selectize.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/default.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/legacy.css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route('post.index')}}">
                            <button class="btn btn-outline-warning"><i class="fa fa-angle-left"></i>Bài viết</button>
                        </a>
                        <a href="{{route('post.create')}}">
                            <button class="btn btn-outline-success"><i class="fa fa-plus"></i>Bài viết</button>
                        </a>
                    </div>
                    <h4 class="card-title">Sửa bài viết</h4>
                    <p class="card-description">
                        {{$post->title}}
                    </p>
                    <form class="forms-sample" action="{{ route('post.update', $post->id) }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề"
                                   value="{{$post->title}}" name="title" required>
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
                                      name="introduce" required>{{$post->introduce}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="my-editor">Nội dung</label>
                            <textarea id="my-editor" name="content"
                                      class="form-control">{{$post->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="type">Danh mục bài viết</label>
                            <select class="form-control" id="category" name="category" required>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{$category->id == $post->category_id ? 'checked' : ''}}>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tác giả... <code>Bạn muốn dùng tên tài khoản hay tên khác?</code></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type"
                                                   value="no" {{$post->author === Auth::user()->name? 'checked': ''}}>
                                            Không
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="yes"
                                                   id="show-input-author" {{$post->author === Auth::user()->name? '': 'checked'}}>
                                            Có
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Tác giả"
                                   {{$post->author === Auth::user()->name? 'hidden': ''}} id="input-author"
                                   value="{{$post->author}}" name="author">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Dùng làm slide</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slide"
                                                   value="show" {{$post->slide == 'show' ? 'checked':''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slide"
                                                   value="hide" {{$post->slide == 'hide' ? 'checked':''}}> Ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="title"><i class="fa fa-tag"></i> Tags</label>
                            <input id="input-tags" class="form-control" name="tags" value="{{$post->tag}}">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Ẩn hiện bài viết</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                   value="show" {{$post->status == 'show' ? 'checked':''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                   value="hide" {{$post->status == 'hide' ? 'checked':''}}> Ẩn
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
    <script src="/admin/js/jqueryui/jquery-ui.min.js"></script>
    <script src="/admin/js/selectize/selectize.min.js"></script>
    <script src="/admin/ckeditor/ckeditor.js"></script>
    <script>
        $('#input-tags').selectize({
            plugins: ['drag_drop', 'remove_button'],
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        })
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
