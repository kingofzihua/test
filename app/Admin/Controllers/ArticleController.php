<?php

namespace App\Admin\Controllers;

use App\Models\Article;

use App\Models\Tag;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticleController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title("标题");
            $grid->tag("标签")->value(function ($tag) {

                $tag = array_map(function ($tag) {
                    return "<span class='label label-warning'>{$tag['name']}</span>";
                }, $tag);

                return join('&nbsp;', $tag);
            });
            $options = [1 => 'admin', 2 => 'test'];
            $grid->auth("作者")->value(function ($value) use ($options) {
                return $options[$value];
            })->editable('select', $options);
            $grid->created_at("发布时间");
            $grid->updated_at("上次修改时间");

            $grid->disableBatchDeletion();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

//            $form->display('id', 'ID');
            $form->text("title", "标题");
            $form->image("image", "图片");
            $form->select("auth", "作者")->options([1 => 'admin', 2 => 'test']);
//            $form->select("tag","标签")->options(Tag::get()->pluck('name','id'));
            $form->multipleSelect('tag', "标签")->options(Tag::all()->pluck('name', 'id'));
            $form->editor("content", "文章内容");
//            $form->display('created_at', 'Created At');
//            $form->display('updated_at', 'Updated At');
        });
    }
}
