# Heartbeat
Heartbeat is a fix for following issues:
- slow file reads on cloud hostings where cache is not on the same server as application (Azure, AWS);
- slow file includes from composer;

Heartbeat finds all the files in your application, includes and "cache" warms
Best performance calling Heartbeat every 5 minutes having application + vendors under 20 000 files

### Install
```
composer require gundars/heartbeat ~0.1
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
