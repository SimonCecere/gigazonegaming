
{{--*/
    $teamNum = -1;
/*--}}
@foreach($play as $id => $player)
@if(!isset($teamNum) or $teamNum !=  $player["team_id"])
{{--*/
$teamNum = $player["team_id"];
/*--}}
@if( $player["team_name"] == " Doesn't Exist Anymore!!!!!")
    <li><h3 style="color:red!important;">Team without a name, the team must of being deleted</h3></li>
@else
    <li><h3>Team {{$player["team_name"]}}</h3></li>
@endif
@endif
<li> <div class="playerName btn btn-default list disabled" >{{$player["username"]}}</div>
&nbsp;&nbsp;
{{ Html::linkAction('Backend\Manage\PlayersController@edit', '', array('player_id'=>$player["id"]), array('class' => 'btn btn-success list fa fa-pencil-square-o', 'title'=>'Edit')) }}
&nbsp;&nbsp;
{{ Form::open(array('id' => "playerForm".$player["id"], 'action' => array('Backend\Manage\PlayersController@destroy', $player["id"]), 'class' => "deletingForms")) }}
<input name="_method" type="hidden" value="DELETE">
{!!
    Form::submit(
        '&#xf235;',
        array('class'=>'btn btn-danger list fa fa-times', 'title'=>'Delete player from team and move to list of Individual Players')
    )
!!}
{{ Form::close() }}
&nbsp;
{{ Form::open(array('id' => "playerForm".$player["id"], 'action' => array('Backend\Manage\PlayersController@destroy', $player["id"]), 'class' => "deletingForms")) }}
<input name="_method" type="hidden" value="DELETE">
{!!
    Form::submit(
        '&#xf014; &#xf1c0;',
        array('class'=>'btn btn-danger list fa', 'title'=>"Delete From Database Permanently!!!")
    )
!!}
{{ Form::close() }}
&nbsp;&nbsp;
<div class="playerTeam btn @if($player["team_count"] < $player["max_players"])btn-warning @else btn-primary @endif list disabled fa" >&#xf0c0;  {{$player["team_count"]}} / {{$player["max_players"]}}</div>
</li>
@endforeach