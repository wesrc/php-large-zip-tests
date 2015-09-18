#!/usr/bin/env php
<?php

$zip = new ZipArchive();
$sampleFilePath = realpath('./sample.txt');

foreach ([0, 1, 2, 3, 4, 5] as $iteration) {


    $openReturn = $zip->open('./test-archive.zip', ZipArchive::CREATE);
    if ($openReturn !== true) {
        throw new \Exception("could not open archive, failed with code {$openReturn}");
        exit(1);
    }

    echo "{$zip->numFiles} already in archive" . PHP_EOL;
    echo "adding {$sampleFilePath} to archive" . PHP_EOL;

    $zip->addFile(
        $sampleFilePath,
        "test/sample{$iteration}.txt"
    );

    $closeReturn = $zip->close();

    if (!$closeReturn) {
        throw new \Exception('could not close archive');
        exit(1);
    }
}