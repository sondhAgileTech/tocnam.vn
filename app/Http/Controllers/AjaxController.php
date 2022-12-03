<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    function handleAjax(Request $request)
    {
        $page = (int)$request->input('page');
        $post_per_page = (int)$request->input('posts_per_page');
        $to = (int)$request->input('to');
        $term_id = $request->input('term_id');
        $type_news = $request->input('post_type');
        $method = $request->input('method');
        return $this->$method($page,$post_per_page,$to,$term_id,$type_news);
    }

    private function GetReadmorePostCategory($page,$post_per_page,$to,$term_id,$type_news)
    {
        if($type_news==='news') {
            if (Category::checkParent($term_id)) {
                $data = Category::getCategoryBySlugs($term_id);
                $result['parent'] = $data->slugs;
                $result['data'] = Category::getRelate_show($data->id, $post_per_page, $type_news, $to);
                return $result;
            } else {
                $data = Category::getCategoryBySlugs($term_id);
                $parent = Category::getParent($data->id_child);
                $result['parent'] = $parent->slugs;
                $result['data'] = News::getAjaxByCategory($page, $post_per_page, $to, $data->id, $type_news);
                return $result;
            }
        }
        elseif($type_news==='video')
        {
            return News::getVideos($to,$post_per_page);
        }
    }

    private function GetPostsSearch($page,$post_per_page,$to,$term_id,$type_news)
    {
        return News::getAjaxByKeyword($page,$post_per_page,$to,$term_id,$type_news);
    }
}
