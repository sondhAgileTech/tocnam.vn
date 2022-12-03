<header class="header">
    <div class="banner-header hidden-lg hidden-md hidden-xs hidden-sm">
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
        <div class="main-menu-block">
            <ul class="form-search-header list-unstyled form-search-header--2 hidden-xs hidden-sm">

                <li class="form-search-header__item">
                    <form class="form-search-header">
                        <a href="#search-form" class="form-search-header__button top-mobile-header__btn-search form-search-header__link" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </form>
                </li>
            </ul>

            <div class="bottom-header">
                <div class="bottom-header__inner">
                    <a class="logo hidden-sm hidden-xs" href="{{''}}"><img alt="" src="{{config('logo-mobile')}}" width="80"></a>
                    <ul class="main-menu list-unstyled">
                        @foreach($data['main_menu'] as  $value)
                        <li class="main-menu__item main-menu__item--green " data-active="{{''}}/{{$value->slugs}}" >
                            <a class="main-menu__link" href="{{''}}/{{$value->slugs}}">{{$value->name}}</a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
                            <ul class="sub-menu sub-menu--green list-unstyled hidden-sm hidden-xs">
                                @foreach($data['child_menu'] as  $value)
                                    <li class="sub-menu__item " data-active="{{''}}/{{$data['parent']->slugs}}/{{$value->slugs}}">
                                        <a  class="sub-menu__link" href="{{''}}/{{$data['parent']->slugs}}/{{$value->slugs}}">{{$value->name}}</a>
                                    </li>
                                @endforeach
                             </ul>
                    </div>

</header>

<form id="search-form" action="{{'search'}}" method="get" role="search" class="search-form mfp-hide" novalidate="novalidate">
    <div class="search-form-group">
        <span>Nhập từ khóa tìm kiếm</span>
        <input type="text" name="key" value="" placeholder="Tìm Kiếm" id="search-input" autocomplete="off">
    </div>
</form>