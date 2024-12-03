<?php

$start = microtime(true);

$total = 0;
$data = file_get_contents(__DIR__ . "/puzzle.txt");

preg_match_all("#do\(\)|don't\(\)#", $data, $does);
$parts = preg_split("#do\(\)|don't\(\)#", $data);

$total = 0;

foreach ($parts as $index => $part) {
    if ($index === 0) {
        preg_match_all("#mul\((\d*),(\d*)\)#", $part, $mul1);

        foreach ($mul1[1] as $index => $firstNumber) {
            $total += intval($firstNumber) * intval($mul1[2][$index]);
        }
        continue;
    }

    if ($does[0][$index-1] === "do()") {
        preg_match_all("#mul\((\d*),(\d*)\)#", $part, $mul1);

        foreach ($mul1[1] as $index => $firstNumber) {
            $total += intval($firstNumber) * intval($mul1[2][$index]);
        }
    }
}

$end = microtime(true);

var_dump(($end - $start) * 1000);
