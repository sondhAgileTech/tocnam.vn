<div class="box-border mb30">
    <h2 class="title">
        <strong>Video </strong><span class="title__ex">Mới nhất</span>
    </h2>
    <div class="news-video-block">
        <div class="news-video-block__inner mobile-free-slide">

                @foreach($data as $key => $value)
                    @if($key==0)

                    <div class="video-item video-item--first">
                            <div class="video-item__inner">
                                <a href="/the-loai/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__thumb">
                                    <span class="img_16_9_video">
                                    <img src=" {{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
                                    </span>
                                    <div class="button-play button-play-1">
                                        <span class="button-play__video button-play__video-1"><i></i></span>
                                    </div>
                                </a>
                                <a href="/the-loai/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__title">{{$value['data']->name}}</a>
                                <div class="video-item__desc hidden-xs hidden-sm">
                                        {{$value['data']->description_news}}                                         </div>
                            </div>
                        </div>
                    @else
                

                        <div class="video-item">
                            <div class="video-item__inner">
                                <a href="/the-loai/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__thumb">
                                    <span class="img_16_9_video">
                                    <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
                                    </span>
                                    <div class="button-play">
                                        <span class="button-play__video"><i></i></span>
                                    </div>
                                </a>
                                <a href="/the-loai/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__title">{{$value['data']->name}}</a>
                            </div>
                        </div>
                    @endif
                   
                @endforeach

                                        </div>
    </div>
</div>