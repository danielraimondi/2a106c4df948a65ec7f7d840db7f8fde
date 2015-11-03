<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

class RouteclientController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Routeclient';    

	
}