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

            $content->header('文章管理');
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

            $content->header('文章修改');
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

            $content->header('添加文章');
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
            $grid->title("标题")->editable();
            $grid->column("image", "图片")->image(config("admin.upload.host"), 50, 50);
            $grid->tag("标签")->where('act', '1')->value(function ($tag) {
                $tag = $tag->toArray();
                $tag = array_map(function ($tag) {
                    return "<span class='label label-warning'>{$tag['name']}</span>";
                }, $tag);

                return join('&nbsp;', $tag);
            });
            $options = [1 => 'admin', 2 => 'test'];
            $grid->auth("作者")->value(function ($value) use ($options) {
                return $options[$value];
            })->editable('select', $options);
            $states = [
                'on' => ['value' => '1', 'text' => 'ON', 'color' => 'success'],
                'off' => ['value' => '0', 'text' => 'OFF', 'color' => 'danger'],
            ];
            $grid->act('是否启用')->switch($states)->sortable();
            $grid->created_at("发布时间");
            $grid->updated_at("上次修改时间");

            $grid->disableBatchDeletion();
            $grid->view("admin.grid.table");
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
            $form->text("title", "标题");
            $form->image("image", "图片");
            $form->select("auth", "作者")->options([1 => 'admin', 2 => 'test']);
            $form->multipleSelect('tag', "标签")->options(Tag::all()->pluck('name', 'id'));
//            $form->PHPEditor("content","php代码");
            $form->wangEditor("content", "文章内容");
            $states = [
                'on' => ['value' => '1', 'text' => '是'],
                'off' => ['value' => '0', 'text' => '否'],
            ];
            $form->switch("act", "是否启用")->states($states);
        });
    }
}
