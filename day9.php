<?php

$input = file_get_contents('day9.txt');

$rows = explode("\n", $input);

foreach ($rows as $index => $row) {
    $row = explode(' ', $row);

    $max = count($row);

    $rows2[$index] = [$row];
    $jj = 1;
    while (1) {
        foreach ($row as $ii => $number) {
            if (isset($row[$ii + 1])) {
                $difference = $row[$ii + 1] - $row[$ii];
                $rows2[$index][$jj][] = $difference;
            }
        }

        if (array_unique($rows2[$index][$jj]) === [0]) {
            break;
        }
        $row = $rows2[$index][$jj];
        $jj += 1;
    }
}

$sum = 0;
foreach ($rows2 as $sequennce) {
    $sequennce = array_reverse($sequennce);
    foreach ($sequennce as $numbers) {
        $last_number = end($numbers);
        $sum += $last_number;
    }
}

var_dump($sum);

$rows2 = [];
foreach ($rows as $index => $row) {
    $row = explode(' ', $row);

    $max = count($row);

    $row = array_reverse($row);

    $rows2[$index] = [$row];
    $jj = 1;
    while (1) {
        foreach ($row as $ii => $number) {
            if (isset($row[$ii + 1])) {
                $difference = $row[$ii] - $row[$ii + 1];
                $rows2[$index][$jj][] = $difference;
            }
        }

        if (array_unique($rows2[$index][$jj]) === [0]) {
            break;
        }
        $row = $rows2[$index][$jj];
        $jj += 1;
    }
}

$sum = 0;
foreach ($rows2 as $sequennce) {
    $sequennce = array_reverse($sequennce);

    if (isset($latest_first_number)) {
        unset($latest_first_number);
    }

    if (isset($difference)) {
        unset($difference);
    }

    foreach ($sequennce as $ii => $numbers) {
        if (isset($sequennce[$ii + 1])) {
            if (isset($difference)) {
                $subtract = $difference;
            } else {
                $subtract = end($numbers);
            }

            $difference = end($sequennce[$ii + 1]) - $subtract;
        }
    }
    $sum += $difference;

}

var_dump($sum);
