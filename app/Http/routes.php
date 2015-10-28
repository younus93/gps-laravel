<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');





Route::group(['middleware' => 'App\Http\Middleware\UserMiddleWare'], function()
{
    Route::get('/plot/{vehicleNumber}/{lat}/{long}/{speed}/{location}', 'FleetMasterController@plot' );
    Route::get('/fleetmaster', 'FleetMasterController@index');

});

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::get('/adminpanel', 'AdminPanelController@index');

    //view user
    Route::get('/users/viewuser/{id}','AdminPanelController@viewUser');
    Route::get('/users/registeruser', 'AdminPanelController@registerUser');
    Route::get('/users/viewusers','AdminPanelController@viewUsers');

    //Add phone to Imei
    Route::get('/imei/add/{id}','AdminPanelController@showIMEI');
    Route::post('/imei/add/','AdminPanelController@addDeviceToUser');

    //gps master
    Route::get('gps/viewgps','AdminPanelController@viewGPS');
    Route::get('gps/viewgps/{id}','AdminPanelController@viewGPSDevice');
    Route::post('gps/recharge/','AdminPanelController@rechargeGPS');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'AdminPanelController@postRegister');

    //datatables routes
    Route::get('/userData','AdminPanelController@getUsers');
    Route::get('/gpsData','AdminPanelController@getDevices');

});