<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class pageIndex extends Model
{
    protected $table="news";

    protected static function getWidget(){
        return DB::table('widgets')->orderBy('order','asc')->get();
    }

    protected static function getNews($category_id,$user_id,$limit=5,$type='news',$order='asc'){
        $result = array();
        if($category_id && $user_id){
            $data = DB::table('news')
                ->join('categories', 'news.id_categories', '=', 'categories.id')
                ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
                ->select('news.*', 'categories.name as name_cate','categories.slugs as slug_cate', 'categories.id_child as id_child', 'admin_users.name as name_user','news.updated_at as time_news_updated','news.name as name_news')
                ->where([
                ['status',0],
                ['type_news',$type],
                ['news.id_categories',$category_id],
                ['news.id_user',$user_id]
            ])->offset(0)->take($limit)->orderBy('id',$order)->get();
            foreach ($data as $key=>$value)
            {
                $result[$key]['data'] = $value;
                $result[$key]['parent'] = Category::getParent($value->id_child);
            }
        }
        elseif($category_id)
        {
            $data = DB::table('news')
                ->join('categories', 'news.id_categories', '=', 'categories.id')
                ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
                ->select('news.*', 'categories.name as name_cate','categories.slugs as slug_cate', 'categories.id_child as id_child', 'admin_users.name as name_user','news.updated_at as time_news_updated','news.name as name_news')
                ->where([
                ['news.status',0],
                ['type_news',$type],
                ['news.id_categories',$category_id]
            ])->offset(0)->take($limit)->orderBy('updated_at',$order)->get();
            foreach ($data as $key=>$value)
            {
                $result[$key]['data'] = $value;
                $result[$key]['parent'] = Category::getParent($value->id_child);
            }
        }
        elseif($user_id)
        {
            $data = DB::table('news')
                ->join('categories', 'news.id_categories', '=', 'categories.id')
                ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
                ->select('news.*', 'categories.name as name_cate','categories.slugs as slug_cate', 'categories.id_child as id_child', 'admin_users.name as name_user','news.updated_at as time_news_updated','news.name as name_news')
                ->where([
                ['status',0],
                ['type_news',$type],
                ['news.id_user',$user_id]
            ])->offset(0)->take($limit)->orderBy('updated_at',$order)->get();
            foreach ($data as $key=>$value)
            {
                $result[$key]['data'] = $value;
                $result[$key]['parent'] = Category::getParent($value->id_child);
            }
        }
        else
        {

            $data = DB::table('news')
            ->join('categories', 'news.id_categories', '=', 'categories.id')
            ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
                ->select('news.*', 'categories.name as name_cate','categories.slugs as slug_cate', 'categories.id_child as id_child', 'admin_users.name as name_user','news.updated_at as time_news_updated','news.name as name_news')
            ->where([
                ['news.status',0],
                ['type_news',$type]
            ])->offset(0)->take($limit)->orderBy('updated_at',$order)->get();
            foreach ($data as $key=>$value)
            {
                $result[$key]['data'] = $value;
                $result[$key]['parent'] = Category::getParent($value->id_child);
            }
        }
        return $result;
    }
   
}
