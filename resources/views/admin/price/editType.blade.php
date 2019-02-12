@extends('layouts.admin')
@section('content')
    <div class="justify-content-center row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa thể loại</h4>
                    <p class="card-description">
                        {{$type->title}}
                    </p>
                    <form class="forms-sample" action="{{ route('type.update', $type->id) }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Tên thể loại</label>
                            <input type="text" class="form-control" id="title" placeholder="Tiêu đề"
                                   value="{{$type->name}}" name="name" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <a href="{{route('price.index')}}"><button class="btn btn-light" type="button">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
