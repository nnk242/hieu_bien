@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tất cả tin nhắn</h4>
                <p class="card-description">
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>###</th>
                            <th>Client</th>
                            <th>Tin nhắn mới</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$post->name}}</td>
                                <td>
                                    <label class="badge badge-success">{{$post->status}}</label>
                                </td>
                                <td>
                                    <a title="Trả lời" href="{{route('inbox.show', ['inbox' => $post->id])}}" class="badge badge-primary replyItem"><i
                                            class="fa fa-pencil-square-o"></i></a>
                                    <a title="Xóa tất cả" href="#" class="badge badge-danger removeItem"
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
        <form METHOD="POST" class="bg-danger" action="{{route('inbox.destroy', ['inbox' => 1])}}" id="form-remove">
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
