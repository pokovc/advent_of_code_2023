<?php

$input = file_get_contents('day2.txt');

$max_red = 12;
$max_green = 13;
$max_blue = 14;

$possible_games = 0;
$impossible_games = 0;

$rows = explode("\n", $input);
foreach ($rows as $row) {
    if (empty($row)) {
        continue;
    }

    list($game_name, $numbers) = explode(': ', $row);
    $game_id = explode(' ', $game_name);
    $game_id = $game_id[1];

    $sets = explode('; ', $numbers);

    foreach ($sets as $set) {
        $sum_red = 0;
        $sum_green = 0;
        $sum_blue = 0;
        $numbers = explode(', ', $set);
        foreach ($numbers as $number) {
            list($number_of, $color) = explode(' ', $number);

            if ($color === 'red') {
                $sum_red += $number_of;
            } elseif ($color === 'green') {
                $sum_green += $number_of;
            } elseif ($color === 'blue') {
                $sum_blue += $number_of;
            }

            if ($sum_red > $max_red || $sum_green > $max_green || $sum_blue > $max_blue) {
                $impossible_games += $game_id;
                continue 3;
            }
        }

    }

        $possible_games += $game_id;
}


$rows = explode("\n", $input);
$sum = 0;
foreach ($rows as $row) {
    if (empty($row)) {
        continue;
    }

    list($game_name, $numbers) = explode(': ', $row);
    $game_id = explode(' ', $game_name);
    $game_id = $game_id[1];

    $red = 0;
        $green = 0;
        $blue = 0;
    $sets = explode('; ', $numbers);

    foreach ($sets as $set) {
        $numbers = explode(', ', $set);
        foreach ($numbers as $number) {
            list($number_of, $color) = explode(' ', $number);

            if ($color === 'red') {
                $red = max($red, $number_of);
            } elseif ($color === 'green') {
                $green = max($green, $number_of);
            } elseif ($color === 'blue') {
                $blue = max($blue, $number_of);
            }
        }

    }
    $sum += $red * $green * $blue;
        $possible_games += $game_id;
}

var_dump($sum);
