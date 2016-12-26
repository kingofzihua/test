<?php

namespace App\Admin\Controllers\Sakila;

use App\Models\Sakila\Category;
use App\Models\Sakila\Film;
use App\Models\Sakila\Language;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FilmController extends Controller
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
        return Admin::grid(Film::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title()->editable();
            $grid->release_year()->editable('year');
            $grid->language()->name('Language');
            $grid->categories()->value(function ($categories) {

                $categories = array_map(function ($category) {
                    return "<span class='label label-warning'>{$category['name']}</span>";
                }, $categories);

                return join('&nbsp;', $categories);
            });

            $options = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
            $grid->rating()->editable('select', array_combine($options, $options));
            $grid->special_features();

            $grid->created_at();

            $grid->disableBatchDeletion();

            $grid->filter(function ($filter) {
                $filter->like('title');
                $filter->is('language_id')->select(Language::all()->pluck('name', 'id'));
            });
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Film::class, function (Form $form) {

            y('id', 'ID');

            $form->text('title');
            $form->textarea('description');
            $form->year('release_year');
            $form->select('language_id', 'Language')->options(Language::all()->pluck('name', 'id'));
            $form->select('original_language_id', 'Original language')->options(Language::all()->pluck('name', 'id'));
            $form->number('rental_duration');
            $form->decimal('rental_rate');
            $form->decimal('replacement_cost');

            $options = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
            $form->select('rating')->options(array_combine($options, $options))->default('G');

            $options = ['Trailers', 'Commentaries', 'Deleted Scenes', 'Behind the Scenes'];
            $form->multipleSelect('special_features')->options(array_combine($options, $options));

            $form->multipleSelect('categories')->options(Category::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
