@extends('Layouts.index2')
@section('content')
<div class="elle-breadcrumb-wrapper gray-background">
    <div class="container">
    <div class="breadcrumb elle-breadcrumb"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="{{''}}" rel="v:url" property="v:title">Trang chủ</a> / <span class="breadcrumb_last">Video</span></span></span></div>
    </div>
</div>
<!-- Content -->
<div class="main-content">
        <div class="container">

            <!-- Video-item -->
            @foreach($video as $key  => $value)
                @if($key==0)
                            <div class="video-big">
                    <a href="/video/{{$value->slugs}}">
                        <img class="img-responsive" src="{{asset('storage/'.$value->img_news)}}" alt="">
                    </a>
                    <div class="video-big__title">
                    <a class="video-big__link" href="/video/{{$value->slugs}}">{{$value->name}}</a>
                        <div class="button-play button-play-big">
                            <span class="button-play__video button-play__video-big"><i></i></span>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach


            
            <div class="row row-video">

                    @foreach($video as $key  => $value)
                    @if($key>0)
                               
                    <div class="col-md-4">
                            <div class="video-content">
                                <a class="video-content__img" href="/video/{{$value->slugs}}">
                                    <span class="img_16_9_video">
                                    <img class="lazy img-responsive" src="{{asset('storage/'.$value->img_news)}} " alt="" style="">
                                    </span>
                                    <div class="button-play">
                                        <span class="button-play__video"><i></i></span>
                                    </div>
                                </a>
                                <a class="video-content__title" href="/video/{{$value->slugs}}">{{$value->name}}</a>
                            </div>
                        </div>
                                                                   
                                                                   
                             
                    @endif
                    @endforeach
                                          
                 </div>
          
          
            <div class="banner-content hidden-sm hidden-xs">

            </div>

            <a href="javascript:void(0)" title="" class="readmore-category btn-viewmore" term-id="" data-page="1" type-news="video" number-post-page-first="16" posts-per-page="6" >Xem thêm video...</a>
                    </div>
        <div class="fixed-block" style="right: 43.5px; top: 0px;">

</div>
    </div>
@endsection