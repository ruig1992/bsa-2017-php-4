<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;

use BinaryStudioAcademy\Game\Worlds\DefaultWorld;
use BinaryStudioAcademy\Game\Contracts\GameWorld;

use BinaryStudioAcademy\Game\Commands\CommandManager;
use BinaryStudioAcademy\Game\Exceptions\ExitFromGame;

class Game
{
    const COIN_TO_WIN = 5;

    protected $player;
    protected $commandManager;

    /**
     * @param GameWorld|null $gameWorld
     */
    public function __construct(GameWorld $gameWorld = null)
    {
        $options = [
            'start' => 'hall',
            'rooms' => [
                'hall' => [
                    'availables' => ['basement', 'corridor'],
                    'things' => ['coin' => 1],
                ],
                'basement' => [
                    'availables' => ['hall', 'cabinet'],
                    'things' => ['coin' => 2],
                ],
                'corridor' => [
                    'availables' => ['hall', 'cabinet', 'bedroom'],
                ],
                'cabinet' => [
                    'availables' => ['corridor'],
                    'things' => ['coin' => 1],
                ],
                'bedroom' => [
                    'availables' => ['corridor'],
                    'things' => ['coin' => 1],
                ],
            ],
        ];

        $world = $gameWorld ?? new DefaultWorld($options);
        $this->player = $world->makePlayer();

        $this->commandManager = new CommandManager($this);
    }

    protected function processCommands(Reader $reader, Writer $writer): bool {
        try {
            $writer->writeln( $this->commandManager->call($reader->read()) );

        } catch (\Exception $e) {
            $writer->writeln($e->getMessage());
            if ($e instanceof ExitFromGame) {
                return false;
            }

        } finally {
            $writer->writeln('');
        }

        return true;
    }

    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln($this->commandManager->call('start'));
        $writer->writeln(
            $this->commandManager->call("set_player {$reader->read()}")
        );

        do {
            if (!$this->processCommands($reader, $writer)) {
                break;
            }
        } while (true);
    }

    public function run(Reader $reader, Writer $writer)
    {
        $this->processCommands($reader, $writer, true);
    }
}
