<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Eloquent\Phony\Phpunit\Phony;

require __DIR__ . '/../vendor/autoload.php';

Phony::stubGlobal('defined', 'Eloquent\Composer\Configuration');
Phony::stubGlobal('file_get_contents', 'Eloquent\Composer\Configuration');
Phony::stubGlobal('getenv', 'Eloquent\Composer\Configuration');
