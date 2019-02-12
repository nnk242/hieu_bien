@extends('layouts.admin')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa bài viết</h4>
                    <p class="card-description">
                        {{$post->title}}
                    </p>
                    <form class="forms-sample" action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="nicEdit">Nội dung</label>
                            <textarea cols="60" id="nicEdit" style="width: 100%" placeholder="Nội dung" name="content"
                                      required>{{$post->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="type">Danh mục bài viết</label>
                            <select class="form-control" id="category" name="category" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $post->category_id ? 'checked' : ''}}>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tác giả... <code>Bạn muốn dùng tên tài khoản hay tên khác?</code></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="no" {{$post->author === Auth::user()->name? 'checked': ''}}> Không
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="yes" id="show-input-author" {{$post->author === Auth::user()->name? '': 'checked'}}> Có
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Tác giả" {{$post->author === Auth::user()->name? 'hidden': ''}} id="input-author"
                                   value="{{$post->author}}" name="author">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Dùng làm slide</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slide" value="show" {{$post->slide == 'show' ? 'checked':''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slide" value="hide" {{$post->slide == 'hide' ? 'checked':''}}> Ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Ẩn hiện bài viết</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="show" {{$post->status == 'show' ? 'checked':''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="hide" {{$post->status == 'hide' ? 'checked':''}}> Ẩn
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
    @include('components.nicEdit.nicEdit')
    <script>
        $("input[name='author_type']").on('click', function () {
            $("#show-input-author:checked").val() === 'yes' ? $('#input-author').removeAttr("hidden") : $('#input-author').attr("hidden", 'true')
        })
    </script>
@endsection
