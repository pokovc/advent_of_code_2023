<?php

$input = file_get_contents('day7.txt');

$rows = explode("\n", $input);

$hands = [
    'high' => [],
    'pair' => [],
    'two_pair' => [],
    'three' => [],
    'full' => [],
    'four' => [],
    'five' => [],
];

$hands_no = count($rows);

/* $rows = [
    "KAJA5 100",
    "KAA9J 200"
]; */

foreach ($rows as $row) {
    list($hand, $bid) = explode(' ', $row);
    $hand_parts = str_split($hand);

    if (count(array_unique($hand_parts)) === 1) {
        $hands['five'][] = [
            'hand' => $hand,
            'bid' => $bid
        ];
    } else {
        $hand_array = [];
        foreach ($hand_parts as $hand_part) {
            if (!array_key_exists($hand_part, $hand_array)) {
                $hand_array[$hand_part] = 0;
            }
            $hand_array[$hand_part] += 1;
        }

        asort($hand_array);

        $array_keys = array_values($hand_array);
        if ($array_keys === [2, 3]) {
            $hands['full'][] = [
                'hand' => $hand,
                'bid' => $bid
            ];
        } elseif ($array_keys === [1, 2, 2]) {
            $hands['two_pair'][] = [
                'hand' => $hand,
                'bid' => $bid
            ];
        } elseif ($array_keys === [1, 4]) {
            $hands['four'][] = [
                'hand' => $hand,
                'bid' => $bid
            ];
        } elseif ($array_keys === [1, 1, 3]) {
            $hands['three'][] = [
                'hand' => $hand,
                'bid' => $bid
            ];
        } elseif ($array_keys === [1, 1, 1, 2]) {
            $hands['pair'][] = [
                'hand' => $hand,
                'bid' => $bid
            ];
        } else {
            $hands['high'][] = [
                'hand' => $hand,
                'bid' => $bid
            ];
        }
    }
}

$ii = 1;
$multiply = 0;
foreach ($hands as $hands2) {
    uasort($hands2, function ($h1, $h2) {
        $h1 = str_replace(['A', 'K', 'Q', 'J', 'T'], ['E', 'D', 'C', 'B', 'A'], $h1);
        $h2 = str_replace(['A', 'K', 'Q', 'J', 'T'], ['E', 'D', 'C', 'B', 'A'], $h2);
        return $h1 > $h2 ? 1 : -1;
    });

    foreach ($hands2 as $h2) {
        echo $h2['hand'] . "\n";
        $multiply += $h2['bid'] * $ii;
        $ii += 1;
    }
}

var_dump($multiply);
