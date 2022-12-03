<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin/laravel-filemanager', 'middleware' => ['web', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/',[
    'as'=>'trang-chu',
    'uses'=>'PageController@getIndex'
]);

Route::get('search',
    'PageController@getSearch'
);

Route::get('video',
    'PageController@getVideo'
);

Route::get('sitemap.xml',
    'PageController@getSitemap'
);

Route::get('page/{slugs}',
    'PageController@getPage'
)->where(['slugs' => '[a-z0-9\-]+']);

Route::get('video/{news}',
    'PageController@getVideoDetail'
)->where(['news' => '[a-z0-9\-]+']);


Route::get('/{category}/{value}',
    'PageController@getDetail'
)->where(['category'=>'[a-z0-9\-]+'],['news' => '[a-z0-9\-]+']);



Route::get('/{category}',
    'PageController@getCategory'
)->where(['category'=>'[a-z0-9\-]+']);


Route::get('the-loai/{category}/{value}',
    'PageController@getCategoryVideo'
)->where(['category'=>'[a-z0-9\-]+'],['news' => '[a-z0-9\-]+']);

Route::get('/{category}',
    'PageController@getCategory'
)->where(['category'=>'[a-z0-9\-]+']);


//ajax
Route::post('/ajax',
    'AjaxController@handleAjax'
);


Route::group(['prefix'=>'ajax'],function(){
    Route::get('loaitin/{id_news}','PageController@getCategoryAjax')->where(['id' => '[0-9]+']);
});



