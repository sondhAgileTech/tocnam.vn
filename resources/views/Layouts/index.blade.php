<!DOCTYPE html>
    <html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><!--<![endif]-->
<head>
    <title>{{config('title')}} | {{config('web_name')}}</title>
    <base href="{{asset('')}}"/>
    <link rel="shortcut icon" href="{{config('favicon')}}" type="image/vnd.microsoft.icon">
    <link rel="canonical" href="{{''}}">
    <link rel="publisher" href="{{config('publisher')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="dc.language" content="VI">
    <meta name="dc.source" content="{{''}}">
    <meta name="dc.creator" content="{{config('web_name')}}">
    <meta name="distribution" content="Global">
    <meta name="revisit" content="1 days">
    <meta name="geo.placename" content="Vietnamese">
    <meta name="geo.region" content="Vietnamese">
    <meta name="generator" content="{{''}}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="home-page" content="{{asset('')}}" />
    <meta name="description" content="{{config('description')}}">
	 <meta name="msapplication-TileImage" content="{{config('logo-mobile')}}">
	<link rel="shortcut icon" href="{{config('logo-mobile')}}"/>
    <meta name="robots" content="noodp">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{config('title')}} | {{config('web_name')}}">
    <meta property="og:description" content="{{config('description')}}">
    <meta property="og:url" content="{{''}}">
    <meta property="og:site_name" content="{{config('web_name')}}">
    <meta property="fb:app_id" content="{{config('fb_app_id')}}">
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81221930-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-81221930-1');
</script>

    <link rel="stylesheet" id="wp-pagenavi-css" href="css/pagenavi-css.css" type="text/css" media="all">
    <link rel="stylesheet" id="css-plugin-css" href="css/plugins.css" type="text/css" media="all">
    <link rel="stylesheet" id="css-main-css" href="css/main.css" type="text/css" media="all">
    <link rel="stylesheet" id="css-themes-css" href="css/style.css" type="text/css" media="all">
    <link rel="stylesheet" id="css-extend-themes-css" href="css/style-ext.css" type="text/css" media="all">
    <link rel="stylesheet" id="" href="fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css" type="text/css" media="all">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script async="async" src="js/gpt.js"></script>
	<script src="js/spm.v1.min.js"></script>
    <script type="text/javascript">
        var ajax_url = ajaxurl = "{{asset('ajax')}}";
    </script>
	
</head>
<body class="home blog">
	
	<div id="wrapper" class="mm-page mm-slideout">
    @include('Layouts.header')
	
    <div class="main-content">
        @yield('content')
    </div>
    @include('Layouts.tagBlock')
    @include('Layouts.footer')
	
	</div>
    <a href="javascript:void(0)" title="" class="back-to-top" id="backtotop"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

    <script type="text/javascript" src="js/modernizr.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/xss.min.js"></script>
    <script src="js/jquery.scrolldepth.min.js"></script>
	
    <script>
    jQuery(function() {
        jQuery.scrollDepth({
        });
    });
    </script>
    <script type="text/javascript" src="js/app-ext.js"></script>
    <div id="mm-blocker" class="mm-slideout"></div>
</body>
</html>