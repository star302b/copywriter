<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\ContentController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('content', ContentController::class);

    $router->resource('requests', RequestController::class);

    $router->resource('revisions', RevisionController::class);



});
