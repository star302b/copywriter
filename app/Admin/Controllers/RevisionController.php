<?php

namespace App\Admin\Controllers;

use App\Models\Revision;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RevisionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Revision';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Revision());

        $grid->column('id', __('Id'));
        $grid->column('notes', __('Notes'));
        $grid->column('request_id', __('Request id'));
        $grid->column('editor_id', __('Editor id'));
        $grid->column('writer_id', __('Writer id'));
        $grid->column('content_id', __('Content id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Revision::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('notes', __('Notes'));
        $show->field('request_id', __('Request id'));
        $show->field('editor_id', __('Editor id'));
        $show->field('writer_id', __('Writer id'));
        $show->field('content_id', __('Content id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Revision());

        $form->textarea('notes', __('Notes'));
        $form->number('request_id', __('Request id'));
        $form->number('editor_id', __('Editor id'));
        $form->number('writer_id', __('Writer id'));
        $form->number('content_id', __('Content id'));

        return $form;
    }
}
