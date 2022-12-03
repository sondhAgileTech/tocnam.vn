<?php

namespace App\Admin\Controllers;

use App\AdminCategories;
use App\AdminUser;
use App\AdminWidgets;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class WidgetsController extends Controller
{
    use ModelForm;
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Widgets')
            ->description('description')
            ->body(AdminWidgets::tree());
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
        $grid = new Grid(new AdminWidgets);

        $grid->id('Id');
        $grid->name('Name');
        $grid->description('Description');
        $grid->order('Order');
        $grid->sort_by_category('Sort by category');
        $grid->sort_by_user('Sort by user');
        $grid->sort_by_time('Sort by time');
        $grid->style('Style');
        $grid->created_at('Created at');
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
        $show = new Show(AdminWidgets::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->description('Description');
        $show->order('Order');
        $show->sort_by_category('Sort by category');
        $show->sort_by_user('Sort by user');
        $show->sort_by_time('Sort by time');
        $show->style('Style');
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
        $form = new Form(new AdminWidgets);

        $form->text('name', 'Name')->rules('required');
        $form->textarea('description', 'Description');
        $form->select('sort_by_category', 'Category')->options(AdminCategories::getChildList());
        $form->select('sort_by_user', 'User')->options(AdminUser::getUserList());
        $form->radio('sort_by_time', 'Sort')->options(['desc'=>'Newest','asc'=>'Oldest'])->value('desc');
        $form->radio('type_news', 'Type')->options(['news'=>'News','video'=>'Video'])->value('news');
        $form->textarea('extends','Extends');
        $form->number('limit_post','Limit')->value(5);
        $style = [
            '1_Top_News' => 'Phong cách 1: Hiển thị tin tức loại 1',
            '6_Post_News' => 'Phong cách 2: Hiển thị tin tức loại 2',
            '8_Post_News_2' => 'Phong cách 3: Hiển thị tin tức loại 3',
            '14_Post_News' => 'Phong cách 4: Hiển thị tin tức loại 4',
            '2_Post_Video' => 'Phong cách 5: Hiển thị video loại 1',
            '7_Videos_Feed' => 'Phong cách 6: Hiển thị video loại 2',
            '5_User_Post' => 'Phong cách 7: Tin tức của thành viên loại 1',
            '9_User_News_2' => 'Phong cách 8: Tin tức của thành viên loại 2',
            '4_News_Feed' => 'Phong cách 9: News Feed',
            '10_Post_Trend_Box' => 'Phong cách 10: Xu hướng',

        ];
        $form->select('style', 'Style')->options($style)->rules('required');
        return $form;
    }
}
