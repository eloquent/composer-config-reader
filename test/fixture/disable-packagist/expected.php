<?php

namespace Eloquent\Composer\Configuration\Element;

return new Configuration(
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    [
        new PackagistRepository(false, $rawData->repositories[0]),
    ],
    new ProjectConfiguration(
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        '/path/to/composer/cache',
        '/path/to/composer/cache/files',
        '/path/to/composer/cache/repo',
        '/path/to/composer/cache/vcs'
    ),
    null,
    null,
    null,
    null,
    $rawData
);
