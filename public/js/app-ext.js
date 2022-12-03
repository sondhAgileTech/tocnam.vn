/**
 * Created by vietanh on 31-Mar-17.
 */
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var HOME_PAGE = $('meta[name="home-page"]').attr('content');
var $ = jQuery.noConflict();
jQuery(document).ready(function ($) {
    $('#sticky_item').stick_in_parent({
        parent: ".sticky-parent",
        spacer : '.sticky-spacer'
    });
    $('.lazy').lazy();
    $('form#subscribe-form-popup').validate({
        ignore: [],
        rules: {
            email: {
                required: true,
                email: true
            },
            phone: "required"
        },
        messages: {
            email: {
                required: 'Vui lòng nhập email.',
                email: 'Email không hợp lệ.'
            },
			phone: 'Vui lòng nhập điện thoại của bạn.',
        },
        errorPlacement: function (error, element) {
            element.attr('data-original-title', error.text())
                .attr('data-toggle', 'tooltip')
                .attr('data-placement', 'top');
            $(element).tooltip('show');
        },
        unhighlight: function (element) {
            $(element)
                .removeAttr('data-toggle')
                .removeAttr('data-original-title')
                .removeAttr('data-placement')
                .removeClass('error');
            $(element).unbind("tooltip");
        },
        submitHandler: function (form) {
            var obj = $(this);
            $.ajax({
                url: ajaxurl,
                type: "post",
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function () {
                    obj.attr('disabled', true).css('opacity', 0.5);
                },
                success: function (data, statusText, xhr) {
                    obj.attr('disabled', false).css('opacity', 1);
                    if( data.status == 'success'){
                        var htmlErrors = "";
                        htmlErrors += '<div class="success">Bạn đăng ký nhận bản tin thành công</div>';
                        swal({"title": "Thành công", "text": htmlErrors, "type": "success", html: true});
                        $.magnificPopup.close();
                        /*$.notify(data.message, {
                         offset: {
                         x: 20,
                         y: 70
                         }
                         });*/
                    } else {
                        var result = data.message;
                        var htmlErrors = "";
                        htmlErrors += "<div class='success'>" +result + "</div>";
                        swal({"title": "Lỗi", "text": htmlErrors, "type": "error", html: true});
                    }

                }

            });
        }
    });
    $('.readmore-tag').click(function () {

        var obj = $(this);
        var page = parseInt(obj.attr('data-page'));
        var totalPage = parseInt(obj.attr('total-page'));
        var taxonomy = obj.attr('taxonomy');
        var term = obj.attr('term');
        var action = "rvn_ajax_handler_page";
        var method = "GetPostsByTag";
        $.ajax({
            type: "post",
            url: ajaxurl,
            dataType: 'json',
            data: ({
                _token: CSRF_TOKEN,
                page: page,
                action: action,
                method: method,
                term:term,
                taxonomy:taxonomy
            }),
            beforeSend: function () {

            },
            success: function (data) {
                if( data.data){
                    var html = "";
                    $.each( data.data, function( key, value ) {
                        html += '<div class="post-item post-item--blue post-item--border-bottom">' +
                            '<div class="post-item__inner">'+
                            '<div class="row">'+
                            '<div class="col-md-5">'+
                            '<div class="post-item__thumb img_16_9">'+
                            '<img src="' + value.images.full + '" alt="" class="img-responsive">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-7">'+
                            '<div class="post-item__info sm-mt15">'+
                            '<div class="post-item__detail">'+
                            '<span class="post-item__circle"></span>'+
                            '<a class="post-item__detail-sub post-item__category" href="'+value.categories.term_link+'">'+value.categories.name+'</a>'+
                            '<span class="post-item__detail-sub post-item__time time_moment">'+moment(value.post_date_YmdHi, "YYYYMMDDHHII").fromNow()+'</span>'+
                            '<div class="post-item__detail-sub post-item__share">'+
                            '<div class="post-item__share-text">Chia sẻ</div>'+
                            '<div class="post-item__share-inner">'+
                            '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+value.permalink+'" class="post-item__share-icon post-item__share-facebook"><i class="fa fa-facebook"></i></a>'+
                            '<a target="_blank" href="mailto:?Subject='+ value.post_title +'&body='+value.post_excerpt+ '%0D%0A%0D%0A' +value.permalink +'" class="post-item__share-icon post-item__share-twitter"><i class="fa fa-envelope"></i></a>'+
                            '</div></div>'+
                            '</div>';
                        if (value.info.sponsored_attachment_id && value.info.sponsored_attachment_id != 0) {
                            if(value.info.sponsored_link === undefined || value.info.sponsored_link === null){value.info.sponsored_link = "javascript:void(0)"; };
                            html += '<div class="post-item__author">'+
                                '<span class="post-item__detail-sub">Bài viết của ELLE cho </span> <a href="'+ value.info.sponsored_link +'" target="_blank"> <img class="post-item__author-img" src="'+value.info.sponsored_attachment_id+'"></a>'+
                                '</div>';
                        }
                        html += '<a href="'+ value.permalink+'" class="post-item__title">'+value.post_title +'</a>'+
                            '<div class="post-item__desc">'+ value.post_excerpt +
                            '</div>';
                        if (value.user_info.display_name && value.user_info.display_name != 0) {
                            html += '<div class="post-item-author mt15">' + value.user_info.display_name + '</div>';
                        }
                        html += '</div></div></div></div></div>';

                    });
                    obj.attr('data-page',parseInt(page) + 1);
                    if(totalPage <= parseInt(page) + 1){
                        obj.css('display','none');
                    }
                    $(html).insertBefore(obj);
                    $(".post-item__share").on("click", function () {
                        $(this).toggleClass("active")
                    })
                } else {

                }
            }
        });
    });

    //Ajax Search
    $('.readmore-search').click(function () {
        var obj = $(this);
        var page = parseInt(obj.attr('data-page'));
        var posts_per_page = parseInt(obj.attr('posts-per-page'));
        var totalPage = parseInt(obj.attr('total-page'));
        var keyword = obj.attr('keyword');
        var number_post_page_frist = parseInt(obj.attr('number-post-page-first'));
        var to = ((page-1) * posts_per_page) + number_post_page_frist;
        var post_type = obj.attr('type-news');
        var action = "rvn_ajax_handler_page";
        var method = "GetPostsSearch";
        $.ajax({
            type: "post",
            url: ajaxurl,
            dataType: 'json',
            data: ({
                _token: CSRF_TOKEN,
                page: page,
                action: action,
                method: method,
                posts_per_page: posts_per_page,
                to : to,
                term_id: keyword,
                post_type: post_type
            }),
            beforeSend: function () {

            },
            success: function (data) {
                if(data){
                    var html = '';
                    if(post_type === 'news'){
                        $.each( data, function( key, value ) {
                            html += _renderPostList(value);
                        });
                    }
                    obj.attr('data-page',parseInt(page) + 1);
                    if(totalPage <= parseInt(page) + 1){
                        obj.css('display','none');
                    }
                    $(html).insertBefore(obj);
                    $(".post-item__share").on("click", function () {
                        $(this).toggleClass("active")
                    })
                } else {

                }
            }
        });
    });
    $('.readmore-homepage').click(function () {
        var obj = $(this);
        var page = parseInt(obj.attr('data-page'));
        var action = "rvn_ajax_handler_page";
        var method = "GetReadmorePostHomePage";
        var posts_per_page = parseInt(obj.attr('posts-per-page'));
        var not_in = obj.attr('data-not-in');
        var not_cat = obj.attr('data-not-cat');
        var number_post_page_first = parseInt($(".readmore-homepage").attr('number-post-page-first'));
        var to = ((page-1) * posts_per_page) + number_post_page_first;
        $.ajax({
            type: "post",
            url: ajaxurl,
            dataType: 'json',
            data: ({
                _token: CSRF_TOKEN,
                page: page,
                action: action,
                method: method,
                posts_per_page: posts_per_page,
                to : to,
                not_in:not_in,
                not_cat:not_cat,
            }),
            beforeSend: function () {

            },
            success: function (data) {
                if( data.data){
                    var html = "";
                    $.each( data.data, function( key, value ) {
                        html += '<div class="post-item post-item--blue post-item--border-bottom">' +
                            '<div class="post-item__inner">'+
                            '<div class="row">'+
                            '<div class="col-md-5">'+
                            '<div class="post-item__thumb img_16_9">'+
                            '<a href="'+ value.permalink+'" class="post-item__title"><img src="' + value.images.rvn_thumbnail + '" alt="" class="img-responsive"></a>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-7">'+
                            '<div class="post-item__info sm-mt15">'+
                            '<div class="post-item__detail">'+
                            '<span class="post-item__circle"></span>'+
                            '<a class="post-item__detail-sub post-item__category" href="'+value.categories.term_link+'">'+value.categories.name+'</a>'+
                            '<span class="post-item__detail-sub post-item__time time_moment">'+moment(value.post_date_YmdHi, "YYYYMMDDHHII").fromNow()+'</span>'+
                            '<div class="post-item__detail-sub post-item__share">'+
                            '<div class="post-item__share-text">Chia sẻ</div>'+
                            '<div class="post-item__share-inner">'+
                            '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+value.permalink+'" class="post-item__share-icon post-item__share-facebook"><i class="fa fa-facebook"></i></a>'+
                            '<a target="_blank" href="mailto:?Subject='+ value.post_title +'&body='+value.post_excerpt+ '%0D%0A%0D%0A' +value.permalink +'" class="post-item__share-icon post-item__share-twitter"><i class="fa fa-envelope"></i></a>'+
                            '</div></div>'+
                            '</div>';
                        if (value.info.sponsored_attachment_id && value.info.sponsored_attachment_id != 0) {
                            if(value.info.sponsored_link === undefined || value.info.sponsored_link === null){value.info.sponsored_link = "javascript:void(0)"; };
                            html += '<div class="post-item__author">'+
                                '<span class="post-item__detail-sub">Bài viết của ELLE cho </span> <a href="'+ value.info.sponsored_link +'" target="_blank"><img class="post-item__author-img" src="'+value.info.sponsored_attachment_id+'"></a>'+
                                '</div>';
                        }
                        html += '<a href="'+ value.permalink+'" class="post-item__title">'+value.post_title +'</a>'+
                            '<div class="post-item__desc">'+ value.post_excerpt +
                            '</div>' ;
                        if (value.user_info.display_name && value.user_info.display_name != 0) {
                            html += '<div class="post-item-author mt15">' + value.user_info.display_name + '</div>';
                        }
                        html += '</div></div></div></div></div>';

                    });
                    obj.attr('data-page',parseInt(page) + 1);
                    $(html).insertBefore(obj);
                    $(".post-item__share").on("click", function () {
                        $(this).toggleClass("active")
                    })

                } else {

                }
            }
        });
    });

    //Ajax Category

    $('.readmore-category').click(function () {
        var obj = $(this);

        // set is_loading state
        if(parseInt(obj.data('is_loading')) === 1){
            return false;
        }
        obj.data('is_loading', '1');

        var page = parseInt(obj.attr('data-page'));
        var totalPage = parseInt(obj.attr('total-page'));
        var action = "rvn_ajax_handler_page";
        var method = "GetReadmorePostCategory";
        var posts_per_page = parseInt(obj.attr('posts-per-page'));
        var number_post_page_frist = parseInt(obj.attr('number-post-page-first'));
        var term_id = obj.attr('term-id');
        var to = ((page-1) * posts_per_page) + number_post_page_frist;
        var post_type = obj.attr('type-news');
        var not_in = $(this).data('not_in');
        var _param = ({
            _token: CSRF_TOKEN,
            page: page,
            action: action,
            method: method,
            posts_per_page: posts_per_page,
            to : to,
            term_id: term_id,
        });
        if(post_type){
            _param['post_type'] = post_type;
        }

         // exclude 3 videos from home page.
        if(not_in !== undefined && not_in.length){
            _param['not_in'] = not_in;
        }

        $.ajax({
            _token: CSRF_TOKEN,
            type: "POST",
            url: ajaxurl,
            dataType: 'json',
            data: _param,
            beforeSend: function () {

            },
            success: function (data) {
                if(data){
                    var html = '';
                    if(post_type === 'video'){
                        html = _renderVideoList(data);
                    }
                    else if(post_type === 'news'){
                        html = _renderPostList(data);
                    }
                    obj.attr('data-page',parseInt(page) + 1);
                    if(totalPage < parseInt(page) + 1){
                        obj.css('display','none');
                    }
                    $(html).insertBefore(obj);

                    obj.data('is_loading', '');

                    $(".post-item__share").on("click", function () {
                        $(this).toggleClass("active")
                    })
                } else {

                }
            }
        });
    });
    $('.readmore-related-network').click(function () {
        var obj = $(this);
        var page = parseInt(obj.attr('data-page'));
        var totalPage = parseInt(obj.attr('total-page'));
        var post_related = obj.attr('post_related');
        var object_id = obj.attr('object_id');
        var to = ((page-1) * 10) + 4;
        var action = "rvn_ajax_handler_page";
        var method = "GetPostsRelated";
        $.ajax({
            type: "post",
            url: ajaxurl,
            dataType: 'json',
            data: ({
                _token: CSRF_TOKEN,
                page: page,
                action: action,
                method: method,
                post_related:post_related,
                to:to,
                object_id:object_id,
            }),
            beforeSend: function () {

            },
            success: function (data) {
                if( data.data){
                    var html = "";
                    $.each( data.data, function( key, value ) {
                        html += '<div class="post-item post-item--blue post-item--border-bottom">' +
                            '<div class="post-item__inner">'+
                            '<div class="row">'+
                            '<div class="col-md-5">'+
                            '<div class="post-item__thumb img_16_9">'+
                            '<img src="' + value.images.full + '" alt="" class="img-responsive">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-7">'+
                            '<div class="post-item__info sm-mt15">'+
                            '<div class="post-item__detail">'+
                            '<span class="post-item__circle"></span>'+
                            '<a class="post-item__detail-sub post-item__category" href="'+value.categories.term_link+'">'+value.categories.name+'</a>'+
                            '<span class="post-item__detail-sub post-item__time time_moment">'+moment(value.post_date_YmdHi, "YYYYMMDDHHII").fromNow()+'</span>'+
                            '<div class="post-item__detail-sub post-item__share">'+
                            '<div class="post-item__share-text">Chia sẻ</div>'+
                            '<div class="post-item__share-inner">'+
                            '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+value.permalink+'" class="post-item__share-icon post-item__share-facebook"><i class="fa fa-facebook"></i></a>'+
                            '<a target="_blank" href="mailto:?Subject='+ value.post_title +'&body='+value.post_excerpt+ '%0D%0A%0D%0A' +value.permalink +'" class="post-item__share-icon post-item__share-twitter"><i class="fa fa-envelope"></i></a>'+
                            '</div></div>'+
                            '</div>';
                        if (value.info.sponsored_attachment_id && value.info.sponsored_attachment_id != 0) {
                            if(value.info.sponsored_link === undefined || value.info.sponsored_link === null){value.info.sponsored_link = "javascript:void(0)"; };
                            html += '<div class="post-item__author">'+
                                '<span class="post-item__detail-sub">Bài viết của ELLE cho </span> <a href="'+ value.info.sponsored_link +'" target="_blank"><img class="post-item__author-img" src="'+value.info.sponsored_attachment_id+'"></a>'+
                                '</div>';
                        }
                        html += '<a href="'+ value.permalink+'" class="post-item__title">'+value.post_title +'</a>'+
                            '<div class="post-item__desc">'+ value.post_excerpt +
                            '</div>';
                        if (value.user_info.display_name && value.user_info.display_name != 0) {
                            html += '<div class="post-item-author mt15">' + value.user_info.display_name + '</div>';
                        }
                        html += '</div></div></div></div></div>';

                    });
                    obj.attr('data-page',parseInt(page) + 1);
                    if(totalPage <= parseInt(page) + 1){
                        obj.css('display','none');
                    }
                    $(html).insertBefore(obj);
                    $(".post-item__share").on("click", function () {
                        $(this).toggleClass("active")
                    })
                } else {

                }
            }
        });
    });
    $('.readmore-author').click(function () {
        var obj = $(this);
        var page = parseInt(obj.attr('data-page'));
        var action = "rvn_ajax_handler_account";
        var method = "GetReadmorePostOfAuthor";
        var posts_per_page = parseInt(obj.attr('posts-per-page'));
        var user_id = parseInt(obj.attr('user-id'));
        var number_post_page_first = parseInt($(".readmore-author").attr('number-post-page-first'));
        var to = ((page-1) * posts_per_page) + number_post_page_first;
        $.ajax({
            type: "post",
            url: ajaxurl,
            dataType: 'json',
            data: ({
                page: page,
                action: action,
                method: method,
                posts_per_page: posts_per_page,
                user_id : user_id,
                to : to,
            }),
            beforeSend: function () {

            },
            success: function (data) {
                if( data.data){
                    var html = "";
                    $.each( data.data, function( key, value ) {
                        html += '<div class="post-item post-item--blue post-item--border-bottom">' +
                            '<div class="post-item__inner">'+
                            '<div class="row">'+
                            '<div class="col-md-5">'+
                            '<div class="post-item__thumb img_16_9">'+
                            '<a href="'+ value.permalink+'" class="post-item__title"><img src="' + value.images.rvn_thumbnail + '" alt="" class="img-responsive"></a>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-md-7">'+
                            '<div class="post-item__info sm-mt15">'+
                            '<div class="post-item__detail">'+
                            '<span class="post-item__circle"></span>'+
                            '<a class="post-item__detail-sub post-item__category" href="'+value.categories.term_link+'">'+value.categories.name+'</a>'+
                            '<span class="post-item__detail-sub post-item__time time_moment">'+moment(value.post_date_YmdHi, "YYYYMMDDHHII").fromNow()+'</span>'+
                            '<div class="post-item__detail-sub post-item__share">'+
                            '<div class="post-item__share-text">Chia sẻ</div>'+
                            '<div class="post-item__share-inner">'+
                            '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+value.permalink+'" class="post-item__share-icon post-item__share-facebook"><i class="fa fa-facebook"></i></a>'+
                            '<a target="_blank" href="mailto:?Subject='+ value.post_title +'&body='+value.post_excerpt+ '%0D%0A%0D%0A' +value.permalink +'" class="post-item__share-icon post-item__share-twitter"><i class="fa fa-envelope"></i></a>'+
                            '</div></div>'+
                            '</div>';
                        if (value.info.sponsored_attachment_id && value.info.sponsored_attachment_id != 0) {
                            if(value.info.sponsored_link === undefined || value.info.sponsored_link === null){value.info.sponsored_link = "javascript:void(0)"; };
                            html += '<div class="post-item__author">'+
                                '<span class="post-item__detail-sub">Bài viết của ELLE cho </span> <a href="'+ value.info.sponsored_link +'" target="_blank"><img class="post-item__author-img" src="'+value.info.sponsored_attachment_id+'"></a>'+
                                '</div>';
                        }
                        html += '<a href="'+ value.permalink+'" class="post-item__title">'+value.post_title +'</a>'+
                            '<div class="post-item__desc">'+ value.post_excerpt +
                            '</div>' ;
                        if (value.user_info.display_name && value.user_info.display_name != 0) {
                            html += '<div class="post-item-author mt15">' + value.user_info.display_name + '</div>';
                        }
                        html += '</div></div></div></div></div>';

                    });
                    obj.attr('data-page',parseInt(page) + 1);
                    $(html).insertBefore(obj);
                    $(".post-item__share").on("click", function () {
                        $(this).toggleClass("active")
                    })

                } else {

                }
            }
        });
    });
    $('.time_moment').click();
    $('.back-to-top').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
    $('.point_ellevietnam').click(function () {
        $("html, body").animate({scrollTop: $('#ellevietnam').offset().top}, 600);
        return false;
    });
    $('.newsletter_click').click(function(event){
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 600);
        event.preventDefault();
    });
    //search elle network
    $('.elle-network-top-search-alpabet a').click(function(){
        $('#frm_search_elle_network input[name=keyal]').val( $(this).text() );
        $('#frm_search_elle_network').submit();
        return false;
    });

    $('#search-form').validate({
        rules: {
            s :'required'
        },
        messages: {
            s: ' Vui lòng nhập từ khóa.'
        },
        focusInvalid: false,
        errorPlacement: function (error, element) {
            element.attr('data-original-title', error.text())
                .attr('data-toggle', 'tooltip')
                .attr('data-placement', 'top');
            $(element).tooltip('show');
        },
        unhighlight: function (element) {
            $(element)
                .removeAttr('data-toggle')
                .removeAttr('data-original-title')
                .removeAttr('data-placement')
                .removeClass('error');
            $(element).unbind("tooltip");
        }

    });

    $(".content-detail__content").find("a:has(img)").addClass('auto_magnific');
    $(".content-detail__content").find("a:has(img)").attr('rel','article_gallery');
    $('.auto_magnific').magnificPopup({
        type: 'image',
        gallery:{enabled:true}
    });
});

function time_moment(obj,data) {
    obj.text(moment(data, "YYYYMMDDHHII").fromNow());
}

function _renderVideoList(data){
    let html = '';
    if(typeof data[0].id !== 'undefined') {
        html += '<div class="row row-video">';
        $.each(data, function (index, value) {
            html += '<div class="col-md-4">' +
                '<div class="video-content">' +
                '<a class="video-content__img" href="'+HOME_PAGE+'video/' + value.slugs + '">' +
                '<span class="img_16_9_video">' +
                '<img class="img-responsive" src="'+HOME_PAGE+'storage/' + value.img_news + '" alt="">' +
                '</span>' +
                '<div class="button-play">' +
                '<span class="button-play__video"><i></i></span>' +
                '</div>' +
                '</a>' +
                '<a class="video-content__title" href="'+HOME_PAGE+'video/' + value.slugs + '">' + value.name + '</a>' +
                '</div>' +
                '</div>';
            if ((index + 1) % 3 === 0) {
                html += '<div class="clearfix"></div>';
            }
        });
        html += '</div>';
    }
    return html;
}
function _renderPostList(data){
    let html = '';
    if(typeof data['data'][0].id !== 'undefined')
    {
        $.each( data['data'], function( key, value ) {
            html += '<div class="post-item post-item--blue post-item--border-bottom">' +
                '<div class="post-item__inner">'+
                '<div class="row">'+
                '<div class="col-md-5">'+
                '<div class="post-item__thumb img_16_9">'+
                '<a href="'+HOME_PAGE+''+value.slug_cate+'/'+value.slugs+'" class="post-item__title"><img src="'+HOME_PAGE+'storage/' + value.img_news + '" alt="" class="img-responsive"></a>'+
                '</div>'+
                '</div>'+
                '<div class="col-md-7">'+
                '<div class="post-item__info sm-mt15">'+
                '<div class="post-item__detail">'+
                '<span class="post-item__circle"></span>'+
                '<a class="post-item__detail-sub post-item__category" href="'+HOME_PAGE+''+data['parent']+'/'+value.slug_cate+'">'+value.name_cate+'</a>'+
                '<span class="post-item__detail-sub post-item__time time_moment">'+moment(value.time_news_updated, "YYYYMMDDHHII").fromNow()+'</span>'+
                '<div class="post-item__detail-sub post-item__share">'+
                '<div class="post-item__share-text">Chia sẻ</div>'+
                '<div class="post-item__share-inner">'+
                '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='+HOME_PAGE+''+value.slug_cate+'/'+value.slugs+'" class="post-item__share-icon post-item__share-facebook"><i class="fa fa-facebook"></i></a>'+
                '<a target="_blank" href="mailto:?Subject='+ value.name +'&body='+value.description_news+ '%0D%0A%0D%0A'+HOME_PAGE+''+value.slug_cate+'/'+value.slugs+'" class="post-item__share-icon post-item__share-twitter"><i class="fa fa-envelope"></i></a>'+
                '</div></div>'+
                '</div>';
            html += '<a href="'+HOME_PAGE+''+value.slug_cate+'/'+value.slugs+'" class="post-item__title">'+value.name +'</a>'+
                '<div class="post-item__desc">'+ value.description_news +
                '</div>' ;
            html += '<div class="post-item-author mt15">' + value.name_user + '</div>';
            html += '</div></div></div></div></div>';
        });
        return html;
    }
}



    var CHILD_TOKEN = $('meta[name="child-cate"]').attr('content');
    var PARENT_TOKEN = $('meta[name="parent-cate"]').attr('content');


    if(PARENT_TOKEN){
        $('.main-menu li').each(function(){
            var $this = $(this);
            // alert(new String($this.attr('data-active')).valueOf());
            //alert(new String($this.attr('data-active')).valueOf());
            // if the current path is like this link, make it active
            if(new String($this.attr('data-active')).valueOf() == new String(PARENT_TOKEN).valueOf()){
                // alert(1);
                $this.addClass('active');
                $this.parent().addClass('show');
            }
        });
    }

    if(CHILD_TOKEN )
    {
        $('.sub-menu li').each(function(){
            var $this = $(this);

            // if the current path is like this link, make it active
            if(new String($this.attr('data-active')).valueOf() == new String(CHILD_TOKEN).valueOf()){
                // alert(1);
                $this.addClass('active');
                $this.parent().addClass('show');
            }
        });
    }



