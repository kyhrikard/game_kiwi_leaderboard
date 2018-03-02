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

    $url = 'https://nestr-dev-backend.herokuapp.com/api/nests';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $nests = json_decode($data);
?>

<header>
    <h1>NEST:R leaderboard</h1>
    <p>0 lines of JavaScript were used building this page, only PHP, which we know shit about</p>
    <h4><a target="_blank" href="https://nestr.surge.sh">Get your name on the leaderboard here!</a></h4>
</header>

<div class="score-div">
<?php
foreach ($teamStandings as $value) {
    $teamName = $value->name;
    if ($teamName == 'Red') {
        echo "<h1 class='redHeading'>";
        //echo  $teamName . ': ';
        echo $value->currentscore;
        echo "</h1>";
        echo "<a target='_blank' href='https://nestr.surge.sh'>";
        echo "<img src='images/black_kiwi.png' width='50' height='50'>";
        echo "</a>";
    } else {
        echo "<h1 class='blueHeading'>";
        //echo  $teamName . ': ';
        echo $value->currentscore;
        echo "</h1>";
    }
}
?>
</div>

<div class="nests-out-there">
    <h2><?php echo count($nests); ?></h2>
    <p>nests are waiting to get snatched</p>
</div>

<main>

<div class="nestr-table">
    <h2>Top snatchers</h2>
    <table>
        <th>Rank</th>
        <th>Snatcher</th>
        <th>Team</th>
        <th>Snatches</th>
<?php
$topTen = array_slice($topPlayers, 0, 100);
$rank = 1;
foreach ($topTen as $value) {
    echo "<tr>";
    echo "<td>";
    echo $rank++;
    echo "</td>";
    echo "<td>";
    echo "$value->username";
    echo "</td>";
    echo "<td>";
    $teamName = $value->team;
    if ($teamName == 'Red') {
        echo "<img src='images/red_kiwi.png' width='20'>";
    } else {
        echo "<img src='images/blue_kiwi.png' width='20'>";
    }
    echo "</td>";
    echo "<td>";
    echo "$value->totalneststaken";
    echo "</td>";
    echo "</tr>";
}
?>
    </table>
</div>

<div class="nestr-table">
<h2>100 latest snatches</h2>
<table>
<!-- <th>When</th> -->
<th>Snatcher</th>
<th>Nest</th>
<?php
$topTen = array_slice($snatchHistory, 0, 100);
foreach ($topTen as $value) {
    echo "<tr>";
    // echo "<td>";
    // echo date('Y-m-d', strtotime("$value->timestamp"));
    // echo "<br>";
    // echo date('H:i', strtotime("$value->timestamp"));
    // echo "</td>";
    echo "<td>";
    echo "$value->username";
    echo "</td>";
    echo "<td>";
    echo "$value->nestname";
    echo "</td>";
    echo "</tr>";
}
?>
</table>
</div>
</main>

</body>
</html>