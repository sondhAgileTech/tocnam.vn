<?php

namespace App\Admin\Controllers;

use App\AdminCategories;
use App\AdminNews;
use App\Http\Controllers\Controller;
use App\AdminUser;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class NewsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */

    public function index(Content $content)
    {
        return $content
            ->header('News')
            ->description('News Manager')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AdminNews);
		$grid->model()->orderBy('id', 'desc');
        $grid->id('Id');
        $grid->img_news('Image')->display(function($url) {
            return ($url)?'<img src="'.asset('storage/'.$url).'" height="70" width="90"/>':'<img src="'.asset('storage/no-thumbnail.jpg').'" height="70" width="90"/>';
        });
        $grid->name('Name');
        //$grid->slugs('Slugs');
        //$grid->description_news('Description news');
        //$grid->content_news('Content news');
        $grid->status('Status')->display(function($id){
            $status = ['Public','Drafts','Private'];
            return $status[$id];
        });
        //$grid->keywords_news('Keywords news');
        $grid->id_categories('Category')->display(function($id) {
            return AdminCategories::find($id)->name_category;
        });
        $grid->id_user('AdminUser')->display(function($userId) {
            return AdminUser::find($userId)->name;
        });
        //$grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(AdminNews::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->slugs('Slugs');
        $show->description_news('Description');
        $show->content_news('Content');
        $show->status('Status');
        $show->img_news('Image Horizontal');
        $show->img_vertical('Image Vertical');
        $show->keywords_news('Keywords');
        $show->id_categories('Id categories');
        $show->id_user('Id user');
        $show->type_news('Type');
        $show->video_news('Video URL (Youtube)');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AdminNews);
        $form->hidden('id_user', 'Id user')->value(Admin::user()->id)->rules('required');
        $form->text('name', 'Name')->rules('required');
        $form->text('slugs', 'Slugs')->rules('required');
        $categories = AdminCategories::getChildList();
        $form->select('id_categories', 'Select a category')->options($categories)->rules('required');
        $type = ['news'=>'News','video'=>'Video'];
        $form->radio('type_news','Select a type')->options($type)->rules('required');
        $form->textarea('description_news', 'Description');
        $form->tags('keywords_news', 'Keywords');
        $form->image('img_news', 'Image Horizontal');
        $form->image('img_vertical', 'Image Vertical');
        $form->editor('content_news', 'Content');
        $status = ['Public','Drafts','Private'];
        $form->select('status', '* Status')->options($status)->rules('required');
        $form->text('video_news','Video URL (Youtube)');
        return $form;
    }
}
