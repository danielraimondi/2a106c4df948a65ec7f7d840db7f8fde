<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=relevando',
            'username' => 'danielraimondi',
            'password' => '',
            'charset' => 'utf8'
            ],
            
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'relevando2@gmail.com',
                'password' => 'mlrgxgrgitmgcumy',
                'port' => '587',
                'encryption' => 'tls',
                // 'port' => '587',
                // 'encryption' => 'ssl',
            ],
        ],
        
        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => [
                // here is the list of clients you want to use
                // you can read more in the "Available clients" section
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => '231187283207-nl6phcbmstc8r8httqerev2sneaqnj78.apps.googleusercontent.com',
                    'clientSecret' => '4TBuRLRDGIO1IdlGA7pjs2Mt',
                ],
            ],
        ],
        
        
    ]
];
