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
                        <a href="{{route('doctor.index')}}">
                            <button class="btn btn-outline-warning"><i class="fa fa-angle-left"></i>Doctor</button>
                        </a>
                        <a href="{{route('doctor.create')}}">
                            <button class="btn btn-outline-success"><i class="fa fa-plus"></i>Tạo doctor</button>
                        </a>
                    </div>
                    <h4 class="card-title">Sửa bài viết</h4>
                    <p class="card-description">
                        {{$doctor->title}}
                    </p>
                    <form class="forms-sample" action="{{ route('doctor.update', $doctor->id) }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Bác sĩ</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title"
                                   value="{{$doctor->title}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <div
                                style="background: url('/{{$doctor->image}}') no-repeat center; background-size: cover; height: 170px; width: 170px; margin: 0 auto"
                            ></div>
                        </div>
                        <div class="form-group">
                            <input name="image" hidden>
                            <label for="image">Hình ảnh tiêu đề</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control" id="image" name="image"
                                       placeholder="Upload Image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert">Chuyên khoa</label>
                            <input type="text" class="form-control" id="expert" placeholder="Chuyên khoa" name="expert"
                                   value="{{$doctor->expert}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="education">Học vấn</label>
                            <input type="text" class="form-control" id="education" placeholder="Học vấn"
                                   name="education" value="{{$doctor->education}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="experience">Kinh nhiệm</label>
                            <input type="text" class="form-control" id="experience" placeholder="Kinh nhiệm"
                                   name="experience" value="{{$doctor->experience}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="description">Giới thiệu</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Giới thiệu"
                                      name="description" rows="3"
                                      required>{{$doctor->description}}</textarea>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Ẩn hiện doctor</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="show"
                                                   {{$doctor->status == 'show' ? 'checked' : ''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="hide"
                                                {{$doctor->status == 'hide' ? 'checked' : ''}}> Ẩn
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
@endsection
