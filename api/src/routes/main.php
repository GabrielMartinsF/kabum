<?php 

use App\Http\Route;
#usuario

Route::get('/',                     'HomeController@index');
Route::post('/users/login',         'UserController@login');
Route::post('/users/create',        'UserController@store');
Route::get('/users/fetch',          'UserController@fetch');
Route::put('/users/update',         'UserController@update');
Route::delete('/users/{id}/delete', 'UserController@remove');

#cliente
Route::post('/client/create',            'ClientController@store');
Route::post('/client/login',             'ClientController@login');
Route::get('/client/fetch',              'ClientController@fetch');
Route::get('/client/fetchClientAddress', 'ClientController@fetchClientAddress');
Route::get('/client/{id}/fetch',         'ClientController@fetchOne');
Route::put('/client/{id}/update',        'ClientController@update');
Route::delete('/client/{id}/delete',     'ClientController@remove');

#endereços
Route::post('/address/create',        'AddressController@store');
Route::post('/address/login',         'AddressController@login');
Route::get('/address/fetch',          'AddressController@fetch');
Route::get('/address/{id}/fetch',     'AddressController@fetchOne');
Route::put('/address/{id}/update',    'AddressController@update');
Route::delete('/address/{id}/delete', 'AddressController@remove');