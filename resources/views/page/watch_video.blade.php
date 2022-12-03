@extends('Layouts.index2')
@section('content')
<div class="elle-breadcrumb-wrapper gray-background">
    <div class="container">
        <div class="breadcrumb elle-breadcrumb"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="{{''}}" rel="v:url" property="v:title">Trang chủ</a> / <span class="breadcrumb_last">{{$value->name}}</span></span></span></div>  </div>
</div>
<div class="main-content">
        <div class="container">
            <!-- Video-item -->

            <div class="embed-responsive embed-responsive-16by9 video-detail">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$video}}"></iframe>
            </div>
            <div class="row row-video">
                <div class="col-md-8">
                    <a class="video-content-title-big" href="javascript:void(0)">
                        {{$value->name}}
                      </a>
                    <div class="video-content-text">
                        <p>  {!!$value->content_news!!}</p>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>

        </div>
        <div class="fixed-block" style="right: 43.5px; top: 726px;">

    </div>
    </div>
    @endsection