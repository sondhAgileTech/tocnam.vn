<div class="box-border mb30">
    <h2 class="title-2">{{$data[0]['data']->name_cate}}</h2>
    <div class="trend-list">
        <div class="trend-list__inner mobile-free-slide">
                @foreach($data as $key=>$value)
            <div class="trend-box">
                <div class="trend-box__inner">
                    <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="trend-box__thumb">
                        <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="width:240px;height:200px;">
                    </a>
                    <div class="trend-box__info clearfix">
                        <div class="trend-box__number">{{$key+1}}</div>
                        <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="trend-box__title">{{$value['data']->name_news}}</a>
                    </div>
                </div>
            </div>
            @endforeach                     
                                      
                                    </div>
    </div>
</div>