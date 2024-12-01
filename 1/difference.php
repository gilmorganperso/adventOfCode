<?php

$stream = fopen(__DIR__ . "/input.txt", "r");

$left = [];
$right = [];

while ($line = fgets($stream)) {
    $split = explode("   " ,$line);
    $left[] = $split[0];
    $right[] = $split[1];
}

sort($left);
sort($right);

$diff = array_map(
    function ($intLeft, $intRight) {
        return abs($intLeft - $intRight);
    },
    $left,
    $right
);

var_dump(array_sum($diff));