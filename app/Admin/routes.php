<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix' => config('admin.prefix'),
    'namespace' => Admin::controllerNamespace(),
    'middleware' => ['web', 'admin'],
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    /**
     * demo
     */
    $router->resource('/sakila/films', 'Sakila\FilmController');
    /**
     * test
     */
    $router->resource('/tag', 'TagController');
    $router->resource('/article', 'ArticleController');
});
