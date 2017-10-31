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

Route::group([], function(){

    Route::match(['get','post'],'/',['uses'=>'IndexController@execute'])->name('home');
    Route::get('/page/{alias}',['uses'=>'PageController@execute'])->name('page');

    Route::auth();

});

Route::group(['prefix'=>'admin','middleware'=>'auth'], function (){

    Route::get('/', function(){

        return;
    });
    Route::group(['prefix'=>'pages'], function (){

        Route::get('/',['uses'=>'PagesController@execute'])->name('pages');

        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute'])->name('pagesAdd');

        Route::match(['get','post','delete'], '/edit/{page}',['uses'=>'PagesEditController@execute'])->name('pagesEdit');
    });

    Route::group(['prefix'=>'portfolios'], function (){

        Route::get('/',['uses'=>'PortfolioController@execute'])->name('portfolio');

        Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute'])->name('portfolioAdd');

        Route::match(['get','post','delete'], '/edit/{portfolio}',['uses'=>'PortfolioEditController@execute'])->name('portfolioEdit');
    });

    Route::group(['prefix'=>'services'], function (){

        Route::get('/',['uses'=>'ServiceController@execute'])->name('services');

        Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execute'])->name('serviceAdd');

        Route::match(['get','post','delete'], '/edit/{service}',['uses'=>'ServiceEditController@execute'])->name('serviceEdit');
    });

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
