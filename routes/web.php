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

// Route::get('/', function () {
//     return view('auth/login');
// });
// Route::get('login', function(){
// 	return view('auth/login');
// });
///////////route auth///////////////////
Route::get('/', 'CekLoginController@loginView')->name('login');
Route::get('login', 'CekLoginController@loginView');

//route get//
Route::get('admin', function(){
	return view('admin/admin_template');
});

//route get data 
//route get api
Route::get('getDataUser', 'HomeController@getDataUser')->name('getDataUser');

//route sync data user
Route::post('sinkronkanDataUser', 'HomeController@sinkronkanDataUser')->name('sinkronkanDataUser');

Route::post('cekLogin', 'CekLoginController@index')->name('cekLogin');

Route::get('test', 'HomeController@test')->name('test');
Route::get('cari', 'HomeController@cari')->name('cari');
Route::get('carijs', 'HomeController@carijs')->name('carijs');
Route::get('infoserver', 'HomeController@infoserver')->name('infoserver');
Route::post('letscari', 'HomeController@letsCari')->name('letscari');
Route::get('sinkronisasi', 'HomeController@sinkronisasi')->name('sinkronisasi');
Route::get('getSinkronisasi', 'HomeController@getSinkronisasi')->name('getSinkronisasi');


route::get('getProdi', 'ProdiController@getProdi')->name('getProdi');
route::get('getFakultas', 'FakultasController@getFakultas')->name('getFakultas');

//route resource//
Route::resource('home', 'HomeController');
Route::resource('prodi', 'ProdiController');
Route::resource('fakultas', 'FakultasController');

