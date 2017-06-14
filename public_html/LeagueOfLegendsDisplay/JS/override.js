/**
 * Created by Roman on 6/8/17.
 */
/* This is used to fill in the champions manually if the request cannot be fulfilled*/
function findChampion() {
    championArray = [];
    if(document.getElementById("player1").value !== '' && document.getElementById("player2").value !== '' && document.getElementById("player3").value !== ''&& document.getElementById("player4").value !== '' && document.getElementById("player5").value !== ''){
        championArray.push('http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + document.getElementById("player1").value + '_0.jpg');
        championArray.push('http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + document.getElementById("player2").value + '_0.jpg');
        championArray.push('http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + document.getElementById("player3").value + '_0.jpg');
        championArray.push('http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + document.getElementById("player4").value + '_0.jpg');
        championArray.push('http://ddragon.leagueoflegends.com/cdn/img/champion/loading/' + document.getElementById("player5").value + '_0.jpg');
        $.ajax({
            method: "GET",
            type: "GET",
            url: "/app/GameDisplay/champions",
            data: {
                '_token': "{{ csrf_token() }}",
                championArray: championArray,
                team: $('#Team option:selected').text(),
            },
        });
        document.getElementById("info").innerHTML='<h3>'+ $('#Team option:selected').text() + ' Champions Updated</h3>';
    }else{
        document.getElementById("info").innerHTML='<h3>All Fields Must Be Filled</h3>';
    }
}