<!doctype html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/app/content/css/startPage.css">
    <Title>Tournament</Title>
    <meta content="true" name="Testing">
</head>
<body>
<div class="startForm" id="root">
        <select class="tournamentSelect" id="Tournament" onchange="showTeams(),showTeams2()">
            <option id="defaultTournament"  value="default">Select a Tournament</option>
            <option v-for="tournament in tournaments" v-bind:value="tournament.id">@{{tournament['name']}}</option>
        </select><br/>
        <label id="label1" for="Team">Team 1:</label><label id="label2" for="Team-1">Team 2:</label><br/>
        <select id="Team">
            <option id="defaultTeam" value="default">Select a Team</option>
            <option  v-for="team in teams" v-model="selected" v-bind:t_id="team.tournament_id" v-bind:value="team.id">@{{team['name']}}</option>
        </select>

        <select id="Team-1">
            <option id="defaultTeam-1" value="default">Select a Team</option>
            <option  v-for="team in teams" v-model="selected" v-bind:t_id="team.tournament_id" v-bind:value="team.id">@{{team['name']}}</option>
        </select><br/>
        <select id="Color">
            <option id="defaultColor" value="default">Select a Color</option>
            <option  v-for="color in colors" v-model="selected">@{{ color }}</option>
        </select>
        <select id="Color-1">
            <option id="defaultColor-1" value="default">Select a Color</option>
            <option  v-for="color in colors" v-model="selected">@{{ color }}</option>
        </select><br/>
        <button class="startButton startButtonDisabled" id="submit" disabled onclick="submitCache();">Submit</button>
        <div id="loader" class="hidden"></div>
    <div id="buttonContainer">
        <div class="button-Sub-Container"><button id="championOverride" onclick="window.open('/app/GameDisplay/override')">Champion Override</button></div>
        <div class="button-Sub-Container"><button id="getChampions" onclick="getChampions();">Get Champions</button></div>
        <div class="button-Sub-Container"><button id="clearCache" onclick="clearCache();">Clear Cache</button></div>
    </div>
</div>
<div class="startFooter">
    <svg style="max-height: 600px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 589.67 292.94"><defs><style>.a{fill:#fff;}.b{fill:#fbb041;}.c{fill:#58595b;}.d{fill:#fbb042;}</style></defs><title>gigazone-gaming-championship-X-on-dark</title><path class="a" d="M235,168.08h17.41v.37c0,4.26-1.52,10.73-5.42,14.78S238.67,188,234.51,188s-8.73-.68-12.83-4.89a20,20,0,0,1-.11-26.66c4.31-4.47,9.62-5.1,13.78-5.1a17.68,17.68,0,0,1,9.83,2.63,19.4,19.4,0,0,1,5.68,6.26l-7.31,3.94a10.62,10.62,0,0,0-3.1-3.79,8.8,8.8,0,0,0-5.36-1.68,9.49,9.49,0,0,0-7.26,2.84,12,12,0,0,0-3,8.31,11,11,0,0,0,2.94,8,9.22,9.22,0,0,0,7.1,2.73,9,9,0,0,0,6.1-1.89,8.19,8.19,0,0,0,2.52-4.15H235Z" transform="translate(0 0)"/><path class="a" d="M274.07,180.6H260.81l-2.68,6.63h-8.41l14.15-35.08h7.41l13.83,35.08H276.7Zm-2.21-6.2-4.31-11.78-4.36,11.78Z" transform="translate(0 0)"/><path class="a" d="M283.49,187.22l5.63-35.08h6.73l8.73,21,8.73-21H320l5.63,35.08h-8.1l-2.79-20.93L306,187.22h-2.84l-8.78-20.93-2.79,20.93Z" transform="translate(0 0)"/><path class="a" d="M336,152.15v35.08h-8.1V152.15Z" transform="translate(0 0)"/><path class="a" d="M339.93,187.22V152.15h7l19,22.61V152.15h8.1v35.08h-7l-19-22.72v22.72Z" transform="translate(0 0)"/><path class="a" d="M394.73,168.08h17.4v.37c0,4.26-1.52,10.73-5.42,14.78S398.36,188,394.2,188s-8.73-.68-12.83-4.89a20,20,0,0,1-.1-26.66c4.31-4.47,9.62-5.1,13.78-5.1a17.67,17.67,0,0,1,9.83,2.63,19.39,19.39,0,0,1,5.68,6.26l-7.31,3.94a10.62,10.62,0,0,0-3.1-3.79,8.8,8.8,0,0,0-5.36-1.68,9.49,9.49,0,0,0-7.26,2.84,12,12,0,0,0-3,8.31,11,11,0,0,0,2.94,8,9.22,9.22,0,0,0,7.1,2.73,9,9,0,0,0,6.1-1.89,8.2,8.2,0,0,0,2.52-4.15h-8.47Z" transform="translate(0 0)"/><path class="a" d="M268,231.33a16.31,16.31,0,0,1-7.73,1.89c-6.47,0-10.83-2.21-13.78-5.1a18.79,18.79,0,0,1,0-26.5,18.62,18.62,0,0,1,13.09-5,20.89,20.89,0,0,1,8.41,1.95v9.36a11.12,11.12,0,0,0-8.2-3.73,9.84,9.84,0,0,0-7.15,2.74,11.23,11.23,0,0,0-3.31,8.1,10.26,10.26,0,0,0,10.62,10.68c2.1,0,4.94-.58,8-3.63Z" transform="translate(0 0)"/><path class="a" d="M278.6,210.71h14V197.36h8.1v35.08h-8.1V217.55h-14v14.88h-8.1V197.36h8.1Z" transform="translate(0 0)"/><path class="a" d="M325,225.81H311.79l-2.68,6.63H300.7l14.15-35.08h7.41l13.83,35.08h-8.41Zm-2.21-6.21-4.31-11.78-4.36,11.78Z" transform="translate(0 0)"/><path class="a" d="M334.47,232.43l5.63-35.08h6.73l8.73,21,8.73-21H371l5.63,35.08h-8.1l-2.79-20.93L357,232.43h-2.84l-8.78-20.93-2.79,20.93Z" transform="translate(0 0)"/><path class="a" d="M391.11,197.36c3.05,0,6.42.42,9.2,2.89a10.79,10.79,0,0,1,3.42,8.52,11.28,11.28,0,0,1-3,8.26c-2.79,2.84-6.47,3.1-8.94,3.1h-4.94v12.31h-8.1V197.36Zm-4.26,16.14h2.89a6.2,6.2,0,0,0,4.36-1.31,4.88,4.88,0,0,0,1.32-3.47,4.63,4.63,0,0,0-1.32-3.42,6.31,6.31,0,0,0-4.52-1.31h-2.73Z" transform="translate(0 0)"/><path class="a" d="M413.15,197.36v35.08h-8.1V197.36Z" transform="translate(0 0)"/><path class="a" d="M448.12,201.67a18.66,18.66,0,0,1,0,26.4,18.73,18.73,0,0,1-13.57,5.15,19.31,19.31,0,0,1-13.67-5.15,17.91,17.91,0,0,1-5.47-13,19.58,19.58,0,0,1,5.42-13.3c2.37-2.37,6.73-5.15,13.73-5.15C440,196.57,444.6,198.25,448.12,201.67ZM426.83,207a10.74,10.74,0,0,0-3.1,7.94,10.47,10.47,0,0,0,3.21,7.89,10.31,10.31,0,0,0,7.52,2.89,10.62,10.62,0,0,0,7.78-3,10.51,10.51,0,0,0,3-7.84,11.05,11.05,0,0,0-3-7.89,11.25,11.25,0,0,0-7.73-3A10.76,10.76,0,0,0,426.83,207Z" transform="translate(0 0)"/><path class="a" d="M455.71,232.43V197.36h7l19,22.61V197.36h8.1v35.08h-7l-19-22.72v22.72Z" transform="translate(0 0)"/><path class="a" d="M511.72,205.93a8.54,8.54,0,0,0-5.89-2.52,4.38,4.38,0,0,0-3.42,1.21,3.13,3.13,0,0,0-.89,2.21,2.46,2.46,0,0,0,.79,1.95c.84.79,2.05,1.11,4.42,2l2.63,1a14.07,14.07,0,0,1,4.79,2.68,8.75,8.75,0,0,1,2.58,6.52,12.57,12.57,0,0,1-3.1,8.68c-3.1,3.26-7.62,3.58-9.94,3.58a14.87,14.87,0,0,1-6.94-1.47,22.31,22.31,0,0,1-5.15-3.84l4.21-5.79a21.41,21.41,0,0,0,3.26,2.68,8.14,8.14,0,0,0,4.42,1.26,5.6,5.6,0,0,0,3.68-1.21,3.63,3.63,0,0,0,1.26-2.84,3.09,3.09,0,0,0-1.21-2.52,17.1,17.1,0,0,0-4.1-1.95l-2.89-1a11.82,11.82,0,0,1-4.89-2.79,8.62,8.62,0,0,1-2.1-6.1,10.78,10.78,0,0,1,3-7.89c2.47-2.52,5.42-3.21,8.68-3.21A17,17,0,0,1,515.35,200Z" transform="translate(0 0)"/><path class="a" d="M526.71,210.71h14V197.36h8.1v35.08h-8.1V217.55h-14v14.88h-8.1V197.36h8.1Z" transform="translate(0 0)"/><path class="a" d="M560.8,197.36v35.08h-8.1V197.36Z" transform="translate(0 0)"/><path class="a" d="M577,197.36c3.05,0,6.42.42,9.2,2.89a10.78,10.78,0,0,1,3.42,8.52,11.28,11.28,0,0,1-3,8.26c-2.79,2.84-6.47,3.1-8.94,3.1h-4.94v12.31h-8.1V197.36Zm-4.26,16.14h2.89a6.21,6.21,0,0,0,4.37-1.31,4.89,4.89,0,0,0,1.31-3.47A4.63,4.63,0,0,0,580,205.3a6.32,6.32,0,0,0-4.52-1.31h-2.74Z" transform="translate(0 0)"/><polygon class="b" points="152 235.81 152.02 235.85 228.78 235.85 190.44 171.3 152 235.81"/><polygon class="b" points="11.47 0 113.51 171.23 113.56 171.3 152 106.59 122.59 57.09 66.9 57.09 61.18 66.7 21.51 0 11.47 0"/><polygon class="c" points="100.89 0 97.2 6.19 127.42 57.09 181.4 57.09 154.4 102.55 166.31 122.62 226.86 20.79 253.45 65.55 292.52 0 100.89 0"/><path class="c" d="M109.44,178.24l-1.84,3.1Z" transform="translate(0 0)"/><polygon class="a" points="66.9 57.09 122.59 57.09 94.78 10.26 66.9 57.09"/><polygon class="a" points="152 106.59 142.04 123.36 113.56 171.3 109.92 177.43 142.01 231.7 145.78 225.37 152 235.81 190.44 171.3 152 106.59"/><path class="c" d="M142,231.7l18.21,30.65L142,292.94H262.69l-33.91-57.09H152l0,0-6.22-10.44ZM0,0,107.59,181.34,41.3,292.94H142L123.8,262.32,142,231.7l-32.09-54.27L4.55,0Z" transform="translate(0 0)"/><path class="a" d="M209.39,123.17v-9h23q0,.44,0,1t0,1.55q0,11.07-5.84,17.18T210.12,140a25.61,25.61,0,0,1-9.27-1.57,20.54,20.54,0,0,1-7.25-4.79,21.64,21.64,0,0,1-4.73-7.28,24.21,24.21,0,0,1,0-17.63,21.7,21.7,0,0,1,12.29-12,24.81,24.81,0,0,1,9-1.61,24.05,24.05,0,0,1,11.14,2.49,21.78,21.78,0,0,1,8.16,7.41l-10.13,4.86a12.33,12.33,0,0,0-4.08-3.7,10.61,10.61,0,0,0-5.08-1.22,10.33,10.33,0,0,0-8.26,3.5q-3,3.5-3,9.56t3,9.64a10.31,10.31,0,0,0,8.26,3.51,12.21,12.21,0,0,0,7.42-2.18,8.35,8.35,0,0,0,3.47-5.81Z" transform="translate(0 0)"/><rect class="a" x="234.73" y="100.56" width="10.57" height="38.4"/><path class="a" d="M267.39,124.82v-8.05H288c0,.26,0,.55,0,.87s0,.78,0,1.39q0,9.91-5.23,15.38T268,139.87a22.92,22.92,0,0,1-8.3-1.4,18.38,18.38,0,0,1-6.49-4.29,19.39,19.39,0,0,1-4.23-6.52,21.69,21.69,0,0,1,0-15.79,19.43,19.43,0,0,1,11-10.74A22.22,22.22,0,0,1,268,99.69a21.53,21.53,0,0,1,10,2.23,19.49,19.49,0,0,1,7.3,6.63l-9.08,4.35a11,11,0,0,0-3.66-3.32,9.48,9.48,0,0,0-4.55-1.09,9.25,9.25,0,0,0-7.4,3.13q-2.7,3.13-2.7,8.56t2.7,8.63A9.23,9.23,0,0,0,268,132a10.94,10.94,0,0,0,6.65-2,7.49,7.49,0,0,0,3.11-5.21Z" transform="translate(0 0)"/><path class="a" d="M298.88,124.61l3.86-12.67q.34-1.18.67-2.47t.67-2.7l.81,3.3q.32,1.29.5,1.86l3.91,12.67Zm11.7-24H297.47L284.22,139h10.41l2-6.87H311.5l1.94,6.87h2.4l5.21-8.09Z" transform="translate(0 0)"/><polygon class="c" points="321.05 130.86 315.84 138.95 323.85 138.95 321.05 130.86"/><path class="d" d="M402.49,119.17q0-1.13-.13-2.48-.14-1.86-.46-4.27,1.13,2.47,2.08,4.29a21.79,21.79,0,0,0,1.4,2.43l0,0h10.75l-13.67-18.61h-10.1v18.61Z" transform="translate(0 0)"/><rect class="d" x="419.89" y="100.56" width="10.04" height="18.61"/><rect class="d" x="392.41" y="120.47" width="10.1" height="18.48"/><path class="d" d="M419.91,120.47c0,.72.06,1.5.13,2.35q.14,1.86.46,4.25-1.15-2.52-2.11-4.34-.84-1.61-1.27-2.26H406.37L419.89,139h10V120.47Z" transform="translate(0 0)"/><polygon class="d" points="444.17 123.87 456.73 123.87 456.73 120.47 433.96 120.47 433.96 138.95 457.49 138.95 457.49 130.35 444.17 130.35 444.17 123.87"/><polygon class="d" points="433.96 100.56 433.96 119.17 456.73 119.17 456.73 115.64 444.17 115.64 444.17 108.98 457.49 108.98 457.49 100.56 433.96 100.56"/><path class="d" d="M379.92,120.49a11.5,11.5,0,0,1-2.82,7.43,9.14,9.14,0,0,1-6.57,3.18V140a20.66,20.66,0,0,0,7.21-1.52,20.94,20.94,0,0,0,6.71-4.37,19.43,19.43,0,0,0,5.94-13.59Z" transform="translate(0 0)"/><path class="d" d="M377.06,111.78a11.45,11.45,0,0,1,2.86,7.4H390.4a19.59,19.59,0,0,0-5.94-13.59,20.29,20.29,0,0,0-6.68-4.37,20.76,20.76,0,0,0-7.25-1.52v8.87a9.19,9.19,0,0,1,6.53,3.21" transform="translate(0 0)"/><polygon class="d" points="328.58 119.18 341.32 119.18 353.17 100.78 317.09 100.78 317.09 110.06 334.45 110.06 328.58 119.18"/><polygon class="d" points="340.48 120.49 327.74 120.49 321.05 130.86 323.85 138.95 315.84 138.95 312.81 143.66 350.71 143.66 350.71 134.31 331.58 134.31 340.48 120.49"/><path class="d" d="M362.67,127.94a11.55,11.55,0,0,1-2.78-7.45h-10.5a19.37,19.37,0,0,0,6,13.59,20.09,20.09,0,0,0,6.62,4.37,20.67,20.67,0,0,0,7.21,1.52v-8.87a9.11,9.11,0,0,1-6.56-3.15" transform="translate(0 0)"/><path class="d" d="M362,101.23a20.05,20.05,0,0,0-6.62,4.37,19.32,19.32,0,0,0-6,13.59h10.5a11.53,11.53,0,0,1,2.82-7.41,9.14,9.14,0,0,1,6.52-3.19V99.71a20.59,20.59,0,0,0-7.21,1.52" transform="translate(0 0)"/><path class="d" d="M462.43,103.63h.33c.38,0,.69-.13.69-.44s-.2-.45-.64-.45a1.69,1.69,0,0,0-.38,0Zm0,1.69h-.69v-3a5.94,5.94,0,0,1,1.14-.09,1.86,1.86,0,0,1,1,.22.83.83,0,0,1,.29.65.76.76,0,0,1-.62.69v0a.88.88,0,0,1,.54.72,2.26,2.26,0,0,0,.22.75h-.74a2.53,2.53,0,0,1-.24-.73c-.06-.33-.24-.47-.62-.47h-.33Zm-1.83-1.56a2.31,2.31,0,0,0,2.32,2.38,2.28,2.28,0,0,0,2.27-2.36,2.3,2.3,0,1,0-4.59,0m5.36,0a3.06,3.06,0,1,1-3.05-3,3,3,0,0,1,3.05,3" transform="translate(0 0)"/></svg>
</div>
<div id="info">
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
<div id="hiddenToken" class="hidden">{{ csrf_field() }}</div>
<script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script type="text/javascript">
    new Vue({
        el: '#root',
        data: {
            selected:'',
            tournaments: {!!$tournaments!!},
            teams: {!!$teams!!},
            colors: ["Blue","Red"],
        }
    });
</script>
<script src="/LeagueOfLegendsDisplay/JS/admin.js"></script>
</body>
</html>