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


Route::delete('cats/{cats}/delete', ['as' => 'cats.destroy', 'uses' =>'WordController@synDelete']);

Route::get('/', function () {
    return redirect('word');
});

Route::get('print', 'WordController@printAll');

Route::get('word', 'WordController@index');
Route::post('word/create', 'WordController@store');
Route::get('synonyms/{id}', 'WordController@getAllSynonyms');

Route::post('makeRelation/', 'WordController@makeSynonyms');

Route::get('word/all', 'WordController@getAllWords');



Route::resource('word', 'WordController');

Route::resource('search', 'SearchController')->only('index');
