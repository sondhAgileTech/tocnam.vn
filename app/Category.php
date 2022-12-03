<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
        protected $table="categories";

    protected static function getChild($id)
    {
        return Category::select('*')->where('id_child',$id)->get();
    }

    protected static function getParent($id_categories)
    {
        return Category::select('*')->where('id',$id_categories)->first();
    }

    protected  static function getCategoryBySlugs($slugs)
    {
        return Category::select('*')->where('slugs',$slugs)->first();
    }

    protected static function checkParent($slug){
          return Category::select('id')->where(
             [ ['slugs',$slug],
              ['id_child',0]]
          )->count();
        }


        protected static function checkParent_two(){
            return Category::select('*')->where('id_child',0)->get();
        }

        protected static function checkParent_twos(){
            return Category::select('*')->where('id_child',0)->get();
        }



      protected static function getRelates($id,$limit=20,$type){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [[
                'categories.id_child',$id
            ],
            
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->offset(0)->take($limit)->orderBy('news.id','desc')->get();
           
    }

    /**
     * @param $id
     * @param int $limit
     * @param $type
     * @return mixed
     */
    protected static function getRelatesChild($id, $limit=20, $type){

        return DB::table('news')
            ->join('categories', 'news.id_categories', '=', 'categories.id')
            ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
            ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
            ->where(
                [[
                    'categories.id',$id
                ],

                    [
                        'news.status',0
                    ],
                    [
                        'news.type_news',$type
                    ]
                ]
            )->offset(0)->take($limit)->orderBy('updated_at','desc')->get();

    }

    protected static function getRelate_show($id,$limit=20,$type,$to=0){
        return DB::table('news')
            ->join('categories', 'news.id_categories', '=', 'categories.id')
            ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
            ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
            ->where(
                [[
                    'categories.id_child',$id
                ],

                    [
                        'news.status',0
                    ],
                    [
                        'news.type_news',$type
                    ]
                ]
            )->offset($to)->take($limit)->orderBy('news.id','desc')->get();

    }

    protected static function getRelate_showChild($id,$limit=20,$type,$to=0){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [[
                'categories.id',$id
            ],
            
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->offset($to)->take($limit)->orderBy('news.id','desc')->get();
           
    }

   

    protected static function getRelate_video($id,$limit=20,$type){
        
        return DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','categories.name as name_cate','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate')
        ->where(
            [
                [
                    'news.id_categories',$id
                ],  
            [
                'news.status',0
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->offset(0)->take($limit)->orderBy('updated_at','desc')->get();
           
    }

    

      protected static function getCate($slug,$type){
       
        $result = array();
        $data = DB::table('categories')
        
                ->select('categories.*')
            ->where([
                ['categories.slugs',$slug]
                
            ])->first();
           
            if($data)
            {

                $result['title_seo_relate']=$data;
                $result['parent'] = $data;
                $result['main_menu'] = Category::checkParent_two();
                $result['child_menu'] = Category::getChild($data->id);
                $result['top_relate'] = Category::getRelates($data->id,4,$type);
                $result['botton_relate'] = Category::getRelate_show($data->id,16,$type,4);
                $result['video_relate'] = Category::getRelate_video($data->id,4,$type);
               
               //print_r($result['top_relate']);
             
            }
            return $result;
      }

    protected static function getCateChild($slug,$type){

        $result = array();
        $data = DB::table('categories')

            ->select('categories.*')
            ->where([
                ['categories.slugs',$slug]

            ])->first();
        $data_parent = DB::table('categories')->select('categories.*')
            ->where([
                ['categories.id',$data->id_child]

            ])->first();
        if($data)
        {

            $result['title_seo_relate'] = $data_parent;
            $result['title_seo_relate_child'] = $data;
            $result['parent'] = $data_parent;
            $result['main_menu'] = Category::checkParent_two();
            $result['child_menu'] = Category::getChild($data_parent->id);
            $result['top_relate']= Category::getRelatesChild($data->id,4,$type);
            $result['botton_relate']= Category::getRelate_showChild($data->id,16,$type,4);
            $result['video_relate']= Category::getRelate_video($data->id,4,$type);

            //print_r($result['top_relate']);

        }
        return $result;
    }


      protected static function getCateVideo($slug,$value,$type){//noi dung
        $result = array();
        $data = DB::table('news')
        ->join('categories', 'news.id_categories', '=', 'categories.id')
        ->join('admin_users', 'news.id_user', '=', 'admin_users.id')
        ->select('news.*','news.name as name_news','admin_users.name as name_user','news.created_at as time_news_created','news.updated_at as time_news_updated','categories.slugs as slug_cate','categories.name as name_cate')
        ->where(
            [
                [
                    'news.slugs',$value
                ],
            [
                'categories.slugs',$slug
            ],
            [
                'news.status',0
            ]
            ]
            )->first();
            if($data)
            {
                
                $result['details']= $data;
                //$result['video_show']=Category::getRelate_video($data->id,14,$type);
            }
            return $result;
    }


    protected static function getRelate_video_watch($slug,$limit=20,$type){
        
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
            )->offset(0)->take($limit)->orderBy('updated_at','desc')->get();


           
    }

    protected static function getAjaxNews($id,$type){
        
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
                'news.id','>',$id
            ],
            [
                'news.type_news',$type
            ]
            ]
            )->limit(1)->get();


           
    }






   


}
