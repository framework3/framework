<?php

define('F3_START', microtime(true));

// All classes are resolved via the Loader
require_once __DIR__ . '/Loader.php';

// And the functions depend on those, so we load those next
require_once __DIR__ . '/Functions.php';

// Finally, a "bootloader" for the framework
require_once __DIR__ . '/Boot.php';

// We're ready to go!
return new \Framework3\Application();
