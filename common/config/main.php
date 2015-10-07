<?php
return [
    'language' => 'en-US',//'es-UY',//
    'name' => 'Relevando.com',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],

    ],
    
    
    'modules' => [
            'datecontrol' =>  [
                'class' => '\kartik\datecontrol\Module'
                    ]
        ]
    
    
    
];
