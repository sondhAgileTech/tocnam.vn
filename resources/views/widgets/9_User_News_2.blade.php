

<div class="elle-style-box md-mb30">
    <div class="elle-style-box__inner">
        <h2 class="title">
        <strong></strong><span class="title__ex">{{$data[0]['data']->name_user}}</span>
        </h2>
        <div class="news-video-block">
            <div class="news-video-block__inner mobile-free-slide">
                                                      

                        @foreach($data as $key =>$value)
                        @if($key==0)
                        <div class="video-item video-item--first">
                                <div class="video-item__inner">
                                    <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__thumb" style="overflow: hidden">
                                        <span class="img_16_9_video">
                                             <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
                                        </span>
                                    </a>
                                    <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__title">{{$value['data']->name_news}}</a>
                                    <div class="video-item__desc hidden-xs hidden-sm">
                                            {{$value['data']->description_news}}                                         
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="video-item">
                                <div class="video-item__inner">
                                    <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__thumb" style="overflow: hidden">
                                        <span class="img_16_9_video">
                                            <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
                                        </span>
                                    </a>
                                    <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="video-item__title">{{$value['data']->name_news}}</a>
                                </div>
                            </div>
                        @endif
                        @endforeach
                                                          
                                                           
              </div>
        </div>
    </div>
</div>