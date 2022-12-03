<header class="header">
    <div class="container">
        <div class="top-header hidden-xs hidden-sm">
            <div class="top-header__inner">
                <ul class="social-list list-unstyled">
                    <li class="social-list__item social-list__item--first">
                        Kết nối
                    </li>
                    <li class="social-list__item">
                        <a href="{{config('facebook')}}" title="Facebook" rel="nofollow" id="fb_header" target="_blank" class="social-list__link">
                            <i class="fab fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="social-list__item">
                        <a href="{{config('instagram')}}" title="Instagram" rel="nofollow" id="instagram_header" target="_blank" class="social-list__link">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="social-list__item">
                        <a href="{{config('youtube')}}" title="Youtube" rel="nofollow" id="youtube_header" target="_blank" class="social-list__link">
                            <i class="fab fa-youtube" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="social-list__item">
                        <a href="{{config('zalo')}}" title="Zalo" rel="nofollow" id="zalo_header" target="_blank" class="social-list__link">
                            <span class="zalo">Zalo</span>
                        </a>
                    </li>
                </ul>

                <form class="form-search-header custom-search hidden-xs hidden-sm">
                    <a href="#search-form" class="form-search-header__button top-mobile-header__btn-search" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </form>

            </div>
        </div>
    </div>
	
    <div class="banner-header hidden-xs hidden-sm" style="background:#fff">
        <div class="container">
            <img class="img-responsive" alt="" src="{{config('banner')}}">
        </div>
    </div>

    <div class="top-mobile-header hidden-md hidden-lg" style="background:#d3d5c3">
        <div class="top-mobile-header__inner" style="background-image:url({{config('mobile-banner')}})">
            <div class="container">
                <a class="top-mobile-header__btn top-mobile-header__btn-menu" href="#"><i class="fa fa-bars"></i></a>
                <a class="top-mobile-header__logo" href="{{''}}"><img src="{{config('logo-mobile')}}" alt=""></a>
                <a class="top-mobile-header__btn top-mobile-header__btn-search" href="#search-form"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="bottom-header">
            <div class="bottom-header__inner">
                <a class="logo hidden-sm hidden-xs" href=""><img alt="{{''}}" src="{{config('logo-mobile')}}"></a>
                <ul class="main-menu list-unstyled">
                    @foreach($menu as $value)
                        <li class="main-menu__item main-menu__item-- ">
                            <a class="main-menu__link" href="/{{$value->slugs}}">{{$value->name}}</a>

                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
<style>
.shimmer{padding:0 150px 0 0;text-align:center;color:rgba(241,118,110,0.1);background:-webkit-gradient(linear,left top,right top,from(#fbe0b5),to(#e78e78),color-stop(0.5,#f7886c));background:-moz-gradient(linear,left top,right top,from(#fbe0b5),to(#e78e78),color-stop(0.5,#f7886c));background:gradient(linear,left top,right top,from(#fbe0b5),to(#e78e78),color-stop(0.5,#f7886c));-webkit-background-size:125px 100%;-moz-background-size:125px 100%;background-size:125px 100%;-webkit-background-clip:text;-moz-background-clip:text;background-clip:text;-webkit-animation-name:shimmer;-moz-animation-name:shimmer;animation-name:shimmer;-webkit-animation-duration:2s;-moz-animation-duration:2s;animation-duration:2s;-webkit-animation-iteration-count:infinite;-moz-animation-iteration-count:infinite;animation-iteration-count:infinite;background-repeat:no-repeat;background-position:0 0;background-color:#f7886c}
@-moz-keyframes shimmer {
0%{background-position:top left}
100%{background-position:top right}
}
@-webkit-keyframes shimmer {
0%{background-position:top left}
100%{background-position:top right}
}
@-o-keyframes shimmer {
0%{background-position:top left}
100%{background-position:top right}
}
@keyframes shimmer {
0%{background-position:top left}
100%{background-position:top right}
}
</style>
</header>

<form id="search-form" action="{{'search'}}" method="get" role="search" class="search-form mfp-hide" novalidate="novalidate">
    <div class="search-form-group">
        <span>Nhập từ khóa tìm kiếm</span>
        <input type="text" name="key" value="" placeholder="Tìm Kiếm" id="search-input" autocomplete="off">
    </div>
</form>



