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
                        <a href="{{route('post.index')}}"><button class="btn btn-outline-warning"><i class="fa fa-angle-left"></i>Bài viết</button></a>
                    </div>
                    <h4 class="card-title">Thêm bài viết</h4>
                    <form class="forms-sample" action="{{ route('post.store') }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title"
                                   required>
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
                                      name="introduce" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nicEdit">Nội dung</label>
                            <textarea cols="60" id="nicEdit" style="width: 100%" placeholder="Nội dung" name="content"
                                      required>content</textarea>
                        </div>
                        <div class="form-group">
                            <label for="type">Danh mục bài viết</label>
                            <select class="form-control" id="category" name="category" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tác giả... <code>Bạn muốn dùng tên tài khoản hay tên khác?</code></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="no"
                                                   checked> Không
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="author_type" value="yes"
                                                   id="show-input-author"> Có
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Tác giả" hidden id="input-author"
                                   value="{{Auth::user()->name}}" name="author">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Dùng làm slide</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slide" value="show"> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slide" value="hide"
                                                   checked> Ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="title"><i class="fa fa-tag"></i> Tags</label>
                            <input id="input-tags" class="form-control" name="tags">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Ẩn hiện bài viết</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="show"
                                                   checked> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="hide"> Ẩn
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
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js"></script>
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
@endsection
