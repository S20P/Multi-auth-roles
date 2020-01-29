<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
    Route::get('/', function () {
        return view('FrontEnd.home');
    });

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
   
    // supplier------   
    Route::prefix('supplier')->group(function () {
        //login
         Route::get('/login', 'Auth\LoginController@showSupplierLoginForm')->name('supplier.login');
        Route::post('/login', 'Auth\LoginController@SupplierLogin')->name('supplier.login');
        //signup
        Route::get('/register', 'Auth\RegisterController@showSupplierRegisterForm');
        Route::post('/register', 'Auth\RegisterController@createSupplier');
        //dashboard
        Route::view('/dashboard', 'supplier.dashboard');
        Route::view('/', 'supplier.dashboard');
        Route::get('/account', 'Supplier\supplierController@account')->name('supplier.account');
        Route::post('/account', 'Supplier\supplierController@account_edit')->name('supplier.account');
        Route::get('/profile', 'Supplier\supplierController@profile')->name('supplier.profile');
        Route::post('/profile', 'Supplier\supplierController@profile_edit')->name('supplier.profile');
    });

    // customer------
    Route::prefix('customer')->group(function () {
        //login
        Route::get('/login', 'Auth\LoginController@showCustomerLoginForm')->name('customer.login');
        Route::post('/login', 'Auth\LoginController@CustomerLogin')->name('customer.login');
        //signup
        Route::get('/register', 'Auth\RegisterController@showCustomerRegisterForm');
        Route::post('/register', 'Auth\RegisterController@createCustomer');
        //dashboard
        Route::view('/', 'customer.dashboard');
        Route::view('/dashboard', 'customer.dashboard');
       
        Route::get('/account', 'Customer\customerController@account')->name('customer.account');
        Route::post('/account', 'Customer\customerController@account_edit')->name('customer.account');
        Route::get('/profile', 'Customer\customerController@profile')->name('customer.profile');
        Route::post('/profile', 'Customer\customerController@profile_edit')->name('customer.profile');
    });
    
    Route::get('password/reset','Auth\CustomResetPasswordController@getResetPasswordForm')->name('password.reset');
    Route::post('password/email','Auth\CustomResetPasswordController@postResetPasswordEmail')->name('password.email');
    Route::get('resetPassword/{email}/{verificationLink}','Auth\CustomResetPasswordController@resetPassword');
    Route::post('resetPassword','Auth\CustomResetPasswordController@newPassword')->name('password.update');

  