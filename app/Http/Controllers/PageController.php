<?php

namespace App\Http\Controllers;

use App\Page;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use App\pageIndex;
use App\Category;
use App\News;
use Carbon\Carbon;

class pageController extends Controller
{
    
    public function getIndex(){
        $data = pageIndex::getWidget();
        $data_menu = Category::checkParent_twos();
        $data_views = array();
        foreach($data as $key=>$widget){
            if($widget->extends){

            }
            else
            {
                $data_views[$key][$widget->style] = pageIndex::getNews($widget->sort_by_category,$widget->sort_by_user,$widget->limit_post,$widget->type_news,$widget->sort_by_time);
            }
            
            
        }
      
        return view('page.pageIndex',['data'=> $data,'widgets'=>$data_views,'menu'=>$data_menu]);
    }

    public function getIdYoutube($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $src);
        return (isset($src[1]))?$src[1]:null;
    }

    public function getVideo()
    {
        $data = News::getVideos();
        SEOMeta::setTitle('Video hay - '.config('web_name'));
        SEOMeta::setDescription('Xem những video hay, video mới nhất, video hot nhất tại '.config('web_name'));
        $result['main_menu'] = Category::checkParent_two();
        $result['child_menu'] = [];
        return view('page.video',['video'=>$data,'data'=>$result]);
    }

    public function getVideoDetail(Request $request)
    {
        $data = News::getVideoDetail($request->news);
        SEOMeta::setTitle($data->name.' | '.config('web_name'));
        SEOMeta::setDescription($data->description);
        OpenGraph::addImage(asset('storage/'.$data->img_news));
        SEOMeta::addKeyword(explode(',',$data->keywords_news));
        $result['main_menu'] = Category::checkParent_two();
        $result['child_menu'] = [];
        return view('page.watch_video',['value'=>$data,'video'=>self::getIdYoutube($data->video_news),'data'=>$result]);
    }

    protected static function getPage(Request $request)
    {
        $data = Page::getPageDetail($request->slugs);
        SEOMeta::setTitle($data->name.' | '.config('web_name'));
        SEOMeta::setDescription($data->description);
        $result['main_menu'] = Category::checkParent_two();
        $result['child_menu'] = [];
        return view('page.page',['data'=>$result,'page'=>$data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDetail(Request $request){
        $slug_1=$request->category;
      
        $slug_2=$request->value;
        if(Category::checkParent($slug_1)){
            //print_r(News::listNews($slug_2));
            //Danh sach theo the loai con
                $data = Category::getCateChild($slug_2,'news');
                SEOMeta::setTitle($data['title_seo_relate_child']->name.' - '.config('web_name'));
                SEOMeta::setDescription($data['title_seo_relate_child']->description_category);
                return view('page.category',['data'=>$data]);
        }
        else
        {
           //Noi dung tin tuc
            $data = News::getNews($slug_2);
            if($data)
            {
                SEOMeta::setTitle($data['details']->name.' | '.config('web_name'));
                SEOMeta::setDescription($data['details']->description_news);
                OpenGraph::addImage(asset('storage/'.$data['details']->img_news));
                SEOMeta::addKeyword(explode(',',$data['details']->keywords_news));
                return view('page.detail',['data'=>$data]);
            }
        }
       
    }


    public function getCategory(Request $request){
            $slug=$request->category;
            $data = Category::getCate($slug,'news');
            SEOMeta::setTitle($data['title_seo_relate']->name.' - '.config('web_name'));
            SEOMeta::setDescription($data['title_seo_relate']->description_category);
            return view('page.list_news',['data'=>$data]);
    }



    public function getSearch(Request $request){
        $key=$request->key;
        $data= News::getSearch($key);
        SEOMeta::setTitle('Kết quả tìm kiếm '.$key.' - '.config('web_name'));
        SEOMeta::setDescription('Kết quả tìm kiếm cho từ khóa '.$key.' trên '.config('web_name'));
        $result['main_menu'] = Category::checkParent_two();
        $result['child_menu'] = [];
        return view('page.search',['data'=> $result,'search'=>$data],['key'=>$key]);
    }
	
	public function getSitemap()
	{
		$data = News::getSitemap();
		$date = date('Y-m-d', time());
		$time =  date('H:i:s', time());
		return response(view('page.sitemap',['data'=> $data,'time'=>$date.'T'.$time]))->header('Content-Type', 'text/xml');
	}

}
