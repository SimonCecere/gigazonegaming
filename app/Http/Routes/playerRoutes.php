<?php
/**
 * Created by PhpStorm.
 * User: nelson_castillo
 * Date: 5/19/16
 * Time: 4:44 PM
 */

Route::get('/manage/player', ['as' => 'manage.player.index', 'uses' => 'Backend\Manage\PlayersController@index']); //no need for middleware as we return the names only
Route::group(['middleware' => ['WPAdmin']], function () {
    Route::post('/manage/player', ['as' => 'manage.player.filter', 'uses' => 'Backend\Manage\PlayersController@filter']); //no need for middleware as we return the names only
    Route::get('/manage/player/edit/{player_id}', ['as' => 'manage.player.edit', 'uses' => 'Backend\Manage\PlayersController@edit']);
    Route::put('/manage/player/edit/{player_id}', ['as' => 'manage.player.edited', 'uses' => 'Backend\Manage\PlayersController@update']);
    Route::post('/manage/player/new/', ['as' => 'manage.player.new', 'uses' => 'Backend\Manage\PlayersController@create']);
    Route::delete('/manage/player/delete/{player_id}', ['as' => 'manage.player.delete', 'uses' => 'Backend\Manage\PlayersController@destroy']);
});