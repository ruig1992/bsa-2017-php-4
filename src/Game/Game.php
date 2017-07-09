<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\{
    Player,
    GameWorld,
    Io\Reader,
    Io\Writer
};
use BinaryStudioAcademy\Game\Worlds\DefaultWorld;

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
     * Game Manager
     * @var GameManager
     */
    private $gameManager;

    /**
     * @param GameWorld|null $gameWorld
     */
    public function __construct(GameWorld $gameWorld = null)
    {
        $options = require __DIR__ . '/../files/game_options.php';

        // Create the Game World and the Player
        $gameWorld = $gameWorld ?? new DefaultWorld($options['game']);
        $this->player = $gameWorld->makePlayer();

        // Initiate the Game Manager
        $this->gameManager = new GameManager($this, $options['app']);
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

    /**
     * The main game mode. Launches the game in a loop and polls the user input
     * @param  Reader $reader
     * @param  Writer $writer
     * @return void
     */
    public function start(Reader $reader, Writer $writer): void
    {
        // Start the Game. Welcome message...
        $writer->writeln(
            $this->gameManager->call('start')->getMessage()
        );

        // The request to enter the player's name
        $writer->write('What is your name? -> ');
        $writer->writeln(
            $this->gameManager->call('setplayer', $reader->read())
                ->getMessage()
        );

        do {
            // The request and the process of the action of the player
            $writer->write('Your action -> ');
            $this->run($reader, $writer);

            // If the player has won or entered the "Exit" command,
            // we end the game session
            if (GameManager::isFinished()) {
                $writer->writeln(
                    $this->gameManager->call('bye')->getMessage()
                );
                break;
            }
        } while (true);
    }

    /**
     * Starts the game in a step-by-step mode. Required for testing
     * @param  Reader $reader
     * @param  Writer $writer
     * @return void
     */
    public function run(Reader $reader, Writer $writer): void
    {
        $input = trim($reader->read());
        // Explode the input data by a space
        $params = explode(' ', $input);
        // And get the first part from them -  the command's name
        $command = array_shift($params);

        // Prepare and call the necessary command to execute
        // using parameters, if they exists
        $this->gameManager->call($command, $params);
        // Get and write the result of the command execution
        $writer->writeln($this->gameManager->getMessage());
    }
}
