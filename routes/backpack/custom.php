<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::get('api/article', 'App\Http\Controllers\Api\ArticleController@index');
Route::get('api/article-search', 'App\Http\Controllers\Api\ArticleController@search');
Route::get('api/article/{id}', 'App\Http\Controllers\Api\ArticleController@show');

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // CRUD resources and other admin routes
    Route::crud('monster', 'MonsterCrudController');
    Route::crud('icon', 'IconCrudController');
    Route::crud('product', 'ProductCrudController');

    // ---------------------------
    // Backpack DEMO Custom Routes
    // Prevent people from doing nasty stuff in the online demo
    // ---------------------------
    if (app('env') == 'production') {
        // disable delete and bulk delete for all CRUDs
        $cruds = ['article', 'category', 'tag', 'monster', 'icon', 'product', 'page', 'menu-item', 'user', 'role', 'permission'];
        foreach ($cruds as $name) {
            Route::delete($name.'/{id}', function () {
                return false;
            });
            Route::post($name.'/bulk-delete', function () {
                return false;
            });
        }
    }
    Route::crud('supplier', 'SupplierCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('suppliercategory', 'SupplierCategoryCrudController');
    Route::crud('pages', 'PagesCrudController');
    Route::crud('articles', 'ArticlesCrudController');
}); // this should be the absolute last line of this file