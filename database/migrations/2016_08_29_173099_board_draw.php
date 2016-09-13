<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BoardDraw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::connection('mysql_champ')->hasTable('game_player')) {
            Schema::connection('mysql_champ')->create('game_player', function (Blueprint $table) { //pivot table
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->string('player_id')->index()->references('id')->on('players');
                $table->string('game_id')->index()->references('id')->on('games');
                $table->timestamps();
            });
        }
        if(!Schema::connection('mysql_champ')->hasColumn('players', 'user_id')) {
            Schema::connection('mysql_champ')->table('players', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('user_id')->index()->unsigned()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }


        //now straighting out foreign keys and references
        if(!Schema::connection('mysql_champ')->hasColumn('tournaments', 'game_id')) {
            Schema::connection('mysql_champ')->table('tournaments', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('game_id')->index()->unsigned()->after('max_players')->change();
                $table->foreign('game_id')->references('id')->on('games')->change();
            });
        }

        if(!Schema::connection('mysql_champ')->hasColumn('teams', 'tournament_id')) {
            Schema::connection('mysql_champ')->table('teams', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('tournament_id')->index()->unsigned()->after('id')->change();
                $table->foreign('tournament_id')->references('id')->on('tournament')->change();
            });
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::connection('mysql_champ')->hasTable('game_player')) {
            Schema::connection('mysql_champ')->drop('game_player');
        }

        if(Schema::connection('mysql_champ')->hasColumn('players','user_id')) {
            Schema::connection('mysql_champ')->table('players', function (Blueprint $table) {
                $table->dropForeign('user_id');
                $table->dropColumn('user_id');
            });
        }
        if(Schema::connection('mysql_champ')->hasColumn('tournaments','game_id')) {
            Schema::connection('mysql_champ')->table('tournaments', function (Blueprint $table) {
                $table->dropForeign('game_id');
            });
        }
        if(Schema::connection('mysql_champ')->hasColumn('teams','tournament_id')) {
            Schema::connection('mysql_champ')->table('teams', function (Blueprint $table) {
                $table->dropForeign('tournament_id');
            });
        }
    }
}