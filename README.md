# Heartbeat

##### Includes - cache warms - all files found under specified path

```
> php vendor/gundars/heartbeat/load.php

Scanning /var/www/public/zend/approot
10102 files loaded in: 0h 2m 49s
```

##### Manual Loading, Verbose
```
<?php

require_once __DIR__ . '/Heartbeat.php';

$heartBeat = new Heartbeat\Heartbeat();
$heartBeat->verbose()->load(__DIR__ . '/../../../');
```
