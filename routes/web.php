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


Route::get('/office', 'OfficeController@index')->name('office.index');
Route::get('/office/create', 'OfficeController@create')->name('office.create');
Route::post('/office/store', 'OfficeController@store')->name('office.store');
Route::get('/office/edit/{id}', 'OfficeController@edit')->name('office.edit');
Route::post('/office/update/{id}', 'OfficeController@update')->name('office.update');
Route::get('/office/destroy/{id}', 'OfficeController@destroy')->name('office.destroy');


Route::get('/working-hour', 'WorkingHourController@index')->name('working-hour.index');
Route::get('/working-hour/create', 'WorkingHourController@create')->name('working-hour.create');
Route::post('/working-hour/store', 'WorkingHourController@store')->name('working-hour.store');
Route::get('/working-hour/edit/{id}', 'WorkingHourController@edit')->name('working-hour.edit');
Route::post('/working-hour/update/{id}', 'WorkingHourController@update')->name('working-hour.update');
Route::get('/working-hour/destroy/{id}', 'WorkingHourController@destroy')->name('working-hour.destroy');



Route::get('/appointment', 'AppointmentController@index')->name('appointment.index');
Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create');
Route::post('/appointment/store', 'AppointmentController@store')->name('appointment.store');
Route::get('/appointment/edit/{id}', 'AppointmentController@edit')->name('appointment.edit');
Route::post('/appointment/update/{id}', 'AppointmentController@update')->name('appointment.update');
Route::get('/appointment/destroy/{id}', 'AppointmentController@destroy')->name('appointment.destroy');
Route::get('/appointment/show-stretcher/{office_id}/{date}/{time}/{id}', 'AppointmentController@showStretcher')->name('appointment.show-stretcher');
Route::get('/appointment/check-date/{office_id}/{date}', 'AppointmentController@checkDate')->name('appointment.check-date');
Route::get('/calender', 'AppointmentController@calender')->name('appointment.calender');



