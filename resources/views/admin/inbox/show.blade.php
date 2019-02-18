@extends('layouts.admin')
@section('css')
    <style>
        .reply-cs {
            width: 100%;
            float: left;
        }

        .content-message {
            width: 100%;
            float: left;
        }

        .input-cs {
            width: 80%;
            float: left;
        }

        .button-cs {
            width: 20%;
            float: left;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-8 grid-margin stretch-card offset-2">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Trả lời tin nhắn: {{$item->name}} <span
                        class="text-warning">#</span> {{$item->ip}}</h1>


            </div>
        </div>
    </div>
    <div class="col-lg-8 offset-2 bg-white float-left p-3">
        <button class="btn btn-danger mb-3" id="removeAll"><i class="fa fa-trash"></i>Xóa tin nhắn</button>
        <div class="content-message" id="message-cs" style="height: 500px; overflow-y: auto">
            @foreach($chat as $value)
                @if($value->type_chat == 'reply')
                    <div>
                        <a href="#">{{time_elapsed_string($value->created_at) }}</a>
                    </div>
                    <div class="message-right justify-content-end d-flex bg-warning p-1 border mb-3 w-100">
                        {{$value->message}}
                    </div>
                @else
                    <div>
                        <small>{{time_elapsed_string($value->created_at) }}</small>
                    </div>
                    <div class="message-left justify-content-start d-flex bg-light p-1 border mb-3">
                        {{$value->message}}
                    </div>
                @endif
            @endforeach
        </div>
        <div class="reply-cs">
            <input class="input-cs" style="border: solid 2px #cccccc" id="input-message">
            <button class="button-cs" id="submit-message">Trả lời</button>
        </div>

    </div>
    <div id="modal-remove" data-izimodal-title="Bạn chắc chắn muốn xóa?"
         data-izimodal-subtitle="{{$item->name}} # {{$item->ip}}"
         style="display: none">
        <form METHOD="POST" class="bg-danger" action="{{route('inbox.destroy.all', ['id' => $item->id])}}"
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
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        $(document).on('click', '#removeAll', function (event) {
            event.preventDefault()
            $('#modal-remove').iziModal('open')
            console.log($("#id-item").val())
        });

        $(document).on('click', '#submit-message', function () {
            var text_message = $('#input-message').val()
            console.log(text_message)
            $.ajax({
                url: '{{route('inbox.reply')}}' + '?message=' + text_message + '&id=' + '{{$item->id}}',
                method: 'GET',
                success: function (response) {
                    // switch (response.status) {
                    //     case 200:
                    //         $('#message-cs').append('<div class="message-left justify-content-end d-flex bg-warning p-1 border mb-3">' + text_message + '</div>')
                    //         break
                    //     default:
                    //         $('#message-cs').append('<div class="text-center mb-3 text-danger">Error</div>')
                    //         break
                    // }
                    $('#input-message').val('')
                }

            })
        })

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

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('fff99aade71a480c4189', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('{{$item->name}}');
        channel.bind('my-event', function (data) {
            if (data['is'] == true) {
                $('#message-cs').append('<div class="message-left justify-content-end d-flex bg-warning p-1 border mb-3">' + data.message + '</div>')
            } else {
                $('#message-cs').append('<div class="message-left justify-content-start d-flex bg-light p-1 border mb-3">' + data.message + '</div>')
            }
        });
        $('#message-cs').scrollTop($('#message-cs')[0].scrollHeight)
    </script>
@endsection
