@extends('Layouts.index2')
@section('content')
    <div class="container">
    <div class="breadcrumb elle-breadcrumb"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="{{''}}" rel="v:url" property="v:title">Trang chủ</a> / <span class="breadcrumb_last">{{$page->name}}</span></span></span></div>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="content-static">
                <div class="content-static__title--top">{{$page->name}}</div>
                {!! $page->content !!}
            </div>
        </div>
        <div class="fixed-block" style="right: 46.5px;">

        </div>
    </div>
@endsection