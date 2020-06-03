<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Symfony\Component\HttpFoundation\Response;


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

Route::redirect('/',   '/redirectUser');
Route::get('/redirectUser','RedirectUser');
Auth::routes(['register' => false]);

//admin routes, get and post
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin,super']],
    function () {

    // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name(
            'permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');

    // Roles
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');

    // Users
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::resource('users', 'UsersController');

    //File
        Route::delete('files/destroy', 'FileController@massDestroy')->name('files.massDestroy');
        Route::resource('files', 'FileController');

    //Schedule
        Route::resource('schedule', 'ScheduleController');

    //default routes
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('/assign-cases', 'HomeController@assignCases')->name('assign.lawyer.cases');
        Route::get('/re-assign-cases', 'HomeController@reAssignCases')->name('re-assign.lawyer.cases');
        Route::get('/pending/cases', 'HomeController@pendingCases')->name('view.pending-cases');
});

//lawyer routes, get & post
Route::group(
    ['prefix' => 'lawyer', 'as' => 'lawyer.', 'namespace' => 'Lawyer', 'middleware' => ['auth', 'role:lawyer,super']],
    function () {

        //Dashboard
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::get('/my-cases', 'HomeController@myCases')->name('cases');
        Route::get('/my-schedule', 'HomeController@mySchedule')->name('schedule');
        Route::get('/pending-cases', 'HomeController@pendingCases')->name('pending.cases');

        // Schedule
        Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('events.massDestroy');
        Route::post('check-schedule', 'ScheduleController@checkSchedule')->name('check-schedule');
        Route::resource('schedule', 'ScheduleController');

    });

//Admin & Lawyer routes

//Case & Case Schedule
Route::group(['middleware' => ['auth', 'role:lawyer,super,admin']], function (){
    Route::resource('cases', 'CaseController')->names([
        'destroy' => 'admin.cases.destroy',
        'create' => 'admin.cases.create',
    ]);
    Route::resource('files', 'Admin\FileController')->names([
        'index' =>'files.index'
    ]);
    Route::delete('cases/destroy', 'CaseController@massDestroy')->name('admin.cases.massDestroy');
    Route::get('file/{file:slug}/cases', 'CaseController@index')->name('admin.open.client.cases');

    //Notification routes for authenticated user
    Route::post('/mark-as-read', 'NotificationController@markNotification')->name('markNotification');
    Route::get('/notifications', 'NotificationController@index')->name('notifications');

});

