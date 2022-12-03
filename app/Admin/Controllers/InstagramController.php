<?php

namespace App\Admin\Controllers;

use App\AdminInstagram;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class InstagramController extends Controller
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
            ->header('Index')
            ->description('description')
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
        $grid = new Grid(new AdminInstagram);

        $grid->id('Id');
        $grid->image_instagram('Image')->display(function($url) {
            return ($url)?'<img src="'.asset('storage/'.$url).'" height="90" width="90"/>':'<img src="'.asset('storage/no-thumbnail.jpg').'" height="90" width="90"/>';
        });
        $grid->name_instagram('Name');
        $grid->link_instagram('Link')->display(function ($url){
            return '<a href="'.$url.'" target="_blank">'.$url.'</a>';
        });
        $grid->style_instagram('Style')->display(function($id){
            $status = ['Style 1','Style 2'];
            return $status[$id];
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
        $show = new Show(AdminInstagram::findOrFail($id));

        $show->id('Id');
        $show->name_instagram('Name')->rules('required');
        $show->image_instagram('Image');
        $show->link_instagram('Link')->rules('required');
        $show->style_instagram('Style');
        //$show->created_at('Created at');
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
        $form = new Form(new AdminInstagram);

        $form->text('name_instagram', 'Name');
        $form->image('image_instagram', 'Image');
        $form->url('link_instagram', 'Link');
        $form->radio('style_instagram', 'Style')->options(['Style 1','Style 2']);

        return $form;
    }
}
