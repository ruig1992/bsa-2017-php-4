<?php

namespace BinaryStudioAcademy\Game\Commands;

class ObserveCommand extends Command
{
    /**
     * Message template
     * @var string
     */
    protected $msgTemplate = "There {coins} coin(s) here.";

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        return $this->buildMessage([
            'coins' => $this->game->player->room->coins,
        ]);
    }
}
