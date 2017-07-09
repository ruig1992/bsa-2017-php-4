<?php

namespace BinaryStudioAcademy\Game\Commands;

class SetplayerCommand extends Command
{
    /**
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = 'setplayer.txt';

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        $this->msgTemplate = $this->getFromFile();
        $player = $this->game->player->setName($params);

        return $this->buildMessage([
            'player' => $player->name,
        ]);
    }
}
