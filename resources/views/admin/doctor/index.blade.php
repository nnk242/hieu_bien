@extends('layouts.admin')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bác sĩ</h4>
                <a href="{{route('doctor.create')}}"><button class="btn btn-outline-success"><i class="fa fa-plus"></i>Thêm bài viết</button></a>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>###</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Chuyên khoa</th>
                            <th>Học vấn</th>
                            <th>Kinh nhiệm</th>
                            <th>Giới thiệu</th>
                            <th>Ẩn, hiện</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$post->title}}</td>
                                <td><img src="{{$post->image}}"></td>
                                <td>{{$post->expert}}</td>
                                <td>{{$post->education}}</td>
                                <td>{{$post->experience}}</td>
                                <td>{!! str_limit(strip_tags($post->description), $limit = 50, $end = '...') !!}</td>
                                <td>
                                    <a href="{{route('doctor.changeStatus', ['id' => $post->id])}}"
                                       class="badge {{$post->status == 'show'? 'badge-warning' : 'badge-secondary'}}">{{$post->status}}</a>
                                </td>
                                <td>
                                    <label class="badge badge-success">{{$post->created_at}}</label>
                                </td>
                                <td>
                                    <a title="Sửa" href="{{route('doctor.edit', $post->id)}}" class="badge badge-primary"><i
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
    <div id="modal-remove" data-izimodal-title="Bạn chắc chắn muốn xóa?" data-izimodal-subtitle=""
         style="display: none">
        <form METHOD="POST" class="bg-danger" action="{{route('doctor.destroy', ['id' => 1])}}" id="form-remove">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="text-center p-2">
                <button class="btn btn-warning" type="submit">Có</button>
                <button class="btn btn-behance" data-izimodal-close="">không</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>

        $(document).on('click', '.removeItem', function (event) {
            event.preventDefault()
            var title = $(this).data("title")
            var id = $(this).data("id")
            var action_first = $("#form-remove").attr('action').substr(0, $("#form-remove").attr('action').length-1)
            var action = action_first + id
            $.when($("#form-remove").attr('action', action)).then(function () {
                $.when($("#modal-remove").iziModal('setSubtitle', title))
                    .then(function () {
                        $('#modal-remove').iziModal('open')
                    })
            })
            console.log($("#id-item").val())


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
    </script>
@endsection
