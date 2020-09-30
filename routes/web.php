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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function () {
    Route::resource('/user', 'UserController');
    Route::resource('/company', 'CompanyController');
    Route::resource('/owner', 'OwnerController');
    Route::resource('/car', 'CarController');
    Route::resource('/logbook', 'LogbookController');
    Route::resource('/contract', 'ContractController');

    Route::get('/owner/{slug}/car', 'OwnerController@car')->name('owner.car');
    Route::get('/owner/{slug}/car/create', 'OwnerController@carCreate')->name('owner.carCreate');
    Route::get('/owner/{slug}/contract', 'OwnerController@contractCreate')->name('owner.contractCreate');
    Route::get('/owner/{slug}/contract/{id}', 'OwnerController@contractEdit')->name('owner.contractEdit');

    Route::get('/company/{slug}/contract', 'CompanyController@contractCreate')->name('company.contractCreate');
    Route::get('/company/{slug}/contract/{id}', 'CompanyController@contractEdit')->name('company.contractEdit');

    Route::get('/logbook/{registration_num}/{id}', 'LogbookController@editLog')->name('logbook.editLog');
    Route::get('/logbook/{registration_num}/past/one', 'LogbookController@showPast')->name('logbook.showPast');
    Route::get('/logbook/{registration_num}/past/two', 'LogbookController@showPastTwo')->name('logbook.showPastTwo');
    Route::post('/logbook/import', 'LogbookController@import')->name('import');

    Route::get('/car/{registration_num}/report', 'CarController@report')->name('car.report');

    Route::get('/car/{slug}/owner_report', 'CarController@ownerReport')->name('car.ownerReport');
    Route::get('/car/{slug}/company_report', 'CarController@companyReport')->name('car.companyReport');

    Route::get('/bill', 'LogbookController@bill')->name('logbook.bill');
    Route::get('/payment', 'LogbookController@payment')->name('logbook.payment');

});