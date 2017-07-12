<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Commands\Command;
use BinaryStudioAcademy\Game\Commands\System\SystemCommand;
use BinaryStudioAcademy\Game\Exceptions\CommandNotFound;

class GameManager
{
    const APP_ROOT = '/src/files/';

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
     * Game Manager options
     * @var array
     */
    private static $options = [
        'IMAGES_PATH' => self::APP_ROOT . 'default/images/',
        'TEMPLATES_PATH' => self::APP_ROOT . 'default/templates/',
    ];

    /**
     * @param Game $game
     * @param array $options
     */
    public function __construct(Game $game, array $options = [])
    {
        $this->game = $game;
        $this->setOptions($options);
    }

    /**
     * Get Game Manager option by its name
     * @param  string $name
     * @return mixed
     */
    public static function get(string $name)
    {
        return self::$options[$name] ?? null;
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
     * Call the necessary system command to execute using parameters, if they exists
     * The system command can not be used by the player, only the system
     * @param  string $command
     * @param  array|string  $params
     * @return $this
     */
    public function callSystem(string $command, $params = null): self
    {
        try {
            $this->message = $this->create($command, true)->execute($params);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
        }

        return $this;
    }

    /**
     * Create the necessary command's instance
     * @param  string $command
     * @param  bool $isSystem  Is the system command?
     * @return Command
     * @throws CommandNotFound Exception
     */
    private function create(string $command, bool $isSystem = false): Command
    {
        $commandInstance = ucfirst($command);
        if ($isSystem) {
            $commandInstance = "System\\{$commandInstance}";
        }
        $commandInstance = '\\' . __NAMESPACE__ .
            "\\Commands\\{$commandInstance}Command";

        if (!class_exists($commandInstance) ||
            !(($commandInstance = new $commandInstance($this->game))
                instanceof Command) ||
            $isSystem !== $commandInstance::IS_SYSTEM
        ) {
            throw new CommandNotFound($command);
        }

        return $commandInstance;
    }

    /**
     * Set options of the Game Manager
     * @param array $options
     * @return $this
     */
    private function setOptions(array $options = []): self
    {
        if (!empty($options['IMAGES_PATH'])) {
            self::$options['IMAGES_PATH'] = self::APP_ROOT .
                $options['IMAGES_PATH'];
        }
        if (!empty($options['TEMPLATES_PATH'])) {
            self::$options['TEMPLATES_PATH'] = self::APP_ROOT .
                $options['TEMPLATES_PATH'];
        }

        self::$options['IMAGES_PATH'] = $this->getEnvRoot() .
            self::$options['IMAGES_PATH'];

        self::$options['TEMPLATES_PATH'] = $this->getEnvRoot() .
            self::$options['TEMPLATES_PATH'];

        return $this;
    }

    /**
     * Gets the value of an environment PWD variable
     * @return string
     */
    private function getEnvRoot(): string
    {
        return getenv('PWD');
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
}
