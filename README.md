# Heartbeat
Includes - cache warms - all files found under specified path

### Install
```
composer require gundars/heartbeat ^0.1
```

### Call in CLI 

```
> php vendor/gundars/heartbeat/load.php

Scanning /var/www/public/zend/approot
10102 files loaded in: 0h 2m 49s
```

### Call with input parameter
Paste this code in your index.php:

```
use Heartbeat\Heartbeat;
```
```
if (array_key_exists('heartbeat', $_REQUEST)) {
    $heartBeat = new Heartbeat();
    $heartBeat->load(__DIR__);
}
```
and call via http(s) `http://example.com/?heartbeat=true`

### Manual Loading
```
<?php

use Heartbeat\Heartbeat;

$heartBeat = new Heartbeat();
$heartBeat->->load(__DIR__ . '/../../../');
```

### Verbose
Prints all included files
```
$heartBeat->verbose()->load(__DIR__);
```

### Die
stops script execution after file include is finished
```
$heartBeat->verbose()->load(__DIR__, true);
```
