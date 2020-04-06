<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//admin routes, get and post
Route::prefix('admin')->group(function (){
    Route::get('/dashboard', 'AdminController@index')->name('admin-dashboard');
    Route::get('/open-file', 'AdminController@openFile')->name('admin-open-client-file');
    Route::get('/open-cases', 'AdminController@openCases')->name('admin-open-client-cases');
    Route::get('/assign-cases', 'AdminController@assignCases')->name('admin-assign-lawyer-cases');
    Route::get('/re-assign-cases', 'AdminController@reAssignCases')->name('admin-re-assign-lawyer-cases');
    Route::get('/view-pending-cases', 'AdminController@pendingCases')->name('admin-view-pending-cases');
});


//lawyer routes, get & post
Route::prefix('lawyer')->group(function (){
    Route::get('/dashboard', 'LawyerController@index')->name('lawyer-dashboard');

});

