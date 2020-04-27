<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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

Route::get('commentaire', 'Commentaire@index')->name('home');
Route::get('ajout_commentaire', 'Commentaire@ajout')->name('ajout_commentaire');
Route::get('clear_db', 'Commentaire@clear_db')->name('clear_db');
Route::get('afficher_comm', 'Commentaire@afficher')->name('afficher_comm');


/*PIZZA */
Route::get('pizza_index', 'Pizza@index')->name('pizza_index');
Route::post('pizza.upload','Pizza@upload')->name('pizza.upload');
Route::post('pizza.modifier','Pizza@modifier')->name('pizza.modifier');
Route::get('pizza_all', 'Pizza@all')->name('pizza_all');
Route::get('afficher_form','Pizza@afficher_form')->name('afficher_form');
Route::get('pizza.supprimer','Pizza@supprimer')->name('pizza.supprimer');
Route::get('pizza_all/{pizza_nom}','Pizza@detail');
Route::post('pizza.promotion','Pizza@promotion')->name('promotion');
Route::post('code.upload','CodeController@upload')->name('code.upload');


/*PANIER*/
Route::get('panier','Panier@afficher')->name('panier');
Route::get('panier.creer','Panier@creer')->name('panier.creer');
Route::get('panier.ajouter','Panier@ajouter')->name('panier.ajouter');
Route::get('panier.modifier','Panier@modifier')->name('panier.modifier');
Route::get('panier.contenu_supprimer','Panier@contenu_supprimer')->name('panier.contenu_supprimer');


/*COMMANDE*/
Route::get('valider', 'Commande@valider')->name('valider');
Route::get('afficher_commande', 'Commande@afficher_comm')->name('afficher_commande');
Route::get('historique', 'Commande@historique')->name('historique');
Route::get('historique_commande','AjaxPaginationController@ajaxPagination')->name('historique_commande');

/*PAYEMENT*/

Route::get('/test', function () {
    return view('payment_save');
});

Route::get('/payment_accepted', function () {
    return view('payment_accepted');
});
Route::get('/payment', 'StripePaymentController@index')->name('payment');
Route::get('testvalidite', 'StripePaymentController@testvalidite')->name('testvalidite');

/*CRAFT*/
Route::get('/craft', 'Craft@index')->name('craft');
Route::get('/craft', 'Craft@afficher')->name('craft');
Route::post('ajouter', 'Craft@ajouter')->name('craft.ajouter');
Route::post('craft_modifier', 'Craft@modifier')->name('craft_modifier');
Route::GET('craft_afficher_form', 'Craft@afficher_form')->name('craft_afficher_form');
Route::post('ajouter_ingredient', 'Craft@ajouter_ingredient')->name('ajouter_ingredient');
Route::get('supprimer_ingredient', 'Craft@supprimer')->name('supprimer_ingredient');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();

Route::get('/', function(){
    $pizza = DB::table('pizza')->select('*')->where('statut','=','Disponible')->get();
    return view('accueil')->with('pizza',$pizza);
})->name('/');


Route::get('engagements', function(){
    return view('engagements');
})->name('engagements');

Route::get('avis', 'Commentaire@index')->name('avis');

Route::get('parametres', function(){
    return view('parametres');
})->name('parametres');

Route::get('horaires', function(){
    return view('horaires');
})->name('horaires');
