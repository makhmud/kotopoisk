<?php

return array(

    'directories' => [
        'public' => [
            'path'  => public_path() . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR,
            'url'   => '/user/'
        ],
        'temporary' => [
            'path'  => sys_get_temp_dir() . DIRECTORY_SEPARATOR
        ]
    ],

    'formats' => [
        'big' => [
            'name'          => 'big',
            'width'         => 540,
            'height'        => 540,
            'prefix'   => 'big_'
        ],
        'medium' => [
            'name'          => 'medium',
            'width'         => 273,
            'height'        => 273,
            'prefix'   => 'medium_'
        ],
        'small' => [
            'name'          => 'small',
            'width'         => 116,
            'height'        => 75,
            'prefix'   => 'small_'
        ],
        'blured' => [
            'name'          => 'blured',
            'width'         => 1366,
            'height'        => 800,
            'prefix'   => 'blured-',
            'methods'       => [
                ['blur', [15] ],
                ['brightness', [-50] ]
            ]
        ]
    ]

);