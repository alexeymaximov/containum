<?php

declare(strict_types=1);

use ArsMnemonica\Containum\containum as c;

require_once __DIR__ . '/../vendor/autoload.php';

/** @var mixed $map */
$map = c::map();
$map[$map] = 'data';

echo "Value associated with objective map key: {$map[$map]}\n";