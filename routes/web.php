<?php
Auth::routes();

Route::get('/', 'PostsController@index');
Route::get('/posts/create','PostsController@create');
Route::post('/posts', 'PostsController@store');

Route::get('/approve/{post_id}', 'PostsController@approve')->name('approve');
Route::get('/spam/{post_id}', 'PostsController@spam')->name('spam');