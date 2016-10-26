<?php

/**
 * Api Routes
 */
Route::group(['middleware' => 'api', 'namespace' => 'Api\Championship'], function() {
//Route::group(['namespace' => 'Api\Championship'], function() {
    Route::get('/api/game', ['as' => 'api.game.index', 'uses' => 'GamesController@index']);
    Route::get('/api/game/{game}', ['as' => 'api.game.get', 'uses' => 'GamesController@show']);
    Route::get('/api/tournament_name/{name}', ['as' => 'api.from_tournament_name.get', 'uses' => 'GameTournamentTeamPlayerController@to_name']);
    Route::get('/api/tournament_id/{id}', ['as' => 'api.from_tournament_id.get', 'uses' => 'GameTournamentTeamPlayerController@to_id']);
    Route::get('/api/team_name/{name}', ['as' => 'api.from_team_name.get', 'uses' => 'GameTournamentTeamPlayerController@te_name']);
    Route::get('/api/team_id/{id}', ['as' => 'api.from_team_id.get', 'uses' => 'GameTournamentTeamPlayerController@te_id']);
});