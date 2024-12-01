<?php

$stream = fopen(__DIR__ . "/input.txt", "r");

$left = [];
$right = [];

while ($line = fgets($stream)) {
    $split = explode("   " ,$line);
    $left[] = intval($split[0]);
    $right[] = intval($split[1]);
}

$diff = array_map(
    function ($intLeft) use ($right) {
        $nb = array_filter(
            $right, 
            function ($intRight) use ($intLeft) {
                return $intRight === $intLeft;
            }
        );

        return $intLeft * count($nb);
    },
    $left
);

var_dump(array_sum($diff));
