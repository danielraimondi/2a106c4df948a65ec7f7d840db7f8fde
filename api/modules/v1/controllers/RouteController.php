<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

class RouteController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Route';    

	

    
    public function actionClientes(){
	    
	    $user_id = $_GET["user_id"];
	    $clientes = (new \yii\db\Query())
	        ->select('*')
            ->from('route r, client c')
            ->where('c.client_id=r.client_id and route_date=curdate() and r.user_id='.$user_id)  
            ->all();
        
        return $clientes;
        
    }
    
    
    
    
}