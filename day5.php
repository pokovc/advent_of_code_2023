<?php

$input = file_get_contents('day5.txt');

$rows = explode("\n\n", $input);

$seeds = array_shift($rows);
$seeds = explode(': ', $seeds);
$seeds = $seeds[1];
$seeds = explode(' ', $seeds);
$seeds = array_map('intval', $seeds);

$maps = [
    "soils" => [],
    "fertilizers" => [],
    "water" => [],
    "light" => [],
    "temperature" => [],
    "humidity" => [],
    "location" => []
];

foreach ($maps as $name => $value) {
    $value = array_shift($rows);
    $value = explode("\n", $value);
    array_shift($value);

    /* $value_maps = [];
    foreach ($value as $row) {
        list($destination_start, $source_start, $range) = explode(" ", $row);
        $value_map = [];
        for ($ii = 0; $ii < $range; $ii += 1) {
            $value_maps[(int) $source_start] = (int) $destination_start;
            $source_start += 1;
            $destination_start += 1;
        }
    } */

    $maps[$name] = $value;
}

$min_location = 100000000000000000000;
foreach ($seeds as $seed) {
    foreach ($maps as $map => $values) {
        foreach ($values as $mapping) {
            list($destination_start, $source_start, $range) = explode(" ", $mapping);
            $source_start = (int) $source_start;
            $destination_start = (int) $destination_start;
            $range = (int) $range;
            $source_end = $source_start + $range;
            if ($seed >= $source_start && $seed < $source_end) {
                $difference = $destination_start - $source_start;
                $seed += $difference;
                // var_dump($seed, $destination_start, $difference, $map);
                break;
            }
        }
    }

    $min_location = min($seed, $min_location);
}

//var_dump($min_location);

$min_location = 100000000000000000000;
foreach ($seeds as $ii => $seed) {
    if ($ii % 2 === 0) {
        $start_seed = $seed;
    } else {
        echo "range $start_seed to " . ($start_seed + $seed) . "\n";
        for ($jj = $start_seed; $jj < $start_seed + $seed; $jj += 1) {
            //var_dump($jj);
            $seed_value = $jj;
            foreach ($maps as $map => $values) {
                foreach ($values as $mapping) {
                    list($destination_start, $source_start, $range) = explode(" ", $mapping);
                    $source_start = (int) $source_start;
                    $destination_start = (int) $destination_start;
                    $range = (int) $range;
                    $source_end = $source_start + $range;
                    if ($seed_value >= $source_start && $seed_value < $source_end) {
                        $difference = $destination_start - $source_start;
                        $seed_value += $difference;
                        if ($jj == 82) {
                            var_dump($seed_value);
                        }

                        break;
                    }
                }
            }
            $min_location = min($seed_value, $min_location);
        }
    }
}

var_dump($min_location);
