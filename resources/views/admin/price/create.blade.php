@extends('layouts.admin')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm bảng giá</h4>
                    <form class="forms-sample" action="{{ route('price.store') }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Tên dịch vụ</label>
                            <input type="text" class="form-control" id="name" placeholder="Tên dịch vụ" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="description">Giới thiệu</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Giới thiệu ngắn" name="description" max="255"
                                      required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="name">Giá</label>
                                    <input type="text" class="form-control" id="price" placeholder="Giá dịch vụ"
                                           name="price" value="0" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="per">Loại(VNĐ/Loại)</label>
                                    <select class="form-control" id="per" name="per" required>
                                        <option value="1">Răng</option>
                                        <option value="2">Cặp</option>
                                        <option value="3">Hàm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Loại dịch vụ</label>
                            <select class="form-control" id="type" name="type" required>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
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
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button class="btn btn-light" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
        $(document).on('keyup', '#price',function() {
            var value_ = numeral($(this).val()).format('0,0')
            $(this).val(value_)
        })
    </script>
@endsection
