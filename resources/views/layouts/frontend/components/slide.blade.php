@if(isset($posts))
    @if($posts->currentPage() == 1)
        @if(isset($slides))
            <section class="slide">
                <div id="slide" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        @foreach($slides as $key=>$slide)
                            <li data-target="#slide" data-slide-to="{{$key}}" class="custom-radius {{$key==0? 'active' : ''}}"></li>
                        @endforeach
                    </ul>
                    <div class="carousel-inner">
                        @foreach($slides as $key=>$slide)
                            <div class="carousel-item {{$key==0? 'active' : ''}}">
                                <div class="custom-carousel"
                                     style="background-image: url({{$slide->image? $slide->image: 'https://66.media.tumblr.com/948e0c698f664e6df4856a23e25d039d/tumblr_pkdnm1hOgl1rogvb0o1_1280.jpg'}});"></div>
                                <div class="carousel-caption">
                                    <h3>{{$slide->title}}</h3>
                                    <p> {{$slide->introduce}}</p>
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
