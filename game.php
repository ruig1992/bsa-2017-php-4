<?php

use BinaryStudioAcademy\Game as Game;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/files/config.php';

$reader = new \BinaryStudioAcademy\Game\Io\CliReader();
$writer = new \BinaryStudioAcademy\Game\Io\CliWriter();

$game = new \BinaryStudioAcademy\Game\Game;
$game->start($reader, $writer);
