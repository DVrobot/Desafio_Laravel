<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('admin.layouts.app');
        
    })->name('dashboard');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users','UserController');
    Route::resource('/categories','CategoryController');
    Route::resource('/courses','CourseController');
    Route::put('/courses/subscription/{course}', 'CourseController@subscription')->name('courses.subscription');
});