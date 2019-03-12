@if(isset($posts))
    @if($posts->currentPage() == 1)
        @if(isset($slides))
            @if(count($slides))
                <section class="slide">
                    <div id="slide" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            @foreach($slides as $key=>$slide)
                                <li data-target="#slide" data-slide-to="{{$key}}"
                                    class="custom-radius {{$key==0? 'active' : ''}}"></li>
                            @endforeach
                        </ul>
                        <div class="carousel-inner">
                            @foreach($slides as $key=>$slide)
                                <div class="carousel-item {{$key==0? 'active' : ''}}">
                                    {{--<img style="width: 100%" src="{{$slide->image? $slide->image: 'https://nhakhoafamily.vn/wp-content/uploads/2019/03/banner-ct-moi.jpg'}}">--}}
                                    <div class="custom-carousel"
                                         style="background-image: url({{$slide->image? $slide->image: 'https://nhakhoafamily.vn/wp-content/uploads/2019/03/banner-ct-moi.jpg'}});"></div>
                                    <div class="carousel-caption">
                                        <a href="{{route('frontend.post', ['post' => $slide->title_seo])}}"><h3>{{$slide->title}}</h3></a>
                                        <a href="{{route('frontend.post', ['post' => $slide->title_seo])}}">{{$slide->introduce}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#slide" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#slide" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </section>
            @endif
        @endif
    @endif
@endif
