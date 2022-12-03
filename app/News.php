<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class News extends Model
{
    protected $table="news";

    protected static function getVideoDetail($news)
    {
        return News::select('*')->where([['status',0],['type_news','video'],['slugs',$news]])->first();
    }

    protected static function getVideos($to=0,$limit=16)
    {
        return News::select('*')->where([['status',0],['type_news','video']])->offset($to)->take($limit)->orderBy('updated_at','desc')->get();
    }

    protected static function getAjaxByKeyword($page, $post_per_page, $to, $key, $type_news)
    {
        $data = DB::table('news')
            ->join('categories', 'news.id_categories', '=', 'categories.id')
            ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
            ->select('news.*','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate','categories.name as name_cate','categories.id_child as cate_child')
            ->where([['news.name','like','%'.$key.'%'],['news.type_news',$type_news],['news.status',0]])->orwhere([['news.slugs',$key],['news.type_news',$type_news],['news.status',0]])
            ->offset($to)->take($post_per_page)->get();
        $result = array();
        foreach($data as $key=>$value)
        {
            $result[$key]['parent'][] = Category::getParent($value->cate_child)->first()->slugs;
            $result[$key]['data'][] = $value;
        }
        return $result;
    }


    protected static function getAjaxByCategory($page, $post_per_page, $to, $term_id, $type='news')
    {
        return DB::table('news')
            ->join('categories', 'news.id_categories', '=', 'categories.id')
            ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
            ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
            ->where(
                [[
                    'news.id_categories',$term_id
                ],
                    [
                        'news.status',0
                    ],
                    [
                        'news.type_news',$type
                    ]
                ]
            )->offset($to)->take($post_per_page)->orderBy('updated_at','desc')->get();
    }


    protected static function getRelate($id,$limit=20,$type){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [[
                'news.id_categories',$id
            ],
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->offset(1)->take($limit)->orderBy('updated_at','desc')->get();
           
    }

    protected static function getRelate_title($id,$limit=20,$type){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','categories.id_child as id_child','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [[
                'news.id_categories',$id
            ],
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->offset(1)->take($limit)->orderBy('updated_at','desc')->first();

           
    }

    protected static function getRelate_Random($id,$limit=20,$type){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [[
                'news.id_categories',$id
            ],
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->inRandomOrder()->limit($limit)->orderBy('updated_at','desc')->get();
           
    }

	protected static function getSitemap($limit=20,$type='news'){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->offset(0)->take($limit)->orderBy('news.id','desc')->get();
           
    }

    protected static function getChild($id_categories)
    {


         return DB::table('categories')

             ->select('categories.*')
             ->where('categories.id_child',$id_categories)->get();
    }

    protected static function getCateMenu()
    {


        return DB::table('categories')

            ->select('categories.*')
            ->where('categories.id_child',0)->get();
    }




    protected static function getNews($slug){//noi dung
        $result = array();
        $data = DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','news.name as name_news','admin_users.name as name_user','admin_users.avatar as avatar_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate','categories.name as name_cate','categories.id_child as cate_child')
        ->where(
            [[
                'news.slugs',$slug
            ],
            [
                'news.status',0
            ]
            ]
            )->first();
            if($data)
            {

                $result['details']= $data;
                $result['parent'] = Category::getParent($data->cate_child);
                $result['main_menu'] = Category::checkParent_two();
                $result['child_menu'] = Category::getChild($result['parent']->id);
                $result['relate']= News::getRelate($data->id_categories,6,$data->type_news);
                $result['botton_relate']=News::getRelate($data->id_categories,12,$data->type_news);
                $result['video_relate']=News::getRelate($data->id_categories,2,'video');
                $result['random_relate']=News::getRelate_Random($data->id_categories,3,$data->type_news);
                $result['title_relate']=News::getRelate_title($data->id_categories,2,$data->type_news);
               // print_r($result['get_cate_parent']);
            }
            return $result;
    }


    protected static function listNews($slug,$limit=20){//danh sach
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','news.name as name_news')
        ->where(
            [[
                'categories.slugs',$slug
            ],
            [
                'news.status',0
            ]
            
            ]
            )->offset(0)->take($limit)->orderBy('updated_at','desc')->get();
    }

    protected static function getSearch($key,$limit=16,$type_news='news'){

        $data = DB::table('news')
            ->join('categories', 'news.id_categories', '=', 'categories.id')
            ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
            ->select('news.*','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate','categories.name as name_cate','categories.id_child as cate_child')
            ->where([['news.name','like','%'.$key.'%'],['news.type_news',$type_news],['news.status',0]])->orwhere([['news.slugs',$key],['news.type_news',$type_news],['news.status',0]])
            ->offset(0)->take($limit)->get();
        $result = array();
        foreach($data as $key=>$value)
        {
            $result[$key]['parent'] = Category::getParent($value->cate_child)->first();
            $result[$key]['data'] = $value;
        }
        return $result;
    }
}
