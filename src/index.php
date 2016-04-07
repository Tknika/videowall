<?php
/*
 *   It will read today's meetings and events from a JSON file (events.json)
 *   Meetings starting right now (20 min before or after) will be emphasized
 *
 *   Author: xezpeleta@tknika.eus
 */

$string = file_get_contents("events.json");
$events = json_decode($string, true);
$time = time();
?>
<html>
    <head>
        <link rel="stylesheet" href="tknika.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    <body bgcolor="#5E35B1">
        <div class="centered">
<?php

foreach ($events as $key => $event){ 
    $extraclass = "";
    $timestart = strtotime($event['time']['start']);
    $showbefore = strtotime('-20 minutes', $timestart);
    $showafter = strtotime('+20 minutes', $timestart);

    if ($time > $showbefore && $time < $showafter ){
        $extraclass = "current-event";
    }
?>
            <div class="event <?=$extraclass?>">
               <div class="time">
                    <div class="now">now</div>
                    <div class="hour"><?=$event['time']['start']?>-<?=$event['time']['end']?></div>
                </div>
                <div class="title">
                    <?=$event['title']?>
                </div>
                <div class="info">
                    <div class="room"><i class="fa fa-globe fa-fw"></i><?=$event['info']['room']?></div>
                    <div class="owner"><i class="fa fa-user fa-fw"></i><?=$event['info']['owner']?></div>
                </div>
            </div>
<?php
}
?>
        </div>
    </body>
</html>
