@extends('Layouts.index2')
@section('content')
<!-- Content -->
<meta name="child-cate" content="{{''}}/{{$data['parent']->slugs}}/{{$data['details']->slug_cate}}" />
<meta name="parent-cate" content="{{''}}/{{$data['parent']->slugs}}" />
<div class="elle-breadcrumb-wrapper gray-background" >
    <div class="container"  >
        <div class="breadcrumb elle-breadcrumb" style="border-top:1px solid #cccccc; margin-top: 11px;"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">
                    <a href="{{''}}" rel="v:url" property="v:title">Trang chủ</a> /
                    <span rel="v:child" typeof="v:Breadcrumb"><a href="/{{$data['parent']->slugs}}" rel="v:url" property="v:title">{{$data['parent']->name}}</a> /
                        <span rel="v:child" typeof="v:Breadcrumb"><a href="/{{$data['parent']->slugs}}/{{$data['details']->slug_cate}}" rel="v:url" property="v:title">{{$data['details']->name_cate}}</a> /
                            <span class="breadcrumb_last">{{$data['details']->name}}</span></span></span></span></span></div>    </div>
</div>
@if(($data))


<div class="main-content">
    <ul class="detail-share detail-share--fixed list-unstyled">
        <li class="detail-share__item">
            <div class="fb-like" data-href="{{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
        </li>
        <li class="detail-share__item">
            <a class="detail-share__link--facebook" target="_blank"  href="https://www.facebook.com/sharer/sharer.php?u={{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}">
                <i class="fab fa-facebook" aria-hidden="true"></i>
            </a>
        </li>
        <li class="detail-share__item">
            <a class="detail-share__link--gmail" target="_blank"  href="https://www.pinterest.com/pin/create/button/?url={{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}" title="Chia sẻ qua pinterest">
                <i class="fab fa-pinterest" aria-hidden="true"></i>
            </a>
        </li>
		
		  <li class="detail-share__item">
            <a class="detail-share__link--gmail" target="_blank"  href="https://plus.google.com/share?url={{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}" title="Chia sẻ qua G+">
                <i class="fab fa-google-plus-g" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
    <div class="container">
                <!-- Top-news -->
        <div class="top-news">
                    <div class="top-news__inner mobile-free-slide">
                          
                            @foreach($data['relate'] as $value) 
                                <div class="top-news__item">
                                    <a href="/{{$value->slug_cate}}/{{$value->slugs}}" class="post-item__thumb img_16_9">
                                        <img class="img-responsive" src="{{asset('storage/'.$value->img_news)}}" alt="">
                                    </a>
                                    <a class="top-news__title"
                                href="{{asset('')}}/{{$value->slug_cate}}/{{$value->slugs}}">{{$value->name_news}}</a>
                                </div>
                                @endforeach
                    </div>
        </div>
                <!-- /Top-news -->

        <!-- Banner -->
        <div class="banner-content hidden-md hidden-lg">

        </div>
        <div class="banner-content hidden-sm hidden-xs">

        </div>
        <!-- /Banner -->

        <div class="content-detail">
            <div class="row sticky-parent" data-sticky_parent >
            
                <div class="col-md-8" data-sticky_column>
                       
                  <div itemscope itemtype="https://schema.org/Article" class="content-detail__post-content">
						<h1 itemprop="name headline" class="content-detail__title">
                               
                                    {{$data['details']->name}}
                               
                        </h1>
                        <div class="clearfix content-detail__info">
							<span class="content-detail__avatar" itemprop="author" itemscope itemtype="http://schema.org/Person">
								<img itemprop="image" class="img-circle" src="{{asset('storage/'.$data['details']->avatar_user)}}" alt="">
								<meta itemprop="name" content="{{$data['details']->name_user}}">
							</span>
							<div class="pull-left">
								<div class="time-author__item">
									Bài viết của <a>{{$data['details']->name_user}}</a>								</div>
								<div class="time-author__item">
																			Xuất bản: <span itemprop="datePublished">{{date('d/m/Y-H:i:s',strtotime($data['details']->time_news_created))}}</span>

																			| Chỉnh sửa:<span itemprop="dateModified"> {{date('d/m/Y-H:i:s',strtotime($data['details']->time_news_created))}}</span>
								</div>
							</div>
                            <div itemprop="description" class="content-detail__short-desc">
                                <p>{{$data['details']->description_news}} </p>
                            </div>
                            <div itemprop="articleBody" class="content-detail__content">
                                    {!!$data['details']->content_news!!}
                               </div>
                                                        
                            <span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                <meta itemprop="url" content="{{asset('storage/'.$data['details']->img_news)}}">
                                <meta itemprop="width" content="800">
                                <meta itemprop="height" content="450">
                            </span>
                            <meta itemprop="mainEntityOfPage" content="{{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}">
                            <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                                <meta itemprop="name" content="{{config('web_name')}}">
                                <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="{{config('logo-main')}}">
								</span>
							</span>
                            <ul class="detail-share detail-share_mb list-unstyled list-inline hidden-md hidden-lg mt20">
                                <li class="detail-share__item">
                                    <div class="fb-like" data-href="{{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
                                </li>
                                <li class="detail-share__item">
                                    <a class="detail-share__link--facebook"  target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}">
                                        <i class="fab fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                  <li class="detail-share__item">
										<a class="detail-share__link--gmail" target="_blank"  href="https://www.pinterest.com/pin/create/button/?url={{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}" title="Chia sẻ qua pinterest">
											<i class="fab fa-pinterest" aria-hidden="true"></i>
										</a>
								</li>
		
							  <li class="detail-share__item">
									<a class="detail-share__link--gmail" target="_blank"  href="https://plus.google.com/share?url={{asset('')}}{{$data['details']->slug_cate}}/{{$data['details']->slugs}}" title="Chia sẻ qua G+">
										<i class="fab fa-google-plus-g" aria-hidden="true"></i>
									</a>
							</li>
                            </ul>
                        </div>
                    </div>
                   

                    
                </div>

               

                <div class="sticky-spacer">
                    <div id="sticky_item" class="col-md-4" data-sticky_column>
						<div class="content-detail__ads banner-left-detail hidden-sm hidden-xs">
							{!!config('news-ads')!!}
						</div>	
						                        
                    </div>
                </div>

                
            </div>
        </div>
                <a class="see-more" href="javascript:void(0)">Bài viết liên quan</a>
        <div class="row">
               
                    <div class="col-md-6">
                            <div class="row">
                            @foreach($data['random_relate'] as $key =>  $value)
                             
                                    <div class="col-md-6">
                                        <div class="video-content">
                                            <a class="video-content__link post-item__thumb img_16_9" href="/{{$value->slug_cate}}/{{$value->slugs}}">
                                                <img class="lazy img-responsive" src="{{asset('storage/'.$value->img_news)}}" data-src="{{asset('storage/'.$value->img_news)}}" alt="">
                                            </a>
                                            <a class="video-content__title"
                                            href="/{{$value->slug_cate}}/{{$value->slugs}}">{{$value->name_news}}</a>
                                        </div>
                                    </div>
                           
                        @endforeach
                                                                        
                                                   <div class="clearfix"></div>
                            
                                                                     
                                                                        
                             </div>
              </div>
             
                                    
                                                
        </div>
                               
                               

                            <div class="video-content-detail">
                                    @foreach($data['video_relate'] as $value)
                <div class="video-content-detail__item embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$value->video_news}}"></iframe>
                </div>
                <a class="video-content-title-big" href="{{$value->video_news}}">
                   
                 
                    {{$value->name_news}}
                   
                </a>
                @endforeach
            </div>
           
                <hr class="border-black border-width-5">
        <h2 class="title-detail-big"><a href="/{{$data['parent']->slugs}}/{{$data['details']->slug_cate}}" title="{{$data['details']->name_cate}}">{{$data['details']->name_cate}}</a></h2>
        <div class="banner-content hidden-md hidden-lg">

        </div>
        <div class="row">
                @foreach($data['botton_relate'] as $value) 
                                <div class="col-md-3">
                        <div class="detail-content">
                            <a class="detail-content__img img_16_9" href="/{{$value->slug_cate}}/{{$value->slugs}}">
                                <img class="lazy img-responsive" src="{{asset('storage/'.$value->img_news)}}" data-src="{{asset('storage/'.$value->img_news)}}" alt="">
                            </a>
                            <a class="video-content__title" href="/{{$value->slug_cate}}/{{$value->slugs}}">{{$value->name_news}}</a>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix"></div>                                                        
                              <div class="banner-content hidden-md hidden-lg">

                        </div>
                                                        
                    <div class="clearfix"></div>                                                        
                                                                           
                                                                           
                                                                           
                    <div class="clearfix"></div>                                                <a href="/{{$data['parent']->slugs}}/{{$data['details']->slug_cate}}" title="{{$data['details']->name_cate}}" class="readmore-homepage btn-viewmore">Xem thêm...</a>
        </div>
        <!-- /Detail-item -->
    </div>
    <div class="fixed-block">

</div>
</div>

    <script>

    </script>
@endif
<!-- Content -->
@endsection