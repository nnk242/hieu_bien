@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tất cả tin nhắn</h4>
                <p class="card-description">
                    <a href="{{ route('messages.new') }}" class="text-danger">.Có tổng {{$new}} tin nhắn chưa
                        đọc</a><br>
                    <a href="{{ route('messages.old') }}" class="text-success">.Có tổng {{$old}} tin nhắn đã đọc</a><br>
                    <span class="text-warning h4">.Lưu trữ <span class="text-dark">{{$posts->total()}}</span>/555 tin nhắn</span>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>###</th>
                            <th>Tên người dùng</th>
                            <th>email</th>
                            <th>Nội dung</th>
                            <th>Status</th>
                            <th>Ngày gửi</th>
                            <th>Ngày trả lời</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->email}}</td>
                                <td>{!! str_limit(strip_tags($post->content), $limit = 40, $end = '...') !!}</td>
                                <td>
                                    @if($post->status == '0')
                                        <a href="{{route('messages.status', ['id' => $post->id])}}"
                                           class="badge {{$post->status == '0'? 'badge-warning' : 'badge-secondary'}}">Chưa
                                            trả lời</a>
                                    @else
                                        <span
                                            class="badge {{$post->status == '0'? 'badge-warning' : 'badge-success'}}">Đã xem</span>
                                    @endif
                                </td>
                                <td>
                                    <label class="badge badge-success">{{$post->created_at}}</label>
                                </td>
                                <td>
                                    <label
                                        class="badge badge-success">{{$post->updated_at == $post->created_at ? '' : $post->updated_at}}</label>
                                </td>
                                <td>
                                    <a title="Trả lời" href="{{route('messages.show', ['message' => $post->id])}}" class="badge badge-primary replyItem"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    <a title="Xóa" href="#" class="badge badge-danger removeItem"
                                       data-id="{{$post->id}}" data-title="{{$post->name}}"><i
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
        <form METHOD="POST" class="bg-danger" action="{{route('messages.destroy', ['id' => 1])}}" id="form-remove">
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
            var action_first = $("#form-remove").attr('action').substr(0, $("#form-remove").attr('action').length - 1)
            var action = action_first + id
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
    </script>
@endsection
