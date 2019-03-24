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
//==========================FACEBOOK LOGINCONTROLLERS============//
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
//======================GROUP CHAT CONTROLLERS===================//
Route::post('sendmessage','groupChat@groupsend');
Route::post('getMessage','groupChat@getMessage');
Route::post('saveMessage','groupChat@save_message');
Route::post('claerChat','groupChat@clearchat');
//====================PRIVATE CHAT CONTROLLERS====================//
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}','ContactsController@getMessagesFor');
Route::post('/conversation/send','ContactsController@send');


