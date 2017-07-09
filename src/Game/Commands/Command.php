<?php

namespace BinaryStudioAcademy\Game\Commands;

use Pixeler\Image;
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
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = '';
    /**
     * Message template
     * @var string
     */
    protected $msgTemplate;

    /**
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
        $this->fileTemplate = APP_TEMPLATES . $this->fileTemplate;
    }

    /**
     * Get content of the file template
     * @return string|false
     */
    protected function getFromFile()
    {
        if (!is_file($this->fileTemplate) || !is_readable($this->fileTemplate)) {
            return 'Template file ' . __CLASS__ . ' not found or not readable!';
        }
        return file_get_contents($this->fileTemplate);
    }

    /**
     * Build command's message by the template
     *
     * Data from $replace can be inserted into the template
     * instead of the corresponding markers {<name>}
     *
     * If the template encounters a marker {:: image = <file>},
     * it can be replaced with an image rendered
     * by the 'renderImage' function
     *
     * @param  array $replace
     * @return string
     */
    protected function buildMessage(array $replace = []): string
    {
        return preg_replace_callback_array(
            [
                '/{([\w-]+)}/i' =>
                    function($match) use($replace) {
                        return $replace[$match[1]] ?? '';
                    },

                '/{::image\s?=\s?([\w\.-]+?\.(?:jpe?g|png|gif))}/i' =>
                    function($match) {
                        $match[1] = APP_IMAGES . $match[1];
                        return $this->renderImage($match[1]);
                    }
            ],
            $this->msgTemplate
        );
    }

    /**
     * Render the image in CLI with UTF-8 dot matrix using 'Pixeler' library
     * @param  string $image  Image filename
     * @return Image  Pixeler image
     */
    protected function renderImage(string $image): Image
    {
        return Pixeler::image($image, 1.0, null, .95, 1);
    }

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    abstract public function execute($params = null): string;
}
