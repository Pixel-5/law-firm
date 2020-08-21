<?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Spatie\Honeypot\ProtectAgainstSpam;
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
Route::get('/redirectUser','RedirectUserController');
Route::middleware(ProtectAgainstSpam::class)->group(function() {
        Auth::routes(['register' => false]);
});
//admin routes, get and post
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin',
    'middleware' => ['auth', 'role:admin,super',ProtectAgainstSpam::class]], function () {

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')
        ->name('permissions.massDestroy');
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
    Route::resource('individual', 'IndividualFileController');
    Route::resource('company', 'CompanyFileController');
    Route::resource('retainer', 'RetainerFileController');


    //Schedule
    Route::resource('schedule', 'ScheduleController');

    //Forms
    Route::resource('conveyancing', 'ConveyancingController');
    Route::resource('client', 'ClientController');

    //default dashboard routes
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/chart', 'HomeController@chart')->name('chart');
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
        Route::get('/chart', 'HomeController@chart')->name('chart');
        Route::get('/my-cases', 'HomeController@myCases')->name('cases');
        Route::get('/my-schedule', 'HomeController@mySchedule')->name('schedule');
        Route::get('/pending-cases', 'HomeController@pendingCases')->name('pending.cases');

        // Schedule
        Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('events.massDestroy');
        Route::resource('schedule', 'ScheduleController');

    });

//Admin & Lawyer routes

//Case & Case Schedule
Route::group(['middleware' => ['auth', 'role:lawyer,super,admin']], function (){
    Route::resource('cases', 'CaseController')->names([
        'destroy' => 'admin.cases.destroy',
        'create' => 'admin.cases.create',
    ]);
    Route::resource('files', 'Admin\FileController');
    Route::delete('cases/destroy', 'CaseController@massDestroy')->name('admin.cases.massDestroy');

    //Notification routes for authenticated user
    Route::post('/mark-as-read', 'NotificationController@markNotification')->name('markNotification');
    Route::get('/notifications', 'NotificationController@index')->name('notifications');

    //Search model routes
    Route::get('/search', 'SearchController')->name('search')->middleware(ProtectAgainstSpam::class);

    //Profile routes for Lawyer & Admin's
    Route::resource('profile','ProfileController');
    Route::post('check-schedule', 'ScheduleController')->name('check-schedule');
    Route::resource('user','UserController')->only([
        'update'
    ]);

});

Route::group(['prefix' => 'admin', 'as' => 'super.', 'namespace' => 'Admin','middleware' => ['auth', 'role:super']],
    function (){
    Route::get('/activity-logs', 'HomeController@activityLogs')->name('activity.logs');
});

