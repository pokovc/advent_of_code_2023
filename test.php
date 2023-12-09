<?php

function isSpecialChar($char) {
    return !is_numeric($char) && $char !== '.';
}

function findNumbersAdjacentToSpecialChars($text) {
    $rows = explode("\n", $text);
    $adjacentOffsets = [
        [-1, 0], [1, 0], [0, -1], [0, 1] // Up, down, left, right
    ];

    foreach ($rows as $y => $row) {
        $rowLength = strlen($row);
        for ($x = 0; $x < $rowLength; $x++) {
            if (is_numeric($rows[$y][$x])) {
                // Check for the start and end of the number
                $number = '';
                while ($x < $rowLength && is_numeric($rows[$y][$x])) {
                    $number .= $rows[$y][$x];
                    $x++;
                }
                $x--; // Adjust for the extra increment in the loop

                // If the extracted number is not empty
                if ($number !== '') {
                    foreach ($adjacentOffsets as $offset) {
                        $newX = $x + $offset[0];
                        $newY = $y + $offset[1];

                        if ($newX >= 0 && $newX < $rowLength &&
                            $newY >= 0 && $newY < count($rows) &&
                            isset($rows[$newY][$newX]) &&
                            isSpecialChar($rows[$newY][$newX])) {
                            echo "Number '{$number}' at position ($x, $y) is adjacent to a special character.\n";
                        }
                    }
                }
            }
        }
    }
}

$text = "
467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..
";

findNumbersAdjacentToSpecialChars($text);
?>
