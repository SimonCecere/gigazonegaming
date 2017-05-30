<!doctype html>
<html lang="{{ config('app.locale')}}" style="@yield('Color')">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href='/LeagueOfLegendsDisplay/CSS/teamDisplay.css'/>
    <Title>Tournament</Title>
</head>
<body>
<div class="mainDiv" id="other">
    <h1 id="teamName">@yield('TeamName')</h1>

    <div class='col-lg'>
        <div><div class="playerNameContainer"><b class="summonerName">@yield('Player0Name')</b>@yield('Player0Icon')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Solo:<br/> </b><b>Win/Loss:</b> @yield('Player0SoloWinLoss') <b>Rank:</b> @yield('Player0SoloRank')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Flex:<br/> </b><b>Win/Loss:</b> @yield('Player0FlexWinLoss') <b>Rank:</b> @yield('Player0FlexRank')</div></div>
        <div>@yield('Player0Champion')<div style="display:none;" id="divB0" class="imageContainer"><img class="championImage" src="http://vignette4.wikia.nocookie.net/leagueoflegends/images/2/25/Azir_OriginalLoading.jpg/revision/latest?cb=20160516004231"/></div></div>
    </div>
    <div class='col-lg'>
        <div><div class="playerNameContainer"><b class="summonerName">@yield('Player1Name')</b>@yield('Player1Icon')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Solo:<br/> </b><b>Win/Loss:</b> @yield('Player1SoloWinLoss') <b>Rank:</b> @yield('Player1SoloRank')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Flex:<br/> </b><b>Win/Loss:</b> @yield('Player1FlexWinLoss') <b>Rank:</b> @yield('Player1FlexRank')</div></div>
        <div>@yield('Player1Champion')<div style="display:none;" id="divB1" class="imageContainer"><img class="championImage" src="http://vignette4.wikia.nocookie.net/leagueoflegends/images/2/25/Azir_OriginalLoading.jpg/revision/latest?cb=20160516004231"/></div></div>
    </div>
    <div class='col-lg'>
        <div><div class="playerNameContainer"><b class="summonerName">@yield('Player2Name')</b>@yield('Player2Icon')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Solo:<br/> </b><b>Win/Loss:</b> @yield('Player2SoloWinLoss') <b>Rank:</b> @yield('Player2SoloRank')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Flex:<br/> </b><b>Win/Loss:</b> @yield('Player2FlexWinLoss') <b>Rank:</b> @yield('Player2FlexRank')</div></div>
        <div>@yield('Player2Champion')<div style="display:none;" id="divB2" class="imageContainer"><img class="championImage" src="http://vignette4.wikia.nocookie.net/leagueoflegends/images/2/25/Azir_OriginalLoading.jpg/revision/latest?cb=20160516004231"/></div></div>
    </div>
    <div class='col-lg'>
        <div><div class="playerNameContainer"><b class="summonerName">@yield('Player3Name')</b>@yield('Player3Icon')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Solo:<br/> </b><b>Win/Loss:</b> @yield('Player3SoloWinLoss') <b>Rank:</b> @yield('Player3SoloRank')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Flex:<br/> </b><b>Win/Loss:</b> @yield('Player3FlexWinLoss') <b>Rank:</b> @yield('Player3FlexRank')</div></div>
        <div>@yield('Player3Champion')<div style="display:none;" id="divB3" class="imageContainer"><img class="championImage" src="http://vignette4.wikia.nocookie.net/leagueoflegends/images/2/25/Azir_OriginalLoading.jpg/revision/latest?cb=20160516004231"/></div></div>
    </div>
    <div class='col-lg'>
        <div><div class="playerNameContainer"><b class="summonerName">@yield('Player4Name')</b>@yield('Player4Icon')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Solo:<br/> </b><b>Win/Loss:</b> @yield('Player4SoloWinLoss') <b>Rank:</b> @yield('Player4SoloRank')</div></div>
        <div><div class="playerInfo playerNameContainer"><b>Flex:<br/> </b><b>Win/Loss:</b> @yield('Player4FlexWinLoss') <b>Rank:</b> @yield('Player4FlexRank')</div></div>
        <div>@yield('Player4Champion')<div style="display:none;" id="divB4" class="imageContainer"><img class="championImage" src="http://vignette4.wikia.nocookie.net/leagueoflegends/images/2/25/Azir_OriginalLoading.jpg/revision/latest?cb=20160516004231"/></div></div>
    </div>
</div>
<div>
    <p id="something"></p>
</div>

    <footer class="teamFooter">
        <svg class="giga_teamImage" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 637.77 151.93"><defs><style>.a{fill:#fff;}.b{fill:#fbb042;}.c{fill:#58595b;}</style></defs><title>gigazone-gaming-championship-X-wide-on-dark</title><path class="a" d="M146.43,115h15.77v.33c0,3.86-1.38,9.72-4.91,13.38S149.71,133,145.95,133s-7.91-.62-11.62-4.43a18.09,18.09,0,0,1-.1-24.15c3.91-4,8.72-4.62,12.48-4.62a16,16,0,0,1,8.91,2.38,17.57,17.57,0,0,1,5.14,5.67l-6.62,3.57a9.62,9.62,0,0,0-2.81-3.43,8,8,0,0,0-4.86-1.52,8.6,8.6,0,0,0-6.57,2.57,10.88,10.88,0,0,0-2.71,7.53,10,10,0,0,0,2.67,7.29,8.35,8.35,0,0,0,6.43,2.48,8.14,8.14,0,0,0,5.53-1.71,7.42,7.42,0,0,0,2.29-3.76h-7.67Z" transform="translate(0 0)"/><path class="a" d="M181.78,126.31h-12l-2.43,6h-7.62l12.81-31.77h6.72l12.53,31.77h-7.62Zm-2-5.62L175.87,110l-4,10.67Z" transform="translate(0 0)"/><path class="a" d="M190.31,132.31l5.1-31.77h6.1l7.91,19,7.91-19h6.1l5.1,31.77h-7.34l-2.52-19-8,19h-2.57l-8-19-2.52,19Z" transform="translate(0 0)"/><path class="a" d="M237.9,100.54v31.77h-7.33V100.54Z" transform="translate(0 0)"/><path class="a" d="M241.43,132.31V100.54h6.38L265.06,121V100.54h7.34v31.77H266l-17.24-20.58v20.58Z" transform="translate(0 0)"/><path class="a" d="M291.08,115h15.77v.33c0,3.86-1.38,9.72-4.91,13.38S294.36,133,290.6,133s-7.91-.62-11.62-4.43a18.09,18.09,0,0,1-.09-24.15c3.91-4,8.72-4.62,12.48-4.62a16,16,0,0,1,8.91,2.38,17.57,17.57,0,0,1,5.14,5.67l-6.62,3.57A9.62,9.62,0,0,0,296,108a8,8,0,0,0-4.86-1.52,8.59,8.59,0,0,0-6.57,2.57,10.88,10.88,0,0,0-2.71,7.53,10,10,0,0,0,2.67,7.29,8.35,8.35,0,0,0,6.43,2.48,8.14,8.14,0,0,0,5.53-1.71,7.43,7.43,0,0,0,2.29-3.76h-7.67Z" transform="translate(0 0)"/><path class="a" d="M346.38,131.31a14.77,14.77,0,0,1-7,1.71c-5.86,0-9.81-2-12.48-4.62a17,17,0,0,1,0-24,16.87,16.87,0,0,1,11.86-4.57,18.92,18.92,0,0,1,7.62,1.76v8.48a10.07,10.07,0,0,0-7.43-3.38,8.91,8.91,0,0,0-6.48,2.48,10.17,10.17,0,0,0-3,7.33,9.29,9.29,0,0,0,9.62,9.67,10,10,0,0,0,7.29-3.29Z" transform="translate(0 0)"/><path class="a" d="M356,112.64h12.67v-12.1H376v31.77h-7.34V118.83H356v13.48h-7.34V100.54H356Z" transform="translate(0 0)"/><path class="a" d="M398.07,126.31h-12l-2.43,6H376l12.81-31.77h6.72l12.53,31.77h-7.62Zm-2-5.62L392.17,110l-4,10.67Z" transform="translate(0 0)"/><path class="a" d="M406.61,132.31l5.1-31.77h6.1l7.91,19,7.91-19h6.1l5.1,31.77h-7.33l-2.53-19-8,19h-2.57l-8-19-2.52,19Z" transform="translate(0 0)"/><path class="a" d="M457.92,100.54c2.76,0,5.81.38,8.34,2.62a9.77,9.77,0,0,1,3.1,7.72,10.22,10.22,0,0,1-2.71,7.48c-2.52,2.57-5.86,2.81-8.1,2.81h-4.48v11.15h-7.34V100.54Zm-3.86,14.62h2.62a5.62,5.62,0,0,0,4-1.19,4.42,4.42,0,0,0,1.19-3.14,4.19,4.19,0,0,0-1.19-3.1,5.72,5.72,0,0,0-4.1-1.19h-2.48Z" transform="translate(0 0)"/><path class="a" d="M477.88,100.54v31.77h-7.33V100.54Z" transform="translate(0 0)"/><path class="a" d="M509.56,104.44a16.9,16.9,0,0,1,0,23.91A17,17,0,0,1,497.27,133a17.49,17.49,0,0,1-12.39-4.67,16.22,16.22,0,0,1-5-11.81,17.74,17.74,0,0,1,4.91-12.05c2.14-2.14,6.1-4.67,12.43-4.67A17,17,0,0,1,509.56,104.44Zm-19.29,4.86a9.73,9.73,0,0,0-2.81,7.19,9.48,9.48,0,0,0,2.91,7.15,9.34,9.34,0,0,0,6.81,2.62,9.62,9.62,0,0,0,7-2.71,9.52,9.52,0,0,0,2.76-7.1,10,10,0,0,0-2.76-7.15,10.19,10.19,0,0,0-7-2.71A9.75,9.75,0,0,0,490.27,109.3Z" transform="translate(0 0)"/><path class="a" d="M516.43,132.31V100.54h6.38L540.05,121V100.54h7.33v31.77H541l-17.24-20.58v20.58Z" transform="translate(0 0)"/><path class="a" d="M567.16,108.3a7.74,7.74,0,0,0-5.33-2.29,4,4,0,0,0-3.1,1.1,2.83,2.83,0,0,0-.81,2,2.23,2.23,0,0,0,.71,1.76c.76.71,1.86,1,4,1.81l2.38.91a12.75,12.75,0,0,1,4.34,2.43,7.93,7.93,0,0,1,2.33,5.91,11.38,11.38,0,0,1-2.81,7.86c-2.81,3-6.91,3.24-9,3.24a13.47,13.47,0,0,1-6.29-1.33,20.21,20.21,0,0,1-4.67-3.48l3.81-5.24a19.39,19.39,0,0,0,3,2.43,7.37,7.37,0,0,0,4,1.14,5.07,5.07,0,0,0,3.33-1.1,3.28,3.28,0,0,0,1.14-2.57,2.8,2.8,0,0,0-1.1-2.29,15.49,15.49,0,0,0-3.72-1.76l-2.62-.9a10.71,10.71,0,0,1-4.43-2.53,7.8,7.8,0,0,1-1.91-5.53,9.76,9.76,0,0,1,2.76-7.14c2.24-2.29,4.91-2.91,7.86-2.91a15.35,15.35,0,0,1,9.43,3.14Z" transform="translate(0 0)"/><path class="a" d="M580.74,112.64h12.67v-12.1h7.34v31.77h-7.34V118.83H580.74v13.48h-7.33V100.54h7.33Z" transform="translate(0 0)"/><path class="a" d="M611.62,100.54v31.77h-7.33V100.54Z" transform="translate(0 0)"/><path class="a" d="M626.34,100.54c2.76,0,5.81.38,8.34,2.62a9.76,9.76,0,0,1,3.1,7.72,10.22,10.22,0,0,1-2.71,7.48c-2.52,2.57-5.86,2.81-8.1,2.81h-4.48v11.15h-7.33V100.54Zm-3.86,14.62h2.62a5.62,5.62,0,0,0,4-1.19,4.43,4.43,0,0,0,1.19-3.14,4.19,4.19,0,0,0-1.19-3.1,5.72,5.72,0,0,0-4.1-1.19h-2.48Z" transform="translate(0 0)"/><polygon class="b" points="78.83 122.31 78.84 122.32 118.66 122.32 98.77 88.85 78.83 122.31"/><polygon class="b" points="5.95 0 58.87 88.81 58.9 88.85 78.83 55.28 63.58 29.61 34.7 29.61 31.73 34.6 11.16 0 5.95 0"/><polygon class="c" points="52.33 0 50.41 3.21 66.09 29.61 94.08 29.61 80.08 53.19 86.26 63.6 117.66 10.78 131.46 34 151.72 0 52.33 0"/><path class="c" d="M56.76,92.44l-1,1.61Z" transform="translate(0 0)"/><polygon class="a" points="34.7 29.61 63.58 29.61 49.16 5.32 34.7 29.61"/><polygon class="a" points="78.83 55.29 73.67 63.98 58.9 88.85 57.01 92.03 73.65 120.17 75.61 116.89 78.83 122.31 98.77 88.85 78.83 55.29"/><path class="c" d="M73.65,120.18l9.44,15.9-9.44,15.86h62.59l-17.59-29.61H78.82v0l-3.23-5.41ZM0,0,55.8,94.05,21.42,151.93H73.65l-9.44-15.88,9.44-15.88L57,92,2.36,0Z" transform="translate(0 0)"/><path class="a" d="M123.17,70.35V62.21H144c0,.26,0,.56,0,.87s0,.79,0,1.41q0,10-5.29,15.56t-14.89,5.53a23.18,23.18,0,0,1-8.39-1.42,18.6,18.6,0,0,1-6.56-4.34,19.59,19.59,0,0,1-4.28-6.59,21.22,21.22,0,0,1-1.52-8,21,21,0,0,1,1.48-8A19.65,19.65,0,0,1,115.67,46.4a22.46,22.46,0,0,1,8.16-1.46,21.78,21.78,0,0,1,10.09,2.25,19.72,19.72,0,0,1,7.39,6.71l-9.18,4.4a11.15,11.15,0,0,0-3.7-3.35,9.6,9.6,0,0,0-4.6-1.1A9.36,9.36,0,0,0,116.35,57q-2.73,3.17-2.73,8.66t2.73,8.73a9.34,9.34,0,0,0,7.48,3.18,11.06,11.06,0,0,0,6.72-2,7.57,7.57,0,0,0,3.14-5.26Z" transform="translate(0 0)"/><polygon class="a" points="146.11 84.65 146.11 49.88 155.68 49.88 155.68 84.65 146.11 84.65 146.11 84.65"/><path class="a" d="M175.68,71.85V64.56H194.3q0,.36,0,.78t0,1.26q0,9-4.74,13.93t-13.33,5a20.75,20.75,0,0,1-7.52-1.27,16.65,16.65,0,0,1-5.88-3.88,17.58,17.58,0,0,1-3.84-5.9,19.64,19.64,0,0,1,0-14.3,17.59,17.59,0,0,1,10-9.73,20.12,20.12,0,0,1,7.3-1.31,19.5,19.5,0,0,1,9,2,17.65,17.65,0,0,1,6.61,6l-8.22,3.94a10,10,0,0,0-3.31-3,8.59,8.59,0,0,0-4.12-1,8.38,8.38,0,0,0-6.7,2.84,11.48,11.48,0,0,0-2.45,7.75q0,5,2.45,7.81a8.36,8.36,0,0,0,6.7,2.85,9.9,9.9,0,0,0,6-1.77,6.78,6.78,0,0,0,2.82-4.71Z" transform="translate(0 0)"/><path class="a" d="M204.2,71.66l3.49-11.47q.31-1.07.61-2.23t.61-2.45l.74,3q.29,1.16.45,1.69l3.54,11.47Zm10.59-21.78H202.92l-12,34.77h9.43l1.8-6.22h13.47l1.76,6.22h2.18l4.72-7.33-9.48-27.44Z" transform="translate(0 0)"/><polygon class="c" points="224.28 77.32 219.56 84.65 226.81 84.65 224.28 77.32 224.28 77.32"/><path class="b" d="M298,66.73q0-1-.12-2.25-.13-1.69-.42-3.87,1,2.23,1.89,3.88a19.89,19.89,0,0,0,1.27,2.2l0,0h9.74L298,49.88H288.9V66.73Z" transform="translate(0 0)"/><polygon class="b" points="322.88 66.73 322.88 49.88 313.79 49.88 313.79 66.73 322.88 66.73 322.88 66.73"/><polygon class="b" points="288.9 67.91 288.9 84.65 298.04 84.65 298.04 67.91 288.9 67.91 288.9 67.91"/><path class="b" d="M313.8,67.91c0,.65.06,1.36.12,2.13q.13,1.69.42,3.85-1-2.28-1.91-3.93-.76-1.45-1.15-2h-9.73l12.24,16.74h9.1V67.91Z" transform="translate(0 0)"/><polygon class="b" points="335.76 70.99 347.14 70.99 347.14 67.91 326.52 67.91 326.52 84.65 347.83 84.65 347.83 76.86 335.76 76.86 335.76 70.99 335.76 70.99"/><polygon class="b" points="326.52 49.88 326.52 66.73 347.14 66.73 347.14 63.53 335.76 63.53 335.76 57.5 347.83 57.5 347.83 49.88 326.52 49.88 326.52 49.88"/><path class="b" d="M277.59,67.93A10.42,10.42,0,0,1,275,74.65a8.28,8.28,0,0,1-6,2.88v8a18.7,18.7,0,0,0,6.53-1.38,19,19,0,0,0,6.08-4,17.6,17.6,0,0,0,5.38-12.31Z" transform="translate(0 0)"/><path class="b" d="M275,60a10.38,10.38,0,0,1,2.59,6.7h9.48a17.74,17.74,0,0,0-5.38-12.31,18.38,18.38,0,0,0-6-4,18.82,18.82,0,0,0-6.57-1.38v8A8.32,8.32,0,0,1,275,60Z" transform="translate(0 0)"/><polygon class="b" points="231.09 66.75 242.63 66.75 253.36 50.08 220.69 50.08 220.69 58.49 236.41 58.49 231.09 66.75 231.09 66.75"/><polygon class="b" points="241.87 67.92 230.33 67.92 224.28 77.32 226.81 84.65 219.56 84.65 216.81 88.91 251.13 88.91 251.13 80.45 233.81 80.45 241.87 67.92 241.87 67.92"/><path class="b" d="M262,74.67a10.46,10.46,0,0,1-2.52-6.75h-9.51a17.54,17.54,0,0,0,5.45,12.31,18.19,18.19,0,0,0,6,4,18.69,18.69,0,0,0,6.52,1.37v-8A8.25,8.25,0,0,1,262,74.67Z" transform="translate(0 0)"/><path class="b" d="M261.38,50.49a18.17,18.17,0,0,0-6,4,17.49,17.49,0,0,0-5.45,12.31h9.51A10.44,10.44,0,0,1,262,60a8.27,8.27,0,0,1,5.91-2.89v-8a18.67,18.67,0,0,0-6.52,1.38Z" transform="translate(0 0)"/><path class="b" d="M352.3,52.66h.3c.34,0,.62-.12.62-.39s-.18-.41-.58-.41a1.48,1.48,0,0,0-.35,0v.77Zm0,1.53h-.62v-2.7a5.42,5.42,0,0,1,1-.08,1.68,1.68,0,0,1,.94.2.75.75,0,0,1,.26.59.69.69,0,0,1-.56.62v0a.79.79,0,0,1,.49.66,2.05,2.05,0,0,0,.2.67h-.67a2.28,2.28,0,0,1-.21-.66c0-.3-.21-.43-.56-.43h-.3v1.08Zm-1.66-1.41a2.09,2.09,0,0,0,2.1,2.15,2.06,2.06,0,0,0,2.05-2.14,2.08,2.08,0,1,0-4.16,0Zm4.85,0a2.77,2.77,0,1,1-2.76-2.7,2.71,2.71,0,0,1,2.76,2.7Z" transform="translate(0 0)"/></svg>
    </footer>
</body>
<script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src="/LeagueOfLegendsDisplay/JS/teamDisplay.js"></script>
<script type="text/javascript">

    $( document ).ready(function() {
        checkAndGrabChampion(document.getElementById('teamName').value);
        //recursive call to checkAndGrabChampion(team)
    });

    /**
     *
     * need to grab tournament to grab the wright serialized data
     */
    function checkAndGrabChampion(team){

        $.ajax({
            method: "POST",
            url: "championApiController.php",
            data: {team:team}
        })
            .done(function (data) {
                document.getElementById('something').value = data->team;
            });
    }
</script>

</html>