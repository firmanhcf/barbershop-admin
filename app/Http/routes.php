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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//# Ajax
Route::get('config/regency/{region}', 'Config\LocationController@getRegency');
Route::get('config/district/{regency}', 'Config\LocationController@getDistrict');
Route::get('config/service/{partnership}', 'Config\PartnershipServicesController@getServices');
Route::get('outlet/info/{id}', 'Dashboard\OutletController@getOutletInfo');

Route::group(['middleware' => 'auth'], function () {

	//# Dashboard
    Route::get('/', 'Dashboard\DashboardController@showMainDashboard');

    //# Transaction
    Route::get('transaction', 'Dashboard\TransactionController@showTransactionDashboard');
    Route::get('transaction/edit/{id}', 'Dashboard\TransactionController@showEditTransaction');
    Route::post('transaction/input', 'Dashboard\TransactionController@inputNewTransaction');
    Route::post('transaction/edit/{id}', 'Dashboard\TransactionController@editTransaction');
    Route::post('transaction/delete/{id}', 'Dashboard\TransactionController@deleteTransaction');

    //# Partner
    Route::get('partner', 'Dashboard\PartnerController@showPartnerDashboard');
    Route::get('partner/edit/{id}', 'Dashboard\PartnerController@showEditPartner');
    Route::post('partner/input', 'Dashboard\PartnerController@inputNewPartner');
    Route::post('partner/edit/{id}', 'Dashboard\PartnerController@editPartner');
    Route::post('partner/delete/{id}', 'Dashboard\PartnerController@deletePartner');

    //# Outlet
    Route::get('outlet', 'Dashboard\OutletController@showOutletDashboard');
    Route::get('outlet/edit/{id}', 'Dashboard\OutletController@showEditOutlet');
    Route::post('outlet/input', 'Dashboard\OutletController@inputNewOutlet');
    Route::post('outlet/edit/{id}', 'Dashboard\OutletController@editOutlet');
    Route::post('outlet/delete/{id}', 'Dashboard\OutletController@deleteOutlet');

    //# Employee
    Route::get('employee', 'Dashboard\EmployeeController@showEmployeeDashboard');
    Route::get('employee/edit/{id}', 'Dashboard\EmployeeController@showEditEmployee');
    Route::post('employee/input', 'Dashboard\EmployeeController@inputNewEmployee');
    Route::post('employee/edit/{id}', 'Dashboard\EmployeeController@editEmployee');
    Route::post('employee/delete/{id}', 'Dashboard\EmployeeController@deleteEmployee');

    //# Asset
    Route::get('asset', 'Dashboard\AssetController@showAssetDashboard');
    Route::get('asset/edit/{id}', 'Dashboard\AssetController@showEditAsset');
    Route::post('asset/input', 'Dashboard\AssetController@inputNewAsset');
    Route::post('asset/edit/{id}', 'Dashboard\AssetController@editAsset');
    Route::post('asset/delete/{id}', 'Dashboard\AssetController@deleteAsset');

    //# Asset
    Route::get('operational', 'Dashboard\OperationalController@showOperationalDashboard');
    Route::get('operational/edit/{id}', 'Dashboard\OperationalController@showEditOperational');
    Route::post('operational/input', 'Dashboard\OperationalController@inputNewOperational');
    Route::post('operational/edit/{id}', 'Dashboard\OperationalController@editOperational');
    Route::post('operational/delete/{id}', 'Dashboard\OperationalController@deleteOperational');

    //# Profile
    Route::get('profile', 'Dashboard\ProfileController@showProfile');
    Route::post('profile/password', 'Dashboard\ProfileController@changePassword');
    Route::post('profile/photo', 'Dashboard\ProfileController@changeProfilePhoto');

    //# Account
    Route::get('account', 'Admin\AccountController@showAccount');
    Route::post('account/activation/{id}/{status}', 'Admin\AccountController@accountActivation');


});

