<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Player;
use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class Game
{
    const COINS_TO_WIN = 5;

    protected $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function start(Reader $reader, Writer $writer): void
    {
        // Feel free to delete these lines

        $writer->writeln("You can't play yet. Please read input and convert it to commands.");
        $writer->writeln("Don't forget to create game's world.");

        $writer->write("Type your name: ");
        $this->player->setName($reader->read());

        $writer->writeln("Good luck with this game, {$this->player->getName()}!");
        $writer->writeln("===================================");

        do {
            $writer->write("Enter something: ");
            $input = trim($reader->read());

            if ($input === 'error') {
                //throw new ErrorException('Error 1');
                //error_log('Error 1');
                break;
            }

            if ($input === 'exit') {
                $writer->writeln('');
                $writer->writeln("-xxx- Game over! Bye, {$this->player->getName()}!");
                $writer->writeln('');
                break;
            }

            $writer->writeln("--- You entered - {$input}");
            $writer->writeln('');

        } while (true);
    }

    public function run(Reader $reader, Writer $writer)
    {
        //TODO: Implement step by step mode with game state persistence between steps

        $writer->writeln("You can't play yet. Please read input and convert it to commands.");
        $writer->writeln("Don't forget to create game's world.");
    }
}
