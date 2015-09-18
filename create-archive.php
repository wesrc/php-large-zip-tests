#!/usr/bin/env php
<?php

$zip = new ZipArchive();
$sampleFilePath = realpath('./sample.txt');

foreach ([0, 1, 2, 3, 4, 5] as $iteration) {

    echo "adding {$sampleFilePath} to archive" . PHP_EOL;

    $openReturn = $zip->open('./test-archive.zip', ZipArchive::CREATE);

    if ($openReturn !== true) {
        printf('Failed with code %d', $openReturn) . PHP_EOL;
    } else {

        $zip->addFile(
            $sampleFilePath,
            "test/sample{$iteration}.txt"
        );
    }

    $closeReturn = $zip->close();

    echo $zip->numFiles . PHP_EOL;
    if (!$closeReturn) {
        throw new \Exception('something went wrong');
        exit(1);
    }
}