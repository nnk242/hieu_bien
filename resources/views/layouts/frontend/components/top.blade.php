<div class="stories">
    <div class="form-group">
        <p class="sidebar-title">
            <i class="fas fa-comment-alt"></i>Bài viết quan tâm
        </p>
        @foreach($top as $key=>$value)
            <div class="item-sidebar">
                <span class="rank-story-sidebar">{{$key+1}}</span>
                <div class="item-story-sidebar">
                    <h2 class="name"><a href="{{route('frontend.post', ['post' => $value->title_seo])}}"
                                        title="{{$value->title}}"
                                        data-toggle="tooltip">{{$value->title}}</a></h2>
                    <span class="stats">
                        <i class="fa fa-eye" aria-hidden="true"></i> {{$value->view}} -
                        <i class="fa fa-clock-o" aria-hidden="true"> {{time_elapsed_string($value->created_at)}}</i>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
