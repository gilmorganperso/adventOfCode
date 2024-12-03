<?php

$total = 0;
$inputData = file_get_contents(__DIR__ . "/puzzle.txt");

preg_match_all("#mul\((\d*),(\d*)\)#", $inputData, $mul1);

foreach ($mul1[1] as $index => $firstNumber) {
    $total += intval($firstNumber) * intval($mul1[2][$index]);
}

var_dump($total);
