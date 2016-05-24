
@extends('game.base')

@section('css')
    .deletingForms{
    display:inline-block;
    }
@endsection
@section('content')
    @if(isset($games) || $games != [])
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($cont_updated) and  $cont_updated)
            <div class="alert alert-success"><strong>Success!</strong> You have updated this Tournament.</div>
        @endif
        @if(isset($theTournament->name))
            {{ Form::open(array('id' => "tournamentForm", 'action' => array('Backend\Manage\TournamentsController@update', $theTournament->id))) }}
        @else
            {{  Form::open(array('id' => "tournamentForm", 'action' => array('Backend\Manage\TournamentsController@create'))) }}
        @endif

        <div class="form-group">
            @if(isset($theTournament->name))
                <input name="_method" type="hidden" value="PUT">
            @else
                <input name="_method" type="hidden" value="POST">
            @endif
            <div class="form-group">
                <label for="name">Tournament Name: </label> &nbsp; <input type="text" name="name" id="name" placeholder="The name of the tournament" @if(isset($theTournament->name))value="{{$theTournament->name}}"@endif/>
            </div>
            <div class="form-group">
                <label for="game_id">Tournament Game ID: </label> &nbsp;
                <select type="text" name="game_id" id="game_id" >
                    @foreach($games as $key => $game)

                        <option value="{{$game['id']}}"
                                @if(isset($theTournament['game_id']) and $theTournament['game_id'] == $game['id']) selected @endif
                        >{{ $game['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" class='btn btn-default' value="Save">
                {{ Html::link('/manage/tournament/', 'Clear', array('id' => 'reset', 'class' => 'btn btn-default'))}}
            </div>
        </div>
        </form>
        <ul id="listOfTournaments" class="listing">
            @if(!isset($tournaments) || $tournaments == [])
                <li>There are no Tournaments yet</li>
            @else
                @foreach($tournaments as $id => $tournament)
                    <li>
                        {{ Html::linkAction('Backend\Manage\TournamentsController@index', $tournament["name"], array('class' => 'btn btn-default list')) }}
                        &nbsp;&nbsp;
                        {{ Html::linkAction('Backend\Manage\TournamentsController@edit', 'Edit', array('tournament_id'=>$tournament["id"]), array('class' => 'btn btn-success list fa fa-pencil-square-o')) }}
                        &nbsp;&nbsp;
                        {{ Form::open(array('id' => "tournamentForm".$tournament["id"], 'action' => array('Backend\Manage\TournamentsController@destroy', $tournament["id"]), 'class' => "deletingForms")) }}
                        <input name="_method" type="hidden" value="DELETE">
                        {!!
                            Form::submit(
                                'Delete',
                                array('class'=>'btn btn-danger list fa fa-times')
                            )
                        !!}
                        {{ Form::close() }}
                    </li>
                @endforeach
            @endif
        </ul>
    @else
        <h1>Sorry, no games where found on the database!, please create a game before proceding with a tournament</h1>
        {{ Html::link('/manage/game/', 'Create a Game', array('id' => 'new_game', 'class' => 'btn btn-default'))}}
    @endif

@endsection
@section('js')
    $(document).ready(function() {
        $('.fa-times').click(function() {
            var conf = confirm('Are you sure?');
            if (conf) {
                var url = $(this).attr('href');
                $(document).load(url);
            }else{
                return false;
            }
        });
    });
@endsection