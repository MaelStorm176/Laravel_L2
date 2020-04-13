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

Route::get('/', function () {
    return view('welcome');
});
Route::get('commentaire', 'Commentaire@index')->name('home');
Route::get('ajout_commentaire', 'Commentaire@ajout')->name('ajout_commentaire');
Route::get('clear_db', 'Commentaire@clear_db')->name('clear_db');
Route::get('afficher_comm', 'Commentaire@afficher')->name('afficher_comm');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
