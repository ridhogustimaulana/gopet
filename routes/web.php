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
})->name('gopet');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::post('/home/store', 'DiagnosisController@store')->name('user.diagnosis.store');

Route::get('petshop', 'UserPetshopController@index')->name('user-petshop.home');

Route::get('petshop/login', 'PetshopAuth\PetshopAuthController@showFormLogin')->name('user-petshop.show-login');
Route::post('petshop/login', 'PetshopAuth\PetshopAuthController@login')->name('user-petshop.login');
Route::get('petshop/logout', 'PetshopAuth\PetshopAuthController@logoutUserPetshop')->name('user-petshop.logout');
Route::get('petshop/register', 'PetshopAuth\PetshopAuthController@showFormRegister')->name('user-petshop.show-register');
Route::post('petshop/register', 'PetshopAuth\PetshopAuthController@register')->name('user-petshop.register');
Route::get('petshop/order', 'PetshopAuth\OrderController@index')->name('user-petshop.order');
Route::patch('petshop/order/{id}', 'PetshopAuth\OrderController@update')->name('user-petshop.update');
Route::get('petshop/item', 'PetshopAuth\ItemController@index')->name('user-petshop.item');
Route::get('petshop/item/create', 'PetshopAuth\ItemController@create')->name('user-petshop.item.create');
Route::post('petshop/item/store', 'PetshopAuth\ItemController@store')->name('user-petshop.item.store');
Route::get('petshop/item/{id}/edit', 'PetshopAuth\ItemController@edit')->name('user-petshop.item.edit');
Route::patch('petshop/item/{id}', 'PetshopAuth\ItemController@update')->name('user-petshop.item.update');
Route::delete('petshop/item/{id}', 'PetshopAuth\ItemController@destroy')->name('user-petshop.item.destroy');
Route::get('petshop/profile', 'PetshopAuth\PetshopController@profile')->name('user-petshop.profile');
Route::patch('petshop/profile', 'PetshopAuth\PetshopController@updateProfile')->name('user-petshop.profile.update');


Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/home', 'AdminController@index');
    Route::get('/login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminAuth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/washing-and-spa', 'WashingAndSpaController@index')->name('admin.washing-and-spa');
    Route::get('/washing-and-spa/create', 'WashingAndSpaController@create')->name('admin.washing-and-spa.create');
    Route::post('/washing-and-spa', 'WashingAndSpaController@store')->name('admin.washing-and-spa.store');
    Route::get('/washing-and-spa/{id}/edit', 'WashingAndSpaController@edit')->name('admin.washing-and-spa.edit');
    Route::patch('/washing-and-spa/{id}', 'WashingAndSpaController@update')->name('admin.washing-and-spa.update');
    Route::delete('/washing-and-spa/{id}', 'WashingAndSpaController@destroy')->name('admin.washing-and-spa.destroy');

    Route::get('/buying-animal', 'BuyingAnimalController@index')->name('admin.buying-animal');
    Route::get('/buying-animal/create', 'BuyingAnimalController@create')->name('admin.buying-animal.create');
    Route::post('/buying-animal', 'BuyingAnimalController@store')->name('admin.buying-animal.store');
    Route::get('/buying-animal/{id}/edit', 'BuyingAnimalController@edit')->name('admin.buying-animal.edit');
    Route::patch('/buying-animal/{id}', 'BuyingAnimalController@update')->name('admin.buying-animal.update');
    Route::delete('/buying-animal/{id}', 'BuyingAnimalController@destroy')->name('admin.buying-animal.destroy');

    Route::get('/petshop', 'PetShopController@index')->name('admin.petshop');
    Route::get('/petshop/create', 'PetShopController@create')->name('admin.petshop.create');
    Route::post('/petshop', 'PetShopController@store')->name('admin.petshop.store');
    Route::get('/petshop/{id}/edit', 'PetShopController@edit')->name('admin.petshop.edit');
    Route::patch('/petshop/{id}', 'PetShopController@update')->name('admin.petshop.update');
    Route::delete('/petshop/{id}', 'PetShopController@destroy')->name('admin.petshop.destroy');

    Route::get('/community', 'CommunityController@index')->name('admin.community');
    Route::get('/community/create', 'CommunityController@create')->name('admin.community.create');
    Route::post('/community', 'CommunityController@store')->name('admin.community.store');
    Route::get('/community/{id}/edit', 'CommunityController@edit')->name('admin.community.edit');
    Route::patch('/community/{id}', 'CommunityController@update')->name('admin.community.update');
    Route::delete('/community/{id}', 'CommunityController@destroy')->name('admin.community.destroy');

    Route::get('/doctor', 'DoctorController@index')->name('admin.doctor');
    Route::get('/doctor/create', 'DoctorController@create')->name('admin.doctor.create');
    Route::post('/doctor', 'DoctorController@store')->name('admin.doctor.store');
    Route::get('/doctor/{id}/edit', 'DoctorController@edit')->name('admin.doctor.edit');
    Route::patch('/doctor/{id}', 'DoctorController@update')->name('admin.doctor.update');
    Route::delete('/doctor/{id}', 'DoctorController@destroy')->name('admin.doctor.destroy');

    Route::get('user-petshop', 'AdminController@userPetshop')->name('admin.user-petshop');
    Route::get('user', 'AdminController@user')->name('admin.user');

    Route::get('/order', 'OrderController@index')->name('admin.order');

    Route::get('/item', 'AdminController@item')->name('admin.item');

});

Route::get('doctor/login', 'DoctorAuth\DoctorAuthController@showFormLogin')->name('doctor.showFormLogin');
Route::post('doctor/login', 'DoctorAuth\DoctorAuthController@login')->name('doctor.login');
Route::get('doctor/logout', 'DoctorAuth\DoctorAuthController@logoutDoctor')->name('doctor.logout');
Route::get('doctor', 'DoctorAuth\DoctorController@index')->name('doctor.home');
Route::get('doctor/diagnosa', 'DoctorAuth\DoctorController@diagnosa')->name('doctor.diagnosa');
Route::patch('doctor/diagnosa/{id}', 'DoctorAuth\DoctorController@updateDiagnosa')->name('doctor.diagnosa.update');
Route::get('doctor/profile', 'DoctorAuth\DoctorController@profile')->name('doctor.profile');
Route::patch('doctor/profile', 'DoctorAuth\DoctorController@updateProfile')->name('doctor.profile.update');