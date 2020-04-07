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


Route::redirect('/', '/login');

Auth::routes(['register' => false]);

//admin routes, get and post
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    //default routes
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/open-file', 'HomeController@openFile')->name('open.client.file');
    Route::get('/open-cases', 'HomeController@openCases')->name('open.client.cases');
    Route::get('/assign-cases', 'HomeController@assignCases')->name('assign.lawyer.cases');
    Route::get('/re-assign-cases', 'HomeController@reAssignCases')->name('re-assign.lawyer.cases');
    Route::get('/view-pending-cases', 'HomeController@pendingCases')->name('view.pending-cases');
});

//lawyer routes, get & post
Route::group(['prefix' => 'lawyer', 'as' => 'lawyer.', 'namespace' => 'Lawyer', 'middleware' => ['auth']],function (){
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/my-cases', 'HomeController@myCases')->name('cases');
    Route::get('/my-schedule', 'HomeController@mySchedule')->name('schedule');
    Route::get('/pending-cases', 'HomeController@pendingCases')->name('pending.cases');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');
});

