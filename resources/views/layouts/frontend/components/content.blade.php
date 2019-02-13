@foreach($posts as $post)
    <div>
        <div class="item">
            <h2 class="post" data-id="{{$post->id}}"><a href="{{route('frontend.post', ['post' => $post->title_seo])}}" title="{{$post->title}}"
                                                        data-toggle="tooltip">{{$post->title}}</a>
            </h2>
            <div>
                                    <span class="fa fa-eye" aria-hidden="true">
                                    </span> {{$post->view}}&nbsp;-&nbsp;<span class="fa fa-clock-o" aria-hidden="true">
                                    </span>&nbsp;{{time_elapsed_string($post->created_at)}}
            </div>
            <div class="row description">
                <div class="col-md-4 mb-3">
                    <div class="custom-item-img"
                         style="background-image: url({{$post->image? $post->image: 'https://66.media.tumblr.com/46731882a838df1797b48fc8dd3a7a04/tumblr_pkqo6ifwv21rogvb0o1_1280.jpg'}}); width: 100%"></div>
                </div>
                <div class="col-md-8">
                    <a href="{{route('frontend.post', ['post' => $post->title_seo])}}" title="{{$post->title}}" data-toggle="tooltip">
                        <p>
                            {{$post->introduce}}
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

{!! $posts->appends(request()->except('page'))->links() !!}
