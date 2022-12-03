@foreach($data as $value)

<div class="post-item post-item--yellow post-item--style-2">
        <div class="post-item__inner">
            <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__thumb">
                <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
            </a>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <div class="post-item__info sm-mt15">
                        <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}"><h2 class="post-item__title">{{$value['data']->name_news}}</h2></a>
                        <div class="post-item__desc">
                                {{$value['data']->description_news}}                                  </div>
                        <div class="post-item__detail">
                            <span class="post-item__circle"></span>
                            <a class="post-item__detail-sub post-item__category" href="/{{$value['data']->slug_cate}}">{{$value['data']->name_cate}}</a>
                            <span class="post-item__detail-sub post-item__time time_moment" onclick="time_moment($(this),{{date('YmdHi',strtotime($value['data']->time_news_updated))}})" data-time="{{$value['data']->time_news_updated}}"> {{now()->diffForHumans($value['data']->time_news_updated)}}</span>
                            <div class="post-item__detail-sub post-item__share">
                                <div class="post-item__share-text">Chia sẻ</div>
                                <div class="post-item__share-inner">
                                          <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{asset('')}}{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__share-icon post-item__share-facebook" title="facebook"><i class="fab fa-facebook"></i></a>
                                        <a target="_blank" href="https://www.pinterest.com/pin/create/button/?url={{asset('')}}{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__share-icon post-item__share-twitter" title="printerest"><i class="fab fa-pinterest"></i></a>
										  <a target="_blank" href="https://plus.google.com/share?url={{asset('')}}{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__share-icon post-item__share-twitter" title="g+"><i class="fab fa-google-plus-g"></i></a>
                                    </div>
                            </div>
                        </div>
                                                        </div>
                </div>
            </div>
        </div>
 </div>

@endforeach