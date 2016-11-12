<?php

#require_once __DIR__ . '/Heartbeat.php';
require __DIR__ . '/../../autoload.php';

use Heartbeat\Heartbeat;

$heartBeat = new Heartbeat();
$heartBeat->/*verbose()*/->load(__DIR__ . '/../../../', true);
