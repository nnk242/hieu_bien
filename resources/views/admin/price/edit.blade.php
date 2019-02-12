@extends('layouts.admin')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa giá</h4>
                    <p class="card-description">
                        {{$price->title}}
                    </p>
                    <form class="forms-sample" action="{{ route('price.update', $price->id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Tên loại</label>
                            <input type="text" class="form-control" id="name" placeholder="Tên loại"
                                   value="{{$price->name}}" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="introduce">Giới thiệu</label>
                            <textarea class="form-control" id="introduce" rows="2" placeholder="Giới thiệu"
                                      name="description" required>{{$price->description}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="name">Giá</label>
                                    <input type="text" class="form-control" id="price" placeholder="Giá dịch vụ"
                                           name="price" value="{{$price->price}}" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="per">Loại(VNĐ/Loại)</label>
                                    <select class="form-control" id="per" name="per" required>
                                        <option value="1" {{$price->per == 'răng'? 'checked' : ''}}>Răng</option>
                                        <option value="2" {{$price->per == 'cặp'? 'checked' : ''}}>Cặp</option>
                                        <option value="3" {{$price->per == 'hàm'? 'checked' : ''}}>Hàm</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type">Loại dịch vụ</label>
                            <select class="form-control" id="type" name="type" required>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}" {{$type->id == $price->type_id ? 'checked' : ''}}>{{$type->name}}</option>
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
                                            <input type="radio" class="form-check-input" name="status" value="show" {{$price->status == 'show' ? 'checked':''}}> Hiện
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-radio">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="hide" {{$price->status == 'hide' ? 'checked':''}}> Ẩn
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
        $(document).on('keyup', '#price',function() {
            var value_ = numeral($(this).val()).format('0,0')
            $(this).val(value_)
        })
    </script>
@endsection

