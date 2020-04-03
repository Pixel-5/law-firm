<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lawyer/dashboard', 'LawyerController@index')->name('lawyer-dashboard');

Route::prefix('admin')->group(function (){
    Route::get('/dashboard', 'AdminController@index')->name('admin-dashboard');
    Route::get('/open-file', 'AdminController@openFile')->name('admin-open-client-file');
    Route::get('/open-cases', 'AdminController@openCases')->name('admin-open-client-cases');
});

