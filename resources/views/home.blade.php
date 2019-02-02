@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <textarea cols="60" id="area2" style="width: 100%"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="js/nicedit/nicEdit.js" type="text/javascript"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('area2');
        });
    </script>
@endsection
