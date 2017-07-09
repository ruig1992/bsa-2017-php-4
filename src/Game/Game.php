<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\{
    Player,
    GameWorld,
    Io\Reader,
    Io\Writer
};
use BinaryStudioAcademy\Game\Worlds\DefaultWorld;
use BinaryStudioAcademy\Game\Commands\CommandManager;

class Game
{
    /**
     * End of game main condition
     */
    const COINS_TO_WIN = 5;
    /**
     * @var Player
     */
    private $player;
    /**
     * Game command manager
     * @var CommandManager
     */
    private $commandManager;

    /**
     * @param GameWorld|null $gameWorld
     */
    public function __construct(GameWorld $gameWorld = null)
    {
        $options = [
            //'start' => 'hall',
            'rooms' => [
                'hall' => [
                    'availables' => ['basement', 'corridor'],
                    'things' => ['coin' => 1],
                ],
                'basement' => [
                    'availables' => ['cabinet', 'hall'],
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

        $gameWorld = $gameWorld ?? new DefaultWorld($options);
        $this->player = $gameWorld->makePlayer();

        $this->commandManager = new CommandManager($this);
    }

    /**
     * PHP Magic Get
     * @param  string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        // Get the game's player
        if ($property === 'player') {
            return $this->player;
        }
        return null;
    }

    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln(
            $this->commandManager->call('start')->getMessage()
        );
        $writer->write('What is your name? -> ');
        $writer->writeln(
            $this->commandManager->call('setplayer', $reader->read())
                ->getMessage()
        );

        do {
            $writer->write('Your action -> ');
            $this->run($reader, $writer);

            if (CommandManager::isFinished()) {
                $writer->writeln(
                    $this->commandManager->call('bye')->getMessage()
                );
                break;
            }
        } while (true);
    }

    public function run(Reader $reader, Writer $writer): void
    {
        $input = trim($reader->read());
        // Explode the input data by a space
        $params = explode(' ', $input);
        // And get the first part from them -  the command's name
        $command = array_shift($params);

        // Prepare and call the necessary command to execute
        // using parameters, if they exists
        $this->commandManager->call($command, $params);
        // Get and write the result of the command execution
        $writer->writeln($this->commandManager->getMessage());
    }
}
