<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('item', 'Api\ItemController@index');
Route::get('item/{id}', 'Api\ItemController@show');

Route::get('washing-and-spa', 'Api\WashingAndSpaController@index');
Route::get('washing-and-spa/{id}', 'Api\WashingAndSpaController@show');
Route::post('washing-and-spa', 'Api\WashingAndSpaController@store');
Route::post('washing-and-spa/{id}', 'Api\WashingAndSpaController@update');
Route::delete('washing-and-spa/{id}', 'Api\WashingAndSpaController@destroy');

Route::get('buying-animal', 'Api\BuyingAnimalController@index');
Route::get('buying-animal/{id}', 'Api\BuyingAnimalController@show');
Route::post('buying-animal', 'Api\BuyingAnimalController@store');
Route::post('buying-animal/{id}', 'Api\BuyingAnimalController@update');
Route::delete('buying-animal/{id}', 'Api\BuyingAnimalController@destroy');

Route::get('petshop', 'Api\PetShopController@index');
Route::get('petshop/{id}', 'Api\PetShopController@show');
Route::post('petshop', 'Api\PetShopController@store');
Route::post('petshop/{id}', 'Api\PetShopController@update');
Route::delete('petshop/{id}', 'Api\PetShopController@destroy');

Route::get('community', 'Api\CommunityController@index');
Route::get('community/{id}', 'Api\CommunityController@show');

Route::get('doctor', 'Api\DoctorController@index');
Route::get('doctor/{id}', 'Api\DoctorController@show');

// Route get order history for each user
Route::get('user/order/history', 'Api\UserPetshopController@history');

// route for register user
Route::post('user/register', 'Api\RegisterController@store');

// route for login user
Route::post('user/login', 'Api\LoginController@store');

// route for update profile user
Route::get('user/profile', 'Api\UserPetshopController@profile');
Route::post('user/profile/update', 'Api\UserPetshopController@updateProfile');

// Routes user for order
Route::post('user/order', 'Api\UserPetshopController@store');

Route::post('user/diagnosis', 'Api\DiagnosisController@store');
Route::get('user/diagnosis/history', 'Api\DiagnosisController@history');
