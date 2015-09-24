## Introduction
We use PHP ZipArchive in customer projects to create zip files containing all sorts of documents.
The created archives range from a few megabytes up to several gigabytes.
We thought we were aware of the limitiations of zip (non zip64) archives and assumed that with zip64 support,
which landed in version 1.11.0 (https://pecl.php.net/package-info.php?package=zip&version=1.11.0) 
big archives (exceeding 2gb) should not be a problem.

## Problems with big archives [![Build Status](https://travis-ci.org/wesrc/php-large-zip-tests.svg)](https://travis-ci.org/wesrc/php-large-zip-tests)
When creating archives bigger than 4GB (somewehere around 4,3GB | 2^32 bytes?)
archives becomde corrupt :(

As we did not find any way to solve the described issue, writing a test script that could be run on travis-ci 
against several recent PHP Versions and tried by others seemed like a good idea.

the failing builds on travis-ci can be found here: https://travis-ci.org/wesrc/php-large-zip-tests/builds

## Help appreciated
- can you reproduce the problem on your machine/PHP version?
- do you have any ideas what exactly is happening ;)?
- is this a bug in the zip extension/module
- should we file a bug with PHP?

Thanks

Leander (@lenada) & Michael (@mischosch)
