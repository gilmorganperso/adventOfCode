<?php

$total = 0;
//$inputData = file_get_contents(__DIR__ . "/test.txt");
$inputData = file_get_contents(__DIR__ . "/puzzle.txt");

preg_match_all("#mul\((\d*),(\d*)\)#", $inputData, $mul1);

$arrDos = [];
$lastPos = 0;

while ($pos = strpos($inputData, "don't()", $lastPos)) {
    $arrDos[$pos] = 'DONT';
    $lastPos = $pos + 1;
}

$lastPos = 0;
while ($pos = strpos($inputData, "do()", $lastPos)) {
    var_dump("here");
    $arrDos[$pos] = 'DO';
    $lastPos = $pos + 1;
}

$range = [];
$state = 'DO';
$pos = 0;

foreach ($arrDos as $index => $doOrDont) {
    if ($doOrDont !== $state) {
        $range[] = [[$pos, $index], $state];
        $pos = $index;
        $state = $doOrDont;
    }
}

$lastState = "DONT";
$lastRange = end($range);

if ($lastRange[1] === "DONT") {
    $lastState = "DO";
}

$range[] = [[$lastRange[0][1], strlen($inputData)], $lastState];

//comme la chanson ... je sors ...
$onlyDo = array_filter(
    $range,
    function ($ranged) {
        return $ranged[1] === 'DO';
    }
);

$position = [];

var_dump($onlyDo);

foreach ($mul1[0] as $index => $value) {
    foreach ($onlyDo as $do) {
        if ($pos >= $do[0][0] && $pos < $do[0][1]) {
               $total += intval($mul1[1][$index]) * intval($mul1[2][$index]);
        }
    }
}


//foreach ($mul1[1] as $index => $firstNumber) {
//    $pos = strpos($inputData, "mul(" . $firstNumber);
//
//        foreach ($onlyDo as $do) {
//            if ($pos >= $do[0][0] && $pos < $do[0][1]) {
//                $total += intval($firstNumber) * intval($mul1[2][$index]);
//            }
//        }
//
//}
//
var_dump($total);

