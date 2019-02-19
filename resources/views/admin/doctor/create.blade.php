@extends('layouts.admin')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route('doctor.index')}}"><button class="btn btn-outline-warning"><i class="fa fa-angle-left"></i>Doctor</button></a>
                    </div>
                    <h4 class="card-title">Thêm doctor</h4>
                    <form class="forms-sample" action="{{ route('doctor.store') }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Bác sĩ</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title"
                                   required>
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
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="education">Học vấn</label>
                            <input type="text" class="form-control" id="education" placeholder="Học vấn" name="education"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="experience">Kinh nhiệm</label>
                            <input type="text" class="form-control" id="experience" placeholder="Kinh nhiệm" name="experience"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="description">Giới thiệu</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Giới thiệu" name="description" rows="3"
                                      required></textarea>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="exampleInputCity1">Ẩn hiện doctor</label>
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
