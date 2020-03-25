<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('users', UserController::class);
    $router->resource('brands', BrandController::class);
    $router->resource('logins', LoginController::class);
    $router->resource('/auth/denglu', LogController::class);
    $router->resource('/auth/reg', RegController::class);


});
