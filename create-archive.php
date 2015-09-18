#!/usr/bin/env php
<?php

$zip = new ZipArchive();
$sampleFilePath = realpath('./sample.txt');
$zip->open('./test-archive.zip', ZipArchive::CREATE);

foreach ([1, 2, 3, 4, 5] as $iteration) {
    echo "adding {$sampleFilePath} to archive" . PHP_EOL;

    $addReturn = $zip->addFile(
        $sampleFilePath,
        "test/sample{$iteration}.txt"
    );

    if (false === $addReturn) {
        throw new \Exception("Failed to add file to archive");
    }
}

$closeReturn = $zip->close();
if (!$closeReturn) {
    throw new \Exception('could not close archive');
}

$openReturn = $zip->open('./test-archive.zip', ZipArchive::CHECKCONS);
if ($openReturn !== true) {
    $constantName = getReturnCodeConstant($openReturn);
    throw new \Exception("could not open archive, failed with code {$openReturn} ({$constantName})");
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
        if ('ER' == substr($name, 0, 2) && $value == $code) {
            $constName = $name;
            break;
        }
    }

    return $constName;
}