#!/usr/bin/env php
<?php

$zipName = $argv[1];

$checkZip = new ZipArchive();
$openReturn = $checkZip->open($zipName, \ZipArchive::CHECKCONS);

echo "open return code: $openReturn" . PHP_EOL;
echo $checkZip->getStatusString() . PHP_EOL;
echo "archive {$zipName} contains: {$checkZip->numFiles}" . PHP_EOL;