@extends('layouts.admin')
@section('content')
    <div class="col-lg-8 grid-margin stretch-card offset-2">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Trả lời tin nhắn: {{$message->name}} <span
                        class="text-warning">#</span> {{$message->email}}</h1>

                <div class="text-center p-2">
                    <form METHOD="POST" action="{{route('messages.reply', ['id' => 1])}}" id="form-reply"
                          style="margin-bottom: 5px">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea id="form-reply" class="form-control" hidden>{{$message->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <p class="text-dark">
                                {{$message->content}}
                            </p>
                            <hr>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-reply"></i>Trả lời</button>
                        <button title="Xóa" href="#" class="btn btn-warning" type="button" id="removeItem"><i
                                class="fa fa-trash-o"></i>Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-remove" data-izimodal-title="Bạn chắc chắn muốn xóa?"
         data-izimodal-subtitle="{{$message->name}} # {{$message->email}}"
         style="display: none">
        <form METHOD="POST" class="bg-danger" action="{{route('messages.destroy.item', ['id' => $message->id])}}"
              id="form-remove">
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
        $(document).on('click', '#removeItem', function (event) {
            event.preventDefault()
            $('#modal-remove').iziModal('open')
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
