<?php

$input = file_get_contents('day6.txt');

$rows = explode("\n", $input);

$times = $rows[0];
$records = $rows[1];

$times = explode("Time:", $times);
$records = explode("Distance:", $records);
array_shift($times);
array_shift($records);

$times2 = implode('', $times);
$records2 = implode('', $records);

$times = explode(' ', $times2);
$records = explode(' ', $records2);

$times2 = str_replace(' ', '', $times2);
$records2 = str_replace(' ', '', $records2);

$times = array_filter($times, function ($time) { return $time; });
$records = array_filter($records, function ($record) { return $record; });

$times = array_values($times);
$records = array_values($records);

$multiplication = 1;
for ($ii = 0; $ii < count($times); $ii += 1) {
    $time = $times[$ii];
    $record = $records[$ii];

    $ways_to_beat = 0;
    for ($jj = 1; $jj < $time; $jj += 1) {
        $distance = ($time - $jj) * $jj;
        if ($distance > $record) {
            $ways_to_beat += 1;
        }
    }
    $multiplication *= $ways_to_beat;
}

$ways_to_beat = 0;
for ($jj = 1; $jj < $times2; $jj += 1) {
    $distance = ($times2 - $jj) * $jj;
    if ($distance > $records2) {
        $ways_to_beat += 1;
    }
}

var_dump($multiplication);

var_dump($ways_to_beat);
