@extends('layouts.admin')
@section('css')
    <!-- selectize -->
    <link href="/frontend/libs/selectize/css/bootstrap2.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/bootstrap3.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/selectize.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/default.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/legacy.css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-inbox-arrow-down text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Tin nhắn hôm nay</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{$todayMessage}}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1"
                           aria-hidden="true"></i> {{ (int)$yesterdayMessage != 0 ? 'Bằng '.((int)$todayMessage/(int)$yesterdayMessage)*100 . ' %' : 'Tăng ' . $todayMessage . ' tin nhắn'}}
                        tương tác gửi tin nhắn so với hôm qua
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Bài viết hôm nay</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{$todayPost}}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Tuần qua đã đăng {{$weekPost}} bài viết
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa fa-tags"></i> Tags của trang</h4>
                    <label>Sửa tags của trang</label>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="author_type" value="no" checked>
                                    Không
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-radio">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="author_type" value="yes"
                                           id="show-input-author"> Có
                                </label>
                            </div>
                        </div>
                    </div>
                    <form class="forms-sample" action="{{ route('dashboard.tag.edit') }}" method="POST"
                          enctype="multipart/form-data" id="form-tag" style="display: none">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title"><i class="fa fa-tag"></i> Tags</label>
                            <input id="input-tags" class="form-control" name="tags" value="{{$tags->tag}}">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <a href="{{\Illuminate\Support\Facades\URL::current()}}" class="btn btn-light" type="reset">Reload</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js"></script>
    <script>
        $('#input-tags').selectize({
            plugins: ['drag_drop', 'remove_button'],
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        })

        $("#show-input-author:checked").val() === 'yes' ? $('#form-tag').css({'display': 'block'}) : $('#form-tag').css({'display': 'none'})

        $("input[name='author_type']").on('click', function () {
            $("#show-input-author:checked").val() === 'yes' ? $('#form-tag').css({'display': 'block'}) : $('#form-tag').css({'display': 'none'})
        })
    </script>
@endsection
