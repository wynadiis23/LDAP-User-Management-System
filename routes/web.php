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

Route::get('/', function () {
    return view('auth/login');
});
Route::get('login', function(){
	return view('auth/login');
});

//route get//
Route::get('admin', function(){
	return view('admin/admin_template');
});

Route::post('cekLogin', 'CekLoginController@index')->name('cekLogin');

Route::get('cari', 'HomeController@cari')->name('cari');
Route::post('letscari', 'HomeController@letsCari')->name('letscari');
Route::get('sinkronisasi', 'HomeController@sinkronisasi')->name('sinkronisasi');
Route::get('getSinkronisasi', 'HomeController@getSinkronisasi')->name('getSinkronisasi');
//route resource//
Route::resource('home', 'HomeController');


