<?php

use BinaryStudioAcademy\Game as G;

require __DIR__ . '/vendor/autoload.php';

try {
    $reader = new G\Io\CliReader();
    $writer = new G\Io\CliWriter();

    $game = new G\Game(new G\DefaultPlayer);

    $game->start($reader, $writer);

} catch (\Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}
