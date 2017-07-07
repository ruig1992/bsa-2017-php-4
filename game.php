<?php

use BinaryStudioAcademy\Game as G;

require __DIR__ . '/vendor/autoload.php';


$reader = new G\Io\CliReader();
$writer = new G\Io\CliWriter();

$game = new G\Game(new G\DefaultPlayer);

$game->start($reader, $writer);
