<?php

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('email', 'MessageController');
Route::get('emails/enviados', 'MessageController@emailenviado');

Route::resource('emails2', 'EmailController');

Route::get('totalinbox','EmailController@totalinbox');

Route::get('users', 'EmailController@getUsers');

Route::get('emailsenviados', 'EmailController@EmailsEnvados');

Route::get('numeroemailenviados', 'EmailController@NrEmailsEnvados');

//Route::post('sendemail', 'EmailController@Enviar');
Route::resource('sendemail', 'EmailController');

Route::get("userlogado", "EmailController@userlogado");
Route::get("iduserlogado", "EmailController@iduserlogado");



