@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thể loại</h4>
                    <p class="card-description">
                        <code>.Có tổng {{count($types)}} thể loại</code>
                    </p>
                    <button class="btn btn-outline-success" id="addType"><i class="fa fa-plus"></i> Thêm thể loại
                    </button>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>###</th>
                                <th>Tên</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($types as $key => $type)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <a title="Sửa" href="{{route('type.edit', $type->id)}}"
                                           class="badge badge-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                        <a title="Xóa" href="#" class="badge badge-danger removeItem"
                                           data-id="{{$type->id}}" data-type="type"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{$posts->render()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bảng giá</h4>
                    <p class="card-description">
                        <code>.Có tổng {{$posts->total()}} bài viết</code>
                    </p>
                    <a href="{{route('price.create')}}">
                        <button class="btn btn-outline-success"><i class="fa fa-plus"></i> Thêm giá</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>###</th>
                                <th>Tên loại</th>
                                <th>Giới thiệu</th>
                                <th>Status</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $key => $post)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$post->name}}</td>
                                    <td>{!! str_limit(strip_tags($post->description), $limit = 50, $end = '...') !!}</td>
                                    <td>
                                        <a href="{{route('price.changeStatus', ['id' => $post->id])}}"
                                           class="badge {{$post->status == 'show'? 'badge-warning' : 'badge-secondary'}}">{{$post->status}}</a>
                                    </td>
                                    <td>
                                        <label class="badge badge-success">{{$post->created_at}}</label>
                                    </td>
                                    <td>
                                        <a title="Sửa" href="{{route('price.edit', $post->id)}}"
                                           class="badge badge-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                        <a title="Xóa" href="#" class="badge badge-danger removeItem"
                                           data-id="{{$post->id}}" data-title="{{$post->title}}"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{$posts->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-remove" data-izimodal-title="Bạn chắc chắn muốn xóa?" data-izimodal-subtitle=""
         style="display: none">
        <form METHOD="POST" class="bg-danger" action="{{route('price.destroy', ['id' => 1])}}" id="form-remove">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="text-center p-2">
                <button class="btn btn-warning" type="submit">Có</button>
                <button class="btn btn-behance" data-izimodal-close="">không</button>
            </div>
        </form>
    </div>

    <div id="modal-add-type" data-izimodal-title="Thêm thể loại?"
         style="display: none">
        <form METHOD="POST" action="{{route('type.create')}}">
            {{ csrf_field() }}
            <div class="m-2">
                <div class="form-group">
                    <input class="form-control" name="name" placeholder="Tên thể loại">
                </div>
                <div class="text-center p-2">
                    <button class="btn btn-warning" type="submit">Đồng ý</button>
                    <button class="btn btn-behance" data-izimodal-close="">không</button>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click', '.removeItem', function (event) {
            event.preventDefault()
            var action = ''
            var title = ''
            var id = $(this).data("id")
            if ($(this).data('type') == 'type') {
                action = window.location.origin + '/admin/price/type/delete/' + id
                console.log(1)
            } else {
                action = window.location.origin + '/admin/price/' + id
            }

            $.when($("#form-remove").attr('action', action)).then(function () {
                $.when($("#modal-remove").iziModal('setSubtitle', title))
                    .then(function () {
                        $('#modal-remove').iziModal('open')
                    })
            })
        });
        //alert
        $('#modal-remove').iziModal({
            headerColor: '#d43838',
            width: 400,
            timeout: 10000,
            pauseOnHover: true,
            timeoutProgressbar: true,
            attached: 'bottom',
            autoOpen: 0
            // loop: false
        });

        $(document).on('click', '#addType', function (event) {
            $('#modal-add-type').iziModal('open')
        });
        //alert
        $('#modal-add-type').iziModal({
            headerColor: '#3565b2',
            width: 400,
            timeout: 10000000,
            pauseOnHover: true,
            timeoutProgressbar: true,
            attached: 'bottom',
            autoOpen: 0
            // loop: false
        });
    </script>
@endsection
