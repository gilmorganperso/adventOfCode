<?php

$arrInputs = [];

$reports = [];

$stream = fopen(__DIR__ . "/puzzle.txt", "r");

while ($line = fgets($stream)) {
    $reports[] = array_map(
        function ($input) {
            return intval($input);
        },
        explode(' ', trim($line))
    );
}

$results = array_map(
    function ($report) {
        return isSafe($report);
    },
    $reports
);

function isSafe(array $report): bool
{
    $return = true;

    if ($report[0] < $report[1]) {
        for ($i = 0; $i < count($report) - 1; $i++) {
            $diff = $report[$i+1] - $report[$i];
            $return &= $diff > 0 && $diff < 4;
        }
    } else {
        for ($i = 0; $i < count($report) - 1; $i++) {
            $diff = $report[$i+1] - $report[$i];
            $return &= $diff < 0 && $diff > -4;
        }
    }

    return $return;
}

//686;

$unsafe = array_filter(
    $reports,
    function ($report) {
        return !isSafe($report);
    }
);

function isReallySave($report) {
    $safe = false;

    for ($i = 0; $i < count($report); $i++) {
        $cloned = $report;
        unset($cloned[$i]);
        $cloned = array_combine(
            range(0, count($cloned) -1),
            array_values($cloned)
        );

        $safe = $safe || isSafe($cloned);
    }

    return $safe;
}

$realyUnsafe = array_filter(
    $unsafe,
    function ($report) {
        return isReallySave($report);
    }
);

var_dump(count($realyUnsafe) + 686);