<?php

namespace App\Admin\Controllers;

use App\Models\Tag;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TagController extends Controller
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

            $content->header('标签管理');
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

            $content->header('修改');
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

            $content->header('添加');
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
        return Admin::grid(Tag::class, function (Grid $grid) {

            $grid->id('ID');
            $grid->name('标签名')->editable();
            $states = [
                'on' => ['value' => '1', 'text' => 'ON', 'color' => 'success'],
                'off' => ['value' => '0', 'text' => 'OFF', 'color' => 'danger'],
            ];
            $grid->act('是否启用')->switch($states);
            $grid->created_at('创建时间');
            $grid->updated_at('最后修改时间');
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
        return Admin::form(Tag::class, function (Form $form) {
            $form->text('name', '标签名');
            $states = [
                'on' => ['value' => '1', 'text' => '是'],
                'off' => ['value' => '0', 'text' => '否'],
            ];
            $form->switch("act", "是否启用")->states($states);
        });
    }
}
