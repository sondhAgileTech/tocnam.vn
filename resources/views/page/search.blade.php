@extends('Layouts.index2')
@section('content')

<div class="elle-breadcrumb-wrapper gray-background">
    <div class="container">
    <div class="breadcrumb elle-breadcrumb"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="https://www.elle.vn/" rel="v:url" property="v:title">Trang chủ</a> / <span class="breadcrumb_last">Kết quả tìm kiếm "{{$key}}"</span></span></span></div>                <!-- 		<div class="breadcrumb elle-breadcrumb"><a href="#">ELLE NETWORK</a>  /  <a href="#">Nhân vật</a>  /  <a href="#">Người mẫu</a></div> -->
    </div>
</div>

<div class="main-content">
    <div class="container">
        <div class="top-title-network">Kết quả tìm kiếm: <span>{{$key}}</span>        </div>
                        <!-- Post-item -->

                @foreach($search as $value)
                <div class="post-item post-item--blue post-item--border-bottom">
                    <div class="post-item__inner">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="post-item__thumb img_16_9">
                                    <img src="{{asset('storage/'.$value['data']->img_news)}}" alt="" class="lazy img-responsive" style="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="post-item__info sm-mt15">
                                    <div class="post-item__detail">
                                        <span class="post-item__circle"></span>
                                        <a class="post-item__detail-sub post-item__category" href="/{{$value['parent']->slugs}}/{{$value['data']->slug_cate}}">{{$value['data']->name_cate}}</a>
                                        <span class="post-item__detail-sub post-item__time time_moment" onclick="time_moment($(this),{{date('YmdHi',strtotime($value['data']->time_news_updated))}})" data-time="{{$value['data']->time_news_updated}}"> {{now()->diffForHumans($value['data']->time_news_updated)}}</span>
                                        <div class="post-item__detail-sub post-item__share">
                                            <div class="post-item__share-text">Chia sẻ</div>
                                            <div class="post-item__share-inner">
                                                <a target="_blank" href="" class="post-item__share-icon post-item__share-facebook"><i class="fa fa-facebook"></i></a>
                                                <a target="_blank" href="" class="post-item__share-icon post-item__share-twitter"><i class="fa fa-envelope"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                                                        <a href="/{{$value['data']->slug_cate}}/{{$value['data']->slugs}}" class="post-item__title">{{$value['data']->name_news}}</a>
                                    <div class="post-item__desc">
                                        {{$value['data']->description_news}}                                   </div>
                                                                            <div class="post-item-author mt15">
                                                                                {{$value['data']->name_user}}                                        </div>
                                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                    <div class="data-loadmore"></div>
                    <a href="javascript:void(0)" title="Kết quả tìm kiếm: {{$key}}" class="readmore-search btn-viewmore" data-page="1" data-total-page="100" type-news="news" number-post-page-first="16" posts-per-page="10" keyword="{{$key}}">Xem thêm...</a>
            </div>
    <div class="fixed-block" style="right: 43.5px; top: 0px;">

</div>
</div>

@endsection