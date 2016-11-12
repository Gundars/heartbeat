<?php

namespace Heartbeat;

use DateTime;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class Heartbeat
 *
 * @package Heartbeat
 */
class Heartbeat
{
    /**
     * By default can 1 level before vendor, or 3 levels up
     */
    const DEFAULT_ROOT_PATH = '/../../..';

    private $verbose = false;

    /**
     * @param bool $verbose
     * @return $this
     */
    public function verbose($verbose = true)
    {
        $this->verbose = $verbose;

        return $this;
    }

    /**
     * @param string $path
     * @param string $vendor
     */
    public function load($path = '')
    {
        $timerStart = microtime(true);
        $path       = realpath(rtrim($path, '\/\\') ?: static::DEFAULT_ROOT_PATH);

        if (!$path) {
            echo "Unable to find path: {$path}\n";
            die("Exiting\n");
        } else {
            echo "Scanning $path\n";
        }
        $this->scanDir($path);

        echo " in: "
             . $this->secondsToTime(round(microtime(true) - $timerStart, 0))
             . "\n";
    }

    /**
     * @param $path
     */
    private function scanDir($path)
    {
        if (!$this->isDir($path)) {
            die('Error: NOT A DIR: ' . $path);
        }

        return $this->includeFiles($path);
    }

    /**
     * @param      $path
     * @param bool $verbose
     * @return bool|string
     */
    private function isDir($path, $verbose = false)
    {
        if ($verbose) {
            return is_dir($path) ? 'Dir' : 'NOT A DIR';
        }

        return is_dir($path);
    }

    /**
     * @verbose string $path
     * @return bool
     */
    private function includeFiles($path)
    {
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        $count = 0;
        foreach ($objects as $name => $object) {
            if ($object->getFileName() === '.' || $object->getFileName() === '..') {
                continue;
            }
            $count++;
            if ($this->verbose) {
                echo str_pad($count, 10) . " Require: $name\n";
            }
            $read = file_get_contents($name);
        }

        echo "$count files loaded";

        return ($count > 0);
    }

    /**
     * @param $seconds
     * @return string
     */
    private function secondsToTime($seconds)
    {
        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");

        return $dtF->diff($dtT)->format("%hh %im %ss");
    }
}
