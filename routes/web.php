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
    return view('index');
});
Route::get('/auth/twitter','Auth\TwitterController@redirect')->name('twiiterLogin');
Route::get('/auth/twitter/callback','Auth\TwitterController@callback')->name('twiiterLogin');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('quiz/make','QuizController@make')->name('make-quiz');
    Route::post('quiz/save','QuizController@save')->name('quiz-save');
    Route::get('mypage/change','HomeController@change')->name('change');
    Route::get('quiz/list','QuizController@list');
    Route::get('quiz/list/{id}','QuizController@get');
    Route::get('quiz/test/{id}','QuizController@test');
    Route::get('quiz/edit/{id}','QuizController@edit');
    Route::post('quiz/change/{id}','QuizController@change');
    Route::post('quiz/delete/{id}','QuizController@delete');
});

Auth::routes();

