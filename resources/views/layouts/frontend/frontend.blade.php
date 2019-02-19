<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="BKmG-taf0SeoRRGYa8T-fvHjZIyheJslPVvV81JEf5c"/>

    <title>Hieu Bien</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--my style-->
    <link href="/frontend/css/styles.css" rel="stylesheet"/>

    <!-- selectize -->
    <link href="/frontend/libs/selectize/css/bootstrap2.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/bootstrap3.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/selectize.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/default.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/legacy.css" rel="stylesheet"/>

    @yield('css')
    <style>
        .custom-chat {
            position: fixed;
            bottom: 10px;
            right: 20px;
            cursor: pointer;
        }

        .custom-button-chat {
            width: 50px;
            height: 50px;
            border: 1px #cccccc;
            border-radius: 50%;
            background-color: #319af0;
        }

        .custom-button-chat i {
            font-size: 30px;
            transform: translate(44%, 37%);
        }

        .custom-bg-chat {
            opacity: 0.9;
            /*overflow-y: auto;*/
            position: fixed;
            max-height: 600px;
            max-width: 300px;
            right: 0;
            bottom: 0;
            background-color: #e9e8ea;
            z-index: 99999;
            width: 100%;
            height: 100%;
        }

        .custom-header-chat {
            background-color: #fff;
            height: 30px;
            width: 100%;
            border: 1px #eac7c7 solid;
        }

        .custom-close-body-chat > i {
            position: absolute;
            color: #ec293c;
            font-size: 22px;
            top: 3px;
            right: 3px;
            cursor: pointer;
        }

        .custom-button-send-chat {
            float: left;
            width: 100%;
            padding: 5px;
        }

        .custom-item-elemt-buttom-chat {
            width: 100%;
        }

        .custom-item-elemt-buttom-chat input {
            width: 79%;
            padding: 7px;
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border: solid 1px #cccccc;
        }

        .custom-item-elemt-buttom-chat button {
            width: 19%;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px;
            padding: 7px;
            border: solid 1px #cccccc;
            background-color: #cccccc;
        }

        .custom-content-chat {
            overflow-y: auto;
            height: 92vh;
            max-height: 515px;
            float: left;
            width: 100%;
        }

        .custom-message-left-chat {
            display: flex;
            justify-content: flex-start;
        }

        .custom-message-right-chat {
            display: flex;
            justify-content: flex-end;
        }

        .custom-message-left-chat .custom-item-message-chat {
            background-color: #cccccc;
        }

        .custom-message-right-chat .custom-item-message-chat {
            background-color: #ffffff;
        }

        .custom-message-left-chat .custom-item-message-chat, .custom-message-right-chat .custom-item-message-chat {
            overflow-wrap: break-word;
            max-width: 300px;
            border-radius: 5px;
            padding: 5px;
            margin: 10px 5px;
        }

        .custom-button-call {
            position: fixed;
            left: 0;
            bottom: 0;
        }

        .custom-button-call button {
            height: 30px;
            padding: 4px;
            border: solid 0px;
            border-radius: 5px;
        }

        .custom-tranform {
            color: #ffffff;
            transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -webkit-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
        }
    </style>
</head>
<body>
<div id="app">
    @include('layouts.frontend.components.header')
    @include('layouts.frontend.components.slide')

    <div class="wrap">
        {{--@include('layouts.frontend.components.shareMXH')--}}
        @yield('content')
    </div>
    @include('layouts.frontend.components.footer')
</div>
<div>
    <div class="custom-button-call">
        <a href="tel:+84382997997">
            <button class="bg-success customm"><i class="fa fa-phone custom-tranform"></i> (+84) 382 997 997</button>
        </a>
    </div>
</div>
<div>
    <div class="custom-chat" id="custom-click">
        <div class="custom-button-chat">
            <i class="fab fa-superpowers"></i>
        </div>
    </div>
    <div class="custom-body-chat" id="custom-body-chat" style="display: none">
        <div class="custom-bg-chat">
            <div class="custom-header-chat">
                <div class="custom-action-chat">
                    <div class="custom-close-body-chat">
                        <i class="fas fa-window-close" id="action-close-body-chat"></i>
                    </div>
                </div>
            </div>
            <div class="custom-content-chat" id="custom-content-message-chat">
                <div class="custom-message-left-chat">
                    <div class="custom-item-message-chat">
                        <h4 class="text-warning">Nha khoa thẩm mỹ Việt Đức xin chào bạn!</h4><br/>
                        <p>Chúng tôi có thể giúp gì được bạn?</p>
                        <p>Bạn có thể nhập số điện thoại để chúng tôi liên lạc với bạn.</p>
                    </div>
                </div>
                @if(isset($chat))
                    @foreach($chat as $value)
                        @if($value->type_chat == 'inbox')
                            <div class="custom-message-right-chat">
                                <div class="custom-item-message-chat">
                                    {{$value->message}}
                                </div>
                            </div>
                        @else
                            <div class="custom-message-left-chat">
                                <div class="custom-item-message-chat">
                                    {{$value->message}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
            <div class="custom-button-send-chat">
                <div class="custom-item-elemt-buttom-chat">
                    <input placeholder="Nhập tin nhắn" id="text-message"/>
                    <button id="submit_message">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

<script src="/frontend/libs/selectize/js/standalone/selectize.js"></script>

<script src="/frontend/libs/selectize/js/selectize.js"></script>

<script src="/frontend/js/search.js"></script>

@yield('js')
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script>
    $('#custom-body-chat').css({'display': 'none'})
    $(document).on('click', '#custom-click', function () {
        $('#custom-body-chat').css({'display': 'block'})
    })
    $(document).on('click', '#action-close-body-chat', function () {
        $('#custom-body-chat').css({'display': 'none'})
    })

    $('.custom-content-chat').scrollTop($('.custom-content-chat')[0].scrollHeight);
    $(document).on('click', '#submit_message', function () {
        var text_message = $('#text-message').val()

        if ($('#text-message').val() != '') {

            $.ajax({
                url: '/sendMessage/guest?message=' + text_message,
                method: 'GET',
                success: function (response) {
                    switch (response.status) {
                        case 205:
                            $('#custom-content-message-chat').append('<p class="text-danger text-center">Bạn gửi tin nhắn quá nhanh...</p>')
                            $('.custom-content-chat').scrollTop($('.custom-content-chat')[0].scrollHeight);
                            break
                        case 200:
                            break
                        default:
                            $('#custom-content-message-chat').append('<p class="text-danger text-center">Có lỗi từ server...</p>')
                            $('.custom-content-chat').scrollTop($('.custom-content-chat')[0].scrollHeight);
                            break
                    }
                    $('#text-message').val('')
                }

            })
        }

    })

    Pusher.logToConsole = true;

    var pusher = new Pusher('fff99aade71a480c4189', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('{{request()->session()->get('event-chat')}}');
    channel.bind('my-event', function (data) {
        if (data['is'] == true) {
            $('#custom-content-message-chat').append('<div class="custom-message-left-chat">\n' +
                '                    <div class="custom-item-message-chat">\n' + data['message'] +
                '                    </div>\n' +
                '                </div>')
            $('.custom-content-chat').scrollTop($('.custom-content-chat')[0].scrollHeight)
        } else {
            $('#custom-content-message-chat').append('<div class="custom-message-right-chat">' +
                '<div class="custom-item-message-chat">' + data['message'] + '</div>\n' +
                '</div>')
            $('.custom-content-chat').scrollTop($('.custom-content-chat')[0].scrollHeight)
        }

    });
</script>
</body>
</html>
