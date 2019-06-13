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

Route::get('lang/{l}', function ($l) {

    $lang = session('lang', 'pt-br');
    session(['lang' => $l]);

    return redirect()->back();

    //
})->name('lang');

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->namespace('admin')->group(function () {
    Route::resource('/users', 'UserController');
});

Route::prefix('admin')->middleware(['auth','can:acl'])->namespace('admin')->group(function () {
    Route::resource('/permissions', 'PermissionController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/companies', 'CompanyController');
    Route::resource('/shifts', 'ShiftController');
    Route::resource('/specialHours', 'SpecialHourController');
});
//prefix admin/roles admin is prefix  ======   namespace admin\PermissionController  admin is namespace
Route::prefix('report')->middleware(['auth','can:acl'])->namespace('report')->group(function () {
    Route::resource('/consolidates', 'ConsolidateController');
});
