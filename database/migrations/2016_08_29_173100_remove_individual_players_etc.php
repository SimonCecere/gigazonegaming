<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveIndividualPlayersEtc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('mysql_champ')->hasTable('players')) {
            $player = \App\Models\Championship\Player::all()->toArray();

            if (isset($player[0]['team_id'])) {
                $this->back_players_table($player);
                foreach ($player as &$p) {
                    $string = 'none_yet';// this is to create a string that would allow team mates to get assign to a team if they didnt have one
                    $team_id = $p['team_id'];
                    unset($p['team_id']);
                    $team_info = \App\Models\Championship\Team::where('id', $team_id)->select('captain', 'tournament_id')->get()->toArray();
//                if(10 == $team_id){dd($team_info);}
                    if (isset($team_info[0]) and $team_info != [] and $team_info[0] != null) {
                        $team_info = $team_info[0];
                        if (isset($team_info['captain']) and $team_info['captain'] == $p['id']) {
                            $string = str_random(8); //it is a captain so create a string that he or she can send to add players
                        } //is it a captain ????

                        //create the pivot table info for players and teams
                        try {
                            $p_te = \App\Models\Championship\Team::find($team_id);
                            $p_te->players()->attach($p['id'], ['verification_code' => $string]);
                        } catch (Exception $ex) {
                            \Log::error($ex->getMessage());
                        }

                        //create the pivot table info for players and tournament
                        try {
                            $p_to = \App\Models\Championship\Tournament::find($team_info['tournament_id']);
                            $p_to->players()->attach($p['id']);
                        } catch (Exception $ex) {
                            \Log::error($ex->getMessage());
                        }

                    } else {
                        \App\Models\Championship\Player::destroy($p['id']);
                    }

                }

                //all players (not individual) are set to go, now we can remove the column that is not need it anymore.

            }
            if (Schema::connection('mysql_champ')->hasColumn('players', 'team_id')) {
                Schema::connection('mysql_champ')->table('players', function ($table) {
                    $table->dropForeign('players_team_id_foreign');
                    $table->dropColumn('team_id');
                });
            }
        }

        if (Schema::connection('mysql_champ')->hasTable('individual_players')) {
//            dd("here is the problem");
            $indPlayer = \App\Models\Championship\IndividualPlayer::all()->toArray();

            $this->back_individualPlayers_table($indPlayer);
            foreach ($indPlayer as &$p) {
//                dd($p);
                $string = 'none_yet';// this is to create a string that would allow team mates to get assign to a team if they didnt have one
                $game_id = $p['game_id'];
                $tournaments = \App\Models\Championship\Tournament::where('game_id', $p['game_id'])->get();
                unset($p['id']);
                unset($p['game_id']);
                $newPlayer = \App\Models\Championship\Player::create($p);
                //create the pivot table info for players and tournaments
                foreach ($tournaments as $tournament) { // this is a bold fix because we just go with every tournament that is for that game, even if the user didn't sign for it, but because there is only one game hopefully will work and we wont need it again :)
                    $tournament->players()->attach($newPlayer->id);
                }
            }
            //all individual players are in the player table and in the pivot table for tournaments now we can drop the table

        }
        if (Schema::connection('mysql_champ')->hasTable('individual_players')) { //if deletes it next step wont detected else if the key blocks the deletion the drop key will work
            Schema::connection('mysql_champ')->dropIfExists('individual_players');
        }
        if (Schema::connection('mysql_champ')->hasTable('individual_players')) {
            if (Schema::connection('mysql_champ')->hasColumn('individual_players', 'game_id')) {
                Schema::connection('mysql_champ')->table('individual_players', function (Blueprint $table) {

                    try {
                        $table->dropForeign(['game_id']);
                    } catch (Exception $e) {
                        echo 'game_id for some reason didnt have a key : ', $e->getMessage(), "\n";
                    }
                    $table->dropColumn(['game_id']);
                });
                Schema::connection('mysql_champ')->dropIfExists('individual_players');
            }
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (!Schema::connection('mysql_champ')->hasTable('individual_players')) {
            Schema::connection('mysql_champ')->create('individual_players', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('name');
                $table->string('phone');
                $table->integer('game_id')->references('id')->on('games');;
                $table->timestamps();
            });
        }
        if (!Schema::connection('mysql_champ')->hasColumn('players', 'team_id')) {
            Schema::connection('mysql_champ')->table('players', function ($table) {
                $table->unsignedInteger('team_id')->default(0);
                $table->foreign('team_id')->references('id')->on('teams');
            });
        }
    }

    /**
     * @param $indPlayer
     * @param $player
     */
    public function back_individualPlayers_table($indPlayer)
    {
        $fp = fopen(dirname(dirname(__FILE__)) . '/individualPlayersTableBkup.csv', 'a+'); ///saving info in case something happen
        foreach ($indPlayer as $fields) {
            fputcsv($fp, $fields, chr(9));
        }
        fclose($fp);
    }
    /**
     * @param $indPlayer
     * @param $player
     */
    public function back_players_table($player)
    {
        $fp = fopen(dirname(dirname(__FILE__)) . '/PlayersTableBkup.csv', 'a+'); ///saving info in case something happen
        foreach ($player as $fields) {
            fputcsv($fp, $fields, chr(9));
        }
        fclose($fp);
    }
}
