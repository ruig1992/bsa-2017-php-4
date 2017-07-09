<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Game;
use BinaryStudioAcademy\Game\Exceptions\CommandNotFound;

class CommandManager
{
    /**
     * Game instance
     * @var Game
     */
    private $game;
    /**
     * Message from the command being executed
     * @var string
     */
    private $message = '';
    /**
     * Is game finished? (win or exit)
     * @var string
     */
    private static $isFinished = false;

    /**
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * PHP Magic call static func
     * @param  string $property
     * @return mixed
     */
    public static function __callStatic(string $name, array $args = [])
    {
        // Is game finished? (win or exit)
        if ($name === 'isFinished') {
            if (isset($args[0])) {
                self::$isFinished = !!$args[0];
            }
            return self::$isFinished;
        }
        return null;
    }

    /**
     * Get command's message
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Call the necessary command to execute using parameters, if they exists
     * @param  string $command
     * @param  array|string  $params
     * @return $this
     */
    public function call(string $command, $params = null): self
    {
        try {
            $this->message = $this->create($command)->execute($params);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
        }

        return $this;
    }

    /**
     * Create the necessary command's instance
     * @param  string $command
     * @return Command
     * @throws CommandNotFound Exception
     */
    protected function create(string $command): Command
    {
        $commandInstance = '\\' . __NAMESPACE__ . "\\{$command}Command";

        if (!class_exists($commandInstance) ||
            !(($commandInstance = new $commandInstance($this->game))
                instanceof Command)
        ) {
            throw new CommandNotFound($command);
        }

        return $commandInstance;
    }
}
