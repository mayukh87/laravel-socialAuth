<?php

/*
|--------------------------------------------------------------------------
| Routes for admin
|--------------------------------------------------------------------------
*/

Route::get('/admin', 'Auth\AuthController@getLoginForm');
Route::get('/admin/login', 'Auth\AuthController@getLoginForm');
Route::get('/admin/logout', 'Auth\AuthController@logout');
Route::post('/admin/login', 'Auth\AuthController@login');
Route::get('/admin/register', 'Auth\AuthController@showRegistrationForm');
Route::post('/admin/register', 'Auth\AuthController@register');
Route::get('/admin/home', 'APP\Admin\HomeController@home');

Route::get('/admin/redirect', 'APP\Admin\SocialAuthController@redirect');
Route::get('/admin/callback', 'APP\Admin\SocialAuthController@callback');