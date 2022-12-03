<div class="box-border md-mt40 md-mb40">
    <div class="title">
            <strong></strong><span class="title__ex"><a> {{$data[0]['data']->name_user}}</a></span>
    </div>
   
    <div class="network-homepage-block">
           
        <div class="network-homepage-block__inner mobile-free-slide">
                @foreach($data as $value)
                      <div class="network-item">
                        <div class="network-item__inner">
                            <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="network-item__thumb img_16_9"><img src="{{asset('/storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style=""></a>
                            <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="network-item__title">{{$value['data']->name_news}}</a>
                            <!--<a href="" class="network-item__name"></a>-->
                        </div>
                    </div>
                    @endforeach      
     </div>

  
    </div>
    
</div>