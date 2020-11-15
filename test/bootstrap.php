<?php

use Eloquent\Phony\Phpunit\Phony;

require __DIR__ . '/../vendor/autoload.php';

Phony::stubGlobal('defined', 'Eloquent\Composer\Configuration');
Phony::stubGlobal('file_get_contents', 'Eloquent\Composer\Configuration');
Phony::stubGlobal('getenv', 'Eloquent\Composer\Configuration');
