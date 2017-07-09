<?php

namespace BinaryStudioAcademy\Game\Commands;

use Pixeler\Pixeler;
use BinaryStudioAcademy\Game\Game;

abstract class Command
{
    /**
     * Game instance
     * @var Game
     */
    protected $game;
    /**
     * [$fileTemplate description]
     * @var string
     */
    protected $fileTemplate;
    /**
     * [$msgTemplate description]
     * @var string
     */
    protected $msgTemplate;

    /**
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    protected function getFromFile()
    {
        if (!is_file($this->fileTemplate) || !is_readable($this->fileTemplate)) {
            return 'Template file ' . __CLASS__ . ' not found or not readable!';
        }
        return file_get_contents($this->fileTemplate);
    }

    protected function buildMessage(array $replace = []): string
    {
        return preg_replace_callback_array(
            [
                '/{([\w-]+)}/i' => function($match) use($replace) {
                    return $replace[$match[1]] ?? '';
                },
                '/{::image\s?=\s?([\w\.-]+?\.(?:jpe?g|png|gif))}/i' => function($match) {
                    $match[1] = APP_IMAGES . $match[1];
                    return $this->renderImage($match[1]);
                }
            ],
            $this->msgTemplate
        );
    }

    protected function renderImage(string $image)
    {
        return Pixeler::image($image, 1.0, null, .95, 1);
    }

    abstract public function execute($params = null);
}
