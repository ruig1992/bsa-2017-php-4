<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class Game
{
    const COINS_TO_WIN = 5;

    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln("You can't play yet. Please read input and convert it to commands.");
        $writer->writeln("Don't forget to create game's world.");

        $writer->write("Type your name: ");
        $input = trim($reader->read());

        $writer->writeln("Good luck with this game, {$input}!");
        $writer->writeln("===================================");

        //TODO: Implement infinite loop and process user's input

        // Feel free to delete these lines

        do {
            $writer->write("Enter something: ");
            $input = trim($reader->read());

            if ($input === 'error') {
                //throw new ErrorException('Error 1');
                //error_log('Error 1');
                break;
            }

            if ($input === 'exit') {
                $writer->writeln("Game over! Bye!");
                break;
            }

            $writer->writeln("--- You entered - {$input}\n");

        } while (true);
    }

    public function run(Reader $reader, Writer $writer)
    {
        //TODO: Implement step by step mode with game state persistence between steps

        $writer->writeln("You can't play yet. Please read input and convert it to commands.");
        $writer->writeln("Don't forget to create game's world.");
    }
}
