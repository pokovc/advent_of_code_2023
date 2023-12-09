<?php

$input = file_get_contents('day8.txt');

$rows = explode("\n", $input);

$instuctions = array_shift($rows);
$instuctions = str_split($instuctions);

array_shift($rows);

$map = [];
$start_places = [];
foreach ($rows as $row) {
    list($current_place, $coords) = explode(' = ', $row);
    $coords = str_replace(['(', ')'], '', $coords);
    list ($l, $r) = explode(', ', $coords);
    $map[$current_place] = [
        'L' => $l,
        'R' => $r
    ];

    if (str_split($current_place, 2)[1] === "A") {
        $start_places[] = $current_place;
    }
}

$ii = 0;
$steps = 0;
$place = "AAA";
while ($place !== "ZZZ") {
    $place = $map[$place][$instuctions[$ii]];

    if ($ii === count($instuctions) - 1) {
        $ii = 0;
    } else {
        $ii += 1;
    }

    $steps += 1;
}

var_dump($steps);


$steps_for_each = [];
foreach ($start_places as $current_place) {
    $steps = 0;
    $ii = 0;
    while (str_split($current_place, 2)[1] !== "Z") {
        $current_place = $map[$current_place][$instuctions[$ii]];

        if ($ii === count($instuctions) - 1) {
            $ii = 0;
        } else {
            $ii += 1;
        }

        $steps += 1;
    }

    $steps_for_each[] = $steps;
}

// Function to calculate the GCD (Greatest Common Divisor)
function gcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

// Function to calculate the LCM (Least Common Multiple)
function lcm($a, $b) {
    return ($a * $b) / gcd($a, $b);
}

// Function to find the LCM of 6 numbers
function findCommonMultiplier($numbers) {
    $result = 1;
    foreach ($numbers as $num) {
        $result = lcm($result, $num);
    }
    return $result;
}

// Finding the common multiplier
$commonMultiplier = findCommonMultiplier($steps_for_each);
var_dump($commonMultiplier);
