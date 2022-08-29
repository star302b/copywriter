<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Administrator;
use App\Models\Request;
//use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Builder;

class RequestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Request';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Request());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('geo', __('Geo'));
        $grid->column('status', __('Status'));
        $grid->column('comments', __('Comments'));
        $grid->column('link_builder_id', __('Link builder id'));
        $grid->column('editor_id', __('Editor id'));
        $grid->column('writer_id', __('Writer id'));
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
        $show = new Show(Request::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('geo', __('Geo'));
        $show->field('status', __('Status'));
        $show->field('comments', __('Comments'));
        $show->field('link_builder_id', __('Link builder id'));
        $show->field('editor_id', __('Editor id'));
        $show->field('writer_id', __('Writer id'));
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
        $form = new Form(new Request());

        $form->textarea('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->textarea('geo', __('Geo'));
        $form->switch('status', __('Status'));
        $form->textarea('comments', __('Comments'));
        if( Admin::user()->inRoles(['administrator','link-builder']) ) {
            $form->hidden('link_builder_id')->value(
                Admin::user()->id
            );
        }
        $form->select('editor_id', __('Editor'))->options(
            Administrator::whereHas('roles', function (Builder $query) {
                $query->where('slug', '=', 'editor');
            })->get()->pluck('name','id')
        );
        $form->select('writer_id', __('Writer'))->options(
            Administrator::whereHas('roles', function (Builder $query) {
                $query->where('slug', '=', 'writer');
            })->get()->pluck('name','id')
        );

        return $form;
    }
}
