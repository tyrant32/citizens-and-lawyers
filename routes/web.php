<?php
declare(strict_types=1);

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

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::middleware(['throttle:1000'])->namespace('Citizens')->group(function () {
    Route::get('/citizen/home', 'AppointmentsController@index')->name('citizen.appointments');
    Route::get('/citizen/request/appointment', 'AppointmentsController@request')->name('citizen.request.appointment');
    Route::get('/citizen/appointment/{id}', 'AppointmentsController@edit')->name('citizen.request.appointment.edit');
    Route::post('/citizen/request/appointment/create', 'AppointmentsController@create')->name('citizen.request.appointment.create');
    Route::put('/citizen/appointment/update/{id}', 'AppointmentsController@update')->name('citizen.request.appointment.update');
    Route::delete('/citizen/appointment/{id}', 'AppointmentsController@delete')->name('citizen.request.appointment.delete');
});

Route::middleware(['throttle:1000'])->namespace('Lawyers')->group(function () {
    Route::get('/lawyer/home', 'AppointmentsController@index')->name('lawyer.appointments');
    Route::get('/lawyer/appointment/{id}', 'AppointmentsController@edit')->name('lawyer.request.appointment.edit');
    Route::put('/lawyer/appointment/update/{id}', 'AppointmentsController@update')->name('lawyer.request.appointment.update');
    Route::delete('/lawyer/appointment/{id}', 'AppointmentsController@delete')->name('lawyer.request.appointment.delete');
});

#API
Route::get('/api/appointments', 'API\AppointmentsController@index')
    ->name('api.appointments');
