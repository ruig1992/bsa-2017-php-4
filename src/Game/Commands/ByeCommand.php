<?php

namespace BinaryStudioAcademy\Game\Commands;

class ByeCommand extends Command
{
    /**
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = 'bye.txt';

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        $this->msgTemplate = $this->getFromFile();

        return $this->buildMessage([
            'player' => $this->game->player->name,
        ]);
    }
}
