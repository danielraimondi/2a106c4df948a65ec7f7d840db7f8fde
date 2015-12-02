<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            // 'rules' => [
            //     [
            //         'pluralize'     => false,
            //         'class' => 'yii\rest\UrlRule', 
            //         'controller' => ['v1/product_cat', 'v1/client', 'v1/product', 'v1/survey', 'v1/route', 'v1/routeclient', 'v1/user'],
            //         'tokens' => [
            //             '{id}' => '<id:\\w+>'
            //         ],
                    
            //     ],
            // ],
            
            
            'rules' => [
                    
                    'GET <apiv:v\d+>/<controller:\w+>/<id:\d+>'     => '<apiv>/<controller>/view',
                    'GET <apiv:v\d+>/<controller:\w+>/<action:\w+>'  => '<apiv>/<controller>/<action>',
                    'POST <apiv:v\d+>/<controller:\w+>/<action:\w+>'  => '<apiv>/<controller>/<action>',
                    
                    'HEAD <apiv:v\d+>/<controller:\w+>'              => '<apiv>/<controller>/index',
                    'GET <apiv:v\d+>/<controller:\w+>'               => '<apiv>/<controller>/index',
                    'HEAD <apiv:v\d+>/<controller:\w+>/<id:(.)+>'    => '<apiv>/<controller>/view',
                    //'GET <apiv:v\d+>/<controller:\w+>/<id:(.)+>'     => '<apiv>/<controller>/view',
                    'POST <apiv:v\d+>/<controller:\w+>'    => '<apiv>/<controller>/create', 
                    'PUT <apiv:v\d+>/<controller:\w+>/<id:(.)+>'     => '<apiv>/<controller>/update',
                    'PATCH <apiv:v\d+>/<controller:\w+>/<id:(.)+>'   => '<apiv>/<controller>/update',
                    'DELETE <apiv:v\d+>/<controller:\w+>/<id:(.)+>'  => '<apiv>/<controller>/delete',
            ],       
        ]
    ],
    'params' => $params,
];