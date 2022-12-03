<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('news', NewsController::class);
    $router->resource('categories', CategoriesController::class);
    $router->resource('instagram', InstagramController::class);
    $router->resource('pages', PagesController::class);
    $router->resource('widgets', WidgetsController::class);
});
