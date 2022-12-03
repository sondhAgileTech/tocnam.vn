  <!-- Top-news -->
  <div class="top-news">
    <div class="top-news__inner mobile-free-slide">
                
            @foreach($data as $value)
                  <div class="top-news__item">
                  <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__thumb img_16_9">
                        <img class="img-responsive" src="{{asset('storage/'.$value['data']->img_news)}}" alt="">
                    </a>
                    <a class="top-news__title"
                href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}">{{$value['data']->name}}</a>
                </div>
                @endforeach
     </div>
</div>
