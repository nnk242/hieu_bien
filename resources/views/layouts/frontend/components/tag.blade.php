<div class="top-story mb-5">
    <div class="form-group">
        <p class="sidebar-title">
            <span class="fa fa-tags" aria-hidden="true"></span>TAGS
        </p>
        <div class="tag-item">
            @foreach($tags['name'] as $key=>$value)
                <span class="fa fa-hashtag"></span><a href="{{route('frontend.tag', ['tag' => $tags['seo'][$key]])}}"
                                                      title="{{$value}}" data-toggle="tooltip">{{$value}}</a>
            @endforeach
        </div>
    </div>
</div>
