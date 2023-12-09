<?php

$input = file_get_contents('day3.txt');
$rows = explode("\n", $input);

$grid = [];
$max_x = count(str_split($rows[0])) - 1;
$max_y = count($rows) - 2;

foreach ($rows as $y => $row) {
    if (empty($row)) {
        continue;
    }

    $row = str_split($row);
    foreach ($row as $x => $char) {
        $grid[$x][$y] = $char;
    }

}

$symbol_locations = [];
$number_locations = [];
$parts_of_engine = [];
$parts_by_symbol = [];
$already_used = [];
foreach ($rows as $y => $row) {
    if (empty($row)) {
        continue;
    }

    $row = str_split($row);
    $current_number = "";
    foreach ($row as $x => $char) {

        if (!is_numeric($char)) {
            if (empty($current_number)) {
                continue;
            }

            $part_used = false;
            $x_start = $x - strlen($current_number) - 1;
            $x_end = $x;
            // check all coordinates around number
            if ($y) {
                // check row above
                $y_check = $y - 1;
                for ($ii = $x_start; $ii <= $x_end; $ii += 1) {
                    if (isset($grid[$ii][$y_check]) && !is_numeric($grid[$ii][$y_check]) && $grid[$ii][$y_check] !== '.') {
                        $parts_of_engine[] = $current_number;
                        $part_used = true;

                        if ($grid[$ii][$y_check] === '*') {
                            $parts_by_symbol[$ii][$y_check][] = $current_number;
                        }

                        break;
                    }
                }

                if ($part_used) {
                    $current_number = "";
                    continue;
                }
            }

            // check same row
            if (isset($grid[$x_start][$y]) && !is_numeric($grid[$x_start][$y]) && $grid[$x_start][$y] !== '.') {
                $parts_of_engine[] = $current_number;
                if ($grid[$x_start][$y] === '*') {
                    $parts_by_symbol[$x_start][$y][] = $current_number;
                }
                $current_number = "";
                continue;
            }
            if (isset($grid[$x_end][$y]) && !is_numeric($grid[$x_end][$y]) && $grid[$x_end][$y] !== '.') {
                $parts_of_engine[] = $current_number;
                if ($grid[$x_end][$y] === '*') {
                    $parts_by_symbol[$x_end][$y][] = $current_number;
                }
                $current_number = "";
                continue;
            }

            // check row below
            $y_check = $y + 1;
            if ($current_number == 661) {
                var_dump($x_start, $x_end);
            }
            for ($ii = $x_start; $ii <= $x_end; $ii += 1) {
                if (isset($grid[$ii][$y_check]) && !is_numeric($grid[$ii][$y_check]) && $grid[$ii][$y_check] !== '.') {
                    $parts_of_engine[] = $current_number;
                    if ($grid[$ii][$y_check] === '*') {
                        $parts_by_symbol[$ii][$y_check][] = $current_number;
                    }
                    break;
                }
            }

            $current_number = "";
        } else {
            $current_number .= $char;
        }

        if ($x === $max_x) {
            $part_used = false;
            $x_start = $x - strlen($current_number);
            $x_end = $x;
            // check all coordinates around number
            if ($y) {
                // check row above
                $y_check = $y - 1;
                for ($ii = $x_start; $ii <= $x_end; $ii += 1) {
                    if (isset($grid[$ii][$y_check]) && !is_numeric($grid[$ii][$y_check]) && $grid[$ii][$y_check] !== '.') {
                        $parts_of_engine[] = $current_number;
                        $part_used = true;

                        if ($grid[$ii][$y_check] === '*') {
                            $parts_by_symbol[$ii][$y_check][] = $current_number;
                        }

                        break;
                    }
                }

                if ($part_used) {
                    $current_number = "";
                    continue;
                }
            }

            // check same row
            if (isset($grid[$x_start][$y]) && !is_numeric($grid[$x_start][$y]) && $grid[$x_start][$y] !== '.') {
                $parts_of_engine[] = $current_number;
                if ($grid[$x_start][$y] === '*') {
                    $parts_by_symbol[$x_start][$y][] = $current_number;
                }
                $current_number = "";
                continue;
            }

            if (isset($grid[$x_end][$y]) && !is_numeric($grid[$x_end][$y]) && $grid[$x_end][$y] !== '.') {
                $parts_of_engine[] = $current_number;
                if ($grid[$x_end][$y] === '*') {
                    $parts_by_symbol[$x_end][$y][] = $current_number;
                }
                $current_number = "";
                continue;
            }

            // check row below
            $y_check = $y + 1;
            for ($ii = $x_start; $ii <= $x_end; $ii += 1) {
                if (isset($grid[$ii][$y_check]) && !is_numeric($grid[$ii][$y_check]) && $grid[$ii][$y_check] !== '.') {
                    $parts_of_engine[] = $current_number;
                    if ($grid[$ii][$y_check] === '*') {
                        $parts_by_symbol[$ii][$y_check][] = $current_number;
                    }
                    break;
                }
            }
        }
    }
}
// echo implode("\n", $parts_of_engine);

var_dump(array_sum($parts_of_engine));

$sum = 0;
foreach ($parts_by_symbol as $x => $parts_y) {
    foreach ($parts_y as $y => $parts) {
        if (count($parts) === 2) {
            $sum += $parts[0] * $parts[1];
        }
    }
}

var_dump($sum);
