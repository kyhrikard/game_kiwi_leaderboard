<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
<link rel="shortcut icon" href="images/favicon.ico" />
<title>NEST:R Leaderboard</title>
</head>
<body>

<header>
<h1>NEST:R leaderboard</h1>
<p>0 lines of JavaScript was used building this page</p>
<p>only PHP, which we don't know shit about</p>
<h4><a target="_blank" href="https://nestr.surge.sh">Get your name on the leaderboard here!</a></h4>
<img src="images/black_kiwi.png" width="50">
<!-- <p>
<a target="_blank" href="https://nestr.surge.sh">https://nestr.surge.sh</a>
</p> -->
</header>

<?php

$url = 'https://nestr-dev-backend.herokuapp.com/api/currentteamscore';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
$teamStandings = json_decode($data);

$url = 'https://nestr-dev-backend.herokuapp.com/api/topplayers';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
$topPlayers = json_decode($data);

$url = 'https://nestr-dev-backend.herokuapp.com/api/snatchhistory';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
$snatchHistory = json_decode($data);

?>
<div class="score-div">
<?php
foreach ($teamStandings as $value){
    echo "<h1>";
    echo "$value->name: ";
    echo "$value->currentscore";
    echo "</h1>";
}
?>
</div>
<main>
<!-- <div class="nestr-table">
<h2>Team Standings</h2>
<table>
<th>Team</th>
<th>Score</th>
<?php
foreach ($teamStandings as $value){
    echo "<tr>";
    echo "<td>";
    echo "$value->name";
    echo "</td>";
    echo "<td>";
    echo "$value->currentscore";
    echo "</td>";     
    echo "</tr>";
}
?>
</table>
</div> -->

<div class="nestr-table">
<h2>Top 100 Snatchers</h2>
<table>
<th>Rank</th>
<th>Snatcher</th>
<th>Snatches</th>
<th>Team</th>
<?php
$topTen = array_slice($topPlayers, 0, 100); 
$rank = 1;
foreach ($topTen as $value){
    echo "<tr>";
    echo "<td>";
    echo $rank++;
    echo "</td>";
    echo "<td>";
    echo "$value->username";
    echo "</td>";
    echo "<td>";
    echo "$value->totalneststaken";
    echo "</td>";
    echo "<td>";
    echo "$value->team";
    echo "</td>";       
    echo "</tr>";
}
?>
</table>
</div>

<div class="nestr-table">
<h2>100 latest snatches</h2>
<table>
<th>Nest</th>
<th>Snatcher</th>
<th>When</th>
<?php
$topTen = array_slice($snatchHistory, 0, 100);
foreach ($topTen as $value){
    echo "<tr>";
    echo "<td>";
    echo "$value->nestname";
    echo "</td>";
    echo "<td>";
    echo "$value->username";
    echo "</td>";
    echo "<td>";
    echo date('Y-m-d , H:i',strtotime("$value->timestamp"));
    echo "</td>";
}
?>
</table>
</div>
<main>

</body>
</html>