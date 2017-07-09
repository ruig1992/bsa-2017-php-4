<?php

return [
    'app' => [
        //'IMAGES_PATH' => 'default/images/',
        //'TEMPLATES_PATH' => 'default/templates/',
    ],
    'game' => [
        //'start' => 'hall',
        'rooms' => [
            'hall' => [
                'availables' => ['basement', 'corridor'],
                'things' => ['coin' => 1],
            ],
            'basement' => [
                'availables' => ['cabinet', 'hall'],
                'things' => ['coin' => 2],
            ],
            'corridor' => [
                'availables' => ['hall', 'cabinet', 'bedroom'],
            ],
            'cabinet' => [
                'availables' => ['corridor'],
                'things' => ['coin' => 1],
            ],
            'bedroom' => [
                'availables' => ['corridor'],
                'things' => ['coin' => 1],
            ],
        ],
    ],
];
