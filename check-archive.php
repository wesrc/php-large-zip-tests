#!/usr/bin/env php
<?php

$zipName = $argv[1];

$checkZip = new ZipArchive();
$openReturn = $checkZip->open($zipName, \ZipArchive::CHECKCONS);

if ($openReturn !== true) {
    throw new \Exception("could not open archive, failed with code {$openReturn}");
    exit(1);
}

echo $checkZip->getStatusString() . PHP_EOL;
echo "archive {$zipName} contains: {$checkZip->numFiles}" . PHP_EOL;