<?php

$input = file_get_contents('day1.txt');

$rows = explode("\n", $input);

/* $numbers = [];
foreach ($rows as $ii => $row) {
    if (empty($row)) {
        continue;
    }

    $chars = str_split($row);
    foreach ($chars as $char) {
        if (empty($numbers[$ii]) && is_numeric($char)) {
            $numbers[$ii] = [$char];
        } elseif (is_numeric($char)) {
            $numbers[$ii][1] = $char;
        }
    }

    if (count($numbers[$ii]) < 2) {
        $numbers[$ii][] = $numbers[$ii][0];
    }
}

$sum = 0;
foreach ($numbers as $number) {
    $number = implode($number);
    $sum += $number;
}

var_dump($sum); */

$numbers = [];
$digits = [
    "one" => "o1ne",
    "two" => "t2wo",
    "three" => "t3hree",
    "four" => "f4our",
    "five" => "f5ive",
    "six" => "s6ix",
    "seven" => "s7even",
    "eight" => "e8ight",
    "nine" => "n9ine"
];

$digits_map = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$original_rows = [];

foreach ($rows as $ii => $row) {
    if (empty($row)) {
        continue;
    }
    $original_rows[$ii] = $row;

    foreach ($digits as $number_word => $replace) {
        $row = str_replace($number_word, $replace, $row);
    }

    $row = preg_replace("/[a-z]/", '', $row) . "\n";

    $chars = str_split($row);
    foreach ($chars as $char) {
        if (empty($numbers[$ii]) && is_numeric($char)) {
            $numbers[$ii] = [$char];
        } elseif (is_numeric($char)) {
            $numbers[$ii][1] = $char;
        }
    }

    if (count($numbers[$ii]) < 2) {
        $numbers[$ii][] = $numbers[$ii][0];
    }
}

$sum = 0;
foreach ($numbers as $ii => $number) {
    $number = implode($number);
    $sum += $number;
}

var_dump($sum);

