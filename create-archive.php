#!/usr/bin/env php
<?php

$zip = new ZipArchive();
$sampleFilePath = realpath('./sample.txt');

foreach ([0, 1, 2, 3, 4, 5] as $iteration) {

    $openReturn = $zip->open('./test-archive.zip', ZipArchive::CREATE);
    if ($openReturn !== true) {
        $constantName = getReturnCodeConstant($openReturn);
        throw new \Exception("could not open archive, failed with code {$openReturn} ({$constantName})");
    }

    echo "adding {$sampleFilePath} to archive" . PHP_EOL;

    $addReturn = $zip->addFile(
        $sampleFilePath,
        "test/sample{$iteration}.txt"
    );

    if (false === $addReturn) {
        throw new \Exception("Failed to add file to archive");
    }

    $closeReturn = $zip->close();
    if (!$closeReturn) {
        throw new \Exception('could not close archive');
    }
}

/**
 * @param $code
 * @return string
 */
function getReturnCodeConstant($code)
{
    $zipArchive = new ReflectionClass ('ZipArchive');
    $constants = $zipArchive->getConstants();

    $constName = null;

    foreach ($constants as $name => $value) {
        if ('ER' == substr($name, 0,2) && $value == $code) {
            $constName = $name;
            break;
        }
    }

    return $constName;
}