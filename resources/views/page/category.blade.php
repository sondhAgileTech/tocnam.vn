@extends('Layouts.index2')
@section('content')
    <meta name="child-cate" content="{{''}}/{{$data['title_seo_relate']->slugs}}/{{$data['title_seo_relate_child']->slugs}}" />
    <meta name="parent-cate" content="{{''}}/{{$data['title_seo_relate']->slugs}}" />
    <div class="elle-breadcrumb-wrapper gray-background">
        <div class="container">
            <div class="breadcrumb elle-breadcrumb" style="border-top: 1px solid #cccccc ;margin-top: 11px;">
                <span xmlns:v="http://rdf.data-vocabulary.org/#">
                    <span typeof="v:Breadcrumb"><a href="{{''}}" rel="v:url" property="v:title">Trang chủ</a> /
                        <span rel="v:child" typeof="v:Breadcrumb">
                            <a href="/{{$data['title_seo_relate']->slugs}}/" rel="v:url" property="v:title">{{$data['title_seo_relate']->name}}</a> /
                            <span class="breadcrumb_last">{{$data['title_seo_relate_child']->name}} </span>
                        </span>
                    </span>
                </span>
            </div>
        </div>
    </div>
<!-- Content -->
@if($data)
<div class="main-content">
        <div class="container">
            <div class="banner-content hidden-sm hidden-xs">
            </div>
            <!-- Category-item -->
            <div class="row content-category">

                         @foreach($data['top_relate'] as $key  => $value)  
                                      @if($key==0)
                                       <div class="col-md-6">
                            <div class="content-category__top">
                                <div class="img-top-category">
                                    <a href="/{{$value->slug_cate}}/{{$value->slugs}}" alt="">
										@if($value->img_vertical)
											<img class="img-responsive" src="{{asset('storage/'.$value->img_vertical)}}" alt="">
										@else
											<img class="img-responsive" src="{{asset('storage/'.$value->img_news)}}" alt="">
										@endif
                                    </a>
                                <h2 class="title-category-first">{{$value->name_cate}}</h2>
                                </div>
                                <a href="/{{$value->slug_cate}}/{{$value->slugs}}"><h1 class="title-category-last sm-mb15">{{$value->name_news}}</h1></a>
                            </div>
                        </div>
                       
                        @endif
                        @endforeach

                        
                                                <div class="col-md-6">
                                                        @foreach($data['top_relate'] as $key  => $value)  
                                                        @if($key>0)
                                                        <div class="content-category__inner row">
                        <div class="col-md-6 content-category__item sm-mb15">
                            <a href="/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__thumb img_16_9">
								<img class="img-responsive" src="{{asset('storage/'.$value->img_news)}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-6 content-category__item">
                            <a class="title-category" href="/{{$value->slug_cate}}/{{$value->slugs}}">{{$value->name_news}}</a>
                            <div class="text-category">
                                    {{$value->description_news}}                               
                             </div>
                        </div>
                        </div>
						<hr class="border-dotted border-black">
                        @endif
                        @endforeach
                        


                        <div class="banner-content hidden-md hidden-lg" style="">
                        
                        </div>
                                        
                        </div>
                      
                       

                                 
              </div>
            <div class="banner-content hidden-sm hidden-xs">
            </div>
            <div class="banner-content hidden-xs hidden-sm">

            </div>
            <!--<div class="mobile-ad hidden-md hidden-lg">
                <div class="mobile-ad__inner">
                    <img src="/images/img-ex-11.png" alt="" class="img-responsive">
                </div>
            </div>-->
            <!-- Post-item -->
            @foreach($data['botton_relate'] as $value) 
                        <div class="post-item post-item--green post-item--border-bottom">
                <div class="post-item__inner">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__thumb img_16_9 sm-mb15">
                                <img src="{{asset('storage/'.$value->img_news)}}" alt="" class="lazy img-responsive" style="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <div class="post-item__info sm-mt15">
                                <div class="post-item__detail mt20">
                                    <span class="post-item__circle"></span>
                                    <a class="post-item__detail-sub post-item__category" href="/{{$data['title_seo_relate']->slugs}}/{{$value->slug_cate}}">{{$value->name_cate}}</a>
                                    <span class="post-item__detail-sub post-item__time time_moment" onclick="time_moment($(this),{{date('YmdHi',strtotime($value->time_news_updated))}})" data-time="{{$value->time_news_updated}}"> {{now()->diffForHumans($value->time_news_updated)}}</span>
                                    <div class="post-item__detail-sub post-item__share">
                                        <div class="post-item__share-text">Chia sẻ</div>
                                        <div class="post-item__share-inner">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https:/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__share-icon post-item__share-facebook"><i class="fab fa-facebook"></i></a>
                                            <a target="_blank" href="https://www.pinterest.com/pin/create/button/?url={{asset('')}}{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__share-icon post-item__share-twitter"><i class="fab fa-pinterest"></i></a>
											  <a target="_blank" href="https://plus.google.com/share?url={{asset('')}}{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__share-icon post-item__share-twitter" title="g+"><i class="fab fa-google-plus-g"></i></a>
                                        </div>
                                    </div>
                                </div>
                                                                <a href="/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__title">{{$value->name_news}}</a>
                                <div class="post-item__desc">
                                    {{$value->description_news}}                             
                                </div>
                                                             <div class="post-item-author mt15">
                                                                        {{$value->name_user}}                                    </div>
                                  </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            <span class="remove_row"></span>
                <a href="javascript:void(0)" title="" class="readmore-category btn-viewmore" term-id="{{$data['title_seo_relate_child']->slugs}}" data-page="1" type-news="news" number-post-page-first="20" posts-per-page="10" >Xem thêm...</a>
            <div class="banner-content hidden-md hidden-lg">

            @section('script')
           
           
            @endsection
                      </div>
                             
               
                        
       
                        <!-- /Post-item -->
            <!--<div class="mobile-ad hidden-md hidden-lg">
                <div class="mobile-ad__inner">
                    <img src="/images/img-ex-11.png" alt="" class="img-responsive">
                </div>
            </div>-->
            <!-- /Category-item -->

                       
                    </div>
        <div class="fixed-block" style="right: 43.5px; top: 5889px;">

</div>
    </div>

    @endif
@endsection

