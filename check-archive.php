#!/usr/bin/env php
<?php

$zipName = $argv[1];

$checkZip = new ZipArchive();
$openReturn = $checkZip->open($zipName, \ZipArchive::CHECKCONS);

if ($openReturn !== true) {
    $constantName = getReturnCodeConstant($openReturn);
    throw new \Exception("could not open archive, failed with code {$openReturn} ({$constantName})");
}

echo $checkZip->getStatusString() . PHP_EOL;
echo "archive {$zipName} contains: {$checkZip->numFiles}" . PHP_EOL;

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