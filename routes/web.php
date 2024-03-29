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

Route::get('/',function(){
    return view('welcome');
});



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
    Route::resource('litigation', 'LitigationController');

    //default dashboard routes
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/chart', 'HomeController@chart')->name('chart');
    Route::get('/pending/', 'HomeController@pendingCases')->name('view.pending-cases');

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

        //Litigation & Conveyancing
        //Common Forms
        Route::resource('litigation', 'LitigationController')->names([
            'destroy' => 'admin.litigation.destroy',
            'create' => 'admin.litigation.create',
        ]);
        Route::resource('conveyancing', 'ConveyancingController')->names([
            'destroy' => 'admin.conveyancing.destroy',
            'create' => 'admin.conveyancing.create',
        ]);
        Route::resource('initial-consultation-form', 'InitialConsultationFormController');
        Route::resource('note-form', 'NoteFormController');
        Route::resource('matrimony-form', 'MatrimonyController');

    });

//Admin & Lawyer routes
//Litigation, Conveyancing & Schedule
Route::group(['middleware' => ['auth', 'role:lawyer,super,admin']], function (){
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
    Route::resource('client', 'ClientController');
});

Route::group(['prefix' => 'admin', 'as' => 'super.', 'namespace' => 'Admin','middleware' => ['auth', 'role:super']],
    function (){
        Route::get('/activity-logs', 'HomeController@activityLogs')->name('activity.logs');
        Route::get('/litigation/{litigation}/updated/{activity}', 'HomeController@showUpdatedLitigation')->name('updated-litigation');
        Route::get('/litigation/{id}/deleted/{activity}', 'HomeController@showDeletedLitigation')->name('deleted-litigation');
        Route::get('/litigation/{id}/activity/{activity}/restore', 'HomeController@restoreDeletedLitigation')->name('restore-litigation');

        Route::get('/conveyancing/{id}/updated/{activity}', 'HomeController@showUpdatedConveyancing')->name('updated-conveyancing');
        Route::get('/conveyancing/{id}/deleted/{activity}', 'HomeController@deletedConveyancing')->name('deleted-conveyancing');
        Route::get('/client/{id}/updated/{activity}', 'HomeController@showUpdatedClient')->name('updated-client');
        Route::get('/client/{id}/deleted/{activity}', 'HomeController@showDeletedClient')->name('deleted-client');

        Route::get('/activity/{activity}', 'HomeController@resolveActivity')->name('resolve-activity');

});

