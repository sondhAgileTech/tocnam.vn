<?php

namespace App\Admin\Controllers;

use App\AdminCategories;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CategoriesController extends Controller
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
        $grid = new Grid(new AdminCategories);

        $grid->id('Id');
        $grid->name('Name');
        $grid->slugs('Slugs');
        $grid->description_category('Description');
        $grid->id_child('Parent')->display(function($id) {
            return ($id)?AdminCategories::find($id)->name:'---------';
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
        $show = new Show(AdminCategories::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->slugs('Slugs');
        $show->description_category('Description');
        $show->id_child('Parent');
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
        $form = new Form(new AdminCategories);

        $form->text('name', 'Name')->rules('required');
        $form->text('slugs', 'Slugs')->rules('required');
        $form->text('description_category', 'Description');
        $categories = AdminCategories::getParentList();
        $categories[0] = 'Root';
        $form->select('id_child', 'Parent')->options($categories);

        return $form;
    }
}
