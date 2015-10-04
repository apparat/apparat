<?php

/**
 * apparat
 *
 * @category    Apparat
 * @package     Apparat
 * @author      Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @copyright   Copyright © 2015 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 * @license     http://opensource.org/licenses/MIT	The MIT License (MIT)
 */

/***********************************************************************************
 *  The MIT License (MIT)
 *
 *  Copyright © 2015 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy of
 *  this software and associated documentation files (the "Software"), to deal in
 *  the Software without restriction, including without limitation the rights to
 *  use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 *  the Software, and to permit persons to whom the Software is furnished to do so,
 *  subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 *  COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 *  IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ***********************************************************************************/

if (false) {

    $types = array('event', 'article', 'note');
    $index = 0;

    // Setup test directories & files
    for ($year = 2012; $year < 2016; ++$year) {
        for ($month = 1; $month < 13; ++$month) {
            for ($day = 1, $maxDays = date('t', mktime(0, 0, 0, $month, 1, $year)) + 1; $day < $maxDays; ++$day) {
                $dir = 'glob'.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.str_pad($month, 2, '0',
                        STR_PAD_LEFT).DIRECTORY_SEPARATOR.str_pad($day, 2, '0', STR_PAD_LEFT);
                mkdir($dir, 0777, true);

                // Create random subfolders and object files
                for ($object = 1; $object < 11; ++$object) {
                    ++$index;
                    $type = $types[rand(0, 2)];
                    $objectDir = $dir.DIRECTORY_SEPARATOR.$index.'.'.$type;
                    mkdir($objectDir);
                    touch($objectDir.DIRECTORY_SEPARATOR.$type.'.'.$index.'.md');
                }
            }
        }
    }
}

// Match all notes via glob
for ($i = 0; $i < 3; ++$i) {
    $timer = microtime(true);
    echo 'Matching all notes via glob() ... ';
    $notes = glob('glob/*/*/*/*.note', GLOB_ONLYDIR);
    echo count($notes).' found in '.(microtime(true) - $timer).' seconds'.PHP_EOL;
}

// Match all notes via glob without sorting
for ($i = 0; $i < 3; ++$i) {
    $timer = microtime(true);
    echo 'Matching all notes via glob() without sorting ... ';
    $notes = glob('glob/*/*/*/*.note', GLOB_ONLYDIR | GLOB_NOSORT);
    echo count($notes).' found in '.(microtime(true) - $timer).' seconds'.PHP_EOL;
}

// Match all notes via GlobIterator + SplFileInfo::isDir()
for ($i = 0; $i < 3; ++$i) {
    $timer = microtime(true);
    echo 'Matching all notes via GlobIterator + SplFileInfo::isDir() without sorting ... ';
    $notes = array();
    $glob = new \GlobIterator('glob/*/*/*/*.note');
    /**
     * @var string $note
     * @var SplFileInfo  $noteInfo
     */
    foreach ($glob as $note => $noteInfo) {
        if ($noteInfo->isDir()) {
            $notes[] = $note;
        }
    }
    echo count($notes).' found in '.(microtime(true) - $timer).' seconds'.PHP_EOL;
}

// Match all notes via scandir() + is_dir() + fnmatch()
for ($i = 0; $i < 3; ++$i) {
    $timer = microtime(true);
    echo 'Matching all notes via scandir() + is_dir() + fnmatch() ... ';
    $notes = array();
    foreach (scandir('glob') as $yearDir) {
        if ($yearDir != '.' && $yearDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir)) {
            foreach (scandir('glob'.DIRECTORY_SEPARATOR.$yearDir) as $monthDir) {
                if ($monthDir != '.' && $monthDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir)) {
                    foreach (scandir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir) as $dayDir) {
                        if ($dayDir != '.' && $dayDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir)) {
                            foreach (scandir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir) as $objectDir) {
                                if (is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir.DIRECTORY_SEPARATOR.$objectDir) && fnmatch('*.note',
                                        $objectDir)
                                ) {
                                    $notes[] = 'glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir.DIRECTORY_SEPARATOR.$objectDir;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo count($notes).' found in '.(microtime(true) - $timer).' seconds'.PHP_EOL;
}

// Match all notes via scandir() + is_dir() + pathinfo()
for ($i = 0; $i < 3; ++$i) {
    $timer = microtime(true);
    echo 'Matching all notes via scandir() + is_dir() + pathinfo() ... ';
    $notes = array();
    foreach (scandir('glob') as $yearDir) {
        if ($yearDir != '.' && $yearDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir)) {
            foreach (scandir('glob'.DIRECTORY_SEPARATOR.$yearDir) as $monthDir) {
                if ($monthDir != '.' && $monthDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir)) {
                    foreach (scandir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir) as $dayDir) {
                        if ($dayDir != '.' && $dayDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir)) {
                            foreach (scandir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir) as $objectDir) {
                                if (is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir.DIRECTORY_SEPARATOR.$objectDir) && (pathinfo($objectDir,
                                            PATHINFO_EXTENSION) == 'note')
                                ) {
                                    $notes[] = 'glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir.DIRECTORY_SEPARATOR.$objectDir;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo count($notes).' found in '.(microtime(true) - $timer).' seconds'.PHP_EOL;
}

// Match all notes via opendir() + is_dir() + fnmatch()
for ($i = 0; $i < 3; ++$i) {
    $timer = microtime(true);
    echo 'Matching all notes via opendir() + is_dir() + fnmatch() ... ';
    $notes = array();
    $GLOB = opendir('glob');
    while ($yearDir = readdir($GLOB)) {
        if ($yearDir != '.' && $yearDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir)) {
            $YEAR = opendir('glob'.DIRECTORY_SEPARATOR.$yearDir);
            while ($monthDir = readdir($YEAR)) {
                if ($monthDir != '.' && $monthDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir)) {
                    $MONTH = opendir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir);
                    while ($dayDir = readdir($MONTH)) {
                        if ($dayDir != '.' && $dayDir != '..' && is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir)) {
                            $DAY = opendir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir);
                            while ($objectDir = readdir($DAY)) {
                                if (is_dir('glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir.DIRECTORY_SEPARATOR.$objectDir) && fnmatch('*.note',
                                        $objectDir)
                                ) {
                                    $notes[] = 'glob'.DIRECTORY_SEPARATOR.$yearDir.DIRECTORY_SEPARATOR.$monthDir.DIRECTORY_SEPARATOR.$dayDir.DIRECTORY_SEPARATOR.$objectDir;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo count($notes).' found in '.(microtime(true) - $timer).' seconds'.PHP_EOL;
}