<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use App\Models\Championship\Team;
use Carbon\Carbon;
use App\Models\Championship\Tournament;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use GameDisplay\RiotDisplay\Summoner;
use Mockery\Exception;
use function MongoDB\BSON\toJSON;
use PhpParser\Node\Stmt\Return_;

class SimonCacheController extends Controller
{

    protected $players = array();


    protected $summonerArray = array();
    protected $iconArray = array();
    protected $soloRankArray = array();
    protected $soloWinLossArray = array();
    protected $flexRankArray = array();
    protected $flexWinLossArray = array();
    protected $ApiIterator = 0;

    public function teamViewDisplay(Request $req)
    {
        $tournament = $req->tournament;
        $team = $req->team;
        $color = $req->color;
        $teamInfoArrays = array();
        $colorArray = array();
        $playersArray = array();

        try{
            for($i = 0; $i < 2; $i++){
                $this->buildTheTeams($tournament, $team[$i]);
                $colorResult = $this->setTeamColor($color[$i]);
                array_push($teamInfoArrays,$this->makeTeam());
                array_push($colorArray,$colorResult);
                array_push($playersArray, $this->players);

                $this->resetArrays();
            }


            $this->cacheContent($teamInfoArrays,$colorArray,$team,$playersArray);
            $returnArray = array(
                'teamName' => $team,
                'teamInfo' => $teamInfoArrays,
                'colors' => $colorArray,
                'ErrorCode' => false,
                'players' => Cache::get('Players')
            );
        }catch(Exception $e){
            $returnArray = array(
                'ErrorCode' => true,
                'ErrorMessage' => $e->getMessage()
            );
        }

        return $returnArray;
    }
    /**
     * @param $tournament
     * @param $team
     * @param $color
     * @return array
     */
    public function buildTheTeams($tournament, $team)
    {
        //Makes an array of player objects
        $this->setPlayers($team, $tournament);
        //$this->serializeTeam($team);
        $this->setLolArrays();
    }

    public function setPlayers($TeamName, $TournamentName)
    {

        #Select the team that has been chosen from the start page
        $team = Team::where('name', $TeamName)->firstOrFail();
        $players = $team->players;

        #Loop through player of the chosen team and create an array of player objects
        foreach($players as $player){
            if(isset($player) and isset($player->username) and $player->username != null) {
                #Creat player object depending on which game is selected.
                switch ($TournamentName){
                    #LOL
                    case str_contains($TournamentName, "league-of-legends"):
                        $summoner = new Summoner($player->username, $this->ApiIterator);
                        array_push($this->players, $summoner);
                        $this->ApiIterator++;
                        //Reset Api Key Counter
                        if($this->ApiIterator == 10){
                            $this->ApiIterator = 0;
                        }
                        break;
                    #Overwatch

                    #Default
                    default:
                        break;
                }
            }
        }
    }
    public function setLolArrays(){
        foreach($this->players as $player){
            array_push($this->summonerArray, $player->getSummonerName());
            array_push($this->iconArray, $player->getIcon());
            array_push($this->soloRankArray, $player->getSoloRank());
            array_push($this->soloWinLossArray, $player->getSoloRankedWinLoss());
            array_push($this->flexRankArray, $player->getFLEXRank());
            array_push($this->flexWinLossArray, $player->getFLEXRankedWinLoss());
        }
    }
    public function setTeamColor($color1){
        if ($color1 == "Red") {
            return "background-size:cover; box-shadow:inset 0 0 0 2000px rgba(255,0,0,0.2); width:100%; height:auto; min-height:100%";
        }
        else {
            return "background-size:cover; box-shadow:inset 0 0 0 2000px rgba(0,0,255,0.2); width:100%; height:auto; min-height:100%";
        }
    }
    public function makeTeam(){
        $team = array(
            'summonerArray' => $this->summonerArray,
            'iconArray' => $this->iconArray,
            'soloRankArray' => $this->soloRankArray,
            'soloWinLossArray' => $this->soloWinLossArray,
            'flexRankArray' => $this->flexRankArray,
            'flexWinLossArray' => $this->flexWinLossArray,
        );
        return $team;
    }
    public function resetArrays(){
        foreach ($this as $key => $value) {
                $this->$key = array();
        }
    }
    public function cacheContent($teamInfoArrays,$colorArray,$team,$players){
        Cache::put('Players', $players, 70);
        Cache::put('Team1Name', $team[0], 70);
        Cache::put('Team1Info', $teamInfoArrays[0], 70);
        Cache::put('Team1Color', $colorArray[0], 70);
        Cache::put('Team1TimeStamp', Carbon::now(), 70);
        Cache::put('Team2Name', $team[1], 70);
        Cache::put('Team2Info', $teamInfoArrays[1], 70);
        Cache::put('Team2Color', $colorArray[1], 70);
        Cache::put('Team2TimeStamp', Carbon::now(), 70);
    }

    public function getChampions(Request $req){
        $team = $req->team;


        if(Cache::has('Players')){
            try{
            $players = Cache::get('Players');
            $championArray=array();
            $championPlayerId = array();
            $j = 0;
            for($i = 0; $i < count($players[0])-1; $i++){
                $status = $players[$j][$i]->checkCurrentGameStatus();
                if($status){
                    $players[$j][$i]->setChampion();
                    array_push($championArray[$j], $players[$j][$i]->getChampion());
                    array_push($championPlayerId[$j], $i);
                }
                if($i=4 && $j<1){
                    $i = 0;
                    $j++;
                }
            }
            if($championArray[0] != []){
                Cache::put('Team1Champions', $championArray[0], 70);
            }if($championArray[1] != []){
                Cache::put('Team2Champions', $championArray[1], 70);
            }
            if($championArray[0] != [] || $championArray[1] != []){
                return array('Champions' => $championArray, 'ChampionsPlayersId'=>$championPlayerId, 'ErrorCode' => 'false');
            }
            else{
                return array('ErrorCode' => 'true', 'ErrorMessage' => 'Champions are not ready.');
            }
            }catch(Exception $e){
                return array('ErrorCode' => 'true', 'ErrorMessage' => $e->getMessage());
            }

        }
        else{
            return array('ErrorCode' => 'true', 'ErrorMessage' => 'The cache is not available. Please Select a team and a color before getting champions.');
        }
    }
}