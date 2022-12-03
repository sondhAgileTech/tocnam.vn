<!-- Category title -->



<div class="category-title hidden-xs hidden-sm">
    <span class="category-title__sub">{{$ngay=date('d')}}/{{$thang=date('m')}}</span>
    <i class="fa fa-star category-title__icon"></i> <span class="category-title__sub">News feed</span>
    <i class="fa fa-star category-title__icon"></i> <span class="category-title__sub">Tin mới nhất</span>
</div>

<!-- Post-item -->
<!-- block 1 post 1 -->
@foreach($data as $key =>$value)
    @if($key==0)
        <div class="post-item post-item--blue post-item--border-bottom">
            <div class="post-item__inner">
                <div class="row">

                    <div class="col-md-7 col-md-push-5">
                        <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__thumb img_16_9">
                            <img data-src="{{asset('storage/'.$value['data']->img_news)}}" src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive">
                        </a>
                    </div>
                    <div class="col-md-5 col-md-pull-7">
                        <div class="post-item__info sm-mt15">
                            <div class="post-item__detail md-mt20">
                                <span class="post-item__circle"></span>
                                <a class="post-item__detail-sub post-item__category"
                                   href="/{{$value['parent']->slugs}}/{{$value['data']->slug_cate}}">{{$value['data']->name_cate}}</a>
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
                            <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}"
                               class="post-item__title">{{$value['data']->name_news}}</a>
                            <div class="post-item__desc">
                                {{$value['data']->description_news}}
                            </div>
                            <div class="post-item-author mt15 mb_mt10">
                                {{$value['data']->name_user}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @else
    @endif
@endforeach


<div class="row">
    <div class="col-md-12">
        <!-- Post-item -->


                @foreach($data as $key =>$value)
                    @if($key>0)
                <div class="post-item post-item--purple  post-item--border-bottom">
                    <div class="post-item__inner">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__thumb img_16_9">
                                    <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
                                </a>
                            </div>
                            <div class="col-md-6">
                                <div class="post-item__info sm-mt15">
                                    <div class="post-item__detail">
                                        <span class="post-item__circle"></span>
                                        <a class="post-item__detail-sub post-item__category" href="/{{$value['parent']->slugs}}/{{$value['data']->slug_cate}}">{{$value['data']->name_cate}}</a>
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
                                    <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__title">{{$value['data']->name_news}}</a>
                                    <div class="post-item__desc">
                                        {{$value['data']->description_news}}
                                    </div>
                                    <div class="post-item-author mt15 mb_mt10">
                                        {{$value['data']->name_user}}                                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @endif
                @endforeach


        <!-- /Post-item -->

    </div>
</div>


<!-- /Post-item -->



