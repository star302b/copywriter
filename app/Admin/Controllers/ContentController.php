<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Administrator;
use App\Models\Content;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Builder;

class ContentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Content';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Content());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('due_date', __('Due date'));
        $grid->column('word_count', __('Word count'));
        $grid->column('require_words', __('Require words'));
        $grid->column('count_filled', __('Count filled'));
        $grid->column('url', __('Url'));
        $grid->column('geo', __('Geo'));
        $grid->column('live_url', __('Live url'));
        $grid->column('site_url', __('Site url'));
        $grid->column('copy_scape_check', __('Copy scape check'));
        $grid->column('approved', __('Approved'));
        $grid->column('writer_id', __('Writer id'));
        $grid->column('editor_id', __('Editor id'));
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
        $show = new Show(Content::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('due_date', __('Due date'));
        $show->field('word_count', __('Word count'));
        $show->field('require_words', __('Require words'));
        $show->field('count_filled', __('Count filled'));
        $show->field('url', __('Url'));
        $show->field('geo', __('Geo'));
        $show->field('live_url', __('Live url'));
        $show->field('site_url', __('Site url'));
        $show->field('copy_scape_check', __('Copy scape check'));
        $show->field('approved', __('Approved'));
        $show->field('writer_id', __('Writer id'));
        $show->field('editor_id', __('Editor id'));
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
        $form = new Form(new Content());

        $form->textarea('title', __('Title'));
        $form->summernote('content', __('Content'));
        $form->datetime('due_date', __('Due date'))->default(date('Y-m-d H:i:s'));
        $form->number('word_count', __('Word count'));
        $form->number('require_words', __('Require words'));
        $form->switch('count_filled', __('Count filled'));
        $form->textarea('url', __('Url'));
        $form->textarea('geo', __('Geo'));
        $form->textarea('live_url', __('Live url'));
        $form->textarea('site_url', __('Site url'));
        $form->switch('copy_scape_check', __('Copy scape check'));
        $form->switch('approved', __('Approved'));
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
        $form->hasMany('revisions', 'Revisions', function (Form\NestedForm $form) {
            $form->textarea('notes')->rows('4');
        });

        return $form;
    }
}
